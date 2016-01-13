<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Base\Form;

use DoctrineModule\Form\Element\ObjectSelect;

/**
 * Class SelectAbstract
 * @package Base\Form
 */
class SelectAbstract extends ObjectSelect
{
    /**
     * @var string $opentag
     */
    protected $opentag;

    /**
     * @var string $closetag
     */
    protected $closetag;

    /**
     * @return mixed
     */
    public function getOpentag()
    {
        return $this->opentag;
    }

    /**
     * @param mixed $opentag
     * @return $this
     */
    public function setOpentag($opentag)
    {
        $this->opentag = (string)$opentag;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClosetag()
    {
        return $this->closetag;
    }

    /**
     * @param mixed $closetag
     * @return $this
     */
    public function setClosetag($closetag)
    {
        $this->closetag = (string)$closetag;

        return $this;
    }
}
