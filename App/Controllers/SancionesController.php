<?php

namespace App\Controllers;
require(__DIR__ . '/../models/Sanciones.php');
require_once(__DIR__.'/../Models/GeneralFunctions.php');

use App\models\Sanciones;
if(!empty($_GET['action'])){
    SancionesController::main($_GET['action']);
}

class SancionesController{

    static function main($action)
    {
        if ($action == "create") {
            SancionesController::create();
        } else if ($action == "edit") {
            SancionesController::edit();
        } else if ($action == "searchForID") {
            SancionesController::searchForId($_REQUEST['Id']);
        } else if ($action == "searchAll") {
            SancionesController::getAll();
        } else if ($action == "activate") {
            SancionesController::activate();
        } else if ($action == "inactivate") {
            SancionesController::inactivate();
        }

    }

    static public function create()
    {
        try {
            $arraySanciones = array();
            $arraySanciones['Tipo'] = $_POST['Tipo'];
            $arraySanciones['Descripcion'] = $_POST['Descripcion'];
            $arraySanciones['Prestamo'] = Prestamo::searchForId ($_POST['Prestamo']);
            $arraySanciones['Estado'] = 'Activo';
            if(!Sanciones::SancionRegistrada($arraySanciones['Id'])){
                $Sanciones = new Sanciones ($arraySanciones);
                if($Sanciones->create()){
                    header("Location: ../../Views/modules/Sanciones/index.php?respuesta=correcto");
                }
            }else{
                header("Location: ../../Views/modules/Sanciones/create.php?respuesta=error&mensaje=Sancion ya registrado");
            }
        } catch (Exception $e) {
            header("Location: ../../Views/modules/Sanciones/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function edit (){
        try {
            $arraySanciones = array();
            $arraySanciones['Tipo'] = $_POST['Tipo'];
            $arraySanciones['Descripcion'] = $_POST['Descripcion'];
            $arraySanciones['Prestamo'] = Prestamo::searchForId ($_POST['Prestamo']);
            $arraySanciones['Estado'] = $_POST['Estado'];


            $user = new Sancion($arraySanciones);
            $user->update();

            header("Location: ../../Views/modules/Sanciones/show.php?id=".$user->getId()."&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/modules/Sanciones/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function activate (){
        try {
            $ObjSanciones = Sanciones::searchForId($_GET['Id']);
            $ObjSanciones->setEstado("Activo");
            if($ObjSanciones->update()){
                header("Location: ../../Views/modules/Sanciones/index.php");
            }else{
                header("Location: ../../Views/modules/Sanciones/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/modules/Sanciones/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function inactivate (){
        try {
            $ObjSanciones = Sanciones::searchForId($_GET['Id']);
            $ObjSanciones->setEstado("Inactivo");
            if($ObjSanciones->update()){
                header("Location: ../../Views/modules/Sanciones/index.php");
            }else{
                header("Location: ../../Views/modules/Sanciones/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/modules/Sanciones/index.php?respuesta=error");
        }
    }

    static public function searchForId($Id){
        try {
            return Sanciones::searchForId($Id);
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../views/modules/Persona/manager.php?respuesta=error");
        }
    }

    static public function getAll (){
        try {
            return Sanciones::getAll();
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/modules/persona/manager.php?respuesta=error");
        }
    }


}
