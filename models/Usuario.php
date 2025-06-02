<?php
/*
Archivo:  Usuario.php
Objetivo: clase que encapsula la información de un usuario
Autor: MoralesVazquezJuanDiego
*/
include_once("AccesoDatos.php");
class Usuario
{
  private $num_control;
  private $ap_paterno;
  private $ap_materno;
  private $nombre;
  private $correo;
  private $contrasena;
  private $tipo;
  private $imagen;

  public function setNumControl($valor)
  {
    $this->num_control = $valor;
  }
  public function getNumControl()
  {
    return $this->num_control;
  }
  public function setApPaterno($valor)
  {
    $this->ap_paterno = $valor;
  }
  public function getApPaterno()
  {
    return $this->ap_paterno;
  }
  public function setApMaterno($valor)
  {
    $this->ap_materno = $valor;
  }
  public function getApMaterno()
  {
    return $this->ap_materno;
  }
  public function setNombre($valor)
  {
    $this->nombre = $valor;
  }
  public function getNombre()
  {
    return $this->nombre;
  }

  public function getNombreCompleto()
  {
    return $this->ap_paterno . " " . $this->ap_materno . " " . $this->nombre;
    ;
  }

  public function setCorreo($valor)
  {
    $this->correo = $valor;
  }
  public function getCorreo()
  {
    return $this->correo;
  }
  public function setContrasena($valor)
  {
    $this->contrasena = $valor;
  }
  public function getContrasena()
  {
    return $this->contrasena;
  }

  public function setTipo($valor)
  {
    $this->tipo = $valor;
  }
  public function getTipo()
  {
    return $this->tipo;
  }
  public function setImagen($valor)
  {
    $this->imagen = $valor;
  }
  public function getImagen()
  {
    return $this->imagen;
  }

  public function buscarCvePwd()
  {
    $bRet = false;
    $sQuery = "";
    $arrRS = null;
    if (($this->num_control == 0 || $this->contrasena == ""))
      throw new Exception("Usuario->buscar: faltan datos");
    else {
      $sQuery = "SELECT num_control , ap_paterno, ap_materno, nombre , correo, contrasena , tipo, imagen
					   FROM usuarios
					   WHERE num_control = " . $this->num_control . "
					   AND contrasena = '" . $this->contrasena . "'";
      $oAD = new AccesoDatos();
      if ($oAD->conectar()) {
        $arrRS = $oAD->ejecutarConsulta($sQuery);
        $oAD->desconectar();
        if ($arrRS != null) {
          $this->setNumControl($arrRS[0][0]);
          $this->setApPaterno($arrRS[0][1]);
          $this->setApMaterno($arrRS[0][2]);
          $this->setNombre($arrRS[0][3]);
          $this->setCorreo($arrRS[0][4]);
          $this->setContrasena($arrRS[0][5]);
          $this->setTipo($arrRS[0][6]);
          $this->setImagen($arrRS[0][7]);
          $bRet = true;
        }
      }
    }
    return $bRet;
  }

  function insertar()
  {
    $oAccesoDatos = new AccesoDatos();
    $sQuery = "";
    $nAfectados = -1;
    if (
      $this->nombre == "" or $this->ap_paterno == "" or
      $this->ap_materno == "" or $this->contrasena == "" or $this->correo == ""
    )
      throw new Exception("Usuario->insertar(): faltan datos");
    else {
      if ($oAccesoDatos->conectar()) {
        $sQuery = "INSERT INTO usuarios (num_control, ap_paterno, ap_materno, nombre, correo, contrasena, tipo, imagen)
        VALUES (" . $this->num_control . ", '" . $this->ap_paterno . "', '" . $this->ap_materno . "',
        '" . $this->nombre . "', '" . $this->correo . "', '" . $this->contrasena . "', " . $this->tipo . ", '" . $this->imagen . "')";

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
      $consulta = "SELECT * FROM usuarios where num_control = " . $this->num_control;
      $resultado = $oAccesoDatos->ejecutarConsulta($consulta);
      $oAccesoDatos->desconectar();
      if ($resultado) {
        $this->setNumControl($resultado[0][0]);
        $this->setNombre($resultado[0][1]);
        $this->setApPaterno($resultado[0][2]);
        $this->setApMaterno($resultado[0][3]);
        $this->setCorreo($resultado[0][4]);
        $this->setContrasena($resultado[0][5]);
        $this->setTipo($resultado[0][6]);
        $this->setImagen($resultado[0][7]);

        $bRet = true;
      }
    }
    return $bRet;
  }

}
?>