<?php

namespace App\Models;

require('BasicModel.php');

class Marca extends BasicModel
{
    public $Id;
    public $Nombre;


    /**
     * Marca constructor.
     * @param $Id
     * @param $Nombre


     */
    public function __construct($Marca = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->Id = $Marca['Id'] ?? null;
        $this->Nombre = $Marca['Nombre'] ?? null;

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
        $this->id = $Id;
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



    public function create() : bool
    {
        $result = $this->insertRow("INSERT INTO Proyecto-ABC.Marca VALUES (NULL, ?)", array(
                $this->Nombre,

            )
        );
        $this->Disconnect();
        return $result;
    }

    public function update() : bool
    {
        $result = $this->updateRow("UPDATE Proyecto-ABC.Marca SET Nombre = ? WHERE Id = ?", array(
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
        $arrMarca = array();
        $tmp = new Marca();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Marca = new Marca();
            $Marca->Id = $valor['Id'];
            $Marca->Nombre = $valor['Nombre'];
            $Marca->Disconnect();
            array_push($arrMarca, $Marca);
        }
        $tmp->Disconnect();
        return $arrMarca;
    }

    public static function searchForId($Id) : Marca
    {
        $Marca = null;
        if ($Id > 0){
            $Marca = new Marca();
            $getrow = $Marca->getRow("SELECT * FROM Proyecto-ABC.Marca WHERE Id =?", array($Id));
            $Marca->Id = $getrow['Id'];
            $Marca->Nombre = $getrow['Nombre'];

        }
        $Marca->Disconnect();
        return $Marca;
    }

    public static function getAll() : array
    {
        return Marca::search("SELECT * FROM Proyecto-ABC.Marca");
    }

    public static function MarcaRegistrada ($Id) : bool
    {
        $result = Marca::search("SELECT Id FROM Proyecto-ABC.Marca where Id = ".$Id);
        if (count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

}
