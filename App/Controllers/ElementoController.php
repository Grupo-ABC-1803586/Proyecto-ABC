<?php

namespace App\Controllers;
require_once(__DIR__.'/../Models/Elemento.php');
require_once(__DIR__.'/../Models/Categoria.php');

use App\Models\GeneralFunctions;
use App\Models\Elemento;
use App\Models\Categoria;

if(!empty($_GET['action'])){
    ElementoController::main($_GET['action']);
}

class ElementoController{

    static function main($action)
    {
        if ($action == "create") {
            ElementoController::create();
        } else if ($action == "edit") {
            ElementoController::edit();
        } else if ($action == "searchForID") {
            ElementoController::searchForID($_REQUEST['Id']);
        } else if ($action == "searchAll") {
            ElementoController::getAll();
        } else if ($action == "activate") {
            ElementoController::activate();
        } else if ($action == "inactivate") {
            ElementoController::inactivate();
        }
    }

    static public function create()
    {
        try {
            $arrayElemento = array();
            $arrayElemento['Nombre'] = $_POST['Nombre'];
            $arrayElemento['Descripcion'] = $_POST['Descripcion'];
            $arrayElemento['Serie'] = $_POST['Serie'];
            $arrayElemento['Categoria'] = Categoria::searchForId($_POST['Categoria']);
            $arrayElemento['Material'] = $_POST['Material'];
            $Elemento = new Elemento($arrayElemento);
            if($Elemento->create()){
                header("Location: ../../views/modules/Elemento/create.php?id=".$Elemento->getId());
            }
        } catch (Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Elemento/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function edit (){
        try {
            $arrayElemento = array();
            $arrayElemento['Nombre'] = $_POST['Nombre'];
            $arrayElemento['Descripcion'] = $_POST['Descripcion'];
            $arrayElemento['Serie'] = $_POST['Serie'];
            $arrayElemento['Categoria'] = Categoria::searchForId($_POST['Categoria']);
            $arrayElemento['Material'] = $_POST['Material'];
            $arrayElemento['Id'] = $_POST['Id'];

            $Elemento = new Elemento($arrayElemento);
            $Elemento->update();

            header("Location: ../../views/modules/Elemento/show.php?Id=".$Elemento->getId()."&respuesta=correcto");
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Elemento/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function activate (){
        try {
            $ObjElemento = Elemento::searchForId($_GET['Id']);
            $ObjElemento->setEstado("Activo");
            if($ObjElemento->update()){
                header("Location: ../../views/modules/Elemento/index.php");
            }else{
                header("Location: ../../views/modules/Elemento/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Elemento/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function inactivate (){
        try {
            $ObjElemento = Elemento::searchForId($_GET['Id']);
            $ObjElemento->setEstado("Inactivo");
            if($ObjElemento->update()){
                header("Location: ../../views/modules/Elemento/index.php");
            }else{
                header("Location: ../../views/modules/Elemento/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Elemento/index.php?respuesta=error");
        }
    }

    static public function searchForID ($id){
        try {
            return Elemento::searchForId($id);
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            //header("Location: ../../views/modules/Elemento/manager.php?respuesta=error");
        }
    }

    static public function getAll (){
        try {
            return Elemento::getAll();
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'log', 'errorStack');
            header("Location: ../Vista/modules/Categoria/manager.php?respuesta=error");
        }
    }

    public static function ElementoIsInArray($Id, $ArrElemento){
        if(count($ArrElemento) > 0){
            foreach ($ArrElemento as $Elemento){
                if($Elemento->getId() == $Id){
                    return true;
                }
            }
        }
        return false;
    }

    static public function selectElemento ($isMultiple=false,
                                          $isRequired=true,
                                          $Id="Elemento",
                                          $Nombre="Elemento",
                                          $defaultValue="",
                                          $class="",
                                          $where="",
                                          $arrExcluir = array()){
        $arrElemento = array();
        if($where != ""){
            $base = "SELECT * FROM Elemento WHERE ";
            $arrElemento = Elemento:: search($base.$where);
        }else{
            $arrElemento = Elemento::getAll();
        }

        $htmlSelect = "<select ".(($isMultiple) ? "multiple" : "")." ".(($isRequired) ? "required" : "")." Id= '".$Id."' name='".$Nombre."' class='".$class."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(count($arrElemento) > 0){
            foreach ($arrElemento as $Elemento)
                if (!ElementoController::ElementoIsInArray($Elemento->getId(),$arrExcluir))
                    $htmlSelect .= "<option ".(($Elemento != "") ? (($defaultValue == $Elemento->getId()) ? "selected" : "" ) : "")." value='".$Elemento->getId()."'>".$Elemento->getNombre()."</option>";
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