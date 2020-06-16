<?php

namespace App\Models;

require('BasicModel.php');

class Unidades extends BasicModel
{
    public $Id;
    public $Nombre;
    public $Tipo;

    /**
     * Unidades constructor.
     * @param $Id
     * @param $Nombre
     * @param $Tipo

     */
    public function __construct($Unidades = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->Id = $Unidades['Id'] ?? null;
        $this->Nombre = $Unidades['Nombre'] ?? null;
        $this->Tipo = $Unidades['Tipo'] ?? null;
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

    /**
     * @return string
     */
    public function getTipo() : string
    {
        return $this->Tipo;
    }

    /**
     * @param string $Tipo
     */
    public function setTipo(string $Tipo): void
    {
        $this->Tipo = $Tipo;
    }


    public function create() : bool
    {
        $result = $this->insertRow("INSERT INTO Proyecto-ABC.Unidades VALUES (NULL, ?, ?)", array(
            $this->Nombre,
            $this->Tipo,
            )
        );
        $this->Disconnect();
        return $result;
    }

    public function update() : bool
    {
        $result = $this->updateRow("UPDATE Proyecto-ABC.Unidades SET Nombre = ?,Tipo = ? WHERE Id = ?", array(
                $this->Nombre,
                $this->Tipo,
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
        $arrUnidades = array();
        $tmp = new Unidades();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Unidades = new Unidades();
            $Unidades->Id = $valor['Id'];
            $Unidades->Nombre = $valor['Nombre'];
            $Unidades->Tipo = $valor['Tipo'];
            $Unidades->Disconnect();
            array_push($arrUnidades, $Unidades);
        }
        $tmp->Disconnect();
        return $arrUnidades;
    }

    public static function searchForId($Id) : Unidades
    {
        $Unidades = null;
        if ($Id > 0){
            $Unidades = new Unidades();
            $getrow = $Unidades->getRow("SELECT * FROM Proyecto-ABC.Unidades WHERE Id =?", array($Id));
            $Unidades->Id = $getrow['Id'];
            $Unidades->Nombre = $getrow['Nombre'];
            $Unidades->Tipo = $getrow['Tipo'];

        }
        $Unidades->Disconnect();
        return $Unidades;
    }

    public static function getAll() : array
    {
        return Unidades::search("SELECT * FROM Proyecto-ABC.Unidades");
    }

    public static function UnidadesRegistrada ($Id) : bool
    {
        $result = Unidades::search("SELECT Id FROM Proyecto-ABC.Unidades where Id = ".$Id);
        if (count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

}
