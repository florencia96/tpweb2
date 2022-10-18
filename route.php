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
            $conductorController->filterDegreeProgram($params[1], $params[2]);
        else
        $viajeController->redirectHome();
        break;

    case 'viajes':
        if (!isset($params[1]))
            $viajeController->showSubjects();
        else
            $viajeController->redirectHome();
        break;

    case 'detalle':
        if (isset($params[2], $params[1]))
            $viajeController->filterSubject($params[2], $params[1]);
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
        $conductorController->formDegreeProgram();
        break;
    case 'agregarviaje':
        $viajeController->formSubject();
        break;
        //   ------------------------------AGREGAR CONDUCTOR VIAJE------------------------------------------------
    case 'agregar-conductor':
        $conductorController->addDegreeProgram();
        break;

    case 'agregar-viaje':
        $viajeController->addSubject();
        break;
        //   ------------------------------EDITAR BORRAR CONDUCTOR------------------------------------------------
    case 'tablaconductores':
        $conductorController->showTableOfDegreePrograms();
        break;

    case 'borrarconductor':
        if (isset($params[1]))
            $conductorController->deleteDegreeProgram($params[1]);
     
        break;

    case 'editarconductor':
        if (isset($params[1])) {
            $conductorController->editDegreeProgram($params[1]);
        } else
            $conductorController->redirectHome();
        break;
        //   ------------------------------EDITAR BORRAR VIAJE------------------------------------------------
    case 'tablaviajes':
        $viajeController->showTableOfSubjects();
        break;

    case 'borrarviaje':
        if (isset($params[1]))
            $viajeController->deleteSubject($params[1]);
        else
            $viajeController->redirectHome();
        break;

    case 'editarviaje':
        if (isset($params[1]))
            $viajeController->editSubject($params[1]);
        else
            $viajeController->redirectHome();
        break;
        //   ------------------------------AGREGAR CONDUCTOR VIAJE------------------------------------------------

    case 'agregarconductor':
        $conductorController->formDegreeProgram();
        break;
    case 'agregarviaje':
        $viajeController->formSubject();
        break;


    default:
        echo "404 NOT FOUND";
        break;
}
