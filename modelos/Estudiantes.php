<?php

class Estudiantes {
    private $id;
    private $nombres;
    private $apellidos;
    private $direccion;
    private $telefono;
    private $email;
    private $foto;

    public function __construct($id, $nombres, $apellidos, $direccion, $telefono, $email, $foto) {
        $this->id = $id;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->foto = $foto;
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; return $this; }

    public function getNombres() { return $this->nombres; }
    public function setNombres($nombres) { $this->nombres = $nombres; return $this; }

    public function getApellidos() { return $this->apellidos; }
    public function setApellidos($apellidos) { $this->apellidos = $apellidos; return $this; }

    public function getDireccion() { return $this->direccion; }
    public function setDireccion($direccion) { $this->direccion = $direccion; return $this; }

    public function getTelefono() { return $this->telefono; }
    public function setTelefono($telefono) { $this->telefono = $telefono; return $this; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; return $this; }

    public function getFoto() { return $this->foto; }
    public function setFoto($foto) { $this->foto = $foto; return $this; }
}
