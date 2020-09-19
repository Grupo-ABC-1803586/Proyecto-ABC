<?php


namespace App\Models;

require_once('BasicModel.php');


class Sanciones extends BasicModel
{
    private $Id;
    private $Tipo;
    private $Prestamo;
    private $Descripcion;
    private $Estado;



    /**
     * Elemento constructor.
     * @param $Id
     * @param $Tipo
     * @param $Prestamo
     * @param $Descripcion
     * @param $Estado


     */
    public function __construct($Sanciones = array())
    {
        parent::__construct();
        $this->Id = $Sanciones['Id'] ?? null;
        $this->Tipo = $Sanciones['Tipo'] ?? null;
        $this->Descripcion = $Sanciones['Descripcion'] ?? null;
        $this->Prestamo = $Sanciones['Prestamo'] ?? null;
        $this->Estado = $Sanciones['Estado'] ?? null;


    }

    /**
     *
     */
    function __destruct()
    {
        $this->Disconnect();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param mixed $Id
     */
    public function setId($Id): void
    {
        $this->Id = $Id;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->Tipo;
    }

    /**
     * @param mixed $Tipo
     */
    public function setTipo($Tipo): void
    {
        $this->Tipo = $Tipo;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->Descripcion;
    }

    /**
     * @param mixed $Descripcion
     */
    public function setDescripcion($Descripcion ): void
    {
        $this->Descripcion = $Descripcion;
    }

    /**
     * @return mixed
     */
    public function getPrestamo()
    {
        return $this->Prestamo;
    }

    /**
     * @param mixed $Prestamo
     */
    public function setPrestamo($Prestamo): void
    {
        $this->Prestamo = $Prestamo;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->Estado;
    }

    /**
     * @param mixed $Serie
     */
    public function setEstado($Estado): void
    {
        $this->Estado = $Estado;
    }

    /**
     * @return mixed
     */

    public static function search($query)
    {

        $arrSanciones = array();
        $tmp = new Sanciones();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Sanciones = new Sanciones();
            $Sanciones->Id = $valor['Id'];
            $Sanciones->Tipo = $valor['Tipo'];
            $Sanciones->Descripcion = $valor['Descripcion'];
            $Sanciones->Prestamo = Prestamo::searchForId($valor['Prestamo']);
            $Sanciones->Estado = $valor['Estado'];
            $Sanciones->Disconnect();
            array_push($arrSanciones, $Sanciones);
        }
        $tmp->Disconnect();
        return $arrSanciones;
    }

    /**
     * @return mixed
     */
    public static function getAll()
    {
        return Elemento::search("SELECT * FROM proyecto_sena.Sanciones");
    }

    /**
     * @param $Id
     * @return mixed
     */
    public static function searchForId($Id)
    {
        $Sanciones = null;
        if ($Id > 0) {
            $Sanciones = new Sanciones();
            $getrow = $Sanciones->getRow("SELECT * FROM proyecto_sena.Sanciones WHERE Id =?", array($Id));
            $Sanciones->Id = $getrow['Id'];
            $Sanciones->Tipo = $getrow['Tipo'];
            $Sanciones->Descripcion = $getrow['Descripcion'];
            $Sanciones->Prestamo = Prestamo::searchForId($getrow['Prestamo']);
            $Sanciones->Estado = $getrow['Estado'];

        }
        $Sanciones->Disconnect();
        return $Sanciones;
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $result = $this->insertRow("INSERT INTO proyecto_sena.Sanciones VALUES (NULL, ?, ?, ?, ?)", array(
                $this->Tipo,
                $this->Descripcion,
                $this->Prestamo->getId(),
                $this->Estado

            )
        );
        $this->setId(($result) ? $this->getLastId() : null);
        $this->Disconnect();
        return $result;
    }

    /**
     * @return mixed
     */
    public function update()
    {
        $result = $this->updateRow("UPDATE proyecto_sena.Sanciones SET Tipo = ?, Descripcion = ?, Prestamo= ?, Estado = ? WHERE Id = ?", array(
                $this->Tipo,
                $this->Descripcion,
                $this->Prestamo->getId(),
                $this->Estado,
                $this->Id
            )
        );
        $this->Disconnect();
        return $result;
    }

    /**
     * @param $Id
     * @return mixed
     */
    public function deleted($Id)
    {
        $Sanciones = Elemento::searchForId($Id); //Buscando una Sancion por el ID
        $Sanciones->setEstado("Inactivo"); //Cambia el estado de la sancion
        return $Sanciones->update();                    //Guarda los cambios..
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Tipo: $this->Tipo, Descripcion: $this->Descripcion, Prestamo: $this->Prestamo, Estado: $this->estado";
    }

}