<?php
namespace Gerador\Helper;

use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Class GeradorService
 * @package Gerador\Service
 */
class DirHelper
{
    const STR_MODULES_DIR_ZF2 = 'module';
    const STR_CONTROLLER_PATH = 'Controller';
    const STR_SERVICE_PATH = 'Service';
    const STR_FORM_PATH = 'Form';
    const STR_ENTITY_PATH = 'Entity';

    /**
     * Name for new Module
     *
     * @var string
     */
    protected $strModuleName = "";

    /**
     * Name for new Controller
     *
     * @var string
     */
    protected $strControllerName = "";

    /**
     * Name for new Form
     *
     * @var string
     */
    protected $strFormName = "";

    /**
     * Name for new Service
     *
     * @var string
     */
    protected $strServiceName = "";

    /**
     * Name for new Entity
     *
     * @var string
     */
    protected $strEntityName = "";

    /**
     * Name for new Route
     *
     * @var string
     */
    protected $strRouteName = "";

    /**
     * GeradorService constructor.
     *
     * @param array $arrValuesForSet Params for set on contruct
     */
    public function __construct(Array $arrValuesForSet = array())
    {
        $hydrator = new ClassMethods();
        $hydrator->hydrate($arrValuesForSet, $this);
    }

    /**
     * @return string
     */
    public function getStrModuleName()
    {
        return $this->strModuleName;
    }

    /**
     * @param string $strModuleName
     */
    public function setStrModuleName($strModuleName)
    {
        $this->strModuleName = $strModuleName;
    }

    /**
     * @return string
     */
    public function getStrControllerName()
    {
        return $this->strControllerName;
    }

    /**
     * @param string $strControllerName
     */
    public function setStrControllerName($strControllerName)
    {
        $this->strControllerName = $strControllerName;
    }

    /**
     * @return string
     */
    public function getStrFormName()
    {
        return $this->strFormName;
    }

    /**
     * @param string $strFormName
     */
    public function setStrFormName($strFormName)
    {
        $this->strFormName = $strFormName;
    }

    /**
     * @return string
     */
    public function getStrServiceName()
    {
        return $this->strServiceName;
    }

    /**
     * @param string $strServiceName
     */
    public function setStrServiceName($strServiceName)
    {
        $this->strServiceName = $strServiceName;
    }

    /**
     * @return string
     */
    public function getStrEntityName()
    {
        return $this->strEntityName;
    }

    /**
     * @param string $strEntityName
     */
    public function setStrEntityName($strEntityName)
    {
        $this->strEntityName = $strEntityName;
    }

    /**
     * @return string
     */
    public function getStrRouteName()
    {
        return $this->strRouteName;
    }

    /**
     * @param string $strRouteName
     */
    public function setStrRouteName($strRouteName)
    {
        $this->strRouteName = $strRouteName;
    }

    /**
     * Get Module diretory
     *
     * @exemple 'module/Newmodule'
     *
     * @return string
     */
    public function getStrDirPathModule()
    {
        return self::STR_MODULES_DIR_ZF2 . '/' . $this->getStrModuleName();
    }

    /**
     * Get Controller diretory
     *
     * @exemple 'module/Newmodule/src/Controller'
     * @return string
     */
    public function getStrDirPathController()
    {
        return $this->getStrDirPathModule() . '/src/' . self::STR_CONTROLLER_PATH;
    }

    /**
     * Get Form diretory
     *
     * @exemple 'module/Newmodule/src/Form
     * @return string
     */
    public function getStrDirPathForm()
    {
        return $this->getStrDirPathModule() . '/src/' . self::STR_FORM_PATH;
    }

    /**
     * Get Service diretory
     *
     * @exemple 'module/Newmodule/src/Service
     * @return string
     */
    public function getStrDirPathService()
    {
        return $this->getStrDirPathModule() . '/src/' . self::STR_SERVICE_PATH;
    }

    /**
     * Get Entity diretory
     *
     * @exemple 'module/Newmodule/src/Entity
     * @return string
     */
    public function getStrDirPathEntity()
    {
        return $this->getStrDirPathModule() . '/src/' . self::STR_ENTITY_PATH;
    }

    /**
     * Get Module namespace
     *
     * @exemple 'Module'
     * @return string
     */
    public function getStrModuleNamespace()
    {
        return $this->getStrModuleName();
    }

    /**
     * Get Controller namespace
     *
     * @exemple 'Module/Controller'
     * @return string
     */
    public function getStrControllerNamespace()
    {
        return $this->getStrModuleNamespace() . '\\' . self::STR_CONTROLLER_PATH;
    }

    /**
     * Get Form namespace
     *
     * @exemple 'Module/Form'
     * @return string
     */
    public function getStrFormNamespace()
    {
        return $this->getStrModuleNamespace() . '\\' . self::STR_FORM_PATH;
    }

    /**
     * Get Service namespace
     *
     * @exemple 'Module/Service'
     * @return string
     */
    public function getStrServiceNamespace()
    {
        return $this->getStrModuleNamespace() . '\\' . self::STR_SERVICE_PATH;
    }

    /**
     * Get Entity namespace
     *
     * @exemple 'Module/Entity'
     * @return string
     */
    public function getStrEntityNamespace()
    {
        return $this->getStrModuleNamespace() . '\\' . self::STR_ENTITY_PATH;
    }
}
