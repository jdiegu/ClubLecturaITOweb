<?php
/*
Archivo:  Libro.php
Objetivo: Clase que encapsula la información de un libro
Autor: MoralesVazquezJuanDiego
*/
include_once("AccesoDatos.php");
class Libro
{

  private $id_libro = 0;
  private $nombre;
  private $descripcion;
  private $autor;
  private $genero;
  private $portada;

  public function setIdLibro($valor)
  {
    $this->id_libro = $valor;
  }
  public function getIdLibro()
  {
    return $this->id_libro;
  }
  public function setNombre($valor)
  {
    $this->nombre = $valor;
  }
  public function getNombre()
  {
    return $this->nombre;
  }
  public function setDescripcion($valor)
  {
    $this->descripcion = $valor;
  }
  public function getDescripcion()
  {
    return $this->descripcion;
  }
  public function setAutor($valor)
  {
    $this->autor = $valor;
  }
  public function getAutor()
  {
    return $this->autor;
  }
  public function setGenero($valor)
  {
    $this->genero = $valor;
  }
  public function getGenero()
  {
    return $this->genero;
  }
  public function setPortada($valor)
  {
    $this->portada = $valor;
  }
  public function getPortada()
  {
    return $this->portada;
  }

  public function buscarTodos()
  {
    $oAccesoDatos = new AccesoDatos();
    $libros = array();
    if ($oAccesoDatos->conectar()) {
      $consulta = "SELECT * FROM libros";
      $resultado = $oAccesoDatos->ejecutarConsulta($consulta);
      $oAccesoDatos->desconectar();
      $j = 0;
      if ($resultado) {
        foreach ($resultado as $reg) {
          $libro = new Libro();
          $libro->setIdLibro($reg[0]);
          $libro->setNombre($reg[1]);
          $libro->setDescripcion($reg[2]);
          $libro->setAutor($reg[3]);
          $libro->setGenero($reg[4]);
          $libro->setPortada($reg[5]);
          $libros[$j] = $libro;
          $j = $j +1;
        }
      }
    }
    return $libros;
  }

  public function buscar()
  {
    $bRet = false;
    $oAccesoDatos = new AccesoDatos();
    if ($oAccesoDatos->conectar()) {
      $consulta = "SELECT * FROM libros where id_libro = ". $this->id_libro;
      $resultado = $oAccesoDatos->ejecutarConsulta($consulta);
      $oAccesoDatos->desconectar();
      if ($resultado) {
          $this->setIdLibro($resultado[0][0]);
          $this->setNombre($resultado[0][1]);
          $this->setDescripcion($resultado[0][2]);
          $this->setAutor($resultado[0][3]);
          $this->setGenero($resultado[0][4]);
          $this->setPortada($resultado[0][5]);
          $bRet = true;
      }
    }
    return $bRet;
  }

  public function insertar()
  {
    $oAccesoDatos = new AccesoDatos();
    $resultado = false;

    if ($oAccesoDatos->conectar()) {
      $consulta = "INSERT INTO libros (nombre, descripcion, autor, genero, portada)
         VALUES ('" . $this->nombre . "', '" . $this->descripcion . "', '" . $this->autor . "', '" . $this->genero . "', '" . $this->portada . "')";
      $resultado = $oAccesoDatos->ejecutarComando($consulta);
      $oAccesoDatos->desconectar();
    }

    return $resultado;
  }

  public function actualizar(){
    $oAccesoDatos = new AccesoDatos();
    $resultado = false;

    if ($oAccesoDatos->conectar()) {
      $consulta = "UPDATE libros SET nombre = '". $this->getNombre() ."', descripcion = '". $this->getDescripcion() ."', autor = '". $this->getAutor() . "', genero = '". $this->getGenero() ."', portada = '". $this->getPortada() . "' WHERE id_libro = ". $this->getIdLibro();
      $resultado = $oAccesoDatos->ejecutarComando($consulta);
      $oAccesoDatos->desconectar();
    }

    return $resultado;

  }


  public function eliminar()
  {
    $oAccesoDatos = new AccesoDatos();
    $resultado = false;

    if ($oAccesoDatos->conectar()) {
      $consulta = "DELETE FROM libros WHERE id_libro = " . $this->id_libro;
      $resultado = $oAccesoDatos->ejecutarComando($consulta);
      $oAccesoDatos->desconectar();
    }
    return $resultado;
  }

  public function misLibros($idUser){
    $oAccesoDatos = new AccesoDatos();
    $libros = array();
    if ($oAccesoDatos->conectar()) {
      $consulta = "SELECT DISTINCT l.id_libro, l.nombre,  l.descripcion, l.autor, l.genero, l.portada FROM avances a JOIN libros l ON a.id_libro = l.id_libro WHERE a.num_control = ". $idUser;
      $resultado = $oAccesoDatos->ejecutarConsulta($consulta);
      $oAccesoDatos->desconectar();
      $j = 0;
      if ($resultado) {
        foreach ($resultado as $reg) {
          $libro = new Libro();
          $libro->setIdLibro($reg[0]);
          $libro->setNombre($reg[1]);
          $libro->setDescripcion($reg[2]);
          $libro->setAutor($reg[3]);
          $libro->setGenero($reg[4]);
          $libro->setPortada($reg[5]);
          $libros[$j] = $libro;
          $j = $j +1;
        }
      }
    }
    return $libros;
  }

}
?>