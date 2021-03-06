<?php

namespace App\Controllers;
require_once(__DIR__.'/../Models/Persona.php');
require_once(__DIR__.'/../Models/ProgramaFormacion.php');

use App\Models\GeneralFunctions;
use App\Models\Persona;
use App\Models\ProgramaFormacion;


if(!empty($_GET['action'])){
    PersonaController::main($_GET['action']);
}

class PersonaController{

    static function main($action)
    {
        if ($action == "create") {
            PersonaController::create();
        } else if ($action == "edit") {
            PersonaController::edit();
        } else if ($action == "searchForID") {
            PersonaController::searchForID($_REQUEST['Id']);
        } else if ($action == "searchAll") {
            PersonaController::getAll();
        } else if ($action == "activate") {
            PersonaController::activate();
        } else if ($action == "inactivate") {
            PersonaController::inactivate();
        }
    }

    static public function create()
    {
        try {
            $arrayPersona = array();
            $arrayPersona['Documento'] = $_POST['Documento'];
            $arrayPersona['Nombre'] = $_POST['Nombre'];
            $arrayPersona['Apellido'] = $_POST['Apellido'];
            $arrayPersona['Telefono'] = $_POST['Telefono'];
            $arrayPersona['Correo'] = $_POST['Correo'];
            $arrayPersona['Rol'] = $_POST['Rol'];
            $arrayPersona['Contraseña'] = $_POST['Contraseña'];
            $arrayPersona['ProgramaFormacion'] = ProgramaFormacion::searchForId($_POST['ProgramaFormacion']);
            $arrayPersona['Estado'] = $_POST['Estado'];
            var_dump($_POST);
            $Persona = new Persona($arrayPersona);
            if($Persona->create()){

                header("Location: ../../views/modules/Persona/create.php?id=".$Persona->getId());
            }
        } catch (Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Persona/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function edit (){
        try {
            $arrayPersona = array();
            $arrayPersona['Documento'] = $_POST['Documento'];
            $arrayPersona['Nombre'] = $_POST['Nombre'];
            $arrayPersona['Apellido'] = $_POST['Apellido'];
            $arrayPersona['Telefono'] = $_POST['Telefono'];
            $arrayPersona['Correo'] = $_POST['Correo'];
            $arrayPersona['Rol'] = $_POST['Rol'];
            $arrayPersona['Contraseña'] = $_POST['Contraseña'];
            $arrayPersona['ProgramaFormacion'] = ProgramaFormacion::searchForId($_POST['ProgramaFormacion']);
            $arrayPersona['Estado'] = $_POST['Estado'];


            $Persona = new Persona($arrayPersona);
            $Persona->update();

            header("Location: ../../views/modules/Persona/show.php?Id=".$Persona->getId()."&respuesta=correcto");
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Persona/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function activate (){
        try {
            $ObjPersona = Persona::searchForDocumento($_GET['Id']);
            $ObjPersona->setEstado("Activo");
            if($ObjPersona->update()){
                header("Location: ../../views/modules/Persona/index.php");
            }else{
                header("Location: ../../views/modules/Persona/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Persona/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function inactivate (){
        try {
            $ObjPersona = Persona::searchForDocumento($_GET['Id']);
            $ObjPersona->setEstado("Inactivo");
            if($ObjPersona->update()){
                header("Location: ../../views/modules/Persona/index.php");
            }else{
                header("Location: ../../views/modules/Persona/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Persona/index.php?respuesta=error");
        }
    }

    static public function searchForID ($Id){
        try {
            return Persona::searchForDocumento($Id);
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            //header("Location: ../../views/modules/Persona/manager.php?respuesta=error");
        }
    }

    static public function getAll (){
        try {
            return Persona::getAll();
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'log', 'errorStack');
            header("Location: ../Vista/modules/Persona/manager.php?respuesta=error");
        }
    }
    static public function selectEstadoPersona ($isMultiple=false,
                                                  $isRequired=true,
                                                  $Id="Persona",
                                                  $Estado="Persona",
                                                  $defaultValue="",
                                                  $class="",
                                                  $where="",
                                                  $arrExcluir = array()){
        $arrPersona = array();
        if($where != ""){
            $base = "SELECT * FROM Persona WHERE ";
            $arrPersona = Persona::search($base.$where);
        }else{
            $arrPersona = Persona::getAll();
        }

        $htmlSelect = "<select ".(($isMultiple) ? "multiple" : "")." ".(($isRequired) ? "required" : "")." id= '".$Id."' name='".$Estado."' class='".$class."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(count($arrPersona) > 0){
            foreach ($arrPersona as $Persona)
                if (!PersonaController::PersonaIsInArray($Persona->getId(),$arrExcluir))
                    $htmlSelect .= "<option ".(($Persona != "") ? (($defaultValue == $Persona->getId()) ? "selected" : "" ) : "")." value='".$Persona->getId()."'>".$Persona->getEstado()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
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