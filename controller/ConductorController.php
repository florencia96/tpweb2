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
        $conductores = $this->model->getDegreeProgram();
        $this->view->showHome($conductores);
    }


    public function filterDegreeProgram($nombre_conductor, $id_conductor)
    {
        $nombre_con_espacios = str_replace('-', ' ', $nombre_conductor);
        $viajes = $this->model->filterDegreeProgram($id_conductor, $nombre_con_espacios);
        if (!empty($viajes))
            $this->view->renderDegreeProgram($viajes, $nombre_con_espacios);
        else
            $this->view->showHomeLocation();
    }
    //VISTA FORMULARIO AGREGAR CONDUCTOR
    public function formDegreeProgram()
    {
        $isAdmin = $this->helper->checkLoggedIn();
        $this->view->FormAddDegreeProgram("",$isAdmin);
    }
    //AGREGAR CONDUCTOR
    public function addDegreeProgram()
    {

          $isAdmin = $this->helper->checkLoggedIn();
          
            if (!empty($_POST['nombre']) && !empty($_POST['vehiculo'])) {
                $this->model->addDegreeProgram($_POST['nombre'], $_POST['vehiculo']);
                $this->view->showLocationToAddFormDegreeProgram();
          
        }else{
           $this->view->formAddDegreeProgram("faltan completar campos",$isAdmin);
    }
}
    //TABLA EDITAR Y BORRAR CONDUCTOR
    public function showTableOfDegreePrograms()
    {
        $isAdmin = $this->helper->checkLoggedIn();
        $tablaConductores = $this->model->getTableDegreeProgram();
        $this->view->renderTableDegreePrograms($isAdmin, $tablaConductores);
    }
    //borrar conductor
    public function deleteDegreeProgram($id_conductor)
    {
        $isAdmin = $this->helper->checkLoggedIn();
        if ($isAdmin == true) {
            $viajesAsociados = $this->model_viaje->searchIdDegreeProgramByTableSubjects($id_conductor);
         
            if (count($viajesAsociados) == 0) {
                $this->model->deleteDegreeProgram($id_conductor);
                $this->view->renderTableOfLocationDegreePrograms();
            } else {

                $tablaConductores =  $this->model->getTableDegreeProgram();
                $this->view->renderTableDegreePrograms($isAdmin, $tablaConductores, "El conductor seleccionado no se puede borrar porque tiene asociados viajes");
            }
        } else {
            $this->view_user->renderLogin();
        }
    }
    public function editDegreeProgram($id_conductor)
    {
        $isAdmin = $this->helper->checkLoggedIn();
        if ($isAdmin == true) {
            $this->model->editDegreeProgram($_POST['nombre'], $_POST['vehiculo'], $id_conductor);
            $this->view->renderTableOfLocationDegreePrograms();
        } else {
            $this->view_user->renderLogin();
        }
    }
}
