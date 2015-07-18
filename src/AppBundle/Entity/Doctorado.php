<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 07/07/2015
 * Time: 16:26
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="doctorado")
 * @ORM\Entity()
 */
class Doctorado extends Trabajo {

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $especialidad;



    /**
     * Set Especialidad
     *
     * @param string $especialidad
     * @return Doctorado
     */
    public function setEspecialidad($especialidad)
    {
        $this->especialidad = $especialidad;

        return $this;
    }

    /**
     * Get Especialidad
     *
     * @return string 
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }
}
