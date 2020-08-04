<?php


namespace App\Models;

require_once('BasicModel.php');


class Elemento extends BasicModel
{
    private $Id;
    private $Nombre;
    private $Descripcion;
    private $Serie;
    private $Categoria;
    private $Material;


    /**
     * Elemento constructor.
     * @param $Id
     * @param $Nombre
     * @param $Descripcion
     * @param $Serie
     * @param $Categoria
     * @param $Material

     */
    public function __construct($Elemento = array())
    {
        parent::__construct();
        $this->Id = $Elemento['Id'] ?? null;
        $this->Nombre = $Elemento['Nombre'] ?? null;
        $this->Descripcion = $Elemento['Descripcion'] ?? null;
        $this->Serie = $Elemento['Serie'] ?? null;
        $this->Categoria = $Elemento['Categoria'] ?? null;
        $this->Material = $Elemento['Material'] ?? null;

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
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * @param mixed $Nombre
     */
    public function setNombre($Nombre): void
    {
        $this->Nombre = $Nombre;
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
    public function getSerie()
    {
        return $this->Serie;
    }

    /**
     * @param mixed $Serie
     */
    public function setSerie($Serie): void
    {
        $this->Serie = $Serie;
    }

    /**
     * @return mixed
     */
    public function getCategoria() : Categoria
    {
        return $this->Categoria;
    }

    /**
     * @param mixed $Categoria
     */
    public function setCategoria(Categoria $Categoria): void
    {
        $this->Categoria = $Categoria;
    }

    /**
     * @return mixed
     */
    public function getMaterial()
    {
        return $this->Material;
    }

    /**
     * @param mixed $Material
     */
    public function setMaterial($Material): void
    {
        $this->Material = $Material;
    }

   
    public static function search($query)
    {

        $arrElemento = array();
        $tmp = new Elemento();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Elemento = new Elemento();
            $Elemento->Id = $valor['Id'];
            $Elemento->Nombre = $valor['Nombre'];
            $Elemento->Descripcion = $valor['Descripcion'];
            $Elemento->Serie = $valor['Serie'];
            $Elemento->Categoria = Categoria::searchForId($valor['Categoria']);
            $Elemento->Material = $valor['Material'];
            $Elemento->Disconnect();
            array_push($arrElemento, $Elemento);
        }
        $tmp->Disconnect();
        return $arrElemento;
    }

    /**
     * @return mixed
     */
    public static function getAll()
    {
        return Elemento::search("SELECT * FROM proyecto_sena.Elemento");
    }

    /**
     * @param $Id
     * @return mixed
     */
    public static function searchForId($Id)
    {
        $Elemento = null;
        if ($Id > 0) {
            $Elemento = new Elemento();
            $getrow = $Elemento->getRow("SELECT * FROM proyecto_sena.Elemento WHERE Id =?", array($Id));
            $Elemento->Id = $getrow['Id'];
            $Elemento->Nombre = $getrow['Nombre'];
            $Elemento->Descripcion = $getrow['Descripcion'];
            $Elemento->Serie = $getrow['serie'];
            $Elemento->Categoria = Categoria::searchForId($getrow['Categoria']);
            $Elemento->Material = $getrow['Material'];

        }
        $Elemento->Disconnect();
        return $Elemento;
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $result = $this->insertRow("INSERT INTO proyecto_sena.Elemento VALUES (NULL, ?, ?, ?, ?, ?  )", array(
                $this->Nombre,
                $this->Descripcion,
                $this->Serie,
                $this->Categoria->getId(),
                $this->Material,

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
        $result = $this->updateRow("UPDATE proyecto_sena.Elemento SET Nombre = ?, Descripcion = ?, Serie = ?, Categoria = ?, Material = ? WHERE Id = ?", array(
                $this->Nombre,
                $this->Descripcion,
                $this->Serie,
                $this->Categoria->getId(),
                $this->Material,
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
        $Elemento = Elemento::searchForId($Id); //Buscando un usuario por el ID
        $Elemento->setEstado("Inactivo"); //Cambia el estado del Usuario
        return $Elemento->update();                    //Guarda los cambios..
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Numero Serie: $this->numero_serie, Categoria: $this->Categoria->getNombre(),  Fecha Venta: $this->fecha_venta, Monto: $this->monto, Estado: $this->estado";
    }

}