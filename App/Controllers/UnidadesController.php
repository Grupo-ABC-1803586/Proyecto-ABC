<?php

namespace App\Controllers;
require_once(__DIR__ . '/../Models/Unidades.php');
use App\Models\Unidades;

if(!empty($_GET['action'])){
    UnidadesController::main($_GET['action']);
}

class UnidadesController{

    static function main($action)
    {
        if ($action == "create") {
            UnidadesController::create();
        } else if ($action == "edit") {
            UnidadesController::edit();
        } else if ($action == "searchForId") {
            UnidadesController::searchForId($_REQUEST['Id']);
        } else if ($action == "searchAll") {
            UnidadesController::getAll();
        } else if ($action == "activate") {
            UnidadesController::activate();
        } else if ($action == "inactivate") {
            UnidadesController::inactivate();
        }/*else if ($action == "login"){
            UnidadesController::login();
        }else if($action == "cerrarSession"){
            UnidadesController::cerrarSession();
        }*/

    }

    static public function create()
    {
        try {
            $arrayUnidades = array();
            $arrayUnidades['Nombre'] = $_POST['Nombre'];
            $arrayUnidades['Tipo'] = $_POST['Tipo'];
            if(!Unidades::UnidadesRegistrada($arrayUnidades['Nombre'])){
                $Unidades = new Unidades ($arrayUnidades);
                if($Unidades->create()){
                    header("Location: ../../views/modules/Unidades/index.php?respuesta=correcto");
                }
            }else{
                header("Location: ../../views/modules/Unidades/create.php?respuesta=error&mensaje=Unidades ya registrado");
            }
        } catch (Exception $e) {
            header("Location: ../../views/modules/Unidades/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function edit (){
        try {
            $arrayUnidades = array();
            $arrayUnidades['Nombre'] = $_POST['Nombre'];
            $arrayUnidades['Tipo'] = $_POST['Tipo'];
            $arrayUnidades['Id'] = $_POST['Id'];

            $user = new Unidades($arrayUnidades);
            $user->update();

            header("Location: ../../views/modules/Unidades/show.php?Id=".$user->getId()."&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Unidades/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function activate (){
        try {
            $ObjUnidades = Unidades::searchForId($_GET['Id']);
            $ObjUnidades->setEstado("Activo");
            if($ObjUnidades->update()){
                header("Location: ../../views/modules/Unidades/index.php");
            }else{
                header("Location: ../../views/modules/Unidades/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Unidades/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function inactivate (){
        try {
            $ObjUnidades = Unidades::searchForId($_GET['Id']);
            $ObjUnidades ->setEstado("Inactivo");
            if($ObjUnidades ->update()){
                header("Location: ../../views/modules/Unidades/index.php");
            }else{
                header("Location: ../../views/modules/Unidades/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Unidades/index.php?respuesta=error");
        }
    }

    static public function searchForId ($Id){
        try {
            return Unidades ::searchForId($Id);
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../views/modules/Unidades/manager.php?respuesta=error");
        }
    }

    static public function getAll (){
        try {
            return Unidades ::getAll();
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/modules/Unidades/manager.php?respuesta=error");
        }
    }

    public static function UnidadesIsInArray($Id, $ArrUnidades){
        if(count($ArrUnidades) > 0){
            foreach ($ArrUnidades as $Unidades){
                if($Unidades->getId() == $Id){
                    return true;
                }
            }
        }
        return false;
    }

    static public function selectUnidades ($isMultiple=false,
                                          $isRequired=true,
                                          $Id="Unidadades",
                                          $Nombre="Unidades",
                                          $defaultValue="",
                                          $class="",
                                          $where="",
                                          $arrExcluir = array()){
        $arrUnidades = array();
        if($where != ""){
            $base = "SELECT * FROM Unidades WHERE ";
            $arrUnidades = Unidades::search($base.$where);
        }else{
            $arrUnidades = Unidades::getAll();
        }

        $htmlSelect = "<select ".(($isMultiple) ? "multiple" : "")." ".(($isRequired) ? "required" : "")." Id= '".$Id."' name='".$Nombre."' class='".$class."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(count($arrUnidades) > 0){
            foreach ($arrUnidades as $Unidades)
                if (!UnidadesController::UnidadesIsInArray($Unidades->getId(),$arrExcluir))
                    $htmlSelect .= "<option ".(($Unidades != "") ? (($defaultValue == $Unidades->getId()) ? "selected" : "" ) : "")." value='".$Unidades->getId()."'>".$Unidades->getNombre()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }

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