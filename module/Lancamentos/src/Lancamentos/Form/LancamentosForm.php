<?php
namespace Lancamentos\Form;

use DoctrineModule\Form\Element\ObjectSelect;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Zend\Form\Element\Button;
use Zend\Form\Element\Text;
use Zend\Form\Form;

use Lancamentos\Form\LancamentosFilter;

/**
 * Class LancamentosForm
 * @package Lancamentos\Form
 */
class LancamentosForm extends Form implements ObjectManagerAwareInterface
{
    protected $objectManager;

    /**
     * LancamentosForm constructor.
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->setObjectManager($objectManager);

        parent::__construct(null);
        $this->setAttribute('method', 'POST');
        $this->setAttribute('class', 'form-horizontal');


        $prioridade = new ObjectSelect('prioridade');
        $prioridade->setLabel('Prioridade')
            ->setOptions(array(
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Prioridade\Entity\Prioridade',
                'property' => 'name',
                'empty_option' => '--Selecione--',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy' => array('name' => 'ASC'),
                    ),
                ),
            ))
            ->setAttributes(array(
                'class' => 'form-control'
            ));
        $this->add($prioridade);

        $categoria = new ObjectSelect('categoria');
        $categoria->setLabel('Categoria')
            ->setOptions(array(
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Categoria\Entity\Categoria',
                'property' => 'name',
                'empty_option' => '--Selecione--',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy' => array('name' => 'ASC'),
                    ),
                ),
            ))
            ->setAttributes(array(
                'class' => 'form-control'
            ));
        $this->add($categoria);

        $operacao = new ObjectSelect('operacao');
        $operacao->setLabel('Operacoes')
            ->setOptions(array(
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Operacoes\Entity\Operacoes',
                'property' => 'name',
                'empty_option' => '--Selecione--',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy' => array('name' => 'ASC'),
                    ),
                ),
            ))
            ->setAttributes(array(
                'class' => 'form-control'
            ));
        $this->add($operacao);

        $origem = new ObjectSelect('origem');
        $origem->setLabel('Origem')
            ->setOptions(array(
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Origem\Entity\Origem',
                'property' => 'name',
                'empty_option' => '--Selecione--',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy' => array('name' => 'ASC'),
                    ),
                ),
            ))
            ->setAttributes(array(
                'class' => 'form-control'
            ));
        $this->add($origem);

        //Input Saldo Inicial
        $valorInicial = new Text('valorInicial');
        $valorInicial->setLabel('Valor Inicial')
            ->setAttributes(array(
                'maxlength' => 10,
                'class' => 'form-control'
            ));
        $this->add($valorInicial);

        //Input Saldo Inicial
        $valorFinal = new Text('valorFinal');
        $valorFinal->setLabel('Valor Final')
            ->setAttributes(array(
                'maxlength' => 10,
                'class' => 'form-control'
            ));
        $this->add($valorFinal);

        $tipo = new ObjectSelect('tipo');
        $tipo->setLabel('Tipo')
            ->setOptions(array(
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Tipo\Entity\Tipo',
                'property' => 'name',
                'empty_option' => '--Selecione--',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy' => array('name' => 'ASC'),
                    ),
                ),
            ))
            ->setAttributes(array(
                'class' => 'form-control'
            ));
        $this->add($tipo);

        //Botao submit
        $button = new Button('submit');
        $button->setAttributes(array(
                'type' => 'submit',
                'class' => 'btn btn-success',
                'value' => 'Salvar'
            ));
        $this->add($button);

        $this->setInputFilter(
            new LancamentosFilter(
                $categoria->getValueOptions(),
                $operacao->getValueOptions(),
                $origem->getValueOptions(),
                $tipo->getValueOptions(),
                $prioridade->getValueOptions()
            )
        );
    }

    /**
     * Set the object manager
     *
     * @param ObjectManager $objectManager
     */
    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Get the object manager
     *
     * @return ObjectManager
     */
    public function getObjectManager()
    {
        return $this->objectManager;
    }
}