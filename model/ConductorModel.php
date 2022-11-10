<?php

class ConductorModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_viajes;charset=utf8', 'root', '');
    }

    public function __destruct()
    {
        $this->db = null;
    }

    
    //PARA LA VISTA PRINCIPAL, Y PARA EL SELECT
    function getProgram()
    {
        $sentencia = $this->db->prepare('SELECT nombre, id_conductor FROM conductor');
        $sentencia->execute(array());
        $conductores = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return  $conductores;
    }
    // -------------------------------------MOSTRAR TABLAS----------------------------------------
    function getTableProgram()
    {
        $sentencia = $this->db->prepare('SELECT * FROM conductor');
        $sentencia->execute(array());
        $tablaConductores = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return  $tablaConductores;
    }
  


    public function filterProgram($id_conductor, $nombre_conductor)
    {
        $sentencia = $this->db->prepare("SELECT viaje.origen, conductor.id_conductor, viaje.id_viaje FROM conductor INNER JOIN viaje
                                            ON conductor.id_conductor = viaje.id_conductor WHERE conductor.id_conductor = ? AND conductor.nombre = ?");
        $sentencia->execute(array($id_conductor, $nombre_conductor));

        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    function getTableTrips($id, $nombre)
    {
        $sentencia = $this->db->prepare('SELECT nombre, id_conductor FROM conductor WHERE id_conductor= ? AND nombre = ? ');
        $sentencia->execute(array($id, $nombre));
        $conductores = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return  $conductores;
    }

    //   ------------------------------AGREGAR CONDUCTOR---------------------------------------------
    //AGREGAR CONDUCTOR

    function addProgram($nombre, $vehiculo)
    {
        $sentencia = $this->db->prepare("INSERT INTO conductor(nombre,vehiculo) VALUES(?,?)");
        $sentencia->execute(array($nombre, $vehiculo));
    }



    //   ------------------------------EDITAR BORRAR CONDUCTOR----------------------------------------------       

    // buscarIdConductorEnTablaViaje
    public function searchIdProgramByTableTrips($id_conductor)
    {
        $sentencia = $this->db->prepare("SELECT id_conductor FROM `viaje` WHERE id_conductor=?");
        $sentencia->execute(array($id_conductor));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    //BORRAR Conductor
    public function deleteProgram($id_conductor)
    {
        $sentencia = $this->db->prepare("DELETE FROM conductor WHERE id_conductor=?");
        $sentencia->execute(array($id_conductor));
    }
    //EDITAR CONDUCTOR
    public function editProgram($nombre, $vehiculo, $id_conductor)
    {
        $sentencia = $this->db->prepare("UPDATE `conductor` SET `nombre`=?,`vehiculo`=?WHERE `id_conductor`=?");
        $sentencia->execute(array($nombre, $vehiculo, $id_conductor));
    }
}
