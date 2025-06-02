<?php
/*
Archivo:  Evento.php
Objetivo: clase que encapsula la información de un Evento
Autor: MoralesVazquezJuanDiego
*/
include_once("AccesoDatos.php");

class Evento
{
  private $id_evento;
  private $nombre;
  private $descripcion;
  private $horario;
  private $fecha;
  private $lugar;
  private $imagen;

  public function setIdEvento($valor)
  {
    $this->id_evento = $valor;
  }
  public function getIdEvento()
  {
    return $this->id_evento;
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

  public function setHorario($valor)
  {
    $this->horario = $valor;
  }
  public function getHorario()
  {
    return $this->horario;
  }
  public function setFecha($valor)
  {
    $this->fecha = $valor;
  }
  public function getFecha()
  {
    return $this->fecha;
  }

  public function setLugar($valor)
  {
    $this->lugar = $valor;
  }
  public function getLugar()
  {
    return $this->lugar;
  }
  public function setImagen($valor)
  {
    $this->imagen = $valor;
  }
  public function getImagen()
  {
    return $this->imagen;
  }

  public function insertar()
  {
    $oAccesoDatos = new AccesoDatos();
    $nAfectados = -1;

    if ($this->nombre == "" || $this->descripcion == "" || $this->lugar == "") {
      throw new Exception("Evento->insertar(): faltan datos");
    }

    if ($oAccesoDatos->conectar()) {
      $sQuery = "INSERT INTO eventos (nombre, descripcion, fecha, horario, lugar, imagen)
                 VALUES ('" . $this->nombre . "',
                         '" . $this->descripcion . "',
                         '" . $this->fecha . "',
                         '" . $this->horario . "',
                         '" . $this->lugar . "',
                         '" . $this->imagen . "')";
      $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
      $oAccesoDatos->desconectar();
    }

    return $nAfectados;
  }

  public function modificar()
  {
    $oAccesoDatos = new AccesoDatos();
    $nAfectados = -1;

    if ($this->id_evento == "" || $this->nombre == "" || $this->descripcion == "" || $this->lugar == "") {
      throw new Exception("Evento->modificar(): faltan datos");
    }

    if ($oAccesoDatos->conectar()) {
      $sQuery = "UPDATE eventos
                 SET nombre = '" . $this->nombre . "',
                     descripcion = '" . $this->descripcion . "',
                     fecha = '" . $this->fecha . "',
                     horario = '" . $this->horario . "',
                     lugar = '" . $this->lugar . "',
                     imagen = '" . $this->imagen . "'
                 WHERE id_evento = " . $this->id_evento;
      $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
      $oAccesoDatos->desconectar();
    }

    return $nAfectados;
  }

  public function eliminar()
  {
    $oAccesoDatos = new AccesoDatos();
    $nAfectados = -1;

    if ($this->id_evento == "") {
      throw new Exception("Evento->eliminar(): falta el id_evento");
    }

    if ($oAccesoDatos->conectar()) {
      $sQuery = "DELETE FROM eventos WHERE id_evento = " . $this->id_evento;
      $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
      $oAccesoDatos->desconectar();
    }

    return $nAfectados;
  }

  public function buscarTodos()
  {
    $oAccesoDatos = new AccesoDatos();
    $arrRS = null;
    $aEventos = array();
    $j=0;
    if ($oAccesoDatos->conectar()) {
      $sQuery = "SELECT id_evento, nombre, descripcion, fecha, horario, lugar, imagen FROM eventos";
      $arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
      $oAccesoDatos->desconectar();

      if ($arrRS) {
        foreach ($arrRS as $row) {
          $oEvento = new Evento();
          $oEvento->setIdEvento($row[0]);
          $oEvento->setNombre($row[1]);
          $oEvento->setDescripcion($row[2]);
          $oDate = new DateTime($row[3]);
          $oEvento->setFecha($oDate->format('Y') ."-".$oDate->format('m') ."-". $oDate->format('d'));
          $oEvento->setHorario($row[4]);
          $oEvento->setLugar($row[5]);
          $oEvento->setImagen($row[6]);
          $aEventos[$j] = $oEvento;
          $j = $j +1;
        }

      }
    }

    return $aEventos;
  }

  public function buscar()
  {
    $bRet = false;
    $oAccesoDatos = new AccesoDatos();
    if ($oAccesoDatos->conectar()) {
      $consulta = "SELECT * FROM eventos where id_evento = ". $this->id_evento;
      $resultado = $oAccesoDatos->ejecutarConsulta($consulta);
      $oAccesoDatos->desconectar();
      if ($resultado) {
          $this->setIdEvento($resultado[0][0]);
          $this->setNombre($resultado[0][1]);
          $oDate = new DateTime($resultado[0][2]);
          $this->setFecha($oDate->format('Y') ."-".$oDate->format('m') ."-". $oDate->format('d'));
          $this->setHorario($resultado[0][3]);
          $this->setDescripcion($resultado[0][4]);
          $this->setLugar($resultado[0][5]);
          $this->setImagen($resultado[0][6]);

          $bRet = true;
      }
    }
    return $bRet;
  }

}
?>