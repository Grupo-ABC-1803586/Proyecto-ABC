<?php

namespace App\Models;

require('BasicModel.php');

class Unidades extends BasicModel
{
    public $Id;
    public $Tipo;
    public $Nombre;

    /**
     * Unidades constructor.
     * @param $Id
     * @param $Tipo
     * @param $Nombre

     */
    public function __construct($Unidades = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->Id = $Unidades['Id'] ?? null;
        $this->Tipo = $Unidades['Tipo'] ?? null;
        $this->Nombre = $Unidades['Nombre'] ?? null;
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
        $result = $this->insertRow("INSERT INTO proyecto_sena.Unidades VALUES (NULL, ?, ?)", array(
            $this->Tipo,
            $this->Nombre,
            )
        );
        $this->Disconnect();
        return $result;
    }

    public function update() : bool
    {
        $result = $this->updateRow("UPDATE proyecto_sena.Unidades SET Tipo = ?,Nombre = ? WHERE Id = ?", array(

                $this->Tipo,
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
        $arrUnidades = array();
        $tmp = new Unidades();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Unidades = new Unidades();
            $Unidades->Id = $valor['Id'];
            $Unidades->Tipo = $valor['Tipo'];
            $Unidades->Nombre = $valor['Nombre'];
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
            $getrow = $Unidades->getRow("SELECT * FROM proyecto_sena.Unidades WHERE Id =?", array($Id));
            $Unidades->Id = $getrow['Id'];
            $Unidades->Tipo = $getrow['Tipo'];
            $Unidades->Nombre = $getrow['Nombre'];

        }
        $Unidades->Disconnect();
        return $Unidades;
    }

    public static function getAll() : array
    {
        return Unidades::search("SELECT * FROM proyecto_sena.Unidades");
    }

    public static function UnidadesRegistrada ($Nombre) : bool
    {
        $result = Unidades::search("SELECT Id FROM proyecto_sena.Unidades where Nombre = '".$Nombre."'");
        if (count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

}
