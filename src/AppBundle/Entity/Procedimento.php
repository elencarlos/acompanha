<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Procedimento
 *
 * @ORM\Table(name="procedimento")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProcedimentoRepository")
 */
class Procedimento
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="tempo_estimado", type="string", length=255, nullable=true)
     */
    private $tempoEstimado;

    /**
     * @ORM\ManyToOne(targetEntity="Paciente")
     * ORM\JoinColumn(name="paciente_id", referencedColumnName="id")
     */
    private $paciente;

    /**
     * @ORM\ManyToOne(targetEntity="Setor")
     * ORM\JoinColumn(name="setor_id", referencedColumnName="id")
     * ORM\Column(name="setor", type="integer", nullable=true)
     */
    private $setor;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Procedimento
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set tempoEstimado
     *
     * @param string $tempoEstimado
     *
     * @return Procedimento
     */
    public function setTempoEstimado($tempoEstimado)
    {
        $this->tempoEstimado = $tempoEstimado;

        return $this;
    }

    /**
     * Get tempoEstimado
     *
     * @return string
     */
    public function getTempoEstimado()
    {
        return $this->tempoEstimado;
    }

    /**
     * Set paciente
     *
     * @param \AppBundle\Entity\Paciente $paciente
     *
     * @return Procedimento
     */
    public function setPaciente(\AppBundle\Entity\Paciente $paciente = null)
    {
        $this->paciente = $paciente;

        return $this;
    }

    /**
     * Get paciente
     *
     * @return \AppBundle\Entity\Paciente
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * Set setor
     *
     * @param \AppBundle\Entity\Setor $setor
     *
     * @return Procedimento
     */
    public function setSetor($setor = null)
    {
        $this->setor = $setor;

        return $this;
    }

    /**
     * Get setor
     *
     * @return \AppBundle\Entity\Setor
     */
    public function getSetor()
    {
        return $this->setor;
    }
}
