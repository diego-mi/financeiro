<?php
namespace Gerador\Helper;

/**
 * Class GeradorService
 * @package Gerador\Service
 */
class MaskHelper
{
    protected $dirHelper;

    /**
     * DirHelper constructor.
     * @param DirHelper $dirHelper
     */
    public function __construct(DirHelper $dirHelper)
    {
        $this->dirHelper = $dirHelper;
    }

    /**
     * Method for search a mask, remove template mask of mask and replace a mask with real value
     *
     * @param $templateController
     * @return array
     */
    public function searchAndReplaceAllMasks($templateController)
    {
        $arrMasks = $this->searchMasks($templateController);
        foreach ($arrMasks as $strMask) {
            $strMaskWithoutTemplateMask = $this->removeTemplateMask($strMask);
            $templateController = $this->replaceMask($templateController, $strMaskWithoutTemplateMask);
        }

        return $templateController;
    }

    /**
     * Search for masks on file '{{}}'
     *
     * @param $templateController
     *
     * @return array
     */
    private function searchMasks($templateController)
    {
        $arrMasks = array();
        preg_match_all('{{[a-zA-Z]+}}', $templateController, $arrMasks);

        return $arrMasks[0];
    }

    /**
     * Method for replace a mask for real value
     *
     * @param $templateController
     * @param $strMask
     * @return array
     */
    private function replaceMask($templateController, $strMask)
    {
        return str_replace(
            '{{' . $strMask . '}}',
            $this->dirHelper->$strMask(),
            $templateController
        );
    }

    /**
     * @param $strMask
     * @return mixed
     */
    private function removeTemplateMask($strMask)
    {
        $strMask = str_replace("{", "", $strMask);

        return str_replace("}", "", $strMask);
    }
}
