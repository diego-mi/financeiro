<?php
namespace Origem\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class OrigemService extends AbstractService
{
    public function __construct(EntityManager $em)
    {
        $this->strEntity = 'Origem\Entity\Origem';
        parent::__construct($em);
    }

    /**
     * @param array $data
     *
     * @return object
     */
    public function save(Array $data = array())
    {
        $data['operacao'] = $this->em->getRepository('Operacoes\Entity\Operacoes')
                                ->find($data['operacao']);

        return parent::save($data);
    }


}