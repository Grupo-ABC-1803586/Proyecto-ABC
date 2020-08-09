<?php

namespace App\Controllers;

require_once(__DIR__ . '/../models/ProgramaFormacion.php');
require_once(__DIR__.'/../Models/GeneralFunctions.php');


use App\Models\GeneralFunctions;
use App\models\Persona;
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
            PersonaController::searchForDocumento($_REQUEST['Documento']);
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
            $arrayPersona['Nombre'] = $_POST['Nombre'];
            $arrayPersona['Apellido'] = $_POST['Apellido'];
            $arrayPersona['Telefono'] = $_POST['Telefono'];
            $arrayPersona['Correo'] = $_POST['Correo'];
            $arrayPersona['Rol'] = $_POST['Rol'];
            $arrayPersona['Contraseña'] = $_POST['Contraseña'];
            $arrayPersona['ProgramaFormacion'] = ProgramaFormacion::searchForId ($_POST['ProgramaFormacion']);
            $arrayPersona['Estado'] = 'Activo';
            if(!Persona::PersonaRegistrada($arrayPersona['Nombre'])){
                $Persona = new Personas ($arrayPersona);
                if($Persona->create()){
                    header("Location: ../../Views/modules/Persona/index.php?respuesta=correcto");
                }
            }else{
                header("Location: ../../Views/modules/Persona/create.php?respuesta=error&mensaje=Persona ya registrado");
            }
        } catch (Exception $e) {
            //header("Location: ../../Views/modules/Persona/create.php?respuesta=error&mensaje=" . $e->getMessage());
            GeneralFunctions::console( $e, 'error', 'errorStack');
        }
    }

    static public function edit (){
        try {
            $arrayPersona = array();
            $arrayPersona['Nombre'] = $_POST['Nombre'];
            $arrayPersona['Apellido'] = $_POST['Apellido'];
            $arrayPersona['Telefono'] = $_POST['Telefono'];
            $arrayPersona['Correo'] = $_POST['Correo'];
            $arrayPersona['Rol'] = $_POST['Rol'];
            $arrayPersona['Contraseña'] = $_POST['Contraseña'];
            $arrayPersona['ProgramaFormacion'] = ProgramaFormacion::searchForId ($_POST['ProgramaFormacion']);
            $arrayPersona['Estado'] = $_POST['Estado'];
            $arrayPersona['Documento'] = $_POST ['Documento'];

            $user = new Personas($arrayPersona);
            $user->update();

            header("Location: ../../Views/modules/Persona/show.php?id=".$user->getDocumento()."&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/modules/Persona/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function activate (){
        try {
            $ObjPersona = Persona::searchForDocumento($_GET['Documento']);
            $ObjPersona->setEstado("Activo");
            if($ObjPersona->update()){
                header("Location: ../../Views/modules/Persona/index.php");
            }else{
                header("Location: ../../Views/modules/Persona/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            GeneralFunctions::console( $e, 'error', 'errorStack');
            //header("Location: ../../Views/modules/Persona/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function inactivate (){
        try {
            $ObjPersona = Persona::searchForDocumento($_GET['Documento']);
            $ObjPersona->setEstado("Inactivo");
            if($ObjPersona->update()){
                header("Location: ../../Views/modules/Persona/index.php");
            }else{
                header("Location: ../../Views/modules/Persona/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            GeneralFunctions::console( $e, 'error', 'errorStack');
            //header("Location: ../../Views/modules/Persona/index.php?respuesta=error");
        }
    }

    static public function searchForDocumento ($Documento){
        try {
            return Persona::searchForDocumento($Documento);
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            //var_dump($e);
            //header("Location: ../../views/modules/Persona/manager.php?respuesta=error");
        }
    }

    static public function getAll (){
        try {
            return Persona::getAll();
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            //var_dump($e);
            //header("Location: ../Vista/modules/persona/manager.php?respuesta=error");
        }
    }
    /*
    private static function PersonaIsInArray($IdPersona, $ArrPersona){
        if(count($ArrPersona) > 0){
            foreach ($ArrPersona as $Usuario){
                if($Usuario->getId() == $idUsuario){
                    return true;
                }
            }
        }
        return false;
    }

    static public function selectUsuario ($isMultiple=false,
                                          $isRequired=true,
                                          $id="idUsuario",
                                          $nombre="idUsuario",
                                          $defaultValue="",
                                          $class="form-control",
                                          $where="",
                                          $arrExcluir = array()){
        $arrUsuarios = array();
        if($where != ""){
            $base = "SELECT * FROM usuarios WHERE ";
            $arrUsuarios = Usuarios::search($base.' '.$where);
        }else{
            $arrUsuarios = Usuarios::getAll();
        }

        $htmlSelect = "<select ".(($isMultiple) ? "multiple" : "")." ".(($isRequired) ? "required" : "")." id= '".$id."' name='".$nombre."' class='".$class."' style='width: 100%;'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(count($arrUsuarios) > 0){
            foreach ($arrUsuarios as $usuario)
                if (!UsuariosController::usuarioIsInArray($usuario->getId(),$arrExcluir))
                    $htmlSelect .= "<option ".(($usuario != "") ? (($defaultValue == $usuario->getId()) ? "selected" : "" ) : "")." value='".$usuario->getId()."'>".$usuario->getDocumento()." - ".$usuario->getNombres()." ".$usuario->getApellidos()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
*/
}