<?php
namespace Gerador\Service;

use Doctrine\ORM\EntityManager;
use Gerador\Service\GerenciarDiretorioService;

/**
 * Class GeradorService
 * @package Gerador\Service
 */
class GeradorService
{
    protected $gerenciarDiretorio;

    /**
     * AbstractService constructor.
     */
    public function __construct()
    {
        $this->gerenciarDiretorioService = new GerenciarDiretorioService();
        $this->criarControllerService = new CriarControllerService();
    }

    /**
     * @param array $arrInfosController
     * @return bool
     */
    public function criarController(Array $arrInfosController = array())
    {
        if ($this->isValidName($arrInfosController['strModuleName'])) {
            if ($this->gerenciarDiretorioService->createAllDir($arrInfosController)) {
                return $this->criarControllerService->createController($arrInfosController);
            }
        }

        return false;
    }

    /**
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
}
