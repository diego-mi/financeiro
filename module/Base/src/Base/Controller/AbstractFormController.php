<?php
namespace Base\Controller;

use Zend\Form\Form;
use Base\Controller\AbstractController;

/**
 * Class AbstractFormController
 * @package Base\Controller
 */
abstract class AbstractFormController extends AbstractController
{
    const CHECK_FORM_IS_POST = 3;
    const CHECK_FORM_IS_NOT_POST = 2;
    const CHECK_FORM_IS_VALID = 1;
    const CHECK_FORM_IS_NOT_VALID = 0;

    protected $strForm;

    /**
     * Inicializar formulario
     *
     * @param string $strFormNamespace Namespaces do formulario a inicializar
     *
     * @return \Zend\Form\Form
     */
    public function getForm($strFormNamespace = null)
    {
        if (is_null($strFormNamespace)) {
            $strFormNamespace = $this->strForm;
        }

        $form = $this->getServiceLocator()->get($strFormNamespace);

        if (is_null($form)) {
            echo(
                'Necessário um Form valido.
                Não foi possivel instanciar o form "' . $strFormNamespace . '"'
            );
            die();
        }

        return $form;
    }

    /**
     * Metodo para validar o isPost e isValid
     *
     * @param Form $form Formulario a ser validado
     *
     * @return int 0 -> invalid, 1 valid, 2 not isPost
     */
    public function checkFormIsValid(Form $form)
    {
        $objRequest = $this->getRequest();

        if ($objRequest->isPost()) {
            $form->setData($objRequest->getPost());
            return $form->isValid()
                ? self::CHECK_FORM_IS_VALID
                : self::CHECK_FORM_IS_NOT_VALID;
        } else {
            return self::CHECK_FORM_IS_NOT_POST;
        }
    }
}
