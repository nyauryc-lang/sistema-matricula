<?php

class Personal {
    private $id;
    private $nombres;
    private $correo;
    private $foto;

    public function __construct($id, $nombres, $correo, $foto) {
        $this->id = $id;
        $this->nombres = $nombres;
        $this->correo = $correo;
        $this->foto = $foto;
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; return $this; }

    public function getNombres() { return $this->nombres; }
    public function setNombres($nombres) { $this->nombres = $nombres; return $this; }

    public function getCorreo() { return $this->correo; }
    public function setCorreo($correo) { $this->correo = $correo; return $this; }

    public function getFoto() { return $this->foto; }
    public function setFoto($foto) { $this->foto = $foto; return $this; }
}
