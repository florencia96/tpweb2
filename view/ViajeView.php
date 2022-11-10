<?php


require_once "./libs/smarty-3.1.39/libs/Smarty.class.php";

class ViajeView
{

    private $smarty;
  

    public function __construct()
    {
        $this->smarty = new Smarty();

    }


    public function renderTrip($viaje)
    {
        $this->smarty->assign('viaje', $viaje);
        $this->smarty->display("templates/detalle.tpl");
    }



    //   --------------------------FORMULARIO---------------------------------------
    //   -------------------VISTAS AGREGAR-----------------------------------

    //VISTA FORMULARIO PARA INGRESAR VIAJE ->ESTAN LOS CONDUCTORES PARA EL SELECT.
    public function renderFormTrip($conductores,$isAdmin)
    {
        $this->smarty->assign('conductores', $conductores);
        $this->smarty->assign('isAdmin', $isAdmin);
        $this->smarty->display("templates/ingresaviaje.tpl");
    }
    public function showLocationToAddFormTrips()
    {
        header("Location: " . BASE_URL . "agregarviaje");
    }

    //   -----------------------------VISTA TABLAS VIAJE----------------------------------------
    public function renderTableTrips($tablaViajes,$isAdmin)
    {
        
        $this->smarty->assign('isAdmin', $isAdmin);
        $this->smarty->assign('tablaViajes', $tablaViajes);
    
        $this->smarty->display("templates/editarborrarviaje.tpl");
    }

    //   ----------------------------location viaje----------------------------------------    
    public function renderTableOfLocationTrips()
    {
        header("Location: " . BASE_URL . "tablaviajes");
    }

    public function showHome()
    {
        header("Location: " . BASE_URL . "conductores");
    }

    public function renderTrips($viajes, $mostrarTodo = true)
    {
        $this->smarty->assign('viajes', $viajes);
        $this->smarty->assign('mostrarTodo', $mostrarTodo);
        $this->smarty->display("templates/viajes.tpl");
    }
}
