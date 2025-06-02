<?php
/*
Archivo:  Evento.php
Objetivo: clase que encapsula la información de un Evento
Autor: MoralesVazquezJuanDiego
*/
include_once("AccesoDatos.php");
include_once("Usuario.php");

class Mensaje
{

  private $id_mensaje = 0;
  private $id_libro = 0;
  private $num_control = 0;
  private $mensaje = "";

  private $usuario;

  public function setIdMensaje($valor)
  {
    $this->id_mensaje = $valor;
  }

  public function getIdMensaje()
  {
    return $this->id_mensaje;
  }

  public function setIdLibro($valor)
  {
    $this->id_libro = $valor;
  }

  public function getIdLibro()
  {
    return $this->id_libro;
  }

  public function setNumControl($valor)
  {
    $this->num_control = $valor;
  }

  public function getNumControl()
  {
    return $this->num_control;
  }

  public function setMensaje($valor)
  {
    $this->mensaje = $valor;
  }

  public function getMensaje()
  {
    return $this->mensaje;
  }

  public function setUsuario($valor)
  {
    $this->usuario = $valor;
  }

  public function getUsuario()
  {
    return $this->usuario;
  }

  public function buscarTodos()
  {
    $oAccesoDatos = new AccesoDatos();
    $arrRS = null;
    $aMsgs = array();
    $j = 0;
    if ($oAccesoDatos->conectar()) {
      $sQuery = "SELECT id_mensaje, id_libro, num_control, mensaje FROM mensajes WHERE id_libro = " . $this->getIdLibro();
      $arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
      $oAccesoDatos->desconectar();

      if ($arrRS) {
        foreach ($arrRS as $row) {
          $oMensaje = new Mensaje();
          $oMensaje->setIdMensaje($row[0]);
          $oMensaje->setIdLibro($row[1]);
          $oMensaje->setNumControl($row[2]);
          $oMensaje->setMensaje($row[3]);
          $oUser = new Usuario();
          $oUser->setNumControl($oMensaje->getNumControl());
          $oUser->buscar();

          $oMensaje->setUsuario($oUser);
          $aMsgs[$j] = $oMensaje;
          $j = $j + 1;
        }

      }
    }

    return $aMsgs;
  }

  public function insertar()
  {
    $oAccesoDatos = new AccesoDatos();
    $nAfectados = -1;

    if ($this->num_control == 0 || $this->id_libro==0) {
      throw new Exception("Mensaje->insertar(): faltan datos");
    }

    if ($oAccesoDatos->conectar()) {
      $sQuery = "INSERT INTO mensajes (num_control, id_libro, mensaje)
                 VALUES (" . $this->num_control . ",
                         " . $this->id_libro . ",
                         '" . $this->mensaje . "')";
      $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
      $oAccesoDatos->desconectar();
    }

    return $nAfectados;
  }

   public function eliminar()
  {
    $oAccesoDatos = new AccesoDatos();
    $nAfectados = -1;

    if ($this->id_mensaje == 0) {
      throw new Exception("Evento->eliminar(): falta el id_mensaje");
    }

    if ($oAccesoDatos->conectar()) {
      $sQuery = "DELETE FROM mensajes WHERE id_mensaje = " . $this->id_mensaje;
      $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
      $oAccesoDatos->desconectar();
    }

    return $nAfectados;
  }

}


?>