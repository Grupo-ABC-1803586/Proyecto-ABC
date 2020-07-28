<?php

namespace App\Controllers;
require(_DIR_ . '/../models/Categoria.php');

use App\models\Categoria;


if(!empty($_GET['action'])){
    CategoriaController::main($_GET['action']);
}

class CategoriaController
{

    static function main($action)
    {
        if ($action == "create") {
            CategoriaController::create();
        } else if ($action == "edit") {
            CategoriaController::edit();
        } else if ($action == "searchForId") {
            CategoriaController::searchForId($_REQUEST['Id']);
        } else if ($action == "searchAll") {
            CategoriaController::getAll();
        } else if ($action == "activate") {
            CategoriaController::activate();
        } else if ($action == "inactivate") {
            CategoriaController::inactivate();
        }/*else if ($action == "login"){
            CategoriaController::login();
        }else if($action == "cerrarSession"){
            CategoriaController::cerrarSession();
        }*/

    }

    static public function create()
    {
        try {

            $arrayCategoria = array();
            $arrayCategoria['Nombre'] = $_POST['Nombre'];

            var_dump($_POST);
            if (!Categoria::CategoriaRegistrada($arrayCategoria['Nombre'])) {
                $Categoria = new Nombre ($arrayCategoria);
                if ($Categoria->create()) {
                    header("Location: ../../Views/modules/Categoria/index.php?respuesta=correcto");
                }
            } else {
                header("Location: ../../Views/modules/Categoria/create.php?respuesta=error&mensaje=Categoria Registrada ");
            }
        } catch (Exception $e) {
            header("Location: ../../Views/modules/Categoria/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }


    static public function edit()
    {
        try {
            $arrayCategoria = array();
            $arrayCategoria['Nombre'] = $_POST['Nombre'];
            $arrayCategoria['Id'] = $_POST['Id'];

            $Categoria = new Categoria($arrayCategoria);
            $Categoria->update();

            header("Location: ../../Views/modules/Categoria/show.php?Id=" . $Categoria->getId() . "&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/modules/Categoria/edit.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function activate()
    {
        try {
            $ObjCategoria = Categoria\searchForId($_GET['Id']);

            $ObjCategoria->setEstado("Activo");
            if ($ObjCategoria->update()) {
                header("Location: ../../Views/modules/Categoria/index.php");
            } else {
                header("Location: ../../Views/modules/Categoria/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/modules/Categoria/index.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function inactivate()
    {
        try {
            $ObCategoria = Categoria::searchForId($_GET['Id']);
            $ObCategoria->setEstado("Inactivo");
            if ($ObCategoria->update()) {
                header("Location: ../../Views/modules/Categoria/index.php");
            } else {
                header("Location: ../../Views/modules/Categoria/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/modules/Categoria/index.php?respuesta=error");
        }
    }

    static public function searchForId($Id)
    {
        try {
            return Categoria::searchForId($Id);
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../views/modules/Categoria/manager.php?respuesta=error");
        }
    }

    static public function getAll()
    {
        try {
            return Categoria::getAll();
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/modules/persona/manager.php?respuesta=error");
        }
    }
}

