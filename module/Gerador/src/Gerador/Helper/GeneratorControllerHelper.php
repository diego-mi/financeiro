<?php
namespace Gerador\Helper;

/**
 * Class GeradorService
 * @package Gerador\Service
 */
class GeneratorControllerHelper
{
    protected $strTemplateControllerDir = 'module/Gerador/Template/src/Controller/';

    /**
     * Index - Lista Resultados
     *
     * @param array $arrDataFromForm
     * @return boolean
     */
    public function createController(Array $arrDataFromForm = array())
    {
        $dirHelper = new DirHelper($arrDataFromForm);
        $maskHelper = new MaskHelper($dirHelper);

        $templateController = file_get_contents($this->strTemplateControllerDir . 'SkeletonController.php');


        $templateController = $maskHelper->searchAndReplaceAllMasks($templateController);

        file_put_contents(
            $dirHelper->getStrDirPathController() . '/' . $dirHelper->getStrControllerName() . '.php',
            $templateController
        );
        return true;
    }
}
