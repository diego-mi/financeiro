<?php

namespace Lancamentos\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Lancamentos
 *
 * @ORM\Table(name="lancamentos", indexes={
 *     @ORM\Index(name="lancamentos_ibfk_1", columns={"categoria"}),
 *     @ORM\Index(name="lancamentos_ibfk_2", columns={"operacao"}),
 *     @ORM\Index(name="lancamentos_ibfk_3", columns={"origem"}),
 * })
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Lancamentos\Entity\LancamentosRepository")
 */
class Lancamentos extends AbstractEntity
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
     * @var \Categoria\Entity\Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria\Entity\Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria", referencedColumnName="id")
     * })
     */
    private $categoria;

    /**
     * @var \Operacoes\Entity\Operacoes
     *
     * @ORM\ManyToOne(targetEntity="Operacoes\Entity\Operacoes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="operacao", referencedColumnName="id")
     * })
     */
    private $operacao;

    /**
     * @var \Origem\Entity\Origem
     *
     * @ORM\ManyToOne(targetEntity="Origem\Entity\Origem")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="origem", referencedColumnName="id")
     * })
     */
    private $origem;

    /**
     * @var float
     *
     * @ORM\Column(name="valor_inicial", type="float", length=10, nullable=false)
     */
    private $valorInicial;

    /**
     * @var float
     *
     * @ORM\Column(name="valor_final", type="float", length=10, nullable=false)
     */
    private $valorFinal;

    /**
     * @var \Tipo\Entity\Tipo
     *
     * @ORM\ManyToOne(targetEntity="Tipo\Entity\Tipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo", referencedColumnName="id")
     * })
     */
    private $tipo;

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
     * Set operacao
     *
     * @param \Operacoes\Entity\Operacoes $operacao
     *
     * @return Post
     */
    public function setOperacao(\Operacoes\Entity\Operacoes $operacao = null)
    {
        $this->operacao = $operacao;

        return $this;
    }

    /**
     * Get operacao
     *
     * @return \Operacoes\Entity\Operacoes
     */
    public function getOperacao()
    {
        return $this->operacao;
    }

    /**
     * @return \Categoria\Entity\Categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param \Categoria\Entity\Categoria $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    /**
     * @return \Origem\Entity\Origem
     */
    public function getOrigem()
    {
        return $this->origem;
    }

    /**
     * @param \Origem\Entity\Origem $origem
     */
    public function setOrigem($origem)
    {
        $this->origem = $origem;
    }

    /**
     * @return float
     */
    public function getValorInicial()
    {
        return $this->valorInicial;
    }

    /**
     * @param float $valorInicial
     */
    public function setValorInicial($valorInicial)
    {
        $this->valorInicial = $valorInicial;
    }

    /**
     * @return float
     */
    public function getValorFinal()
    {
        return $this->valorFinal;
    }

    /**
     * @param float $valorFinal
     */
    public function setValorFinal($valorFinal)
    {
        $this->valorFinal = $valorFinal;
    }

    /**
     * @return \Tipo\Entity\Tipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param \Tipo\Entity\Tipo $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }
}
