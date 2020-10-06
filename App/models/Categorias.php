<?php

namespace App\Models;

require('BasicModel.php');

class categorias extends conexion
{
    private $id;
    private $nombre;



    /**
     * categorias constructor.
     * @param $id
     * @param $nombre

     */
    public function __construct($categorias = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->id = $categorias['id'] ?? null;
        $this->nombre = $categorias['nombre'] ?? null;


    }

    /* Metodo destructor cierra la conexion. */
    function __destruct() {
        $this->Disconnect();
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNombres() : string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombres(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */

    /**
     * @return string
     */
    public function getUser() : string
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser(string $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */

    public function create() : bool
    {
        $result = $this->insertRow("INSERT INTO weber.usuarios VALUES (NULL, ?)", array(
            $this->nombres,

            )
        );
        $this->Disconnect();
        return $result;
    }

    public function update() : bool
    {
        $result = $this->updateRow("UPDATE weber.usuarios SET nombre = ?, WHERE id = ?", array(
                $this->nombre,
                $this->id
            )
        );
        $this->Disconnect();
        return $result;
    }

    public function deleted($id) : void
    {
        // TODO: Implement deleted() method.
    }

    public static function search($query) : array
    {
        $arrUsuarios = array();
        $tmp = new categorias();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Usuario = new categorias();
            $Usuario->id = $valor['id'];
            $Usuario->nombres = $valor['nombres'];
            $Usuario->apellidos = $valor['apellidos'];
            $Usuario->tipo_documento = $valor['tipo_documento'];
            $Usuario->documento = $valor['documento'];
            $Usuario->telefono = $valor['telefono'];
            $Usuario->direccion = $valor['direccion'];
            $Usuario->user = $valor['user'];
            $Usuario->password = $valor['password'];
            $Usuario->rol = $valor['rol'];
            $Usuario->estado = $valor['estado'];
            $Usuario->Disconnect();
            array_push($arrUsuarios, $Usuario);
        }
        $tmp->Disconnect();
        return $arrUsuarios;
    }

    public static function searchForId($id) : categorias
    {
        $Usuario = null;
        if ($id > 0){
            $Usuario = new categorias();
            $getrow = $Usuario->getRow("SELECT * FROM weber.usuarios WHERE id =?", array($id));
            $Usuario->id = $getrow['id'];
            $Usuario->nombres = $getrow['nombres'];
            $Usuario->apellidos = $getrow['apellidos'];
            $Usuario->tipo_documento = $getrow['tipo_documento'];
            $Usuario->documento = $getrow['documento'];
            $Usuario->telefono = $getrow['telefono'];
            $Usuario->direccion = $getrow['direccion'];
            $Usuario->user = $getrow['user'];
            $Usuario->password = $getrow['password'];
            $Usuario->rol = $getrow['rol'];
            $Usuario->estado = $getrow['estado'];
        }
        $Usuario->Disconnect();
        return $Usuario;
    }

    public static function getAll() : array
    {
        return categorias::search("SELECT * FROM weber.usuarios");
    }

    public static function usuarioRegistrado ($documento) : bool
    {
        $result = categorias::search("SELECT id FROM weber.usuarios where documento = ".$documento);
        if (count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

}