<?php

namespace App\Controller;
require(__DIR__ . '/../models/Categoria.php');
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
            CategoriaController::searchForId($_REQUEST['IdCategoria']);
        } else if ($action == "searchAll") {
            CategoriaController::getAll();
        } else if ($action == "activate") {
            CategoriaController::activate();
        } else if ($action == "inactivate") {
            CategoriaController::inactivate();
        }}

    static public function create()
    {
        try {

            $arrayCategoria = array();
            $arrayCategoria['Nombre'] = $_POST['Nombre'];

            var_dump($_POST);
            if(!Categoria::CategoriaRegistrado($arrayCategoria['Nombre'])){
                $Categoria = new Categoria ($arrayCategoria);
                if($Categoria->create()){
                    header("Location: ../../Views/modules/Categoria/index.php?respuesta=correcto");
                }
            }else{
                header("Location: ../../Views/modules/Categoria/create.php?respuesta=error&mensaje=Usuario ya registrado");
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

            $user = new Categoria($arrayCategoria);
            $user->update();

            header("Location: ../../Views/modules/Categoria/show.php?Id=" . $user->getId() . "&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../Views/modules/Categoria/edit.php?respuesta=error&mensaje=" . $e->getMessage());        }
    }

    static public function activate()
    {
        try {
            $ObjCategoria = Categoria::searchForId($_GET['Id']);
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
            $ObjCategoria = Categoria::searchForId($_GET['Id']);
            $ObjCategoria->setEstado("Inactivo");
            if ($ObjCategoria->update()) {
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
            //header("Location: ../../Views/modules/Categoria/manager.php?respuesta=error");
        }
    }

    static public function getAll()
    {
        try {
            return Categoria::getAll();
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/modules/Persona/manager.php?respuesta=error");
        }
    }

}