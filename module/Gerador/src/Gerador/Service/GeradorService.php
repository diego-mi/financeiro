<?php
namespace Gerador\Service;

use Doctrine\ORM\EntityManager;
use Gerador\Helper\GeneratorControllerHelper;
use Gerador\Helper\GeneratorFilterHelper;
use Gerador\Helper\GeneratorFormHelper;
use Gerador\Helper\Inepzend\Form\GeneratorInepzendFormHelper;
use Gerador\Helper\Inepzend\Filter\GeneratorInepzendFilterHelper;

/**
 * Class GeradorService
 * @package Gerador\Service
 */
class GeradorService
{
    protected $em;
    protected $gerenciarDiretorio;
    protected $generatorControllerHelper;
    protected $generatorFormHelper;

    /**
     * AbstractService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->generatorInepzendFilterHelper = new GeneratorInepzendFilterHelper($em);
        $this->gerenciarDiretorioService = new GerenciarDiretorioService();
        $this->generatorControllerHelper = new GeneratorControllerHelper();
        $this->generatorFormHelper = new GeneratorFormHelper($em);
        $this->generatorInepzendFormHelper = new GeneratorInepzendFormHelper($em);
        $this->generatorFilterHelper = new GeneratorFilterHelper($em);
    }

    /**
     * Metodo responsavel por criar um controller
     *
     * @param array $arrInfosController
     * @return bool
     */
    public function createController(Array $arrInfosController = array())
    {
        if ($this->isValidName($arrInfosController['strModuleName'])) {
            if ($this->gerenciarDiretorioService->createAllDir($arrInfosController)) {
                return $this->generatorControllerHelper->createController($arrInfosController);
            }
        }

        return false;
    }

    /**
     *
     *
     * @param string $strName
     * @return bool
     * @throws \Exception
     */
    private function isValidName($strName = "")
    {
        if (strlen($strName) == 0) {
            throw new \Exception('Path para criar o modulo nao pode ser vazio. Error: GeradorService::isValidName');
            die();
        }

        return true;
    }

    /**
     * Metodo responsavel por criar um form
     *
     * @param array $arrInfosForm
     * @return bool
     */
    public function createForm(Array $arrInfosForm = array())
    {
        if ($this->isValidName($arrInfosForm['strTableName'])) {
            if ($this->gerenciarDiretorioService->createAllDir($arrInfosForm)) {
                $this->generatorFormHelper->createNewForm($arrInfosForm);
            }
        }

        return false;
    }

    /**
     * Metodo responsavel por criar um form
     *
     * @param array $arrInfosForm
     * @return bool
     */
    public function createFormInepzend(Array $arrInfosForm = array())
    {
        if ($this->isValidName($arrInfosForm['strTableName'])) {
            if ($this->gerenciarDiretorioService->createAllDir($arrInfosForm)) {
                $this->generatorInepzendFormHelper->createNewForm($arrInfosForm);
            }
        }

        return false;
    }

    /**
     * Metodo responsavel por criar um filter para um form
     *
     * @param array $arrInfosForm
     * @return bool
     */
    public function createFilter(Array $arrInfosForm = array())
    {
        if ($this->isValidName($arrInfosForm['strTableName'])) {
            if ($this->gerenciarDiretorioService->createAllDir($arrInfosForm)) {
                $this->generatorFilterHelper->createNewFilter($arrInfosForm);
            }
        }

        return false;
    }


    /**
     * Metodo responsavel por criar um filter para um form
     *
     * @param array $arrInfosForm
     * @return bool
     */
    public function createFilterInepzend(Array $arrInfosForm = array())
    {
        if ($this->isValidName($arrInfosForm['strTableName'])) {
            if ($this->gerenciarDiretorioService->createAllDir($arrInfosForm)) {
                $this->generatorInepzendFilterHelper->createNewFilter($arrInfosForm);
            }
        }

        return false;
    }
}
