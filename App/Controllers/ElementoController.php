<?php

namespace App\Controllers;
<<<<<<< HEAD:App/Controllers/ElementoController.php
require_once(__DIR__.'/../Models/Elemento.php');
require_once(__DIR__.'/../Models/Categoria.php');

use App\Models\GeneralFunctions;
use App\Models\Elemento;
use App\Models\Categoria;



if(!empty($_GET['action'])){
    ElementoController::main($_GET['action']);
}

class ElementoController{
=======

require_once(__DIR__.'/../Models/Marca.php');
require_once(__DIR__.'/../Models/Items.php');
require_once(__DIR__.'/../Models/Unidades.php');

use App\Models\GeneralFunctions;
use App\Models\Items;
use App\Models\Marca;

use App\Models\Unidades;

if(!empty($_GET['action'])){
    ItemsController::main($_GET['action']);
}

class ItemsController{
>>>>>>> Yolixs:App/Controllers/ItemsController.php

    static function main($action)
    {
        if ($action == "create") {
<<<<<<< HEAD:App/Controllers/ElementoController.php
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
=======
            ItemsController::create();
        } else if ($action == "edit") {
            ItemsController::edit();
        } else if ($action == "searchForID") {
            ItemsController::searchForID($_REQUEST['Id']);
        } else if ($action == "searchAll") {
            ItemsController::getAll();
        } else if ($action == "activate") {
            ItemsController::activate();
        } else if ($action == "inactivate") {
            ItemsController::inactivate();
>>>>>>> Yolixs:App/Controllers/ItemsController.php
        }
    }

    static public function create()
    {
        try {
<<<<<<< HEAD:App/Controllers/ElementoController.php
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
=======
            $arrayitem = array();
            $arrayitem['Placa'] = $_POST['Placa'];
            $arrayitem['Descripcion'] = $_POST['Descripcion'];
            $arrayitem['Ubicacion'] = $_POST['Ubicacion'];
            $arrayitem['Imagen'] = 'Imagen';
            $arrayitem['Marca'] = Marca::searchForId($_POST['Marca']);
            $arrayitem['Unidades'] = Marca::searchForId($_POST['Unidades']);
            $arrayitem['Estado'] = 'Activo';
            $item = new Items($arrayitem);
            if($item->create()){
                header("Location: ../../views/modules/Items/create.php?Id=".$item->getId());
            }
        } catch (Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Items/create.php?respuesta=error&mensaje=" . $e->getMessage());
>>>>>>> Yolixs:App/Controllers/ItemsController.php
        }
    }

    static public function edit (){
        try {
<<<<<<< HEAD:App/Controllers/ElementoController.php
            $arrayElemento = array();
            $arrayElemento['Nombre'] = $_POST['Nombre'];
            $arrayElemento['Descripcion'] = $_POST['Descripcion'];
            $arrayElemento['Serie'] = $_POST['Serie'];
            $arrayElemento['Categoria'] = Categoria::searchForId($_POST['Categoria']);
            $arrayElemento['Material'] = $_POST['Material'];
            $arrayElemento['Id'] = $_POST['Id'];

            $Elemento = new Elemento($arrayElemento);
            $Elemento->update();

            header("Location: ../../views/modules/Elemento/show.php?id=".$Elemento->getId()."&respuesta=correcto");
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Elemento/edit.php?respuesta=error&mensaje=".$e->getMessage());
=======
            $arrayitem = array();
            $arrayitem['Placa'] = $_POST['Placa'];
            $arrayitem['Descripcion'] = $_POST['Descripcion'];
            $arrayitem['Ubicacion'] = $_POST['Ubicacion'];
            $arrayitem['Imagen'] = $_POST ['Imagen'];
            $arrayitem['Elemento'] = Elemento::searchForId($_POST['Elemento']);
            $arrayitem['Marca'] = Marca::searchForId($_POST['Marca']);
            $arrayitem['Kit'] = Kit::searchForId($_POST['Kit']);
            $arrayitem['Unidades'] = Marca::searchForId($_POST['Unidades']);
            $arrayitem['Estado'] = 'Activo';
            $arrayitem['Id'] = $_POST['Id'];


            $item = new Items($arrayitem);
            $item->update();

            header("Location: ../../views/modules/Items/show.php?Id=".$item->getId()."&respuesta=correcto");
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Items/edit.php?respuesta=error&mensaje=".$e->getMessage());
>>>>>>> Yolixs:App/Controllers/ItemsController.php
        }
    }

    static public function activate (){
        try {
<<<<<<< HEAD:App/Controllers/ElementoController.php
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
=======
            $Objitem = Items::searchForId($_GET['Id']);
            $Objitem->setEstado("Activo");
            if($Objitem->update()){
                header("Location: ../../views/modules/Items/index.php");
            }else{
                header("Location: ../../views/modules/Items/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Items/index.php?respuesta=error&mensaje=".$e->getMessage());
>>>>>>> Yolixs:App/Controllers/ItemsController.php
        }
    }

    static public function inactivate (){
        try {
<<<<<<< HEAD:App/Controllers/ElementoController.php
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
=======
            $Objitem = Items::searchForId($_GET['Id']);
            $Objitem->setEstado("Inactivo");
            if($Objitem->update()){
                header("Location: ../../views/modules/Items/index.php");
            }else{
                header("Location: ../../views/modules/Items/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Items/index.php?respuesta=error");
>>>>>>> Yolixs:App/Controllers/ItemsController.php
        }
    }

    static public function searchForID ($Id){
        try {
<<<<<<< HEAD:App/Controllers/ElementoController.php
            return Elemento::searchForId($id);
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            //header("Location: ../../views/modules/Elemento/manager.php?respuesta=error");
=======
            return Items::searchForId($Id);
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            //header("Location: ../../views/modules/ventas/manager.php?respuesta=error");
>>>>>>> Yolixs:App/Controllers/ItemsController.php
        }
    }

    static public function getAll()
    {
        try {
<<<<<<< HEAD:App/Controllers/ElementoController.php
            return Elemento::getAll();
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'log', 'errorStack');
            header("Location: ../Vista/modules/Categoria/manager.php?respuesta=error");
=======
            return Items::getAll();
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../Views/Modules/Compra/manager.php?respuesta=error");
>>>>>>> Yolixs:App/Controllers/ItemsController.php
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