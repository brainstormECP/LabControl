<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 07/07/2015
 * Time: 16:25
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="pais")
 * @ORM\Entity()
 */
class Pais {

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
     * @ORM\OneToMany(targetEntity="Institucion", mappedBy="pais")
     */
    protected $instituciones;

    public function __construct(){
        $this->instituciones = new ArrayCollection();
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
     * @return Pais
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
     * Add Instituciones
     *
     * @param \AppBundle\Entity\Institucion $instituciones
     * @return Pais
     */
    public function addInstitucione(\AppBundle\Entity\Institucion $instituciones)
    {
        $this->instituciones[] = $instituciones;

        return $this;
    }

    /**
     * Remove Instituciones
     *
     * @param \AppBundle\Entity\Institucion $instituciones
     */
    public function removeInstitucione(\AppBundle\Entity\Institucion $instituciones)
    {
        $this->instituciones->removeElement($instituciones);
    }

    /**
     * Get Instituciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInstituciones()
    {
        return $this->instituciones;
    }
}
