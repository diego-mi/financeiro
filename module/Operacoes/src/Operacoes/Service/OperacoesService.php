<?php
namespace Operacoes\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class OperacoesService extends AbstractService
{
    public function __construct(EntityManager $em)
    {
        $this->strEntity = 'Operacoes\Entity\Operacoes';
        parent::__construct($em);
    }

}