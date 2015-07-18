<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 07/07/2015
 * Time: 16:28
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="inventario_reactivo")
 * @ORM\Entity()
 */
class InventarioReactivo {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $cantidad;

    /**
     * @var reactivo
     * @ORM\ManyToOne(targetEntity="Reactivo", inversedBy="inventarioReactivos")
     * @ORM\JoinColumn(name="reactivoId", referencedColumnName="id")
     */
    protected $reactivo;

    /**
     * @ORM\OneToMany(targetEntity="SalidaReactivo", mappedBy="reactivo")
     */
    protected $salidas;

    /**
     * @ORM\OneToMany(targetEntity="EntradaReactivo", mappedBy="reactivo")
     */
    protected $entradas;

    public function __construct(){
        $this->entradas = new ArrayCollection();
        $this->salidas = new ArrayCollection();
    }


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
     * Set Cantidad
     *
     * @param string $cantidad
     * @return InventarioReactivo
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
     * @param \AppBundle\Entity\Reactivo $reactivo
     * @return InventarioReactivo
     */
    public function setReactivo(\AppBundle\Entity\Reactivo $reactivo = null)
    {
        $this->reactivo = $reactivo;

        return $this;
    }

    /**
     * Get Reactivo
     *
     * @return \AppBundle\Entity\Reactivo 
     */
    public function getReactivo()
    {
        return $this->reactivo;
    }

    /**
     * Add Salidas
     *
     * @param \AppBundle\Entity\SalidaReactivo $salidas
     * @return InventarioReactivo
     */
    public function addSalida(\AppBundle\Entity\SalidaReactivo $salidas)
    {
        $this->salidas[] = $salidas;

        return $this;
    }

    /**
     * Remove Salidas
     *
     * @param \AppBundle\Entity\SalidaReactivo $salidas
     */
    public function removeSalida(\AppBundle\Entity\SalidaReactivo $salidas)
    {
        $this->salidas->removeElement($salidas);
    }

    /**
     * Get Salidas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSalidas()
    {
        return $this->salidas;
    }

    /**
     * Add Entradas
     *
     * @param \AppBundle\Entity\EntradaReactivo $entradas
     * @return InventarioReactivo
     */
    public function addEntrada(\AppBundle\Entity\EntradaReactivo $entradas)
    {
        $this->entradas[] = $entradas;

        return $this;
    }

    /**
     * Remove Entradas
     *
     * @param \AppBundle\Entity\EntradaReactivo $entradas
     */
    public function removeEntrada(\AppBundle\Entity\EntradaReactivo $entradas)
    {
        $this->entradas->removeElement($entradas);
    }

    /**
     * Get Entradas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEntradas()
    {
        return $this->entradas;
    }
}
