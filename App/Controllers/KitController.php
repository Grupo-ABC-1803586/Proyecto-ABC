<?php

namespace App\Controllers;
require_once(__DIR__ . '/../Models/Kit.php');

use App\Models\Kit;
if(!empty($_GET['action'])){
    KitController::main($_GET['action']);
}

class KitController{

    static function main($action)
    {
        if ($action == "create") {
            KitController::create();
        } else if ($action == "edit") {
            KitController::edit();
        } else if ($action == "searchForID") {
            KitController::searchForID($_REQUEST['idKit']);
        } else if ($action == "searchAll") {
            KitController::getAll();
        } else if ($action == "activate") {
            KitController::activate();
        } else if ($action == "inactivate") {
            KitController::inactivate();

        }/*else if ($action == "login"){
            UsuariosController::login();
        }else if($action == "cerrarSession"){
            UsuariosController::cerrarSession();
        }*/

    }

    static public function create()
    {
        try {
            $arrayKit = array();
            $arrayKit['Nombre'] = $_POST['Nombre'];
            $arrayKit['Descripcion'] = $_POST['Descripcion'];
            $arrayKit['Placa'] = $_POST['Placa'];
            if(!Kit::KitRegistrado($arrayKit['Nombre'])){
                $arrayKit = new Kit ($arrayKit);
                if($arrayKit->create()){
                    header("Location: ../../views/modules/Kit/index.php?respuesta=correcto");
                }
            }else{
                header("Location: ../../views/modules/Kit/create.php?respuesta=error&mensaje= Kit ya registrado");
            }
        } catch (Exception $e) {
            header("Location: ../../views/modules/Kit/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function edit (){
        try {
            $arrayKit = array();
            $arrayKit['Nombre'] = $_POST['Nombre'];
            $arrayKit['Descripcion'] = $_POST['Descripcion'];
            $arrayKit['Placa'] = $_POST['Placa'];
            $arrayKit['Id'] = $_POST['Id'];
            $user = new Kit ($arrayKit);
            $user->update();

            header("Location: ../../views/modules/Kit/show.php?Id=".$user->getId()."&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Kit/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function activate (){
        try {
            $ObjKit = Kit::searchForId($_GET['Id']);
            $ObjKit->setEstado("Activo");
            if($ObjKit->update()){
                header("Location: ../../views/modules/Kit/index.php");
            }else{
                header("Location: ../../views/modules/Kit/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Kit/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function inactivate (){
        try {
            $ObjKit = Kit::searchForId($_GET['Id']);
            $ObjKit->setEstado("Inactivo");
            if($ObjKit->update()){
                header("Location: ../../views/modules/Kit/index.php");
            }else{
                header("Location: ../../views/modules/Kit/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Kit/index.php?respuesta=error");
        }
    }

    static public function searchForID ($Id){
        try {
            return Kit::searchForId($Id);
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../views/modules/usuarios/manager.php?respuesta=error");
        }
    }

    static public function getAll (){
        try {
            return Kit::getAll();
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/modules/persona/manager.php?respuesta=error");
        }
    }

    public static function KitIsInArray($Id, $ArrKit){
        if(count($ArrKit) > 0){
            foreach ($ArrKit as $Kit){
                if($Kit->getKit() == $Id){
                    return true;
                }
            }
        }
        return false;
    }

    static public function selectKit ($isMultiple=false,
                                          $isRequired=true,
                                          $Id="Kit",
                                          $Nombre="Kit",
                                          $defaultValue="",
                                          $class="",
                                          $where="",
                                          $arrExcluir = array()){
        $arrKit = array();
        if($where != ""){
            $base = "SELECT * FROM Kit WHERE ";
            $arrKit = Kit::search ($base.$where);
        }else{
            $arrKit = Kit::getAll();
        }

        $htmlSelect = "<select ".(($isMultiple) ? "multiple" : "")." ".(($isRequired) ? "required" : "")." Id= '".$Id."' name='".$Nombre."' class='".$class."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(count($arrKit) > 0){
            foreach ($arrKit as $Kit)
                if (!KitController::KitIsInArray($Kit->getId(),$arrExcluir))
                    $htmlSelect .= "<option ".(($Kit != "") ? (($defaultValue == $Kit->getId()) ? "selected" : "" ) : "")." value='".$Kit->getId()."'>".$Kit->getNombre()." </option>";
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