<?php

namespace App\Models;

require('BasicModel.php');

class Prestamo extends BasicModel
{
    private $Id;
    private $FechaPrestamo;
    private $FechaEntrega;
    private $Observaciones;
    private $Estado;
    private $Persona;

    /**
     * Usuarios constructor.
     * @param $Id
     * @param $FechaPrestamo
     * @param $FechaEntrega
     * @param $Observaciones
     * @param $Estado
     * @param $Persona
     */
    public function __construct($Prestamo = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->Id = $Prestamo['Id'] ?? null;
        $this->FechaPrestamo = $Prestamo['FechaPrestammo'] ?? null;
        $this->FechaEntrega = $Prestamo['FechaEntrega'] ?? null;
        $this->Observaciones = $Prestamo['Observaciones'] ?? null;
        $this->Estado = $Prestamo['Estado'] ?? null;
        $this->Persona = $Prestamo['Persona'] ?? null;

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
    public function getFechaPrestamo() : string
    {
        return $this->FechaPrestamo;
    }

    /**
     * @param string $FechaPrestamo
     */
    public function setFechaPrestamo(string $FechaPrestamo): void
    {
        $this->FechaPrestamo = $FechaPrestamo;
    }
    /**
     * @return string
     */
    public function getFechaEntrega() : string
    {
        return $this->FechaEntrega;
    }

    /**
     * @param string $FechaEntrega
     */
    public function setFechaEntrega(string $FechaEntrega): void
    {
        $this->FechaEntrega = $FechaEntrega;
    }

    /**
     * @return string
     */
    public function getObservaciones() : string
    {
        return $this->Observaciones;
    }

    /**
     * @param string $Observaciones
     */
    public function setObservaciones(string $Observaciones): void
    {
        $this->Observaciones = $Observaciones;
    }
    /**
     * @return string
     */
    public function getEstado() : string
    {
        return $this->Estado;
    }

    /**
     * @param string $Estado
     */
    public function setEstado(string $Estado): void
    {
        $this->Estado = $Estado;
    }


    /**
     * @return string
     */
    public function getPersona() : string
    {
        return $this->Persona;
    }

    /**
     * @param string $Persona
     */
    public function setPersona(string $Persona): void
    {
        $this->Persona = $Persona;
    }

    /**
     * @return int
     */


    public function create() : bool
    {
        $result = $this->insertRow("INSERT INTO proyecto_sena.Prestamo VALUES (NULL, ?, ?, ?, ?, ?)", array(
            $this->FechaPrestamo,
            $this->FechaEntrega,
            $this->Observaciones,
                $this->Estado,
                $this->Persona,

            )
        );
        $this->Disconnect();
        return $result;
    }

    public function update() : bool
    {
        $result = $this->updateRow("UPDATE proyecto_sena.Prestamo SET FechaPrestamo = ?, FechaEntrega = ?, Observaciones= ?, Estado= ?, Persona= ? WHERE Id = ?", array(
                $this->FechaPrestamo,
                $this->FechaEntrega,
                $this->Observaciones,
                $this->Estado,
                $this->Persona,
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
        $arrPrestamo = array();
        $tmp = new Prestamo();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Prestamo = new Prestamo();
            $Prestamo->Id = $valor['Id'];
            $Prestamo->FechaPrestamo = $valor['FechaPrestamo'];
            $Prestamo->FechaEntrega = $valor['FechaEntrega'];
            $Prestamo->Observaciones = $valor['Observaciones'];
            $Prestamo->Estado = $valor['Estado'];
            $Prestamo->Persona = $valor['Persona'];
            $Prestamo->Disconnect();
            array_push($arrPrestamo, $Prestamo);
        }
        $tmp->Disconnect();
        return $arrPrestamo;
    }

    public static function searchForId($Id) : Prestamo
    {
        $Prestamo = null;
        if ($Id > 0){
            $Prestamo = new Prestamo();
            $getrow = $Prestamo->getRow("SELECT * FROM proyecto_sena.Prestamo WHERE Id =?", array($Id));
            $Prestamo->Id = $getrow['Id'];
            $Prestamo->FechaPrestamo = $getrow['FechaPrestamo'];
            $Prestamo->FechaEntrega = $getrow['FechaEntrega'];
            $Prestamo->Observaciones = $getrow['Observaciones'];
            $Prestamo->Estado = $getrow['Estado'];
            $Prestamo->Persona = $getrow['Persona'];
                    }
        $Prestamo->Disconnect();
        return $Prestamo;
    }

    public static function getAll() : array
    {
        return Prestamo::search("SELECT * FROM proyecto_sena.Prestamo");
    }

    public static function PrestamoRegistrado ($Persona) : bool
    {
        $result = Prestamo::search("SELECT Id FROM proyecto_sena.Prestamo where Persona = '".$Persona."'");
        if (count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

}
