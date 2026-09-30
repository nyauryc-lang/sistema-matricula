<?php
 
class Cursos {
 
    private $id;
    private $nombre_curso;
    private $creditos;
    private $id_profesor;
    private $nombre_profesor;
 
    public function __construct($id, $nombre_curso, $creditos, $id_profesor, $nombre_profesor = null)
    {
        $this->id = $id;
        $this->nombre_curso = $nombre_curso;
        $this->creditos = $creditos;
        $this->id_profesor = $id_profesor;
        $this->nombre_profesor = $nombre_profesor;
    }
 
    public function getId()
    {
        return $this->id;
    }
 
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
 
    public function getNombreCurso()
    {
        return $this->nombre_curso;
    }
 
    public function setNombreCurso($nombre_curso)
    {
        $this->nombre_curso = $nombre_curso;
        return $this;
    }
 
    public function getCreditos()
    {
        return $this->creditos;
    }
 
    public function setCreditos($creditos)
    {
        $this->creditos = $creditos;
        return $this;
    }
 
    public function getIdProfesor()
    {
        return $this->id_profesor;
    }
 
    public function setIdProfesor($id_profesor)
    {
        $this->id_profesor = $id_profesor;
        return $this;
    }

    public function getNombreProfesor()
    {
        return $this->nombre_profesor;
    }

    public function setNombreProfesor($nombre_profesor)
    {
        $this->nombre_profesor = $nombre_profesor;
        return $this;
    }
}
