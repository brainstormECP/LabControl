<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 *
 * @ORM\Table(name="planificacion_corte_experimento")
 * @ORM\Entity
 */
class PlanificacionCorteExperimento
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected  $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha", type="date")
     */
    protected $fecha;

    /**
     * @var $descripcion
     *
     * @ORM\Column(name="string")
     */
    protected $descripcion;

    /**
     * @var experimento
     * @ORM\ManyToOne(targetEntity="Experimento", inversedBy="cortes")
     * @ORM\JoinColumn(name="experimentoId", referencedColumnName="id")
     */
    protected $experimento;

    /**
     * Get Id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Fecha
     *
     * @param \DateTime $fecha
     * @return PlanificacionCorteExperimento
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get Fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set Fecha
     *
     * @param string $descripcion
     * @return PlanificacionCorteExperimento
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get Fecha
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set Experimento
     *
     * @param \AppBundle\Entity\Experimento $experimento
     * @return PlanificacionCorteExperimento
     */
    public function setExperimento(\AppBundle\Entity\Experimento $experimento = null)
    {
        $this->experimento = $experimento;

        return $this;
    }

    /**
     * Get Experimento
     *
     * @return \AppBundle\Entity\Experimento
     */
    public function getExperimento()
    {
        return $this->experimento;
    }
}
