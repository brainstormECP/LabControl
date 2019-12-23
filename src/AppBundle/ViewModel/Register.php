<?php


namespace AppBundle\ViewModel;

use Symfony\Component\Validator\Constraints as Assert;

class Register {

    private $nombre;

    private $username;

    private $institucion;

    /**
     * @var email
     * @Assert\Email(
     *     message = "El correo '{{ value }}' no es una dirección de correo válida."
     * )
     */
    private $email;

    /**
     * @Assert\Length(
     *      min = 6,
     *      max = 15,
     *      minMessage = "La contraseña debe tener al menos {{ limit }} caracteres",
     *      maxMessage = "La contraseña debe tener como máximo {{ limit }} caracteres"
     * )
     */
    private $password;

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function getInstitucion(){
        return $this->institucion;
    }

    public function setInstitucion($institucion){
        $this->institucion = $institucion;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }
} 