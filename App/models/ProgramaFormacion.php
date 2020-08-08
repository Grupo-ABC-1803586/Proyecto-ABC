<?php

namespace App\Models;

require_once('BasicModel.php');

class ProgramaFormacion extends BasicModel
{



    private $Id;
    private $FechaRegistro;
    private $NumeroFicha;
    private $FechaInicio;
    private $FechaFinalizacion;
    private $NombrePrograma;
    private  $NivelPrograma;

    /**
     * Programaformacion  constructor.
     * @param $Id
     * @param $FechaRegistro
     * @param $NumeroFicha
     * @param $FechaInicio
     * @param $FechaFinalizacion
     *
     * @param $NombrePrograma
     * @param $NivelPrograma

     */
    public function __construct($ProgramaFormacion = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->Id = $ProgramaFormacion['Id'] ?? null;
        $this->FechaRegistro = $ProgramaFormacion['FechaRegistro'] ?? null;
        $this->NumeroFicha =$ProgramaFormacion['NumeroFicha']?? null;
        $this->FechaInicio =$ProgramaFormacion['FechaInicio']?? null;
        $this->FechaFinalizacion =$ProgramaFormacion['FechaFinalizacion']?? null;
        $this->NombrePrograma =$ProgramaFormacion['NombrePrograma']?? null;
        $this->NivelPrograma =$ProgramaFormacion['NivelPrograma']?? null;



    }

    /* Metodo destructor cierra la conexion. */
    public function getId(): int{
        return $this->Id;
    }
    /**
     * @param int $Id
     */public function setId( int $Id): void
{
    $this->Id = $Id;
}

    /**
     * @return string
     */
    public function getFechaRegistro(): string
    {
        return $this->FechaRegistro;
    }

    /**
     * @param string $FechaRegistro
     */
    public function setFechaRegistro(string $FechaRegistro): void
    {
        $this->FechaRegistro = $FechaRegistro;
    }

    /**
     * @return string
     */
    public function getNumeroFicha():string
    {
        return $this->NumeroFicha;
    }

    /**
     * @param string $NumeroFicha
     */
    public function setNumeroFicha( string $NumeroFicha): void
    {
        $this->NumeroFicha = $NumeroFicha;
    }

    /**
     * @return string
     */
    public function getFechaInicio():string
    {
        return $this->FechaInicio;
    }

    /**
     * @param string $fechaInicio
     */
    public function setFechaInicio($FechaInicio): void
    {
        $this->FechaInicio = $FechaInicio;
    }

    /**
     * @return string
     */
    public function getFechaFinalizacion():string
    {
        return $this->FechaFinalizacion;
    }

    /**
     * @param string $fechaFinalizacion
     */
    public function setFechaFinalizacion(string $FechaFinalizacion): void
    {
        $this->fechaFinalizacion = $FechaFinalizacion;
    }

    /**
     * @return string
     */
    public function getNombrePrograma() :string
    {
        return $this->NombrePrograma;
    }

    /**
     * @param string $nombrePrograma
     */
    public function setNombrePrograma(string $NombrePrograma): void
    {
        $this->NombrePrograma = $NombrePrograma;
    }

    /**
     * @return string
     */
    public function getNivelPrograma():string
    {
        return $this->NivelPrograma;
    }

    /**
     * @param string $NivelPrograma
     */
    public function setNivelPrograma(string $NivelPrograma): void
    {
        $this->NivelPrograma = $NivelPrograma;
    }
    /**
     * @return string
     */
    public function create() : bool
    {
        $result = $this->insertRow("INSERT INTO proyecto_sena.ProgramaFormacion VALUES (NULL, ?, ?, ?, ?, ?, ? )", array(
                $this->FechaRegistro,
                $this->NumeroFicha,
                $this->FechaInicio,
                $this->FechaFinalizacion,
                $this->NombrePrograma,
                $this->NivelPrograma,

            )
        );
        $this->Disconnect();
        return $result;
    }

    public function update() : bool
    {
        $result = $this->updateRow("UPDATE proyecto_sena.ProgramaFormacion SET FechaRegistro = ?,NumeroFicha = ?,FechaInicio = ?,FechaFinalizacion = ?,NombrePrograma = ?,NivelPrograma = ? WHERE Id = ?", array(
                $this->FechaRegistro,
                $this->NumeroFicha,
                $this->FechaInicio,
                $this->FechaFinalizacion,
                $this->NombrePrograma,
                $this->NivelPrograma,
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
        $arrProgramaFormacion = array();
        $tmp = new ProgramaFormacion();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $ProgramaFormacion = new ProgramaFormacion();

            $ProgramaFormacion->Id = $valor['Id'];
            $ProgramaFormacion->FechaRegistro = $valor['FechaRegistro'];
            $ProgramaFormacion->NumeroFicha = $valor['NumeroFicha'];
            $ProgramaFormacion->FechaInicio = $valor['FechaInicio'];
            $ProgramaFormacion->FechaFinalizacion = $valor['FechaFinalizacion'];
            $ProgramaFormacion->NombrePrograma = $valor['NombrePrograma'];
            $ProgramaFormacion->NivelPrograma = $valor['NivelPrograma'];

            $ProgramaFormacion->Disconnect();
            array_push($arrProgramaFormacion, $ProgramaFormacion);
        }
        return  $arrProgramaFormacion;
    }

        public static function searchForId($Id) : ProgramaFormacion
    {
        $ProgramaFormacion = null;
        if ($Id > 0){
            $ProgramaFormacion = new ProgramaFormacion();
            $getrow = $ProgramaFormacion->getRow("SELECT * FROM proyecto_sena.ProgramaFormacion WHERE Id =?", array($Id));
            $ProgramaFormacion->Id = $getrow['Id'];
            $ProgramaFormacion->FechaRegistro = $getrow['FechaRegistro'];
            $ProgramaFormacion->NumeroFicha = $getrow['NumeroFicha'];
            $ProgramaFormacion->FechaInicio = $getrow['FechaInicio'];
            $ProgramaFormacion->FechaFinalizacion = $getrow['FechaFinalizacion'];
            $ProgramaFormacion->NombrePrograma = $getrow['NombrePrograma'];
            $ProgramaFormacion->NivelPrograma = $getrow['NivelPrograma'];

        }
        $ProgramaFormacion->Disconnect();
        return $ProgramaFormacion;
    }

    public static function getAll() : array
    {
        return ProgramaFormacion::search("SELECT * FROM proyecto_sena.ProgramaFormacion");
    }

    public static function ProgramaFormacionRegistrado ($NumeroFicha) : bool
    {
        $result = ProgramaFormacion::search("SELECT Id FROM proyecto_sena.ProgramaFormacion where NumeroFicha ='".$NumeroFicha."'");
        if (count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

}