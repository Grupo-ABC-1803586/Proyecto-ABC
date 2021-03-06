<?php

namespace App\Controllers;
require(__DIR__ . '/../Models/Prestamo.php');


use App\Models\Prestamo;

if(!empty($_GET['action'])){
    PrestamoController::main($_GET['action']);
}

class PrestamoController{

    static function main($action)
    {
        if ($action == "create") {
            PrestamoController::create();
        } else if ($action == "edit") {
            PrestamoController::edit();
        } else if ($action == "searchForID") {
            PrestamoController::searchForID($_REQUEST['IdPrestamo']);
        } else if ($action == "searchAll") {
            PrestamoController::getAll();
        } else if ($action == "activate") {
            PrestamoController::activate();
        } else if ($action == "inactivate") {
            PrestamoController::inactivate();
        }
    }

    static public function create()
    {
        try {
            $arrayPrestamo = array();
            $arrayPrestamo['FechaPrestamo'] = $_POST['FechaPrestamo'];
            $arrayPrestamo['FechaEntrega'] = $_POST['FechaEntrega'];
            $arrayPrestamo['Descripcion'] = $_POST['Descripcion'];
            $arrayPrestamo['Estado'] = $_POST['Estado'];
            $arrayPrestamo['Persona_id'] = Persona::searchForId($_POST['Persona_id']);
            if(!Prestamo::PrestamoRegistrado($arrayPrestamo['Persona'])){
                $arrayPrestamo = new Prestamo ($arrayPrestamo);
                if($arrayPrestamo->create()){
                    header("Location: ../../views/modules/Prestamo/index.php?respuesta=correcto");
                }
            }else{
                header("Location: ../../views/modules/Prestamo/create.php?respuesta=error&mensaje= Kit ya registrado");
            }
        } catch (Exception $e) {
            header("Location: ../../views/modules/Prestamo/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }


    static public function edit (){
        try {
            $arrayPrestamo['FechaPrestamo'] = $_POST['FechaPrestamo'];
            $arrayPrestamo['FechaEntrega'] = $_POST['FechaEntrega'];
            $arrayPrestamo['Descripcion'] = $_POST['Descripcion'];
            $arrayPrestamo['Estado'] = $_POST['Estado'];
            $arrayPrestamo['Persona_id'] = Persona::searchForId($_POST['Persona_id']);
            $user = new Prestamo ($arrayPrestamo);
            $user->update();

            header("Location: ../../views/modules/Prestamo/show.php?Id=".$user->getId()."&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Prestamo/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function activate (){
        try {
            $ObjPrestamo = Prestamo::searchForId($_GET['Id']);
            $ObjPrestamo->setEstado("Activo");
            if($ObjPrestamo->update()){
                header("Location: ../../views/modules/Prestamo/index.php");
            }else{
                header("Location: ../../views/modules/Prestamo/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Prestamo/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function inactivate (){
        try {
            $ObjPrestamo = Prestamo::searchForId($_GET['Id']);
            $ObjPrestamo->setEstado("Inactivo");
            if($ObjPrestamo->update()){
                header("Location: ../../views/modules/Prestamo/index.php");
            }else{
                header("Location: ../../views/modules/Prestamo/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Prestamo/index.php?respuesta=error");
        }
    }

    static public function searchForID ($Id){
        try {
            return Prestamo::searchForId($Id);
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../views/modules/usuarios/manager.php?respuesta=error");
        }
    }

    static public function getAll (){
        try {
            return Prestamo::getAll();
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/modules/persona/manager.php?respuesta=error");
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