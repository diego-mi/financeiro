<?php
namespace Gerador\Common;

use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Trait GeradorService
 * @package Gerador\Common
 */
trait DirHelper
{
    private $strModulesDirZf2 = 'module';
    private $strControllerPath = 'Controller';
    private $strServicePath = 'Service';
    private $strFormPath = 'Form';
    private $strFilterPath = 'Form';
    private $strEntityPath = 'Entity';

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
     * Name for new Filter
     *
     * @var string
     */
    protected $strFilterName = "";

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
     * Method for set params
     * @param array $arrValuesForSet
     */
    public function initParams(Array $arrValuesForSet = array())
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
        $this->strModuleName = ucfirst($strModuleName);
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
        $this->strControllerName = ucfirst($strControllerName);
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
        $this->strFormName = ucfirst($strFormName);
    }

    /**
     * @return string
     */
    public function getStrFilterName()
    {
        return $this->strFilterName;
    }

    /**
     * @return string
     */
    public function getStrFilterNameWithPrefix()
    {
        return $this->strFilterName . 'Filter';
    }

    /**
     * @param string $strFilterName
     */
    public function setStrFilterName($strFilterName)
    {
        $this->strFilterName = ucfirst($strFilterName);
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
        $this->strServiceName = ucfirst($strServiceName);
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
        $this->strEntityName = ucfirst($strEntityName);
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
        return $this->strModulesDirZf2 . '/' . $this->getStrModuleName();
    }

    /**
     * Get Controller diretory
     *
     * @exemple 'module/Newmodule/src/Controller'
     * @return string
     */
    public function getStrDirPathController()
    {
        return $this->getStrDirPathModule() . '/src/' . $this->strControllerPath;
    }

    /**
     * Get Form diretory
     *
     * @exemple 'module/Newmodule/src/Form
     * @return string
     */
    public function getStrDirPathForm()
    {
        return $this->getStrDirPathModule() . '/src/' . $this->strFormPath;
    }

    /**
     * Get Filter diretory
     *
     * @exemple 'module/Newmodule/src/Filter
     * @return string
     */
    public function getStrDirPathFilter()
    {
        return $this->getStrDirPathModule() . '/src/' . $this->strFormPath;
    }

    /**
     * Get Service diretory
     *
     * @exemple 'module/Newmodule/src/Service
     * @return string
     */
    public function getStrDirPathService()
    {
        return $this->getStrDirPathModule() . '/src/' . $this->strServicePath;
    }

    /**
     * Get Entity diretory
     *
     * @exemple 'module/Newmodule/src/Entity
     * @return string
     */
    public function getStrDirPathEntity()
    {
        return $this->getStrDirPathModule() . '/src/' . $this->strEntityPath;
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
        return $this->getStrModuleNamespace() . '\\' . $this->strControllerPath;
    }

    /**
     * Get Form namespace
     *
     * @exemple 'Module/Form'
     * @return string
     */
    public function getStrFormNamespace()
    {
        return $this->getStrModuleNamespace() . '\\' . $this->strFormPath;
    }

    /**
     * Get Filter namespace
     *
     * @exemple 'Module/Filter'
     * @return string
     */
    public function getStrFilterNamespace()
    {
        return $this->getStrModuleNamespace() . '\\' . $this->strFormPath;
    }

    /**
     * Get Service namespace
     *
     * @exemple 'Module/Service'
     * @return string
     */
    public function getStrServiceNamespace()
    {
        return $this->getStrModuleNamespace() . '\\' . $this->strServicePath;
    }

    /**
     * Get Entity namespace
     *
     * @exemple 'Module/Entity'
     * @return string
     */
    public function getStrEntityNamespace()
    {
        return $this->getStrModuleNamespace() . '\\' . $this->strEntityPath;
    }
}
