<?php
/*
Archivo:  Participacio.php
Objetivo: clase que encapsula la información de un Participacio
Autor: MoralesVazquezJuanDiego
*/
include_once("AccesoDatos.php");
class Participacion
{
  private $id_participacion;
  private $num_control;
  private $id_evento;


  public function setIpParticipacion($valor)
  {
    $this->id_participacion = $valor;
  }
  public function getIdParticipacion()
  {
    return $this->id_participacion;
  }
  public function setNumControl($valor)
  {
    $this->num_control = $valor;
  }
  public function getNumControl()
  {
    return $this->num_control;
  }
  public function setIdEvento($valor)
  {
    $this->id_evento = $valor;
  }
  public function getIdEvento()
  {
    return $this->id_evento;
  }

  function insertar()
  {
    $oAccesoDatos = new AccesoDatos();
    $sQuery = "";
    $nAfectados = -1;
    if (
      $this->num_control == null or $this->id_evento == null
    )
      throw new Exception("Avance->insertar(): faltan datos");
    else {
      if ($oAccesoDatos->conectar()) {
        $sQuery = "INSERT INTO participaciones (num_control, id_evento)
          VALUES (" .
          $this->num_control . "," .
          $this->id_evento . ")";


        $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
        $oAccesoDatos->desconectar();
      }
    }
    return $nAfectados;
  }

  public function buscar()
  {
    $bRet = false;
    $oAccesoDatos = new AccesoDatos();
    if ($oAccesoDatos->conectar()) {
      $consulta = "SELECT * FROM participaciones where num_control = " . $this->num_control . " AND id_evento =" . $this->id_evento;
      $resultado = $oAccesoDatos->ejecutarConsulta($consulta);
      $oAccesoDatos->desconectar();
      if ($resultado) {
        $this->setIpParticipacion($resultado[0][0]);
        $this->setNumControl($resultado[0][1]);
        $this->setIdEvento($resultado[0][2]);
        $bRet = true;
      }
    }
    return $bRet;
  }

  public function eliminar()
  {
    $oAccesoDatos = new AccesoDatos();
    $nAfectados = -1;

    if ($this->id_participacion == 0) {
      throw new Exception("Parti->eliminar(): falta el id");
    }

    if ($oAccesoDatos->conectar()) {
      $sQuery = "DELETE FROM participaciones WHERE id_participacion = " . $this->id_participacion;
      $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
      $oAccesoDatos->desconectar();
    }

    return $nAfectados;
  }

}
?>