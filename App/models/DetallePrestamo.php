<?php


namespace App\Models;

use App\Controllers\DetallePrestamoController;



require_once('BasicModel.php');

class DetallePrestamo extends BasicModel
{
    private $Id;
    private $Observaciones;
    private Prestamo $Prestamo_id;
    private Items $Items_id;
    private Kit $Kit_id;

    /**
     * DetallePrestamo constructor.
     * @param $Id
     * @param $Observaciones
     * @param $Prestamo_Id
     * @param $Items_Id
     * @param $Kit_Id
     */
    public function __construct($DetallePrestamo = array())
    {
        parent::__construct();
        $this->Id = $DetallePrestamo['Id'] ?? null;
        $this->Observaciones = $DetallePrestamo['Observaciones'] ?? null;
        $this->Items_id = $DetallePrestamo['Items'] ?? new Items();
        $this->Prestamo_id = $DetallePrestamo['Prestamo'] ?? new Prestamo();
        $this->Kit_id = $DetallePrestamo['Kit'] ?? new Kit();


    }

    /**
     *
     */
    function __destruct()
    {
        $this->Disconnect();
    }

    /**
     * @return int|mixed
     */
    public function getId(): int
    {
        return $this->Id;
    }

    /**
     * @param int|mixed $Id
     */
    public function setId(int $Id): void
    {
        $this->Id = $Id;
    }
    /**
     * @return mixed|null
     */
    public function getObservaciones(): ?mixed
    {
        return $this->Observaciones;
    }

    /**
     * @param mixed|null $Observaciones
     */
    public function setObservaciones(?mixed $Observaciones): void
    {
        $this->Observaciones = $Observaciones;
    }


    /**
     * @return Prestamo|mixed
     */
    public function getPrestamoId() : Prestamo
    {
        return $this->Prestamo_id;
    }

    /**
     * @param Prestamo|mixed $Prestamo_id
     */
    public function setPrestamoId(Prestamo $Prestamo_id): void
    {
        $this->$Prestamo_id = $Prestamo_id;
    }

    /**
     * @return mixed
     */
    public function getItemsId() : Items
    {
        return $this->Items_id;
    }

    /**
     * @param mixed $Items_Id
     */
    public function setItemsId(Items $Items_Id): void
    {
        $this->Items_id = $Items_Id;
    }

    /**
     * @return mixed
     */
    public function getKitId()
    {
        return $this->Kit_id;
    }

    /**
     * @param mixed $Kit_Id
     */
    public function setKit($Kit_Id): void
    {
        $this->Kit_id = $Kit_Id;
    }

    /**
     * @param $query
     * @return mixed
     */
    public static function search($query)
    {
        $arrDetallePrestamo = array();
        $tmp = new DetallePrestamo();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $DetallePrestamo = new DetallePrestamo();
            $DetallePrestamo->Id = $valor['id'];
            $DetallePrestamo->Observaciones = $valor['Observaciones'];
            $DetallePrestamo->Itmes_id = Items::searchForId($valor['Items_id']);
            $DetallePrestamo->Prestamo_id = Prestamo::searchForId($valor['Prestamo_id']);
            $DetallePrestamo->Kit_id = Kit::searchForId($valor['Kit_id']);
            $DetallePrestamo->Disconnect();
            if(count($getrows) == 1){ // Si solamente hay un registro encontrado devuelve este objeto y no un array
                return $DetallePrestamo;
            }
            array_push($arrDetallePrestamo, $DetallePrestamo);
        }
        $tmp->Disconnect();
        return $arrDetallePrestamo;
    }

    /**
     * @return mixed
     */
    public static function getAll()
    {
        return DetallePrestamo::search("SELECT * FROM weber.proyecto_sena.DetallePrestamo");
    }

    /**
     * @param $Id
     * @return mixed
     */
    public static function searchForId($Id)
    {
        $DetallePrestamo = null;
        if ($Id > 0) {
            $DetallePrestamo = new DetallePrestamo();
            $getrow = $DetallePrestamo->getRow("SELECT * FROM proyecto_sena.DetallePrestamo WHERE Id =?", array($Id));
            $DetallePrestamo->Id = $getrow['Id'];
            $DetallePrestamo->Observaciones = $getrow['Observaciones'];
            $DetallePrestamo->Prestamo_Id = Prestamo::searchForId($getrow['Prestamo_id']);
            $DetallePrestamo->Items_Id = Itmes::searchForId($getrow['Items_id']);
            $DetallePrestamo->Kit_Id = Kit::searchForId($getrow['Kit_id']);
        }
        $DetallePrestamo->Disconnect();
        return $DetallePrestamo;
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $result = $this->insertRow("INSERT INTO proyecto_sena.DetallePrestamo VALUES (NULL, ?, ?, ?, ?)", array(
                $this->Observaciones,
                $this->Prestamo_id->getId(),
                $this->Items_id->getId(),
                $this->Kit_id->getId(),
            )
        );
        $this->Disconnect();
        return $result;
    }

    /**
     * @return mixed
     */
    public function update()
    {
        $result = $this->updateRow("UPDATE proyecto_sena.DetallePrestamo SET Observaciones = ?, Prestamo_id = ?, Items_id = ?, Kit_id = ? WHERE Id = ?", array(
                $this->Observaciones,
                $this->Prestamo_id->getId(),
                $this->Items_id->getId(),
                $this->Kit_id->getId(),
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
        $DetallePrestamo = DetallePrestamo::searchForId($Id); //Buscando un usuario por el ID
        $deleterow = $DetallePrestamo->deleteRow("DELETE FROM DetallePrestamo WHERE Id = ?", array($Id));
        return $deleterow;                    //Guarda los cambios..
    }

    /**
     * @param $nombres
     * @return bool
     */
    public static function productoEnFactura($producto_id): bool
    {
        $result = DetalleVentas::search("SELECT id FROM weber.detalle_venta where producto_id = '" . $producto_id. "'");
        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Venta: $this->ventas_id->getNumeroSerie(), Producto: $this->producto_id->getNombres(), Cantidad: $this->cantidad, Precio Venta: $this->precio_venta";
    }
}