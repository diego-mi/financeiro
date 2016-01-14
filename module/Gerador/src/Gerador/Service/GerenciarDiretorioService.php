<?php
namespace Gerador\Service;

use Gerador\Helper\DirHelper;

/**
 * Class GeradorService
 * @package Gerador\Service
 */
class GerenciarDiretorioService
{

    protected $dirHelper;

    /**
     * AbstractService constructor.
     */
    public function __construct()
    {

    }

    /**
     * Metodo responsavel por criar os diretorios necessarios
     *
     * @param array $arrDataFromForm
     * @return bool
     * @throws \Exception
     */
    public function createAllDir(Array $arrDataFromForm = array())
    {
        $this->dirHelper = new DirHelper($arrDataFromForm);
        if (!$this->createDirModule()) {
            throw new \Exception('Não foi possivel criar o diretorio para o modulo');
            exit();
        }

        if (!$this->createDirSrc()) {
            throw new \Exception('Não foi possivel criar o diretorio para o src');
            exit();
        }

        if (!$this->createDirController()) {
            throw new \Exception('Não foi possivel criar o diretorio para Controllers');
            exit();
        }

        if (!$this->createDirService()) {
            throw new \Exception('Não foi possivel criar o diretorio para o Service');
            exit();
        }

        if (!$this->createDirForm()) {
            throw new \Exception('Não foi possivel criar o diretorio para o Form');
            exit();
        }

        if (!$this->createDirEntity()) {
            throw new \Exception('Não foi possivel criar o diretorio para o Entity');
            exit();
        }

        return true;
    }

    /**
     * Metodo responsavel por verificar se existe a pasta do modulo em uso no gerador
     * @param string $strModuleName Path para o modulo
     * @return string
     * @throws \Exception
     */
    public function isExistDir($strModuleName = "")
    {
        return (file_exists($strModuleName)) ? true : false;
    }

    /**
     * @param string $strDirName
     * @return bool
     * @throws \Exception
     */
    public function createDir($strDirName = "")
    {
        if ($this->isExistDir($strDirName)) {
            return true;
        }

        try {
            mkdir($strDirName, 0777);
            return true;
        } catch (\Exception $objException) {
            var_dump($objException->getMessage());
            die();
        }
    }

    /**
     * @return bool
     */
    public function createDirModule()
    {
        return $this->createDir($this->dirHelper->getStrDirPathModule());
    }

    /**
     * @return bool
     */
    public function createDirSrc()
    {
        return $this->createDir($this->dirHelper->getStrDirPathModule() . '/src');
    }

    /**
     * @return bool
     */
    public function createDirController()
    {
        return $this->createDir($this->dirHelper->getStrDirPathController());
    }

    /**
     * @return bool
     */
    public function createDirService()
    {
        return $this->createDir($this->dirHelper->getStrDirPathService());
    }

    /**
     * @return bool
     */
    public function createDirForm()
    {
        return $this->createDir($this->dirHelper->getStrDirPathForm());
    }

    /**
     * @return bool
     */
    public function createDirEntity()
    {
        return $this->createDir($this->dirHelper->getStrDirPathEntity());
    }
}
