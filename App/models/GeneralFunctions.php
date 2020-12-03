<?php


namespace App\Models;

require(__DIR__.'/../../vendor/autoload.php');
use Verot\Upload\Upload;
class GeneralFunctions
{
    /**
     * @param $File = $FILES['Archivo'];
     * @param $Ruta
     * @return bool|string
     */
    static function SubirArchivo($File, $Ruta){
        $archivos = new Upload($File);
        if ($archivos->uploaded){
            $archivos->file_new_name_body = (date('H-M-s')."-".$archivos->file_src_name_body);
            $archivos->Process($Ruta);
            if($archivos->processed){
                return $archivos->file_dst_name;
            }else{
                echo "Archivo No Subido, Error en la carpeta..".$archivos->error;
                return false;
            }
        }else{
            echo "Archivo No Subido, Error en la carpeta..".$archivos->error;
            return false;
        }
    }
}