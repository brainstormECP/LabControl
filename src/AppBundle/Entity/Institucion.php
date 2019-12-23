<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 07/07/2015
 * Time: 16:25
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="institucion")
 * @ORM\Entity()
 */
class Institucion {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    protected $nombre;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $direccion;

    /**
     * @var pais
     * @ORM\ManyToOne(targetEntity="Pais", inversedBy="instituciones")
     * @ORM\JoinColumn(name="paisId", referencedColumnName="id")
     */
    protected $pais;

    /**
     * @ORM\OneToMany(targetEntity="Investigador", mappedBy="institucion")
     */
    protected $investigadores;


    public function __toString(){
        return $this->getNombre();
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
     * @return Institucion
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
     * Set Direccion
     *
     * @param string $direccion
     * @return Institucion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get Direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set pais
     *
     * @param \AppBundle\Entity\Pais $pais
     * @return Institucion
     */
    public function setPais(\AppBundle\Entity\Pais $pais = null)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return \AppBundle\Entity\Pais 
     */
    public function getPais()
    {
        return $this->pais;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->investigadores = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add investigadores
     *
     * @param \AppBundle\Entity\Investigador $investigadores
     * @return Institucion
     */
    public function addInvestigadore(\AppBundle\Entity\Investigador $investigadores)
    {
        $this->investigadores[] = $investigadores;

        return $this;
    }

    /**
     * Remove investigadores
     *
     * @param \AppBundle\Entity\Investigador $investigadores
     */
    public function removeInvestigadore(\AppBundle\Entity\Investigador $investigadores)
    {
        $this->investigadores->removeElement($investigadores);
    }

    /**
     * Get investigadores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvestigadores()
    {
        return $this->investigadores;
    }
}
