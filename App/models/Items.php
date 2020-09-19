<?php


namespace App\Models;

require_once('BasicModel.php');


class Items extends BasicModel
{
    private $Id;
    private $Placa;
    private $Descripcion;
    private $Costo;
    private $Ubicacion;
    private $Imagen;
    private $Elemento;
    private $Marca;
    private $Kit;
    private $Unidades;
    private $Estado;


    /**
     * Ventas constructor.
     * @param $Id
     * @param $Placa
     * @param $Descripcion
     * @param $Costo
     * @param $Ubicacion
     * @param $Imagen
     * @param $Elemento
     * @param $Marca
     * @param $Kit
     * @param $Unidades
     * @param $Estado
     *
     */
    public function __construct($item = array())
    {
        parent::__construct();
        $this->Id = $item['Id'] ?? null;
        $this->Placa = $item['Placa'] ?? null;
        $this->Descripcion = $item['Descripcion'] ?? null;
        $this->Costo = $item['Costo'] ?? null;
        $this->Ubicacion = $item['Ubicacion'] ?? null;
        $this->Imagen = $item['Imagen'] ?? null;
        $this->Elemento = $item['Elemento'] ?? null;
        $this->Marca = $item['Marca'] ?? null;
        $this->Kit = $item['Kit'] ?? null;
        $this->Unidades = $item['Unidades'] ?? null;
        $this->Estado = $item['Estado'] ?? null;
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
    public function getId() : int
    {
        return $this->Id;
    }

    /**
     * @param mixed $Id
     */
    public function setId(int $Id): void
    {
        $this->Id = $Id;
    }

    /**
     * @return mixed
     */
    public function getPlaca() : string
    {
        return $this->Placa;
    }

    /**
     * @param mixed $Placa
     */
    public function setPlaca(string $Placa): void
    {
        $this->Placa = $Placa;
    }


    /**
     * @return mixed
     */
    public function getDescripcion() : string
    {
        return $this->Descripcion;
    }

    /**
     * @param mixed $Descripcion
     */
    public function setDescripcion(string $Descripcion): void
    {
        $this->Descripcion = $Descripcion;
    }
    /**
     * @return mixed
     */
    public function getCosto() : float
    {
        return $this->Costo;
    }

    /**
     * @param mixed $Costo
     */
    public function setCosto (float $Costo) : void
    {
        $this->Costo = $Costo;
    }

    /**
     * @return mixed
     */
    public function getUbicacion() : string
    {
        return $this->Ubicacion;
    }

    /**
     * @param mixed $Ubicacion
     */
    public function setUbicacion(string $Ubicacion): void
    {
        $this->Ubicacion = $Ubicacion;
    }


    /**
     * @return mixed
     */
    public function getImagen() : string
    {
        return $this->Imagen;
    }

    /**
     * @param mixed $Imagen
     */
    public function setImagen(string $Imagen): void
    {
        $this->Imagen = $Imagen;
    }

    /**
     * @return Elemento
     */
    public function getElemento() : Elemento
    {
        return $this->Elemento;
    }

    /**
     * @param mixed $Elemento
     */
    public function setElemento(Elementos $Elemento): void
    {
        $this->Elemento = $Elemento;
    }

    /**
     * @return mixed
     */
    public function getMarca() : Marca //como se llama la tabla
    {
        return $this->Marca;
    }

    /**
     * @param mixed $Marca
     */
    public function setMarca(Marca $Marca): void
    {
        $this->Marca = $Marca;
    }


    /**
     * @return mixed
     */
    public function getKit() : Kit//como se llama la tabla
    {
        return $this->Kit;
    }

    /**
     * @param mixed $Kit
     */
    public function setKit(Marca $Kit): void
    {
        $this->Kit = $Kit;
    }

    /**
     * @return mixed
     */
    public function getUnidades() : Unidades//como se llama la tabla
    {
        return $this->Unidades;
    }

    /**
     * @param mixed $Unidades
     */
    public function setUnidades(Unidades $Unidades): void
    {
        $this->Unidades = $Unidades;
    }

    /**
     * @return mixed
     */
    public function getEstado() : string
    {
        return $this->Estado;
    }

    /**
     * @param mixed $Estado
     */
    public function setEstado(string $Estado): void
    {
        $this->Estado = $Estado;
    }

    /**
     * @param $query
     * @return mixed
     */
    public static function search($query)
    {

        $arrItems = array();
        $tmp = new Items();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $item = new Items();
            $item->Id = $valor['Id'];
            $item->Placa = $valor['Placa'];
            $item->Descripcion = $valor['Descripcion'];
            $item->Costo = $valor['Costo'];
            $item->Ubicacion = $valor['Ubicacion'];
            $item->Imagen = $valor['Imagen'];
            $item->Elemento = Elemento::searchForId($valor['Elemento']);
            $item->Marca = Marca::searchForId($valor['Marca']);
            $item->Kit = Kit::searchForId($valor['Kit']);
            $item->Unidades = Unidades::searchForId($valor['Unidades']);
            $item->Estado = $valor['Estado'];
            $item->Disconnect();
            array_push($arrItems, $item);
        }
        $tmp->Disconnect();
        return $arrItems;
    }

    /**
     * @return mixed
     */
    public static function getAll()
    {
        return Items::search("SELECT * FROM proyecto_sena.Items");
    }

    /**
     * @param $Id
     * @return mixed
     */
    public static function searchForId($Id)
    {
        $item = null;
        if ($Id > 0) {
            $item = new Items();
            $getrow = $item->getRow("SELECT * FROM proyecto_sena.Items WHERE Id =?", array($Id));
            $item->Id = $getrow['Id'];
            $item->Placa = $getrow['Placa'];
            $item->Descripcion = $getrow['Descipcion'];
            $item->Costo = $getrow['Costo'];
            $item->Ubicacion = $getrow['Ubicacion'];
            $item->Imagen= $getrow['Imagen'];
            $item->Elemento = Elemento::searchForId($getrow['Elemento']);
            $item->Marca = Marca::searchForId($getrow['Marca']);
            $item->Kit = Kit::searchForId($getrow['Kit']);
            $item->Unidades = Unidades::searchForId($getrow['Unidades']);
            $item->Estado = $getrow['Estado'];
        }
        $item->Disconnect();
        return $item;
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $result = $this->insertRow("INSERT INTO proyecto_sena.Items VALUES (NULL, ?, ?, ?, ?, ?, ?,?,?,?,?)", array(
                $this->Placa,
                $this->Descripcion,
                $this->Costo,
                $this->Ubicacion,
                $this->Imagen,
                $this->Elemento->getId(),
                $this->Marca->getId(),
                $this->Kit->getId(),
                $this->Unidades->getId(),
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
        $result = $this->updateRow("UPDATE proyecto_sena.Items SET Placa = ?, Descripcion = ?, Costo = ?, Ubicacion = ?, Imagen = ?, Elemento = ?, Marca = ?, Kit = ?,  Unidades = ?, Estado = ? WHERE Id = ?", array(
                $this->Placa,
                $this->Descripcion,
                $this->Costo,
                $this->Ubicacion,
                $this->Imagen,
                $this->Elemento->getId(),
                $this->Marca->getId(),
                $this->Kit->getId(),
                $this->Unidades->getId(),
                $this->Estado,
                $this->Id
            )
        );
        $this->Disconnect();
        return $result;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleted($Id)
    {
        $item = Items::searchForId($Id); //Buscando un usuario por el ID
        $item->setEstado("Inactivo"); //Cambia el estado del Usuario
        return $item->update();                    //Guarda los cambios..
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Placa: $this->Placa, Descripcion: $this->Descripcion, Costo: $this->Costo, Ubicacion: $this->Ubicacion, Imagen: $this->Imagen, Elemento: $this->Elemento->getNombre(), Marca: $this->Marca->getNombre(), Kit: $this->Kit->getNombre(), Unidades: $this->Unidades->getNombre(), Estado: $this->Estado";
    }

}