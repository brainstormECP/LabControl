<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntradaReactivo
 *
 * @ORM\Table(name="entrada_reactivo")
 * @ORM\Entity
 */
class EntradaReactivo
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
     *
     * @ORM\Column(name="Cantidad", type="decimal", scale=2)
     */
    protected $cantidad;

    /**
     * @var reactivo
     * @ORM\ManyToOne(targetEntity="InventarioReactivo", inversedBy="entradas")
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
     * @return EntradaReactivo
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
     * @return EntradaReactivo
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
     * @return EntradaReactivo
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
