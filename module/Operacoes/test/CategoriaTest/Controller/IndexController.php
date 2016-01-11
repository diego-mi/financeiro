<?php

namespace CategoriaTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class IndexControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        var_dump("a");
        $this->setApplicationConfig(
            include 'C:\PROJETOS\PHP\project\config\application.config.php'
        );
        parent::setUp();
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->dispatch('/categoria');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Categoria');
        $this->assertControllerName('Categoria\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('categoria');
    }
}
