<?php

namespace App\Controllers;
require_once(__DIR__ . '/../Models/Marca.php');
use App\Models\Marca;

if(!empty($_GET['action'])){
    MarcaController::main($_GET['action']);
}

class MarcaController{

    static function main($action)
    {
        if ($action == "create") {
            MarcaController::create();
        } else if ($action == "edit") {
            MarcaController::edit();
        } else if ($action == "searchForID") {
            MarcaController::searchForID($_REQUEST['Id']);
        } else if ($action == "searchAll") {
            MarcaController::getAll();
        } else if ($action == "activate") {
            MarcaController::activate();
        } else if ($action == "inactivate") {
            MarcaController::inactivate();
        }/*else if ($action == "login"){
            UnidadesController::login();
        }else if($action == "cerrarSession"){
            UnidadesController::cerrarSession();
        }*/

    }

    static public function create()
    {
        try {
            $arrayMarca = array();
            $arrayMarca['Nombre'] = $_POST['Nombre'];
            if(!Marca::MarcaRegistrada($arrayMarca['Nombre'])){
                $Marca = new Marca ($arrayMarca);
                if($Marca->create()){
                    header("Location: ../../views/modules/Marca/index.php?respuesta=correcto");
                }
            }else{
                header("Location: ../../views/modules/Marca/create.php?respuesta=error&mensaje=Marca ya registrado");
            }
        } catch (Exception $e) {
            header("Location: ../../views/modules/Marca/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function edit (){
        try {
            $arrayMarca = array();
            $arrayMarca['Nombre'] = $_POST['Nombre'];
            $arrayMarca['Id'] = $_POST['Id'];

            $user = new Marca($arrayMarca);
            $user->update();

            header("Location: ../../views/modules/Marca/show.php?Id=".$user->getId()."&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Marca/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function activate (){
        try {
            $ObjMarca = Marca::searchForId($_GET['Id']);
            $ObjMarca->setEstado("Activo");
            if($ObjMarca->update()){
                header("Location: ../../views/modules/Marca/index.php");
            }else{
                header("Location: ../../views/modules/Marca/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Marca/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function inactivate (){
        try {
            $ObjMarca = Marca::searchForId($_GET['Id']);
            $ObjMarca->setEstado("Inactivo");
            if($ObjMarca->update()){
                header("Location: ../../views/modules/Marca/index.php");
            }else{
                header("Location: ../../views/modules/Marca/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Marca/index.php?respuesta=error");
        }
    }

    static public function searchForID ($id){
        try {
            return Marca::searchForId($id);
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../views/modules/Unidades/manager.php?respuesta=error");
        }
    }

    static public function getAll (){
        try {
            return Marca::getAll();
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/modules/persona/manager.php?respuesta=error");
        }
    }

    public static function MarcaIsInArray($Id, $ArrMarca){
        if(count($ArrMarca) > 0){
            foreach ($ArrMarca as $Marca){
                if($Marca->getId() == $Id){
                    return true;
                }
            }
        }
        return false;
    }

    static public function selectMarca ($isMultiple=false,
                                           $isRequired=true,
                                           $Id="Marca",
                                           $Nombre="Marca",
                                           $defaultValue="",
                                           $class="",
                                           $where="",
                                           $arrExcluir = array()){
        $arrMarca = array();
        if($where != ""){
            $base = "SELECT * FROM Marca WHERE ";
            $arrMarca = Marca::search($base.$where);
        }else{
            $arrMarca = Marca::getAll();
        }

        $htmlSelect = "<select ".(($isMultiple) ? "multiple" : "")." ".(($isRequired) ? "required" : "")." Id= '".$Id."' name='".$Nombre."' class='".$class."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(count($arrMarca) > 0){
            foreach ($arrMarca as $Marca)
                if (!MarcaController::MarcaIsInArray($Marca->getId(),$arrExcluir))
                    $htmlSelect .= "<option ".(($Marca != "") ? (($defaultValue == $Marca->getId()) ? "selected" : "" ) : "")." value='".$Marca->getId()."'>".$Marca->getNombre()."</option>";
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