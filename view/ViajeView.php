<?php


require_once "./libs/smarty-3.1.39/libs/Smarty.class.php";

class ViajeView
{

    private $smarty;
  

    public function __construct()
    {
        $this->smarty = new Smarty();

    }


    public function renderSubject($viaje)
    {
        $this->smarty->assign('viaje', $viaje);
        $this->smarty->display("templates/detalle.tpl");
    }



    //   --------------------------FORMULARIO---------------------------------------
    //   -------------------VISTAS AGREGAR-----------------------------------

    //VISTA FORMULARIO PARA INGRESAR VIAJE ->ESTAN LOS CONDUCTORES PARA EL SELECT.
    public function renderFormSubject($conductores,$isAdmin)
    {
        $this->smarty->assign('conductores', $conductores);
        $this->smarty->assign('isAdmin', $isAdmin);
        $this->smarty->display("templates/ingresaviaje.tpl");
    }
    public function showLocationToAddFormSubjects()
    {
        header("Location: " . BASE_URL . "agregarviaje");
    }

    //   -----------------------------VISTA TABLAS VIAJE----------------------------------------
    public function renderTableSubjects($tablaViajes,$isAdmin)
    {
        
        $this->smarty->assign('isAdmin', $isAdmin);
        $this->smarty->assign('tablaViajes', $tablaViajes);
    
        $this->smarty->display("templates/editarborrarviaje.tpl");
    }

    //   ----------------------------location viaje----------------------------------------    
    public function renderTableOfLocationSubjects()
    {
        header("Location: " . BASE_URL . "tablaviajes");
    }

    public function showHome()
    {
        header("Location: " . BASE_URL . "conductores");
    }

    public function renderSubjects($viajes, $mostrarTodo = true)
    {
        $this->smarty->assign('viajes', $viajes);
        $this->smarty->assign('mostrarTodo', $mostrarTodo);
        $this->smarty->display("templates/viajes.tpl");
    }
}
