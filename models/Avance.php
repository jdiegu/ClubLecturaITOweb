<?php
/*
Archivo:  Avance.php
Objetivo: clase que encapsula la información de un Avance
Autor: MoralesVazquezJuanDiego
*/
include_once("AccesoDatos.php");
class Avance
{
  private $id_avance = 0;
  private $num_control;
  private $id_libro;
  private $paginas_leidas = 0;
  private $paginas_totales = 0;
  private $comentario = "";
  private $fecha = "";

  public function setIdAvance($valor)
  {
    $this->id_avance = $valor;
  }
  public function getIdAvance()
  {
    return $this->id_avance;
  }
  public function setNumControl($valor)
  {
    $this->num_control = $valor;
  }
  public function getNumControl()
  {
    return $this->num_control;
  }
  public function setIdLibro($valor)
  {
    $this->id_libro = $valor;
  }
  public function getIdLibro()
  {
    return $this->id_libro;
  }
  public function setPaginasLeidas($valor)
  {
    $this->paginas_leidas = $valor;
  }
  public function getPaginasLeidas()
  {
    return $this->paginas_leidas;
  }
  public function setPaginasTotales($valor)
  {
    $this->paginas_totales = $valor;
  }
  public function getPaginasTotales()
  {
    return $this->paginas_totales;
  }
  public function setComentario($valor)
  {
    $this->comentario = $valor;
  }
  public function getComentario()
  {
    return $this->comentario;
  }
  public function setFecha($valor)
  {
    $this->fecha = $valor;
  }
  public function getFecha()
  {
    return $this->fecha;
  }

  function insertar()
  {
    $oAccesoDatos = new AccesoDatos();
    $sQuery = "";
    $nAfectados = -1;
    if (
      $this->num_control == null or $this->id_libro == ""
    )
      throw new Exception("Avance->insertar(): faltan datos");
    else {
      if ($oAccesoDatos->conectar()) {
        $sQuery = "INSERT INTO avances (num_control, id_libro, paginas_leidas, comentario, fecha, paginas_totales)
          VALUES (" .
          $this->num_control . "," .
          $this->id_libro . "," .
          $this->paginas_leidas . ",'" .
          $this->comentario . "'," .
          "NOW()" . "," .
          $this->paginas_totales . ")";


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
      $consulta = "SELECT * FROM avances where id_avance = " . $this->id_avance;
      $resultado = $oAccesoDatos->ejecutarConsulta($consulta);
      $oAccesoDatos->desconectar();
      if ($resultado) {
        $this->setIdAvance($resultado[0][0]);
        $this->setNumControl($resultado[0][1]);
        $this->setIdLibro($resultado[0][2]);
        $this->setPaginasLeidas($resultado[0][3]);
        $this->setComentario($resultado[0][4]);
        $oDate = new DateTime($resultado[0][5]);
        $this->setFecha($oDate->format('Y') . "-" . $oDate->format('m') . "-" . $oDate->format('d'));
        $this->setPaginasTotales($resultado[0][6]);
        $bRet = true;
      }
    }
    return $bRet;
  }

  public function eliminar()
  {
    $oAccesoDatos = new AccesoDatos();
    $nAfectados = -1;

    if ($this->id_avance == "") {
      throw new Exception("Evento->eliminar(): falta el id_avance");
    }

    if ($oAccesoDatos->conectar()) {
      $sQuery = "DELETE FROM avances WHERE id_avance = " . $this->id_avance;
      $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
      $oAccesoDatos->desconectar();
    }

    return $nAfectados;
  }

  public function modificar()
  {
    $oAccesoDatos = new AccesoDatos();
    $nAfectados = -1;

    if ($this->id_avance == 0 || $this->comentario == "" || $this->paginas_leidas == 0 || $this->paginas_totales == 0) {
      throw new Exception("Evento->modificar(): faltan datos");
    }

    if ($oAccesoDatos->conectar()) {
      $sQuery = "UPDATE avances
                 SET paginas_leidas = " . $this->paginas_leidas . " ,
                     paginas_totales = " . $this->paginas_totales . " ,
                     comentario = '" . $this->comentario . "' WHERE id_avance = " . $this->id_avance;
      $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
      $oAccesoDatos->desconectar();
    }

    return $nAfectados;
  }

  public function buscarTodos()
  {
    $oAccesoDatos = new AccesoDatos();
    $arrRS = null;
    $aAvances = array();
    $j = 0;
    if ($oAccesoDatos->conectar()) {
      $sQuery = "SELECT * FROM avances WHERE num_control = ". $this->num_control . " AND id_libro = ". $this->id_libro;;
      $arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
      $oAccesoDatos->desconectar();

      if ($arrRS) {
        foreach ($arrRS as $row) {
          $oAvances = new Avance();
          $oAvances->setIdAvance($row[0]);
          $oAvances->setNumControl($row[1]);
          $oAvances->setIdLibro($row[2]);
          $oAvances->setPaginasLeidas($row[3]);
          $oAvances->setComentario($row[4]);
          $oDate = new DateTime($row[5]);
          $oAvances->setFecha($oDate->format('Y') . "-" . $oDate->format('m') . "-" . $oDate->format('d'));
          $oAvances->setPaginasTotales($row[6]);
          $aAvances[$j] = $oAvances;
          $j = $j + 1;
        }

      }
    }

    return $aAvances;
  }


}
?>