<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 07/07/2015
 * Time: 16:24
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="tratamiento")
 * @ORM\Entity()
 */
class Tratamiento {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string",nullable=true)
     */
    protected $nombre;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $descripcion;


    /**
     * The Roles of the User
     *
     * A Bidirectional Many to Many relationship.
     *
     * @var Muestra[]
     * @ORM\ManyToMany(targetEntity="Muestra",mappedBy="tratamientos")
     */
    protected $muestras;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->muestras = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Tratamiento
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
     * Set Descripcion
     *
     * @param string $descripcion
     * @return Tratamiento
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get Descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Add Muestras
     *
     * @param \AppBundle\Entity\Muestra $muestras
     * @return Tratamiento
     */
    public function addMuestra(\AppBundle\Entity\Muestra $muestras)
    {
        $this->muestras[] = $muestras;

        return $this;
    }

    /**
     * Remove Muestras
     *
     * @param \AppBundle\Entity\Muestra $muestras
     */
    public function removeMuestra(\AppBundle\Entity\Muestra $muestras)
    {
        $this->muestras->removeElement($muestras);
    }

    /**
     * Get Muestras
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMuestras()
    {
        return $this->muestras;
    }
}
