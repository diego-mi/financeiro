<?php

namespace Base\Form;

use Base\Message\MessageTrait;
use Zend\InputFilter\Input;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Validator\InArray;
use Zend\Validator\StringLength;

/**
 * Class AbstractFilter
 * @package Base
 */
class BaseInputFilter extends Input
{

    use MessageTrait;

    /**
     * AbstractFilter constructor.
     * @param null $strName
     * @param array $arrToHaystack
     * @param bool $booRequired
     * @param bool $booSetDefaultValidators
     * @param int $intMinLength
     * @param int $intMaxLength
     */
    public function __construct(
        $strName,
        Array $arrToHaystack = array(),
        $booRequired = true,
        $booSetDefaultValidators = true,
        $intMinLength = 0,
        $intMaxLength = 0
    ) {
        parent::__construct($strName);

        if (count($arrToHaystack)) {
            $this->getValidatorChain()->attach(
                $this->getHaystackValidator(
                    $arrToHaystack
                )
            );
        }

        if ($booRequired) {
            $this->setRequired($booRequired);
        }

        if ($booSetDefaultValidators) {
            $this->getFilterChain()
                ->attach(new StripTags())
                ->attach(new StringTrim());
        }

        $this->setMinAndMaxStringLengthValidator($intMinLength, $intMaxLength);
    }

    /**
     * Metodo para adicionar a validacao de foreign key
     *
     * @param array $arrParams
     * @return array
     */
    public function getHaystackValidator(Array $arrParams = array())
    {
        $arrToHaystack = array();
        foreach ($arrParams as $value) {
            if ($value) {
                $arrToHaystack[] = $value['value'];
            }
        }

        $arrHaystack = new InArray();
        $arrHaystack->setOptions([
            'haystack' => $arrToHaystack
        ]);

        return $arrHaystack;
    }

    /**
     * Metodo responsavel por criar o validator para min e max length
     *
     * @param integer $intMinLength
     * @param integer $intMaxLength
     * @return $this|bool
     */
    public function setMinAndMaxStringLengthValidator($intMinLength = 0, $intMaxLength = 0)
    {
        if ((!$intMinLength) && (!$intMaxLength)) {
            return false;
        }

        $objValidator = new StringLength([
            'min' => $intMinLength,
            'max' => $intMaxLength
        ]);

        $this->getValidatorChain()->attach($objValidator->setMessage($this->strMsgErrorNotEmpty));

        return $this;
    }
}
