<?php
namespace Lancamentos\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class LancamentosService extends AbstractService
{
    public function __construct(EntityManager $em)
    {
        $this->strEntity = 'Lancamentos\Entity\Lancamentos';
        parent::__construct($em);
    }

    /**
     * @param array $data
     *
     * @return object
     */
    public function save(Array $data = array())
    {
        $data['categoria'] = $this->em->getRepository('Categoria\Entity\Categoria')
            ->find($data['categoria']);
        $data['operacao'] = $this->em->getRepository('Operacoes\Entity\Operacoes')
            ->find($data['operacao']);
        $data['origem'] = $this->em->getRepository('Origem\Entity\Origem')
            ->find($data['origem']);

        return parent::save($data);
    }


}