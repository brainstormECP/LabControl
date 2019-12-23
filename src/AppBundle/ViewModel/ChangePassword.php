<?php


namespace AppBundle\ViewModel;

use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;

class ChangePassword {


    /**
     * @SecurityAssert\UserPassword(
     *     message = "Su contraseña actual es incorrecta."
     * )
     */
    private $passwordAnterior;


    /**
     * @Assert\Length(
     *      min = 6,
     *      max = 15,
     *      minMessage = "La contraseña debe tener al menos {{ limit }} caracteres",
     *      maxMessage = "La contraseña debe tener como máximo {{ limit }} caracteres"
     * )
     */
    private $password;


    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getPasswordAnterior(){
        return $this->passwordAnterior;
    }

    public function setPasswordAnterior($passwordAnterior){
        $this->passwordAnterior = $passwordAnterior;
    }
} 