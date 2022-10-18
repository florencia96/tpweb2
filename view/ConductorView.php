<?php
require_once "helpers/AuthHelper.php";
require_once "./libs/smarty-3.1.39/libs/Smarty.class.php";

class ConductorView {

    private $smarty;
 

    public function __construct() {
        $this->smarty = new Smarty();
        $this->helper = new AuthHelper();
        $this->smarty->assign('mostrarTodo', true);
        $this->smarty->assign('nombre_conductor', "");
      
    }

    public function showHome($conductores=""){
        $this->smarty->assign('conductores', $conductores);
        $this->smarty->display('templates/conductores.tpl');
    }

    public function renderDegreeProgram($viajes, $nombre = ""){
        $this->smarty->assign('viajes', $viajes);
        $this->smarty->assign('nombre_conductor', $nombre);
        $this->smarty->display('templates/viajes.tpl');
    }


    //   -------------------------------FORMULARIO---------------------------------------
    //   -------------------VISTAS AGREGAR-----------------------------------
    //vista conductor
    public function formAddDegreeProgram($aviso="",$isAdmin=""){
        $this->smarty->assign('isAdmin', $isAdmin);
        $this->smarty->assign('aviso', $aviso);
        $this->smarty->display("templates/ingresaconductor.tpl");
    }

    

     //   -----------------------------VISTA TABLAS Conductor----------------------------------------
     public function renderTableDegreePrograms($isAdmin,$tablaConductores,$aviso=""){
        $this->smarty->assign('isAdmin', $isAdmin);
        $this->smarty->assign('tablaConductores', $tablaConductores);
      
        $this->smarty->assign('aviso', $aviso);
   
        $this->smarty->display("templates/editarborrarconductor.tpl");
    }
      //   ----------------------------location conductores----------------------------------------    
    public function renderTableOfLocationDegreePrograms(){
        header("Location: ".BASE_URL."tablaconductores");
    }


//   ----------------------------location----------------------------------------      
    public function showHomeLocation(){
        header("Location: ".BASE_URL."conductores");
    }

    public function showLocationToAddFormDegreeProgram(){

        header("Location: ".BASE_URL."agregarconductor");   
    }

   

}