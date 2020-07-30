<?php

namespace App\Controllers;
require(__DIR__.'/../Models/Persona.php');
use App\Models\Persona;

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
            PersonaController::searchForID($_REQUEST['idPersona']);
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
            $arrayPersona['nombres'] = $_POST['nombres'];
            $arrayPersona['apellidos'] = $_POST['apellidos'];
            $arrayPersona['tipo_documento'] = $_POST['tipo_documento'];
            $arrayPersona['documento'] = $_POST['documento'];
            $arrayPersona['telefono'] = $_POST['telefono'];
            $arrayPersona['direccion'] = $_POST['direccion'];
            $arrayPersona['rol'] = 'Cliente';
            $arrayPersona['estado'] = 'Activo';
            if(!Persona::PersonaRegistrado($arrayPersona['documento'])){
                $Persona = new Persona ($arrayPersona);
                if($Persona->create()){
                    header("Location: ../../views/modules/Persona/index.php?respuesta=correcto");
                }
            }else{
                header("Location: ../../views/modules/Persona/create.php?respuesta=error&mensaje=Persona ya registrado");
            }
        } catch (Exception $e) {
            header("Location: ../../views/modules/Persona/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function edit (){
        try {
            $arrayPersona = array();
            $arrayPersona['tipo_documento'] = $_POST['tipo_documento'];
            $arrayPersona['Documento'] = $_POST['Documento'];
            $arrayPersona['Nombre'] = $_POST['Nombre'];
            $arrayPersona['Apellido'] = $_POST['Apellido'];
            $arrayPersona['Telefono'] = $_POST['Telefono'];
            $arrayPersona['Correo'] = $_POST['Correo'];
            $arrayPersona['Rol'] = $_POST['Rol'];
            $arrayPersona['estado'] = $_POST['estado'];
            $arrayPersona['id'] = $_POST['id'];

            $user = new Persona($arrayPersona);
            $user->update();

            header("Location: ../../views/modules/Persona/show.php?id=".$user->getId()."&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Persona/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function activate (){
        try {
            $ObjPersona = Persona::searchForId($_GET['Id']);
            $ObjPersona->setEstado("Activo");
            if($ObjPersona->update()){
                header("Location: ../../views/modules/Persona/index.php");
            }else{
                header("Location: ../../views/modules/Persona/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Persona/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function inactivate (){
        try {
            $ObjPersona = Persona::searchForId($_GET['Id']);
            $ObjPersona->setEstado("Inactivo");
            if($ObjPersona->update()){
                header("Location: ../../views/modules/Persona/index.php");
            }else{
                header("Location: ../../views/modules/Persona/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Persona/index.php?respuesta=error");
        }
    }

    static public function searchForID ($id){
        try {
            return Persona::searchForId($id);
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../views/modules/Persona/manager.php?respuesta=error");
        }
    }

    static public function getAll (){
        try {
            return Persona::getAll();
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/modules/persona/manager.php?respuesta=error");
        }
    }

}