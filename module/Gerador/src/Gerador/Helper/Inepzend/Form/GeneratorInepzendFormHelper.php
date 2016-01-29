<?php
namespace Gerador\Helper\Inepzend\Form;

use Doctrine\ORM\EntityManager;
use Gerador\Common\DirHelper;
use Gerador\Common\Nomenclatura;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\DocBlock\Tag\ParamTag;
use Zend\Code\Generator\DocBlockGenerator;
use Zend\Code\Generator\DocBlock\Tag;
use Zend\Code\Generator\DocBlock\Tag\ReturnTag;
use Zend\Code\Generator\FileGenerator;
use Zend\Code\Generator\MethodGenerator;

/**
 * Class GeneratorFormService
 * @package Gerador\Service
 */
class GeneratorInepzendFormHelper
{
    use Nomenclatura;
    use DirHelper;

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
    private $arrPrimaryKeys;

    /**
     * @var ClassGenerator
     */
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
     * Method for generate a new Form
     * @param array $arrInfosForm
     */
    public function createNewForm(Array $arrInfosForm = array())
    {
        $this->init($arrInfosForm);

        $this->newForm
            ->setName($this->getStrFormName())
            ->setNamespaceName($this->getStrFormNamespace())
            ->setExtendedClass('FormGenerator')
            ->setDocblock($this->getDocBlockForm());

        $this->addMethodsForNewForm();
        $this->addUseForNewForm();

        $this->generateNewForm();
    }

    /**
     * Metodo responsavel por popular valores nos itens necessarios, para uso em toda a classe
     *
     * @param array $arrInfosFilter
     */
    private function init(Array $arrInfosForm = array())
    {
        $this->schema = $this->em->getConnection()->getSchemaManager()->createSchema();
        $this->newForm = new ClassGenerator();
        $this->initParams($arrInfosForm);
        $this->objTable = $this->schema->getTable($arrInfosForm['strTableName']);
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
     * Metodo para criar docBlock pra o novo Form. Comentario de classe
     *
     * @return DocBlockGenerator
     */
    private function getDocBlockForm()
    {
        return DocBlockGenerator::fromArray([
            'shortDescription' => $this->getStrFormName(),
            'tags' => array(
                array(
                    'name' => 'name',
                    'description' => $this->getStrFormName(),
                ),
                array(
                    'name' => 'package',
                    'description' => $this->getStrModuleName(),
                ),
                array(
                    'name' => 'subpackage',
                    'description' => 'Form',
                ),
                array(
                    'name' => 'since',
                    'description' => date('d/m/Y'),
                ),
            ),
        ]);
    }

    /**
     * Method for add USE for new form
     * For add more USE - add more ->addUse('namespace')
     */
    private function addUseForNewForm()
    {
        $this->newForm
            ->addUse('InepZend\FormGenerator\FormGenerator');
    }

    /**
     * Metodo para gerar o novo form.
     *
     * Cria uma nova classe com o novo conteudo criado.
     * Apos criar a nova classe, cria um arquivo ou atualiza o arquivo existente, caso exista.
     */
    private function generateNewForm()
    {
        $file = FileGenerator::fromArray(array(
            'classes' => array($this->newForm)
        ));

        $code = $file->generate();
        file_put_contents(
            $this->getStrDirPathForm() . '/' . $this->getStrFormName() . '.php',
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
        return DocBlockGenerator::fromArray(array(
            'shortDescription' => 'Adiciona os filtros no form e habilitando a validacao na view.',
            'tags' => array(
                array(
                    'name' => 'name',
                    'description' => '__construct',
                ),
                new ParamTag(
                    '$strName',
                    'string'
                ),
                new ParamTag(
                    '$arrOption',
                    'array'
                )
            ),
        ));
    }

    /**
     * Method for add methods for new form
     * For add more methods, add after $this->createMethodConstruct()
     */
    private function addMethodsForNewForm()
    {
        $this->newForm->addMethods(
            [
                $this->createMethodConstruct(),
                $this->createMethodPrepareElements(),
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
        return MethodGenerator::fromArray([
            'name' => '__construct',
            'parameters' => ['strName', 'arrOption'],
            'body' => $this->getConstructContent(),
            'docblock' => $this->getDocBlockMethodConstruct(),
        ]);
    }

    /**
     * Metodo para criar o conteudo
     *
     * @return string
     */
    public function getConstructContent()
    {
        return 'parent::__construct($strName, $arrOption);' . PHP_EOL .
        '$this->setViewValidate(true);' . PHP_EOL .
        '$this->setInputFilter(new ' . $this->getStrFilterName() . '());' . PHP_EOL . PHP_EOL;
    }

    /**
     * Method for create method __construct
     *
     * @return MethodGenerator
     */
    private function createMethodPrepareElements()
    {
        return MethodGenerator::fromArray([
            'name' => 'prepareElements',
            'body' => $this->getPrepareElementsContent(),
            'docblock' => $this->getDocBlockMethodPrepareElements(),
        ]);
    }

    /**
     * Metodo para criar o conteudo
     *
     * @return string
     */
    public function getPrepareElementsContent()
    {
        return '# WELL Inicio.' . PHP_EOL .
        '$this->addHtml(' . "'" . '<div class="well">' . "'" .');' . PHP_EOL . PHP_EOL .
        $this->getInputs() . PHP_EOL . PHP_EOL .
        '$this->addHtml("</ div>");' . PHP_EOL . '# WELL Fim.' . PHP_EOL;
    }


    /**
     * Metodo para criar docBlock para o metodo prepareElements
     *
     * @return DocBlockGenerator
     */
    public function getDocBlockMethodPrepareElements()
    {
        return DocBlockGenerator::fromArray(array(
            'shortDescription' => 'Adicionando html, campos e botoes no formulario.',
            'tags' => array(
                array(
                    'name' => 'name',
                    'description' => 'prepareElements',
                ),
                new ReturnTag('$this')
            ),
        ));
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
            $generatorInputFormHelper = new GeneratorInepzendFormInputHelper(
                $objColumn,
                $this->isPrimaryKey($objColumn),
                $this->isForeignKey($objColumn)
            );
            $strInputs .= $generatorInputFormHelper->getStrCreateInputForm();
        }

        return $strInputs;
    }


    /**
     * Metodo para verificar se a coluna eh chave primaria
     *
     * @param Column $objColumn
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
     * @param Column $objColumn
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
