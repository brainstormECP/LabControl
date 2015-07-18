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
 * @ORM\Table(name="reactivo")
 * @ORM\Entity()
 */
class Reactivo {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $nombre;

    /**
     * @ORM\OneToMany(targetEntity="InventarioReactivo", mappedBy="reactivo")
     */
    protected $inventarioReactivos;

    /**
     * @ORM\OneToMany(targetEntity="AnalisisReactivo", mappedBy="reactivo")
     */
    protected $analisisReactivos;

    public function __construct(){
        $this->analisisReactivos = new ArrayCollection();
        $this->inventarioReactivos = new ArrayCollection();
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
     * Set Nombre
     *
     * @param string $nombre
     * @return Reactivo
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get Nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add InventarioReactivos
     *
     * @param \AppBundle\Entity\InventarioReactivo $inventarioReactivos
     * @return Reactivo
     */
    public function addInventarioReactivo(\AppBundle\Entity\InventarioReactivo $inventarioReactivos)
    {
        $this->inventarioReactivos[] = $inventarioReactivos;

        return $this;
    }

    /**
     * Remove InventarioReactivos
     *
     * @param \AppBundle\Entity\InventarioReactivo $inventarioReactivos
     */
    public function removeInventarioReactivo(\AppBundle\Entity\InventarioReactivo $inventarioReactivos)
    {
        $this->inventarioReactivos->removeElement($inventarioReactivos);
    }

    /**
     * Get InventarioReactivos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInventarioReactivos()
    {
        return $this->inventarioReactivos;
    }

    /**
     * Add AnalisisReactivos
     *
     * @param \AppBundle\Entity\AnalisisReactivo $analisisReactivos
     * @return Reactivo
     */
    public function addAnalisisReactivo(\AppBundle\Entity\AnalisisReactivo $analisisReactivos)
    {
        $this->analisisReactivos[] = $analisisReactivos;

        return $this;
    }

    /**
     * Remove AnalisisReactivos
     *
     * @param \AppBundle\Entity\AnalisisReactivo $analisisReactivos
     */
    public function removeAnalisisReactivo(\AppBundle\Entity\AnalisisReactivo $analisisReactivos)
    {
        $this->analisisReactivos->removeElement($analisisReactivos);
    }

    /**
     * Get AnalisisReactivos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnalisisReactivos()
    {
        return $this->analisisReactivos;
    }
}
