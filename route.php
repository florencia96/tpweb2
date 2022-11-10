<?php
require_once "controller/ConductorController.php";
require_once "controller/ViajeController.php";
require_once "controller/UserController.php";
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');



// lee la acción
if (!empty($_GET['action']))
    $action = $_GET['action'];
else
    $action = 'conductores';     // acción por defecto si no envían

$params = explode('/', $action);

$conductorController = new ConductorController();
$viajeController = new ViajeController();
$userController = new UserController();

switch ($params[0]) {
    case 'conductores':
        //Verificacion para que no pasen parametros extra por la url
        if (!isset($params[1]))
            $conductorController->showHome($params);
        else
            $conductorController->showHome();
        break;

    case 'conductor':
        if (isset($params[1]) && isset($params[2]))
            $conductorController->filterProgram($params[1], $params[2]);
        else
        $viajeController->redirectHome();
        break;

    case 'viajes':
        if (!isset($params[1]))
            $viajeController->showTrips();
        else
            $viajeController->redirectHome();
        break;

    case 'detalle':
        if (isset($params[2], $params[1]))
            $viajeController->filterTrip($params[2], $params[1]);
        else
            $viajeController->redirectHome();
        break;

    case 'login':
        $userController->showLogin();
        break;

    case 'logout':
        $userController->logOut();
        break;

    case 'verify':
        $userController->verifyLogin();
        break;

    case 'registro':
        $userController->showRegistro();
        break;

    case 'signup':
        $userController->registrarUsuario();
        break;

    case 'modifyrol':
        if (isset($params[1])){
           $userController->modifyRol($params[1]); 
        }
        
    case 'panel':
        $userController->showPanel();
        break;
     case 'borrarusuario':
            $userController->borrarUsuario($params[1]);
            break;
        //   ------------------------------VISTA AGREGAR VIAJE CONDUCTOR------------------------------------------------

    case 'agregarconductor':
        $conductorController->formProgram();
        break;
    case 'agregarviaje':
        $viajeController->formTrip();
        break;
        //   ------------------------------AGREGAR CONDUCTOR VIAJE------------------------------------------------
    case 'agregar-conductor':
        $conductorController->addProgram();
        break;

    case 'agregar-viaje':
        $viajeController->addTrip();
        break;
        //   ------------------------------EDITAR BORRAR CONDUCTOR------------------------------------------------
    case 'tablaconductores':
        $conductorController->showTableOfPrograms();
        break;

    case 'borrarconductor':
        if (isset($params[1]))
            $conductorController->deleteProgram($params[1]);
     
        break;

    case 'editarconductor':
        if (isset($params[1])) {
            $conductorController->editProgram($params[1]);
        } else
            $conductorController->redirectHome();
        break;
        //   ------------------------------EDITAR BORRAR VIAJE------------------------------------------------
    case 'tablaviajes':
        $viajeController->showTableOfTrips();
        break;

    case 'borrarviaje':
        if (isset($params[1]))
            $viajeController->deleteTrip($params[1]);
        else
            $viajeController->redirectHome();
        break;

    case 'editarviaje':
        if (isset($params[1]))
            $viajeController->editTrip($params[1]);
        else
            $viajeController->redirectHome();
        break;
        //   ------------------------------AGREGAR CONDUCTOR VIAJE------------------------------------------------

    case 'agregarconductor':
        $conductorController->formProgram();
        break;
    case 'agregarviaje':
        $viajeController->formTrip();
        break;


    default:
        echo "404 NOT FOUND";
        break;
}
