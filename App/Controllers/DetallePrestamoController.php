<?php

namespace App\Controllers;
require_once(__DIR__.'/../Models/GeneralFunctions.php');
require_once(__DIR__.'/../Models/DetallePrestamo.php');
require_once(__DIR__.'/../Models/Kit.php');
require_once(__DIR__.'/../Models/Prestamo.php');
use App\Models\GeneralFunctions;
use App\Models\DetallePrestamo;
use App\Models\Prestamo;
use App\Models\Kit;

if(!empty($_GET['action'])){
    DetallePrestamoController::main($_GET['action']);
}

class DetallePrestamoController{

    static function main($action)
    {
        if ($action == "create") {
            DetallePrestamoController::create();
        } else if ($action == "edit") {
            DetallePrestamoController::edit();
        } else if ($action == "searchForID") {
            DetallePrestamoController::searchForID($_REQUEST['IdDetallePrestamo']);
        } else if ($action == "searchAll") {
            DetallePrestamoController::getAll();
        } else if ($action == "activate") {
            DetallePrestamoController::activate();
        } else if ($action == "inactivate") {
            DetallePrestamoController::inactivate();
        }
    }

    static public function create()
    {
        try {
            $arrayDetallePrestamo = array();
            $arrayDetallePrestamo['Observaciones'] = $_POST['Observaciones'];
            $arrayDetallePrestamo['Prestamo_id'] = Prestamo::searchForId($_POST['Prestamo_id']);
            $arrayDetallePrestamo['Items_id'] = Items::searchForId($_POST['Items_id']);
            $arrayDetallePrestamo['Kit_id'] = Kit::searchForId($_POST['Kit_id']);
            $DetallePrestamo = new DetallePrestamo($arrayDetallePrestamo);
            if($DetallePrestamo->create()){
                header("Location: ../../views/modules/DetallePrestamo/index.php?respuesta=correcto");
            }
        } catch (Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/DetallePrestamo/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function edit (){
        try {
            $arrayDetallePrestamo = array();
            $arrayDetallePrestamo['Observaciones'] = $_POST['Observaciones'];
            $arrayDetallePrestamo['Prestamo_id'] = Prestamo::searchForId($_POST['Prestamo_id']);
            $arrayDetallePrestamo['Items_id'] = Items::searchForId($_POST['Items_id']);
            $arrayDetallePrestamo['Kit_id'] = Kit::searchForId($_POST['Kit_id']);
            $arrayDetallePrestamo['Id'] = $_POST['Id'];
            $DetallePrestamo = new DetallePrestamo($arrayDetallePrestamo);
            $DetallePrestamo->update();
            header("Location: ../../views/modules/DetallePrestamo/show.php?id=".$DetallePrestamo>getId()."&respuesta=correcto");
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/DetallePrestamo/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function searchForID ($Id){
        try {
            return DetallePrestamo::searchForId($Id);
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/DetallePrestamo/manager.php?respuesta=error");
        }
    }

    static public function getAll (){
        try {
            return DetallePrestamo::getAll();
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'log', 'errorStack');
            header("Location: ../Vista/modules/DetallePrestamo/manager.php?respuesta=error");
        }
    }

    /*public static function personaIsInArray($idPersona, $ArrPersonas){
        if(count($ArrPersonas) > 0){
            foreach ($ArrPersonas as $Persona){
                if($Persona->getIdPersona() == $idPersona){
                    return true;
                }
            }
        }
        return false;
    }

    static public function selectPersona ($isMultiple=false,
                                          $isRequired=true,
                                          $id="idConsultorio",
                                          $nombre="idConsultorio",
                                          $defaultValue="",
                                          $class="",
                                          $where="",
                                          $arrExcluir = array()){
        $arrPersonas = array();
        if($where != ""){
            $base = "SELECT * FROM persona WHERE ";
            $arrPersonas = Persona::buscar($base.$where);
        }else{
            $arrPersonas = Persona::getAll();
        }

        $htmlSelect = "<select ".(($isMultiple) ? "multiple" : "")." ".(($isRequired) ? "required" : "")." id= '".$id."' name='".$nombre."' class='".$class."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(count($arrPersonas) > 0){
            foreach ($arrPersonas as $persona)
                if (!UsuariosController::personaIsInArray($persona->getIdPersona(),$arrExcluir))
                    $htmlSelect .= "<option ".(($persona != "") ? (($defaultValue == $persona->getIdPersona()) ? "selected" : "" ) : "")." value='".$persona->getIdPersona()."'>".$persona->getNombres()." ".$persona->getApellidos()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }*/

    /*
    public function buscar ($Query){
        try {
            return Persona::buscar($Query);
        } catch (Exception $e) {
            header("Location: ../Vista/modules/persona/manager.php?respuesta=error");
        }
    }

    static public function asociarEspecialidad (){
        try {
            $Persona = new Persona();
            $Persona->asociarEspecialidad($_POST['Persona'],$_POST['Especialidad']);
            header("Location: ../Vista/modules/persona/managerSpeciality.php?respuesta=correcto&id=".$_POST['Persona']);
        } catch (Exception $e) {
            header("Location: ../Vista/modules/persona/managerSpeciality.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function eliminarEspecialidad (){
        try {
            $ObjPersona = new Persona();
            if(!empty($_GET['Persona']) && !empty($_GET['Especialidad'])){
                $ObjPersona->eliminarEspecialidad($_GET['Persona'],$_GET['Especialidad']);
            }else{
                throw new Exception('No se recibio la informacion necesaria.');
            }
            header("Location: ../Vista/modules/persona/managerSpeciality.php?id=".$_GET['Persona']);
        } catch (Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/modules/persona/manager.php?respuesta=error");
        }
    }

    public static function login (){
        try {
            if(!empty($_POST['Usuario']) && !empty($_POST['Contrasena'])){
                $tmpPerson = new Persona();
                $respuesta = $tmpPerson->Login($_POST['Usuario'], $_POST['Contrasena']);
                if (is_a($respuesta,"Persona")) {
                    $hydrator = new ReflectionHydrator(); //Instancia de la clase para convertir objetos
                    $ArrDataPersona = $hydrator->extract($respuesta); //Convertimos el objeto persona en un array
                    unset($ArrDataPersona["datab"],$ArrDataPersona["isConnected"],$ArrDataPersona["relEspecialidades"]); //Limpiamos Campos no Necesarios
                    $_SESSION['UserInSession'] = $ArrDataPersona;
                    echo json_encode(array('type' => 'success', 'title' => 'Ingreso Correcto', 'text' => 'Sera redireccionado en un momento...'));
                }else{
                    echo json_encode(array('type' => 'error', 'title' => 'Error al ingresar', 'text' => $respuesta)); //Si la llamda es por Ajax
                }
                return $respuesta; //Si la llamada es por funcion
            }else{
                echo json_encode(array('type' => 'error', 'title' => 'Datos Vacios', 'text' => 'Debe ingresar la informacion del usuario y contraseña'));
                return "Datos Vacios"; //Si la llamada es por funcion
            }
        } catch (Exception $e) {
            var_dump($e);
            header("Location: ../login.php?respuesta=error");
        }
    }

    public static function cerrarSession (){
        session_unset();
        session_destroy();
        header("Location: ../Vista/modules/persona/login.php");
    }*/

}