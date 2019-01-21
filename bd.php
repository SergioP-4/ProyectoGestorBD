<?php
/**
 * Description of bd
 *
 * @author alumno
 */
class bd {

    private $conexion;
    private $h;
    private $u;
    private $p;

    public function __construct($h, $u, $p) {
        $this->h = $h;
        $this->u = $u;
        $this->p = $p;
        $this->conexion = $this->conectar();
    }

    public function conectar() {
        $conexion = new mysqli($this->h, $this->u, $this->p);
        if ($conexion->connect_errno) {
            $this->error = "Error Conectando..." . $conexion->connect_error;
        }
        return $conexion;
    }

    public function consultar(string $c): array {
        $filas = [];
        if ($this->conexion == null) {
            $this->conexion = $this->conectar();
        }
        $rtdo = $this->conexion->query($c);

        while ($fila = $rtdo->fetch_row()) {
            $filas[] = $fila;
        }
        return $filas;
    }

    public function cerrar() {
        $this->conexion->close();
    }

    /* public function conectarPDO($bd) {
      try {
      $dsn = "mysql:host=$this->host;dbname=$bd";
      $atributos = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
      PDO::ATTR_ERRMODE => true,
      PDO::ERRMODE_EXCEPTION => true];
      $conexionPDO = new PDO($dsn, $this->user, $this->pass, $atributos);
      return $conexionPDO;
      } catch (PDOException $ex) {
      return die("Error conectando a la base de datos " . $ex->getMessage());
      }
      } */
}
