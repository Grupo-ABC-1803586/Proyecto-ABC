<?php

namespace App\Models;

require('BasicModel.php');

class Kit extends BasicModel
{
    private $Id;
    private $Nombre;
    private $Descripcion;
    private $Placa;

    /**
     * Usuarios constructor.
     * @param $Id
     * @param $Nombre
     * @param $Descripcion
     * @param $Placa

     */
    public function __construct($Kit = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->Id = $Kit['Id'] ?? null;
        $this->Nombre = $Kit['Nombre'] ?? null;
        $this->Descripcion = $Kit['Descripcion'] ?? null;
        $this->Placa = $Kit['Placa'] ?? null;

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
    public function getDescripcion() : string
    {
        return $this->Descripcion;
    }

    /**
     * @param string $Descripcion
     */
    public function setDescripcion(string $Descripcion): void
    {
        $this->Descripcion = $Descripcion;
    }

    /**
     * @return string
     */
    public function getPlaca() : string
    {
        return $this->Placa;
    }

    /**
     * @param string $Placa
     */
    public function setPlaca(string $Placa): void
    {
        $this->tPlaca = $Placa;
    }

    /**
     * @return int
     */


    public function create() : bool
    {
        $result = $this->insertRow("INSERT INTO proyecto_sena.Kit VALUES (NULL, ?, ?, ?)", array(
            $this->Nombre,
            $this->Descripcion,
            $this->Placa,

            )
        );
        $this->Disconnect();
        return $result;
    }

    public function update() : bool
    {
        $result = $this->updateRow("UPDATE proyecto_sena.Kit SET Nombre = ?, Descripcion = ?, Placa = ? WHERE Id = ?", array(
                $this->Nombre,
                $this->Descripcion,
                $this->Placa,
                $this->Id,

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
        $arrKit = array();
        $tmp = new Kit();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Kit = new Kit();
            $Kit->Id = $valor['Id'];
            $Kit->Nombre = $valor['Nombre'];
            $Kit->Descripcion = $valor['Descripcion'];
            $Kit->Placa = $valor['Placa'];
            $Kit->Disconnect();
            array_push($arrKit, $Kit);
        }
        $tmp->Disconnect();
        return $arrKit;
    }

    public static function searchForId($Id) : Kit
    {
        $Kit = null;
        if ($Id > 0){
            $Kit = new Kit();
            $getrow = $Kit->getRow("SELECT * FROM proyecto_sena.Kit WHERE Id =?", array($Id));
            $Kit->Id = $getrow['Id'];
            $Kit->Nombre = $getrow['Nombre'];
            $Kit->Descripcion = $getrow['Descripcion'];
            $Kit->Placa = $getrow['Placa'];
                    }
        $Kit->Disconnect();
        return $Kit;
    }

    public static function getAll() : array
    {
        return Kit::search("SELECT * FROM proyecto_sena.Kit");
    }

    public static function KitRegistrado ($Nombre) : bool
    {
        $result = Kit::search("SELECT Id FROM proyecto_sena.Kit where Nombre = '".$Nombre."'");
        if (count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

}
