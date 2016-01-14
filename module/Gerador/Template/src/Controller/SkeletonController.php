<?php
namespace {{getStrControllerNamespace}};

use Base\Controller\AbstractCrudController;

/**
 * Class {{getStrControllerName}}
 * @package {{getStrControllerNamespace}}
 */
class {{getStrControllerName}} extends AbstractCrudController
{

    /**
     * {{getStrControllerName}}Controller constructor.
     */
    public function __construct()
    {
        $this->strForm = '{{getStrFormNamespace}}\{{getStrFormName}}';
        $this->strController = '{{getStrControllerName}}';
        $this->strRoute = '{{getStrRouteName}}';
        $this->strService = '{{getStrServiceNamespace}}\{{getStrServiceName}}';
        $this->strEntity = '{{getStrEntityNamespace}}\{{getStrEntityName}}';
    }
}
