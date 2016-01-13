<?php
namespace Gerador\Service;

use Doctrine\ORM\EntityManager;

/**
 * Class GeradorService
 * @package Gerador\Service
 */
class GeradorService
{
    const STR_MODULE_PATH = 'module';
    const STR_CONTROLLER_PATH = 'Controller';
    const STR_SERVICE_PATH = '/Service';
    const STR_FORM_PATH = 'Form';
    const STR_ENTITY_PATH = 'Entity';


    /**
     * AbstractService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->strEntity = 'Gerador\Entity\Gerador';
    }

    /**
     * @param array $arrInfosController
     * @return bool
     */
    public function criarController(Array $arrInfosController = array())
    {
        $arrInfosController['strModuleName'] = 'Teste1';

        return $this->createAllDir($arrInfosController['strModuleName']);
    }

    ///////////// Private Methods //////////////

    /**
     * Metodo responsavel por criar os diretorios necessarios
     *
     * @param string $strModuleName
     * @return bool
     * @throws \Exception
     */
    private function createAllDir($strModuleName = "")
    {
        if (strlen($strModuleName)==0) {
            throw new \Exception('Path do modulo nao pode ser vazio.');
            exit();
        }

        if (!$this->createDirModule($strModuleName)) {
            throw new \Exception('Não foi possivel criar o diretorio para o modulo');
            exit();
        }

        if (!$this->createDirController($strModuleName)) {
            throw new \Exception('Não foi possivel criar o diretorio para Controllers');
            exit();
        }

        if (!$this->createDirService($strModuleName)) {
            throw new \Exception('Não foi possivel criar o diretorio para o Service');
            exit();
        }

        if (!$this->createDirForm($strModuleName)) {
            throw new \Exception('Não foi possivel criar o diretorio para o Form');
            exit();
        }

        if (!$this->createDirEntity($strModuleName)) {
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
    private function isExistDir($strModuleName = "")
    {
        if (strlen($strModuleName)==0) {
            throw new \Exception('Path do modulo nao pode ser vazio.');
            die();
        }

        return (file_exists($strModuleName)) ? true : false;
    }

    /**
     * @param string $strModuleName
     * @return bool
     * @throws \Exception
     */
    private function createDir($strModuleName = "")
    {
        if (strlen($strModuleName)==0) {
            throw new \Exception('Path para criar o modulo nao pode ser vazio.');
            die();
        }

        if ($this->isExistDir($strModuleName)) {
            return true;
        }

        try {
            mkdir($strModuleName, 0777);
            return true;
        } catch (\Exception $objException) {
            var_dump($objException->getMessage());
            die();
        }
    }

    /**
     * @param string $strModuleName
     * @return bool
     */
    private function createDirModule($strModuleName = "")
    {
        return $this->createDir(self::STR_MODULE_PATH . '/' . $strModuleName);
    }

    /**
     * @param string $strModuleName
     * @return bool
     */
    private function createDirController($strModuleName = "")
    {
        return $this->createDir(self::STR_MODULE_PATH . '/' . $strModuleName . '/' . self::STR_CONTROLLER_PATH);
    }

    /**
     * @param string $strModuleName
     * @return bool
     */
    private function createDirService($strModuleName = "")
    {
        return $this->createDir(self::STR_MODULE_PATH . '/' . $strModuleName . '/' . self::STR_SERVICE_PATH);
    }

    /**
     * @param string $strModuleName
     * @return bool
     */
    private function createDirForm($strModuleName = "")
    {
        return $this->createDir(self::STR_MODULE_PATH . '/' . $strModuleName . '/' . self::STR_FORM_PATH);
    }

    /**
     * @param string $strModuleName
     * @return bool
     */
    private function createDirEntity($strModuleName = "")
    {
        return $this->createDir(self::STR_MODULE_PATH . '/' . $strModuleName . '/' . self::STR_ENTITY_PATH);
    }
}
