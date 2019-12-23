<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 07/07/2015
 * Time: 16:26
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="actividad_cientifica")
 * @ORM\Entity()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="disc", type="string")
 * @ORM\DiscriminatorMap({
 *  "maestria" = "Maestria",
 *  "doctorado" = "Doctorado",
 *  "proyecto" = "Proyecto"
 * })
 */
class ActividadCientifica {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string",unique=true)
     */
    protected $nombre;

    /**
     * @ORM\OneToMany(targetEntity="Experimento", mappedBy="actividadCientifica")
     */
    protected $experimentos;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->experimentos = new ArrayCollection();
    }

    public function __toString(){
        return 'Actividad Científica ('.$this->getNombre().')';
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
     * @return ActividadCientifica
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
     * Add Experimentos
     *
     * @param \AppBundle\Entity\Experimento $experimentos
     * @return ActividadCientifica
     */
    public function addExperimento(\AppBundle\Entity\Experimento $experimentos)
    {
        $this->experimentos[] = $experimentos;

        return $this;
    }

    /**
     * Remove Experimentos
     *
     * @param \AppBundle\Entity\Experimento $experimentos
     */
    public function removeExperimento(\AppBundle\Entity\Experimento $experimentos)
    {
        $this->experimentos->removeElement($experimentos);
    }

    /**
     * Get Experimentos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExperimentos()
    {
        return $this->experimentos;
    }
}
