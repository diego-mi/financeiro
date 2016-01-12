<?php
namespace Tipo\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class TipoService extends AbstractService
{
    public function __construct(EntityManager $em)
    {
        $this->strEntity = 'Tipo\Entity\Tipo';
        parent::__construct($em);
    }

}