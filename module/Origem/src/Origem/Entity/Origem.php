<?php

namespace Origem\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Origem
 *
 * @ORM\Table(name="origem")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Origem\Entity\OrigemRepository")
 */
class Origem extends AbstractEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="saldo_inicial", type="float", length=10, nullable=false)
     */
    private $saldoInicial;

    /**
     * @var string
     *
     * @ORM\Column(name="saldo_atual", type="float", length=10, nullable=true)
     */
    private $saldoAtual;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSaldoInicial()
    {
        return $this->saldoInicial;
    }

    /**
     * @param string $saldoInicial
     */
    public function setSaldoInicial($saldoInicial)
    {
        $this->saldoInicial = $saldoInicial;
    }

    /**
     * @return string
     */
    public function getSaldoAtual()
    {
        return $this->saldoAtual;
    }

    /**
     * @param string $saldoAtual
     */
    public function setSaldoAtual($saldoAtual)
    {
        $this->saldoAtual = $saldoAtual;
    }
}
