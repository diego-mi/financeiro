<?php
namespace Prioridade\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class PrioridadeService extends AbstractService
{
    public function __construct(EntityManager $em)
    {
        $this->strEntity = 'Prioridade\Entity\Prioridade';
        parent::__construct($em);
    }

}