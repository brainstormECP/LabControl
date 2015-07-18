<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 07/07/2015
 * Time: 16:27
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="proyecto")
 * @ORM\Entity()
 */
class Proyecto extends Trabajo {

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $numero;





    /**
     * Set Numero
     *
     * @param string $numero
     * @return Proyecto
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get Numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }
}
