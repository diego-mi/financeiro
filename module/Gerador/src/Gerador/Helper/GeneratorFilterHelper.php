<?php
namespace Gerador\Helper;

use Doctrine\ORM\EntityManager;
use Gerador\Helper\Filter\GeneratorFilterInputHelper;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\DocBlockGenerator;
use Zend\Code\Generator\DocBlock\Tag;
use Zend\Code\Generator\FileGenerator;
use Zend\Code\Generator\MethodGenerator;

/**
 * Class GeneratorFilterHelper
 * @package Gerador\Service
 */
class GeneratorFilterHelper
{
    /**
     * @var EntityManager
     */
    private $em;
    private $schema;

    /**
     * @var \Doctrine\DBAL\Schema\Table
     */
    private $objTable;

    /**
     * @var \Doctrine\DBAL\Schema\Index
     */
    private $objPrimaryKeys;

    private $dirHelper;
    private $newFilter;
    private $arrForeignKeys;

    /**
     * GeneratorFilterHelper constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Method for generate a new Filter
     * @param array $arrInfosFilter
     */
    public function createNewFilter(Array $arrInfosFilter = array())
    {
        $this->init($arrInfosFilter);

        $this->newFilter
            ->setName($this->dirHelper->getStrFilterName())
            ->setNamespaceName($this->dirHelper->getStrFilterNamespace())
            ->setExtendedClass('InputFilter')
            ->setDocblock($this->getDocBlockFilter());

        $this->addMethodsForNewFilter();
        $this->addUseForNewFilter();

        $this->generateNewFilter();
    }

    /**
     * Metodo responsavel por popular valores nos itens necessarios, para uso em toda a classe
     *
     * @param array $arrInfosFilter
     */
    private function init(Array $arrInfosFilter = array())
    {
        $this->schema = $this->em->getConnection()->getSchemaManager()->createSchema();
        $this->newFilter = new ClassGenerator();
        $this->dirHelper = new DirHelper();
        $this->dirHelper->initParams($arrInfosFilter);
        $this->objTable = $this->schema->getTable($arrInfosFilter['strTableName']);
        $arrForeignKeys = $this->objTable->getForeignKeys();
        $this->arrPrimaryKeys = $this->objTable->getPrimaryKey();
        foreach ($arrForeignKeys as $arrForeignKey) {
            $this->arrForeignKeys[$arrForeignKey->getColumns()[0]] = [
                'strColumns' => $arrForeignKey->getColumns()[0],
                'strForeignColumns' => $arrForeignKey->getForeignColumns()[0],
                'strForeignTableName' => $arrForeignKey->getForeignTableName()
            ];
        }
    }

    /**
     * Metodo para criar docBlock pra o novo Filter. Comentario de classe
     *
     * @return DocBlockGenerator
     */
    private function getDocBlockFilter()
    {
        return DocBlockGenerator::fromArray([
            'shortDescription' => 'Filter for Entity Categoria',
            'longDescription' => 'This is a class generated with Generator for skeleton-zend. By Diego-Mi'
        ]);
    }

    /**
     * Method for add USE for new form
     * For add more USE - add more ->addUse('namespace')
     */
    private function addUseForNewFilter()
    {
        $this->newFilter
            ->addUse('Zend\InputFilter\InputFilter')
            ->addUse('Zend\Filter\StringTrim')
            ->addUse('Zend\Filter\StripTags')
            ->addUse('Zend\InputFilter\Input')
            ->addUse('Zend\Validator\StringLength');
    }

    /**
     * Metodo para gerar o novo form.
     *
     * Cria uma nova classe com o novo conteudo criado.
     * Apos criar a nova classe, cria um arquivo ou atualiza o arquivo existente, caso exista.
     */
    private function generateNewFilter()
    {
        $file = FileGenerator::fromArray(array(
            'classes' => array($this->newFilter)
        ));

        $code = $file->generate();
        file_put_contents(
            $this->dirHelper->getStrDirPathFilter() . '/' . $this->dirHelper->getStrFilterName() . '.php',
            $code
        );
    }

    /**
     * Metodo para criar docBlock para o metodo __construct
     *
     * @return DocBlockGenerator
     */
    public function getDocBlockMethodConstruct()
    {
        $arrParameters = array_keys($this->arrForeignKeys);

        $arrTags = [];

        foreach ($arrParameters as $arrParameter) {
            $arrTags[] = new Tag\ParamTag(
                $arrParameter,
                'array',
                'Valores da tabela ' . $this->arrForeignKeys[$arrParameter]['strColumns']
            );
        }

        return DocBlockGenerator::fromArray(array(
            'shortDescription' => 'CategoriaFilter constructor.',
            'tags' => $arrTags
        ));

    }

    /**
     * Method for add methods for new form
     * For add more methods, add after $this->createMethodConstruct()
     */
    private function addMethodsForNewFilter()
    {
        $this->newFilter->addMethods(
            [
                $this->createMethodConstruct()
            ]
        );
    }

    /**
     * Method for create method __construct
     *
     * @return MethodGenerator
     */
    private function createMethodConstruct()
    {
        $arrParameters = array_keys($this->arrForeignKeys);

        return MethodGenerator::fromArray([
            'name' => '__construct',
            'parameters' => $arrParameters,
            'body' => $this->getInputs(),
            'docblock' => $this->getDocBlockMethodConstruct()
        ]);
    }

    /**
     * Metodo responsavel por criar os inputs para o novo form atraves da tabela no banco de dados
     * passada pelo form
     *
     * @return string
     */
    private function getInputs()
    {
        $strInputs = '';

        $objColumns = $this->objTable->getColumns();

        foreach ($objColumns as $objColumn) {
            $generatorInputFilterHelper = new GeneratorFilterInputHelper(
                $objColumn,
                $this->isPrimaryKey($objColumn),
                $this->isForeignKey($objColumn)
            );
            $strInputs .= $generatorInputFilterHelper->getStrCreateInputFilter();
        }

        return $strInputs;
    }

    /**
     * Metodo para verificar se a coluna eh chave primaria
     *
     * @param $objColumn
     * @return bool
     */
    private function isPrimaryKey($objColumn)
    {
        $booIsPrimaryKey = false;
        if (is_int(array_search($objColumn->getName(), $this->objTable->getPrimaryKey()->getColumns()))) {
            $booIsPrimaryKey = true;
        }
        return $booIsPrimaryKey;
    }

    /**
     * Metodo que verifica se a coluna eh foreign key, caso for - retorna os dados da chave estrangeira
     *
     * @param $objColumn
     * @return array
     */
    private function isForeignKey($objColumn)
    {
        $arrForeignKey = [];

        if (array_key_exists($objColumn->getName(), $this->arrForeignKeys)) {
            $arrForeignKey = $this->arrForeignKeys[$objColumn->getName()];
        }

        return $arrForeignKey;
    }
}
