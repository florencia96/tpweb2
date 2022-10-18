<?php
require_once "model\ViajeModel.php";
require_once "view\ViajeView.php";
require_once "helpers/AuthHelper.php";
require_once "model/ConductorModel.php";
require_once "view\UserView.php";
//SUBJECT = viaje 
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
    public function filterSubject($id_viaje, $nombre)
    {
        if (isset($id_viaje, $nombre))
            if ($this->model->getSubjectById($id_viaje)) {
                $viaje = $this->model->getSubjectById($id_viaje);
                $this->view->renderSubject($id_viaje);
                
            } else
                $this->redirectHome();
        else
            $this->redirectHome();
    }



    //MOSTRAR FORMULARIO INSERTAR VIAJE
    public function formSubject()
    {

        $isAdmin = $this->helper->checkLoggedIn();
        $conductores = $this->conductor_model->getDegreeProgram();
        $this->view->renderFormSubject($conductores, $isAdmin);
    }


    //INSERTAR VIAJE
    public function addSubject()
    {

        if (isset($_POST['origen'], $_POST['destino'], $_POST['fecha'], $_POST['salida'], $_POST['llegada'], $_POST['precio'], $_POST['id_conductor'])) {
            if (!$this->searchForMatches())
                $this->model->addSubject($_POST['origen'], $_POST['destino'], $_POST['fecha'], $_POST['salida'], $_POST['llegada'], $_POST['precio'], $_POST['id_conductor']);
            $this->view->showLocationToAddFormSubjects();
        }
    }
    //buscamos si hay coincidencias (un viaje con ese nombre y ese ID)
    private function searchForMatches()
    {
        $conductor = $this->model->searchForMatches($_POST['id_conductor'], $_POST['origen']);
        return !empty($conductor);
    }
    //MOSTRAR VIAJES
    public function showSubjects()
    {
        $viajes = $this->model->getSubjects();
        $this->view->renderSubjects($viajes, false);
    }

    //   ------------------------------EDITAR BORRAR VIAJES----------------------------------------------

    //MOSTRAR TABLA BORRAR EDITAR VIAJES

    public function showTableOfSubjects()
    {

        $isAdmin = $this->helper->checkLoggedIn();
        $tablasViajes = $this->model->getTableOfSubjects();
        $this->view->renderTableSubjects($tablasViajes, $isAdmin);
    }
    //   BORRAR VIAJE
    public function deleteSubject($id)
    {
        $isAdmin = $this->helper->checkLoggedIn();
        if ($isAdmin == true) {
            $this->model->deleteSubject($id);
            $this->view->renderTableOfLocationSubjects();
        } else {
            $this->view_user->renderLogin();
        }
    }

    //EDITAR VIAJE
    public function editSubject($id_viaje)
    {
        $isAdmin = $this->helper->checkLoggedIn();
        if ($isAdmin == true) {
            $this->model->editSubject($_POST['origen'], $_POST['destino'], $_POST['fecha'], $_POST['salida'], $_POST['llegada'], $_POST['precio'], $_POST['id_conductor'], $id_viaje);
            $this->view->renderTableOfLocationSubjects();
        } else {
            $this->view_user->renderLogin();
        }
    }
    public function redirectHome()
    {
        $this->view->showHome();
    }
}
