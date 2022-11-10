<?php
require_once "helpers/AuthHelper.php";
require_once "model\ConductorModel.php";
require_once "model\ViajeModel.php";
require_once "view\ConductorView.php";
require_once "view\UserView.php";
class ConductorController
{
    private $model;
    private $view;
    private $view_user;
    private $helper;
    private $model_viaje;

    public function __construct()
    {
        $this->model = new ConductorModel();
        $this->view = new ConductorView();
        $this->helper = new AuthHelper();
        $this->model_viaje = new ViajeModel();
        $this->view_user = new UserView();
    }

    public function showHome()
    {
        $conductores = $this->model->getProgram();
        $this->view->showHome($conductores);
    }


    public function filterProgram($nombre_conductor, $id_conductor)
    {
        $nombre_con_espacios = str_replace('-', ' ', $nombre_conductor);
        $viajes = $this->model->filterProgram($id_conductor, $nombre_con_espacios);
        if (!empty($viajes))
            $this->view->renderProgram($viajes, $nombre_con_espacios);
        else
            $this->view->showHomeLocation();
    }
    //MUESTRA FORMULARIO AGREGAR CONDUCTOR
    public function formProgram()
    {
        $isAdmin = $this->helper->checkLoggedIn();
        $this->view->FormAddProgram("",$isAdmin);
    }
    //AGREGAR CONDUCTOR
    public function addProgram()
    {

          $isAdmin = $this->helper->checkLoggedIn();
          
            if (!empty($_POST['nombre']) && !empty($_POST['vehiculo'])) {
                $this->model->addProgram($_POST['nombre'], $_POST['vehiculo']);
                $this->view->showLocationToAddFormProgram();
          
        }else{
           $this->view->formAddProgram("faltan completar campos",$isAdmin);
    }
}
    //TABLA EDITAR Y BORRAR CONDUCTOR
    public function showTableOfPrograms()
    {
        $isAdmin = $this->helper->checkLoggedIn();
        $tablaConductores = $this->model->getTableProgram();
        $this->view->renderTablePrograms($isAdmin, $tablaConductores);
    }
    //borrar conductor
    public function deleteProgram($id_conductor)
    {
        $isAdmin = $this->helper->checkLoggedIn();
        if ($isAdmin == true) {
            $viajesAsociados = $this->model_viaje->searchIdProgramByTableTrips($id_conductor);
         
            if (count($viajesAsociados) == 0) {
                $this->model->deleteProgram($id_conductor);
                $this->view->renderTableOfLocationPrograms();
            } else {

                $tablaConductores =  $this->model->getTableProgram();
                $this->view->renderTablePrograms($isAdmin, $tablaConductores, "El conductor seleccionado no se puede borrar porque tiene asociados viajes");
            }
        } else {
            $this->view_user->renderLogin();
        }
    }
    public function editProgram($id_conductor)
    {
        $isAdmin = $this->helper->checkLoggedIn();
        if ($isAdmin == true) {
            $this->model->editProgram($_POST['nombre'], $_POST['vehiculo'], $id_conductor);
            $this->view->renderTableOfLocationPrograms();
        } else {
            $this->view_user->renderLogin();
        }
    }
}
