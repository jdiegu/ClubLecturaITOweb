<?php
/*
Archivo:  Avance.php
Objetivo: clase que encapsula la información de un Avance
Autor: MoralesVazquezJuanDiego
*/
include_once("AccesoDatos.php");
class Estadisticas
{

  public function partiEvento()
  {
    $oAccesoDatos = new AccesoDatos();
    $datos = [];
    if ($oAccesoDatos->conectar()) {
      $consulta = "SELECT
                    e.nombre AS evento,
                    COUNT(p.id_participacion) AS total_participantes
                FROM eventos e
                JOIN participaciones p ON e.id_evento = p.id_evento
                GROUP BY e.id_evento";
      $resultado = $oAccesoDatos->ejecutarConsulta($consulta);
      $oAccesoDatos->desconectar();
      if ($resultado) {
        foreach ($resultado as $fila) {
          $datos[] = $fila;
        }
        return $datos;
      }
    }
    return $datos;
  }

  public function msgLibro()
  {
    $oAccesoDatos = new AccesoDatos();
    $datos = [];
    if ($oAccesoDatos->conectar()) {
      $consulta = "SELECT
                    l.nombre AS libro,
                    COUNT(m.id_mensaje) AS total_mensajes
                FROM libros l
                LEFT JOIN mensajes m ON l.id_libro = m.id_libro
                GROUP BY l.id_libro";
      $resultado = $oAccesoDatos->ejecutarConsulta($consulta);
      $oAccesoDatos->desconectar();
      if ($resultado) {
        foreach ($resultado as $fila) {
          $datos[] = $fila;
        }
        return $datos;
      }
    }
    return $datos;
  }


}
?>