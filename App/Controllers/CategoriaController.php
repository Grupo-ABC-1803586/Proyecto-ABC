<?php

namespace App\Controllers;
require_once(__DIR__ . '/../Models/Categoria.php');

use App\Models\Categoria;
use App\Models\Usuarios;


if(!empty($_GET['action'])){
    CategoriaController::main($_GET['action']);
}

class CategoriaController{

    static function main($action)
    {
        if ($action == "create") {
            CategoriaController::create();
        } else if ($action == "edit") {
            CategoriaController::edit();
        } else if ($action == "searchForId") {
            CategoriaController::searchForId($_REQUEST['id']);
        } else if ($action == "searchAll") {
            CategoriaController::getAll();
        } else if ($action == "activate") {
            CategoriaController::activate();
        } else if ($action == "inactivate") {
            CategoriaController::inactivate();
        }/*else if ($action == "login"){
            ProgramaFormacionController::login();

        }else if($action == "cerrarSession"){
            ProgramaFormacionController::cerrarSession();
        }*/

    }

    static public function create()
    {
        try {

            $arrayCategoria = array();
            $arrayCategoria['Nombre'] = $_POST['Nombre'];
            var_dump($_POST);
            if(!Categoria::CategoriaRegistrado($arrayCategoria['Nombre'])){
                $Categoria = new Categoria ($arrayCategoria);
                if($Categoria->create()){
                    header("Location: ../../views/modules/Categoria/index.php?respuesta=correcto");
                }
            }else{
                header("Location: ../../views/modules/Categoria/create.php?respuesta=error&mensaje=Usuario ya registrado");
            }
        } catch (Exception $e) {
            header("Location: ../../views/modules/Categoria/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }


    static public function edit (){
        try {
            $arrayCategoria = array();
            $arrayCategoria['Nombre'] = $_POST['Nombre'];
            $arrayCategoria['Id'] = $_POST['Id'];

            $Categoria = new Categoria($arrayCategoria);
            $Categoria->update();

            header("Location: ../../views/modules/Categoria/show.php?Id=".$Categoria->getId()."&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Categoria/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function activate (){
        try {
            $ObjCategoria = Categoria::searchForId($_GET['Id']);

            $ObjCategoria->setEstado("Activo");
            if($ObjCategoria->update()){
                header("Location: ../../views/modules/Categoria/index.php");
            }else{
                header("Location: ../../views/modules/Categoria/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Categoria/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function inactivate (){
        try {
            $ObCategoria = Categoria::searchForId($_GET['Id']);
            $ObCategoria->setEstado("Inactivo");
            if($ObCategoria->update()){
                header("Location: ../../views/modules/Categoria/index.php");
            }else{
                header("Location: ../../views/modules/Categoria/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Categoria/index.php?respuesta=error");
        }
    }

    static public function searchForId ($id){
        try {
            return Categoria::searchForId($id);
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../views/modules/usuarios/manager.php?respuesta=error");
        }
    }

    static public function getAll (){
        try {
            return Categoria::getAll();
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/modules/persona/manager.php?respuesta=error");
        }
    }

    private static function CategoriaIsInArray($idCategoria, $ArrCategoria){
        if(count($ArrCategoria) > 0){
            foreach ($ArrCategoria as $Categoria){
                if($Categoria->getId() == $idCategoria){
                    return true;
                }
            }
        }
        return false;
    }

    static public function selectCategoria ($isMultiple=false,
                                          $isRequired=true,
                                          $Id="IdCategoria",
                                          $Name="IdCategoria",
                                          $defaultValue="",
                                          $class="form-control",
                                          $where="",
                                          $arrExcluir = array()){
        $arrCategoria = array();
        if($where != ""){
            $base = "SELECT * FROM Categoria WHERE ";
            $arrCategoria = Categoria::search($base.' '.$where);
        }else{
            $arrCategoria = Categoria::getAll();
        }

        $htmlSelect = "<select ".(($isMultiple) ? "multiple" : "")." ".(($isRequired) ? "required" : "")." Id= '".$Id."' name='".$Name."' class='".$class."' style='width: 100%;'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(count($arrCategoria) > 0){
            foreach ($arrCategoria as $Categoria)
                if (!CategoriaController::CategoriaIsInArray($Categoria->getId(),$arrExcluir))
                    $htmlSelect .= "<option ".(($Categoria != "") ? (($defaultValue == $Categoria->getId()) ? "selected" : "" ) : "")." value='".$Categoria->getId()."'>".$Categoria->getNombre()."</option>";
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