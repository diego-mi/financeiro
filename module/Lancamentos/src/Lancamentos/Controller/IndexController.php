<?php
namespace Lancamentos\Controller;

use Base\Controller\AbstractCrudController;

use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\DocBlockGenerator;
use Zend\Code\Generator\DocBlock\Tag;
use Zend\Code\Generator\MethodGenerator;
use Zend\Code\Generator\PropertyGenerator;
use Zend\Code\Generator\FileGenerator;

/**
 * Class IndexController
 * @package Lancamentos\Controller
 */
class IndexController extends AbstractCrudController
{

    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        $this->strForm = 'Lancamentos\Form\LancamentosForm';
        $this->controller = 'lancamentos';
        $this->route = 'lancamentos/default';
        $this->strService = 'Lancamentos\Service\LancamentosService';
        $this->strEntity = 'Lancamentos\Entity\Lancamentos';
    }

    /**
     * Index - Lista Resultados
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        $foo      = new ClassGenerator();
        $docblock = DocBlockGenerator::fromArray(array(
            'shortDescription' => 'Sample generated class',
            'longDescription'  => 'This is a class generated with Zend\Code\Generator.',
            'tags'             => array(
                array(
                    'name'        => 'version',
                    'description' => '$Rev:$',
                ),
                array(
                    'name'        => 'license',
                    'description' => 'New BSD',
                ),
            ),
        ));
        $foo->setName('Foo')
            ->setDocblock($docblock)
            ->addProperties(array(
                array('_bar', 'baz',          PropertyGenerator::FLAG_PROTECTED),
                array('baz',  'bat',          PropertyGenerator::FLAG_PUBLIC)
            ))
            ->addConstants(array(
                array('bat',  'foobarbazbat', PropertyGenerator::FLAG_CONSTANT)
            ))
            ->addMethods(array(
                // Method passed as array
                MethodGenerator::fromArray(array(
                    'name'       => 'setBar',
                    'parameters' => array('bar'),
                    'body'       => '$this->_bar = $bar;' . "\n" . 'return $this;',
                    'docblock'   => DocBlockGenerator::fromArray(array(
                        'shortDescription' => 'Set the bar property',
                        'longDescription'  => null,
                        'tags'             => array(
                            new Tag\ParamTag(array(
                                'paramName' => 'bar',
                                'datatype'  => 'string'
                            )),
                            new Tag\ReturnTag(array(
                                'datatype'  => 'string',
                            )),
                        ),
                    )),
                )),
                // Method passed as concrete instance
                new MethodGenerator(
                    'getBar',
                    array(),
                    MethodGenerator::FLAG_PUBLIC,
                    'return $this->_bar;',
                    DocBlockGenerator::fromArray(array(
                        'shortDescription' => 'Retrieve the bar property',
                        'longDescription'  => null,
                        'tags'             => array(
                            new Tag\ReturnTag(array(
                                'datatype'  => 'string|null',
                            )),
                        ),
                    ))
                ),
            ));

        $file = FileGenerator::fromArray(array(
            'classes'  => array($foo),
            'docblock' => DocBlockGenerator::fromArray(array(
                'shortDescription' => 'Foo class file',
                'longDescription'   => null,
                'tags'             => array(
                    array(
                        'name'        => 'license',
                        'description' => 'New BSD',
                    ),
                ),
            )),
            'body'     => 'define(\'APPLICATION_ENV\', \'testing\');',
        ));

        $code = $file->generate();
        mkdir("module/Test");
        file_put_contents('module/Test/Foo.php', $code);
    }
}
