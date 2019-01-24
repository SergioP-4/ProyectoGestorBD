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
    private $bd;

    public function __construct($h, $u, $p, $bd) {
        $this->h = $h;
        $this->u = $u;
        $this->p = $p;
        $this->bd = $bd;
        try {
            if (is_null($this->bd)) {
                $this->conexion = new PDO("mysql:host=$this->h;dbname=", $this->u, $this->p);
            } else {
                $this->conexion = new PDO("mysql:host=$this->h;dbname=$this->bd", $this->u, $this->p);
            }
        } catch (PDOException $ex) {
            echo "Error " . $ex->getMessage();
        }
    }

    public function conectado() {
        if ($this->conexion == true) {
            return true;
        }
    }

    public function select($c) {
        $baseDatos = [];
        $consulta = $this->conexion->prepare($c);
        $consulta->execute();
        while ($f = $consulta->fetch(PDO::FETCH_NUM)) {
            $baseDatos[] = $f;
        }
        return $baseDatos;
    }

    public function select_tables($c) {

    }

    public function cerrar() {
        $this->conexion->close();
    }

}
