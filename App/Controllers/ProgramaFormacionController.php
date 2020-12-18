<?php

namespace App\Controllers;

require_once(__DIR__ . '/../Models/ProgramaFormacion.php');

use App\Models\ProgramaFormacion;

if(!empty($_GET['action'])){
    ProgramaFormacionController::main($_GET['action']);
}

class ProgramaFormacionController{

    static function main($action)
    {
        if ($action == "create") {
            ProgramaFormacionController::create();
        } else if ($action == "edit") {
            ProgramaFormacionController::edit();
        } else if ($action == "searchForId") {
            ProgramaFormacionController::searchForId($_REQUEST['id']);
        } else if ($action == "searchAll") {
            ProgramaFormacionController::getAll();
        } else if ($action == "activate") {
            ProgramaFormacionController::activate();
        } else if ($action == "inactivate") {
            ProgramaFormacionController::inactivate();
        }
    }

    static public function create()    {
        try {

            $arrayProgramaFormacion = array();
            $arrayProgramaFormacion['FechaRegistro'] = $_POST['FechaRegistro'];
            $arrayProgramaFormacion['NumeroFicha'] = $_POST['NumeroFicha'];
            $arrayProgramaFormacion['FechaInicio'] = $_POST['FechaInicio'];
            $arrayProgramaFormacion['FechaFinalizacion'] = $_POST['FechaFinalizacion'];
            $arrayProgramaFormacion['NombrePrograma'] = $_POST['NombrePrograma'];
            $arrayProgramaFormacion['NivelPrograma'] = $_POST['NivelPrograma'];
            if(!ProgramaFormacion::ProgramaformacionRegistrado($arrayProgramaFormacion['NumeroFicha'])){
                $ProgramaFormacion = new ProgramaFormacion ($arrayProgramaFormacion);
                if($ProgramaFormacion->create()){
                    header("Location: ../../views/modules/ProgramaFormacion/index.php?respuesta=correcto");
                }
            }else{
                header("Location: ../../views/modules/ProgramaFormacion/create.php?respuesta=error&mensaje=Usuario ya registrado");
            }
        } catch (Exception $e) {
            header("Location: ../../views/modules/ProgramaFormacion/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }


    static public function edit (){
        try {
            $arrayProgramaFormacion = array();
            $arrayProgramaFormacion['FechaRegistro'] = $_POST['FechaRegistro'];
            $arrayProgramaFormacion['NumeroFicha'] = $_POST['NumeroFicha'];
            $arrayProgramaFormacion['FechaInicio'] = $_POST['FechaInicio'];
            $arrayProgramaFormacion['FechaFinalizacion'] = $_POST['FechaFinalizacion'];
            $arrayProgramaFormacion['NombrePrograma'] = $_POST['NombrePrograma'];
            $arrayProgramaFormacion['NivelPrograma'] = $_POST['NivelPrograma'];
            $arrayProgramaFormacion['Id'] = $_POST['Id'];

            $ProgramaFormacion = new ProgramaFormacion($arrayProgramaFormacion);
            $ProgramaFormacion->update();

            header("Location: ../../views/modules/programaformacion/show.php?Id=".$ProgramaFormacion->getId()."&respuesta=correcto");
        } catch (\Exception $e) {
            header("Location: ../../views/modules/programaformacion/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function activate (){
        try {
            $ObjProgramaFormacion = ProgramaFormacion::searchForId($_GET['Id']);

            $ObjProgramaFormacion->setEstado("Activo");
            if($ObjProgramaFormacion->update()){
                header("Location: ../../views/modules/ProgramaFormacion/index.php");
            }else{
                header("Location: ../../views/modules/ProgramaFormacion/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            header("Location: ../../views/modules/ProgramaFormacion/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function inactivate (){
        try {
            $ObjProgramaFormacion = ProgramaFormacion::searchForId($_GET['Id']);
            $ObjProgramaFormacion->setEstado("Inactivo");
            if($ObjProgramaFormacion->update()){
                header("Location: ../../views/modules/ProgramaFormacion/index.php");
            }else{
                header("Location: ../../views/modules/ProgramaFormacion/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/ProgramaFormacion/index.php?respuesta=error");
        }
    }

    static public function searchForId ($id){
        try {
            return ProgramaFormacion::searchForId($id);
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../views/modules/usuarios/manager.php?respuesta=error");
        }
    }

    static public function getAll (){
        try {
            return ProgramaFormacion::getAll();
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/modules/ProgramaFormacion/manager.php?respuesta=error");
        }
    }

    public static function ProgramaFormacionIsInArray($Id, $ArrProgramaFormacion){
        if(count($ArrProgramaFormacion) > 0){
            foreach ($ArrProgramaFormacion as $ProgramaFormacion){
                if($ProgramaFormacion->getIdProgramaFormacion() == $Id){
                    return true;
                }
            }
        }
        return false;
    }

    static public function selectProgramaFormacion ($isMultiple=false,
                                          $isRequired=true,
                                          $Id="ProgramaFormacion",
                                          $NombrePrograma="ProgramaFormacion",
                                          $defaultValue="",
                                          $class="",
                                          $where="",
                                          $arrExcluir = array()){
        $arrProgramaFormacion = array();
        if($where != ""){
            $base = "SELECT * FROM ProgramaFormacion WHERE ";
            $arrProgramaFormacion = ProgramaFormacion::search($base.$where);
        }else{
            $arrProgramaFormacion = ProgramaFormacion::getAll();
        }

        $htmlSelect = "<select ".(($isMultiple) ? "multiple" : "")." ".(($isRequired) ? "required" : "")." id= '".$Id."' name='".$NombrePrograma."' class='".$class."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(count($arrProgramaFormacion) > 0){
            foreach ($arrProgramaFormacion as $ProgramaFormacion)
                if (!ProgramaFormacionController::ProgramaFormacionIsInArray($ProgramaFormacion->getId(),$arrExcluir))
                    $htmlSelect .= "<option ".(($ProgramaFormacion != "") ? (($defaultValue == $ProgramaFormacion->getId()) ? "selected" : "" ) : "")." value='".$ProgramaFormacion->getId()."'>".$ProgramaFormacion->getNombrePrograma()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }

    /*
    public function buscar ($Query){
        try {
            return ProgramaFormacion::buscar($Query);
        } catch (Exception $e) {
            header("Location: ../Vista/modules/ProgramaFormacion/manager.php?respuesta=error");
        }
    }

    static public function asociarEspecialidad (){
        try {
            $ProgramaFormacion = new ProgramaFormacion();
            $ProgramaFormacion->asociarEspecialidad($_POST['ProgramaFormacion'],$_POST['Especialidad']);
            header("Location: ../Vista/modules/ProgramaFormacion/managerSpeciality.php?respuesta=correcto&id=".$_POST['ProgramaFormacion']);
        } catch (Exception $e) {
            header("Location: ../Vista/modules/ProgramaFormacion/managerSpeciality.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function eliminarEspecialidad (){
        try {
            $ObjProgramaFormacion = new ProgramaFormacion();
            if(!empty($_GET['ProgramaFormacion']) && !empty($_GET['Especialidad'])){
                $ObjProgramaFormacion->eliminarEspecialidad($_GET['ProgramaFormacion'],$_GET['Especialidad']);
            }else{
                throw new Exception('No se recibio la informacion necesaria.');
            }
            header("Location: ../Vista/modules/ProgramaFormacion/managerSpeciality.php?id=".$_GET['ProgramaFormacion']);
        } catch (Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/modules/ProgramaFormacion/manager.php?respuesta=error");
        }
    }

    public static function login (){
        try {
            if(!empty($_POST['Usuario']) && !empty($_POST['Contrasena'])){
                $tmpPerson = new ProgramaFormacion();
                $respuesta = $tmpPerson->Login($_POST['Usuario'], $_POST['Contrasena']);
                if (is_a($respuesta,"ProgramaFormacion")) {
                    $hydrator = new ReflectionHydrator(); //Instancia de la clase para convertir objetos
                    $ArrDataProgramaFormacion = $hydrator->extract($respuesta); //Convertimos el objeto ProgramaFormacion en un array
                    unset($ArrDataProgramaFormacion["datab"],$ArrDataProgramaFormacion["isConnected"],$ArrDataProgramaFormacion["relEspecialidades"]); //Limpiamos Campos no Necesarios
                    $_SESSION['UserInSession'] = $ArrDataProgramaFormacion;
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
        header("Location: ../Vista/modules/ProgramaFormacion/login.php");
    }*/

}