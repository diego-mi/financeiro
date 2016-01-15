<?php
namespace Gerador\Service;

use Doctrine\ORM\EntityManager;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\DocBlockGenerator;
use Zend\Code\Generator\DocBlock\Tag;
use Zend\Code\Generator\MethodGenerator;
use Zend\Code\Generator\PropertyGenerator;

class GeradorFormService
{
    private $em;
    private $schema;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->schema = $this->em->getConnection()->getSchemaManager()->createSchema();
    }

    public function createForm($strTable = '')
    {
        $table = $this->schema->getTable($strTable);

        var_dump($table);
    }

    public function getData()
    {
        $arrTables = $this->em->getConnection()->getSchemaManager()->listTableNames();

        foreach ($arrTables as $arrTable) {
            $schema = $this->em->getConnection()->getSchemaManager()->createSchema();
            $tableDetails = $schema->getTable($arrTable);
            var_dump($tableDetails->getName());
            echo "<br>";
            $arrColumns = $tableDetails->getColumns();
            foreach ($arrColumns as $arrColumn) {
                echo '<pre>';
                var_dump($arrColumn->toArray());
                echo '</pre>';
            }
        }
    }

    public function generate()
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

        echo $foo->generate();
    }

}


