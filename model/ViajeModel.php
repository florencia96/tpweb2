<?php

class ViajeModel
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

        //----------Viajes POR id----------
    public function getTripById($id_viaje)
    {
        $sentencia = $this->db->prepare("SELECT * FROM viaje WHERE id_viaje = ?");
        $sentencia->execute(array($id_viaje));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
    
    public function getTrip()
    {
        $sentencia = $this->db->prepare("SELECT origen, id_viaje FROM viaje");
        $sentencia->execute(array());
        $viajes = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $viajes;
    }

     function getTrips()
    {
        $sentencia = $this->db->prepare('SELECT * FROM viaje');
        $sentencia->execute(array());
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

   function searchForMatches($id_conductor, $nombre){
    {
        $sentencia = $this->db->prepare('SELECT nombre, id_conductor FROM viaje WHERE id_conductor = ? AND nombre = ?');    
        $sentencia->execute(array($id_conductor, $nombre));
        $conductores = $sentencia->fetch(PDO::FETCH_OBJ);
        return  $conductores;
    }
   }
        //-----------------------INSERTAR viaje ------------------------------------------------     

    function  addTrip($origen, $destino, $fecha, $salida, $llegada, $precio, $id_conductor)
    {
        $sentencia = $this->db->prepare("INSERT INTO viaje(origen,destino,fecha,salida,llegada,precio,id_conductor) VALUES(?,?,?,?,?,?,?)");
        $sentencia->execute(array($origen, $destino, $fecha, $salida, $llegada, $precio, $id_conductor));

    }
        function getTableOfTrips()
    {
        $sentencia = $this->db->prepare('SELECT * FROM viaje');
        $sentencia->execute(array());
        $tablaViajes = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return  $tablaViajes;
    }

        //   ------------------------------EDITAR BORRAR VIAJES----------------------------------------------       

    //BORRAR VIAJE
    public function deleteTrip($id_viaje)
    {
        $sentencia = $this->db->prepare("DELETE FROM viaje WHERE id_viaje=?");
        $sentencia->execute(array($id_viaje));
    }

    public function editTrip($origen, $destino, $fecha, $salida, $llegada, $precio, $id_conductor, $id_viaje)
    {
        $sentencia = $this->db->prepare("UPDATE `viaje` SET `origen`=?,`destino`=?,`fecha`=?,`salida`=?,`llegado`=?,`precio`=?,`id_conductor`=? WHERE `id_viaje`=?");
        $sentencia->execute(array($origen, $destino, $fecha, $salida, $llegada, $precio, $id_conductor, $id_viaje));
    }
    // buscarIdConductorEnTablaViaje
    public function searchIdProgramByTableTrips($id_conductor)
    {
        $sentencia = $this->db->prepare("SELECT id_conductor FROM `viaje` WHERE id_conductor=?");
        $sentencia->execute(array($id_conductor));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
      
    }
 
}
