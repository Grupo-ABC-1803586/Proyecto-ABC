<?php

namespace App\models;

require('Conexion.php');

class Categoria extends conexion
{
    private $Id;
    private $Nombre;



    /**
     * categorias constructor.
     * @param $Id
     * @param $Nombre

     */
    public function __construct($Categoria = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->Id = $Categoria['Id'] ?? null;
        $this->Nombre = $Categoria['Nombre'] ?? null;


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
        return $this->Id;
    }

    /**
     * @param int $Id
     */
    public function setId(int $Id): void
    {
        $this->Id = $Id;
    }

    /**
     * @return string
     */
    public function getNombre() : string
    {
        return $this->Nombre;
    }

    /**
     * @param string $Nombre
     */
    public function setNombre(string $Nombre): void
    {
        $this->Nombre = $Nombre;
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
        $result = $this->insertRow("INSERT INTO proyecto_sena.Categoria VALUES (NULL, ?)", array(
            $this->Nombre

            )
        );
        $this->Disconnect();
        return $result;
    }

    public function update() : bool
    {
        $result = $this->updateRow("UPDATE proyecto_sena.Categoria SET Nombre = ?, WHERE Id = ?", array(
                $this->Nombre,
                $this->Id
            )
        );
        $this->Disconnect();
        return $result;
    }

    public function deleted($Id) : void
    {
        // TODO: Implement deleted() method.
    }

    public static function search($query) : array
    {
        $arrCategoria = array();
        $tmp = new Categoria();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Categoria = new Categoria();
            $Categoria->Id = $valor['Id'];
            $Categoria->Nombre = $valor['Nombre'];
            $Categoria->Disconnect();
            array_push($arrCategoria, $Categoria);
        }
        $tmp->Disconnect();
        return $arrCategoria;
    }

    public static function searchForId($Id) : Categoria
    {
        $Categoria = null;
        if ($Id > 0) {
            $Categoria = new Categoria();
            $getrow = $Categoria->getRow("SELECT * FROM proyecto_sena.Categoria WHERE Id =?", array($Id));
            $Categoria->Id = $getrow['Id'];
            $Categoria->Nombre = $getrow['Nombre'];
         }
        $Categoria->Disconnect();
        return $Categoria;
    }

    public static function getAll() : array
    {
        return Categoria::search("SELECT * FROM proyecto_sena.Categoria");
    }

    public static function CategoriaRegistrada ($Id) : bool
    {
        $result = Categoria::search("SELECT Id FROM proyecto_sena.Categoria where Nombre = ".($Id));
        if (count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

}