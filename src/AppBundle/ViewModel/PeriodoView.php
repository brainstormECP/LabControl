<?php

namespace AppBundle\ViewModel;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


class PeriodoView {

    /**
     * @Assert\Date()
     */
    protected $fechaInicio;

    /**
     * @Assert\Date()
     */
    protected $fechaFin;

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return PeriodoView
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
     * @return PeriodoView
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
