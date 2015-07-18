<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SalidaReactivo
 *
 * @ORM\Table(name="salida_reactivo")
 * @ORM\Entity
 */
class SalidaReactivo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected  $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha", type="date")
     */
    protected  $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="Cantidad", type="decimal")
     */
    protected  $cantidad;


    /**
     * @var Reactivo
     * @ORM\ManyToOne(targetEntity="InventarioReactivo", inversedBy="salidas")
     * @ORM\JoinColumn(name="inventarioReactivoId", referencedColumnName="id")
     */
    protected $reactivo;


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
     * @return SalidaReactivo
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
     * Set Cantidad
     *
     * @param string $cantidad
     * @return SalidaReactivo
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get Cantidad
     *
     * @return string 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set Reactivo
     *
     * @param \AppBundle\Entity\InventarioReactivo $reactivo
     * @return SalidaReactivo
     */
    public function setReactivo(\AppBundle\Entity\InventarioReactivo $reactivo = null)
    {
        $this->reactivo = $reactivo;

        return $this;
    }

    /**
     * Get Reactivo
     *
     * @return \AppBundle\Entity\InventarioReactivo 
     */
    public function getReactivo()
    {
        return $this->reactivo;
    }
}
