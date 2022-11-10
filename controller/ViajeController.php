<?php
require_once "model\ViajeModel.php";
require_once "view\ViajeView.php";
require_once "helpers/AuthHelper.php";
require_once "model/ConductorModel.php";
require_once "view\UserView.php";
//Trip=viaje 
class ViajeController
{
    private $model;
    private $view;
    private $view_user;
    private $helper;
    private $conductor_model;

    public function __construct()
    {
        $this->model = new ViajeModel();
        $this->conductor_model = new ConductorModel();
        $this->view = new ViajeView();
        $this->view_user = new UserView();
        $this->helper = new AuthHelper();
    }
    //filtrar viajes
    public function filterTrip($id_viaje, $origen)
    {
        if (isset($id_viaje, $origen))
            if ($this->model->getTripById($id_viaje)) {
                $viaje = $this->model->getTripById($id_viaje);
                $this->view->renderTrip($id_viaje);
                
            } else
                $this->redirectHome();
        else
            $this->redirectHome();
    }



    //MOSTRAR FORMULARIO INSERTAR VIAJE
    public function formTrip()
    {

        $isAdmin = $this->helper->checkLoggedIn();
        $conductores = $this->conductor_model->getProgram();
        $this->view->renderFormTrip($conductores, $isAdmin);
    }


    //AGREGAR VIAJE
    public function addTrip()
    {

        if (isset($_POST['origen'], $_POST['destino'], $_POST['fecha'], $_POST['salida'], $_POST['llegada'], $_POST['precio'], $_POST['id_conductor'])) {
            if (!$this->searchForMatches())
                $this->model->addTrip($_POST['origen'], $_POST['destino'], $_POST['fecha'], $_POST['salida'], $_POST['llegada'], $_POST['precio'], $_POST['id_conductor']);
            $this->view->showLocationToAddFormTrips();
        }
    }
    //buscamos si hay coincidencias (un conductor que tenga ese viaje)
    private function searchForMatches()
    {
        $conductor = $this->model->searchForMatches($_POST['id_conductor'], $_POST['origen']);
        return !empty($conductor);
    }
    //MOSTRAR VIAJES
    public function showTrips()
    {
        $viajes = $this->model->getTrips();
        $this->view->renderTrips($viajes, false);
    }

    //   ------------------------------EDITAR BORRAR VIAJES----------------------------------------------

    //MOSTRAR TABLA BORRAR EDITAR VIAJES

    public function showTableOfTrips()
    {

        $isAdmin = $this->helper->checkLoggedIn();
        $tablasViajes = $this->model->getTableOfTrips();
        $this->view->renderTableTrips($tablasViajes, $isAdmin);
    }
    //   BORRAR VIAJE
    public function deleteTrip($id)
    {
        $isAdmin = $this->helper->checkLoggedIn();
        if ($isAdmin == true) {
            $this->model->deleteTrip($id);
            $this->view->renderTableOfLocationTrips();
        } else {
            $this->view_user->renderLogin();
        }
    }

    //EDITAR VIAJE
    public function editTrip($id_viaje)
    {
        $isAdmin = $this->helper->checkLoggedIn();
        if ($isAdmin == true) {
            $this->model->editTrip($_POST['origen'], $_POST['destino'], $_POST['fecha'], $_POST['salida'], $_POST['llegada'], $_POST['precio'], $_POST['id_conductor'], $id_viaje);
            $this->view->renderTableOfLocationTrips();
        } else {
            $this->view_user->renderLogin();
        }
    }
    public function redirectHome()
    {
        $this->view->showHome();
    }
}
