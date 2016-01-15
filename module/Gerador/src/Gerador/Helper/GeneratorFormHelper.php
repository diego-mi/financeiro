<?php
namespace Gerador\Helper;

use Doctrine\ORM\EntityManager;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\DocBlockGenerator;
use Zend\Code\Generator\DocBlock\Tag;
use Zend\Code\Generator\FileGenerator;
use Zend\Code\Generator\MethodGenerator;

/**
 * Class GeneratorFormService
 * @package Gerador\Service
 */
class GeneratorFormHelper
{
    private $em;
    private $schema;
    private $dirHelper;
    private $newForm;
    private $objTable;

    /**
     * GeneratorFormService constructor.
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
            ->setName($this->dirHelper->getStrFormName())
            ->setNamespaceName($this->dirHelper->getStrFormNamespace())
            ->setExtendedClass('Form')
            ->setDocblock($this->getDocBlockForm());

        $this->addMethodsForNewForm();
        $this->addUseForNewForm();

        $this->generateNewForm();
    }

    /**
     * Metodo responsavel por popular valores nos itens necessarios, para uso em toda a classe
     *
     * @param array $arrInfosForm
     */
    private function init(Array $arrInfosForm = array())
    {
        $this->schema = $this->em->getConnection()->getSchemaManager()->createSchema();
        $this->newForm = new ClassGenerator();
        $this->dirHelper = new DirHelper();
        $this->dirHelper->initParams($arrInfosForm);
        $this->objTable = $this->schema->getTable($arrInfosForm['strTableName']);
    }

    /**
     * Metodo para criar docBlock pra o novo Form. Comentario de classe
     *
     * @return DocBlockGenerator
     */
    private function getDocBlockForm()
    {
        return DocBlockGenerator::fromArray([
            'shortDescription' => 'Form for Entity Categoria',
            'longDescription' => 'This is a class generated with Generator for skeleton-zend. By Diego-Mi'
        ]);
    }

    /**
     * Method for add USE for new form
     * For add more USE - add more ->addUse('namespace')
     */
    private function addUseForNewForm()
    {
        $this->newForm
            ->addUse('Zend\Form\Form')
            ->addUse($this->dirHelper->getStrFormNamespace() . '\\' . $this->dirHelper->getStrFilterName());
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
            $this->dirHelper->getStrDirPathForm() . '/' . $this->dirHelper->getStrFormName() . '.php',
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
            'shortDescription' => 'CategoriaForm constructor.'
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
        return 'parent::__construct(null);' . PHP_EOL .
        '$this->setAttribute("method", "POST");' . PHP_EOL .
        '$this->setInputFilter(new ' . $this->dirHelper->getStrFilterName() . '());' . PHP_EOL . PHP_EOL .
        $this->getInputs();
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
        $generatorInputFormHelper = new GeneratorInputFormHelper();
        $objColumns = $this->objTable->getColumns();

        foreach ($objColumns as $objColumn) {
            $strInputs .= $generatorInputFormHelper->createInput($objColumn);
        }

        $strInputs .= $generatorInputFormHelper->createInputBtnSubmit();

        return $strInputs;
    }
}
