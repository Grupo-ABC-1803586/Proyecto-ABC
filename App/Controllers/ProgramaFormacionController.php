<?php

namespace App\Controllers;
<<<<<<< HEAD
<<<<<<< HEAD:App/Controllers/UsuariosController.php
require(__DIR__ . '/../Models/Categorias.php');
use App\Models\categorias;
=======
require(__DIR__ . '/../Models/ProgramaFormacion.php');
=======
require_once(__DIR__ . '/../Models/ProgramaFormacion.php');
>>>>>>> origin/master

use App\Models\ProgramaFormacion;

>>>>>>> origin/master:App/Controllers/ProgramaFormacionController.php

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
        }/*else if ($action == "login"){
            ProgramaFormacionController::login();
        }else if($action == "cerrarSession"){
            ProgramaFormacionController::cerrarSession();
        }*/

    }

    static public function create()
    {
        try {
<<<<<<< HEAD:App/Controllers/UsuariosController.php
            $arrayUsuario = array();
            $arrayUsuario['nombres'] = $_POST['nombres'];
            $arrayUsuario['apellidos'] = $_POST['apellidos'];
            $arrayUsuario['tipo_documento'] = $_POST['tipo_documento'];
            $arrayUsuario['documento'] = $_POST['documento'];
            $arrayUsuario['telefono'] = $_POST['telefono'];
            $arrayUsuario['direccion'] = $_POST['direccion'];
            $arrayUsuario['rol'] = 'Cliente';
            $arrayUsuario['estado'] = 'Activo';
            if(!categorias::usuarioRegistrado($arrayUsuario['documento'])){
                $Usuario = new categorias ($arrayUsuario);
                if($Usuario->create()){
                    header("Location: ../../views/modules/usuarios/conexion.php?respuesta=correcto");
=======

            $arrayProgramaFormacion = array();
            $arrayProgramaFormacion['FechaRegistro'] = $_POST['FechaRegistro'];
            $arrayProgramaFormacion['NumeroFicha'] = $_POST['NumeroFicha'];
            $arrayProgramaFormacion['FechaInicio'] = $_POST['FechaInicio'];
            $arrayProgramaFormacion['FechaFinalizacion'] = $_POST['FechaFinalizacion'];
            $arrayProgramaFormacion['NombrePrograma'] = $_POST['NombrePrograma'];
            $arrayProgramaFormacion['NivelPrograma'] = $_POST['NivelPrograma'];
 var_dump($_POST);
            if(!ProgramaFormacion::ProgramaformacionRegistrado($arrayProgramaFormacion['NumeroFicha'])){
                $ProgramaFormacion = new ProgramaFormacion ($arrayProgramaFormacion);
                if($ProgramaFormacion->create()){
                    header("Location: ../../views/modules/ProgramaFormacion/index.php?respuesta=correcto");
>>>>>>> origin/master:App/Controllers/ProgramaFormacionController.php
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
<<<<<<< HEAD:App/Controllers/UsuariosController.php
            $arrayUsuario = array();
            $arrayUsuario['nombres'] = $_POST['nombres'];
            $arrayUsuario['apellidos'] = $_POST['apellidos'];
            $arrayUsuario['tipo_documento'] = $_POST['tipo_documento'];
            $arrayUsuario['documento'] = $_POST['documento'];
            $arrayUsuario['telefono'] = $_POST['telefono'];
            $arrayUsuario['direccion'] = $_POST['direccion'];
            $arrayUsuario['rol'] = $_POST['rol'];
            $arrayUsuario['estado'] = $_POST['estado'];
            $arrayUsuario['id'] = $_POST['id'];

            $user = new categorias($arrayUsuario);
            $user->update();

            header("Location: ../../views/modules/usuarios/show.php?id=".$user->getId()."&respuesta=correcto");
=======
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
>>>>>>> origin/master:App/Controllers/ProgramaFormacionController.php
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/programaformacion/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function activate (){
        try {
<<<<<<< HEAD:App/Controllers/UsuariosController.php
            $ObjUsuario = categorias::searchForId($_GET['Id']);
            $ObjUsuario->setEstado("Activo");
            if($ObjUsuario->update()){
                header("Location: ../../views/modules/usuarios/conexion.php");
            }else{
                header("Location: ../../views/modules/usuarios/conexion.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/usuarios/Conexion.php?respuesta=error&mensaje=".$e->getMessage());
=======
            $ObjProgramaFormacion = ProgramaFormacion::searchForId($_GET['Id']);

            $ObjProgramaFormacion->setEstado("Activo");
            if($ObjProgramaFormacion->update()){
                header("Location: ../../views/modules/Programaformacion/index.php");
            }else{
                header("Location: ../../views/modules/Programaformacion/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Programaformacion/index.php?respuesta=error&mensaje=".$e->getMessage());
>>>>>>> origin/master:App/Controllers/ProgramaFormacionController.php
        }
    }

    static public function inactivate (){
        try {
<<<<<<< HEAD:App/Controllers/UsuariosController.php
            $ObjUsuario = categorias::searchForId($_GET['Id']);
            $ObjUsuario->setEstado("Inactivo");
            if($ObjUsuario->update()){
                header("Location: ../../views/modules/usuarios/conexion.php");
            }else{
                header("Location: ../../views/modules/usuarios/Conexion.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/usuarios/Conexion.php?respuesta=error");
=======
            $ObProgramaFormacion = ProgramaFormacion::searchForId($_GET['Id']);
            $ObProgramaFormacion->setEstado("Inactivo");
            if($ObProgramaFormacion->update()){
                header("Location: ../../views/modules/Programaformacion/index.php");
            }else{
                header("Location: ../../views/modules/Programaformacion/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Programaformacion/index.php?respuesta=error");
>>>>>>> origin/master:App/Controllers/ProgramaFormacionController.php
        }
    }

    static public function searchForId ($id){
        try {
<<<<<<< HEAD:App/Controllers/UsuariosController.php
            return categorias::searchForId($id);
=======
            return ProgramaFormacion::searchForId($id);
>>>>>>> origin/master:App/Controllers/ProgramaFormacionController.php
        } catch (\Exception $e) {
            var_dump($e);
            //header("Location: ../../views/modules/usuarios/manager.php?respuesta=error");
        }
    }

    static public function getAll (){
        try {
<<<<<<< HEAD:App/Controllers/UsuariosController.php
            return categorias::getAll();
=======
            return ProgramaFormacion::getAll();
>>>>>>> origin/master:App/Controllers/ProgramaFormacionController.php
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