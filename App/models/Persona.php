<?php

namespace App\models;

require('BasicModel.php');

class Persona extends BasicModel
{
    private $Documento;
    private $Nombre;
    private $Apellido;
    private $Telefono;
    private $Correo;
    private $Rol;
    private $Contraseña;
    private $Programaformacion;
    private $Estado;

    /* Relaciones */
    private //$Programaformacion;         al integrar programa de formacion

    /**
     * Personas constructor.
     * @param $Documento
     * @param $Nombre
     * @param $Apellido
     * @param $Telefono
     * @param $Correo
     * @param $Rol
     * @param $Contraseña
     * @param $Programaformacion
     * @param $Estado

     */
     function __construct($Persona = array())
    {
        parent::__construct(); //Llama al contructor padre "la clase conexion" para conectarme a la BD
        $this->Documento = $Persona['Documento'] ?? null;
        $this->Nombre = $Persona['Nombre'] ?? null;
        $this->Apellido = $Persona['Apellido'] ?? null;
        $this->Telefono = $Persona['Telefono'] ?? null;
        $this->Correo = $Persona['Correo'] ?? null;
        $this->Rol = $Persona['Rol'] ?? null;
        $this->Contraseña= $Persona['Contraseña'] ?? null;
        $this->Programaformacion = $Persona['Programaformacion'] ?? null;
        $this->Estado = $Persona['Estado'] ?? null;
    }

    /* Metodo destructor cierra la conexion. */

    public static function getAll(): array
    {
        return Persona::search("SELECT * FROM proyecto_sena.Persona");
    }

    public static function search($query): array
    {
        $arrPersona = array();
        $tmp = new Persona();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Persona = new Persona();
            $Persona->Documento = $valor['Documento'];
            $Persona->Nombre = $valor['Nombre'];
            $Persona->Apellido = $valor['Apellido'];
            $Persona->Correo = $valor['Correo'];
            $Persona->Rol = $valor['Rol'];
            $Persona->Contraseña = $valor['Contraseña'];
            $Persona->Programaformacion = $valor['Programaformacion'];
            $Persona->Estado = $valor['Estado'];
            $Persona->Disconnect();
            array_push($arrPersonas, $Persona);
        }
        $tmp->Disconnect();
        return $arrPersona;
    }

    public static function PersonaRegistrado($Nombre): bool
    {
        $result = Persona::search("SELECT Documento FROM proyecto_sena.Persona where Nombre = " . $Nombre);
        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function __destruct()
    {
        $this->Disconnect();
    }

    /**
     * @return int
     */
    public function getDocumento(): int
    {
        return $this->Documento;
    }

    /**
     * @param int Documento
     */
    public function setDocumento(int $Documento): void
    {
        $this->Documento = $Documento;
    }

    /**
     * @return string
     */
    public function getNombre(): string
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
    public function getApellido(): string
    {
        return $this->Apellido;
    }

    /**
     * @param string $Apellido
     */
    public function setApellido(string $Apellido): void
    {
        $this->Apellido = $Apellido;
    }

    /**
     * @return int
     */
    public function getTelefono(): int
    {
        return $this->Telefono;
    }

    /**
     * @param int $Telefono
     */
    public function setTelefono(int $Telefono): void
    {
        $this->Telefono = $Telefono;
    }

    /**
     * @return int
     */
    public function getCorreo(): String
    {
        return $this->Correo;
    }

    /**
     * @param int $Correo
     */
    public function setCorreo(String $Correo): void
    {
        $this->Correo = $Correo;
    }

    /**
     * @return int
     */
    public function getRol(): int
    {
        return $this->Rol;
    }

    /**
     * @param int $Rol
     */
    public function setRol(int $Rol): void
    {
        $this->Rol = $Rol;
    }

    /**
     * @return string
     */
    public function getContraseña(): string
    {
        return $this->Contraseña;
    }

    /**
     * @param string $Contraseña
     */
    public function setContraseña(string $Contraseña): void
    {
        $this->Contraseña = $Contraseña;
    }

    /**
     * @return int
     */
    public function getProgramaformacion(): int
    {
        return $this->Programaformacion;
    }

    /**
     * @param int $Programaformacion
     */
    public function setProgramaformacion(int $Programaformacion): void
    {
        $this->Programaformacion = $Programaformacion;
    }

    /**
     * @return string
     */
    public function getEstado(): string
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

    public function create(): bool
    {
        $result = $this->insertRow("INSERT INTO proyecto_sena.Persona VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)", array(
                $this->Documento,
                $this->Nombre,
                $this->Apellido,
                $this->Telefono,
                $this->Correo,
                $this->Rol,
                $this->Contraseña,
                $this->Programaformacion,
                $this->Estado
            )
        );
        $this->Disconnect();
        return $result;
    }

    public function deleted($Documento): bool
    {
        $Nombre = Persona::searchForDocumento($Documento); //Buscando un Persona por documento
        $Nombre->setEstado("Inactivo"); //Cambia el estado del Persona
        return $Nombre->update();                    //Guarda los cambios..
    }

    public static function searchForDocumento($Documento): Persona
    {
        $Persona = null;
        if ($Documento > 0) {
            $Persona = new Persona();
            $getrow = $Persona->getRow("SELECT * FROM proyecto_sena.Persona WHERE Documento =?", array($Documento));
            $Persona->Documento = $getrow['Documento'];
            $Persona->Nombre = $getrow['Nombre'];
            $Persona->Apellido = $getrow['Apellido'];
            $Persona->Telefono= $getrow['Telefono'];
            $Persona->Correo = $getrow['Correo'];
            $Persona->Rol = $getrow['Rol'];
            $Persona->Contraseña= $getrow['Contraseña'];
            $Persona->Programaformacion = $getrow['Programaformacion'];
            $Persona->Estado = $getrow['Estado'];
        }
        $Persona->Disconnect();
        return $Persona;
    }

    public function update(): bool
    {
        $result = $this->updateRow("UPDATE proyecto.Persona SET Nombre = ?, Apellido = ?, Telefono = ?, Correo = ?, Rol = ?, Contraseña = ?, Programaformacion = ?, Estado = ? WHERE Documento = ?", array(

                $this->Nombre,
                $this->Apellido,
                $this->Telefono,
                $this->Correo,
                $this->Rol,
                $this->Contraseña,
                $this->Programaformacion,
                $this->Estado
            )
        );
        $this->Disconnect();
        return $result;
    }

    public function __toString()
    {
        //
        return $this->Nombre. " " . $this->Apellido;

    }

    protected static function searchForId($id)
    {
        self::searchForDocumento($id);
    }
}