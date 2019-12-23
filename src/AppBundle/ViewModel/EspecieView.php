<?php

namespace AppBundle\ViewModel;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


class EspecieView {

    /**
     * @Assert\Date()
     */
    protected $fechaInicio;

    /**
     * @Assert\Date()
     * @Assert\Expression(
     *     "this.getFechaFin() > this.getFechaInicio()",
     *     message = "La fecha final no puede ser menor que la fecha inicial."
     * )
     */
    protected $fechaFin;

    protected $especie;

    /**
     * Set Especie
     *
     * @param \AppBundle\Entity\Especie $especie
     * @return EspecieView
     */
    public function setEspecie(\AppBundle\Entity\Especie $especie = null)
    {
        $this->especie = $especie;

        return $this;
    }

    /**
     * Get Especie
     *
     * @return \AppBundle\Entity\Especie
     */
    public function getEspecie()
    {
        return $this->especie;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return EspecieView
     */
    public function setFechaInicio($fecha)
    {
        $this->fechaInicio = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fecha
     * @return EspecieView
     */
    public function setFechaFin($fecha)
    {
        $this->fechaFin = $fecha;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }
}
