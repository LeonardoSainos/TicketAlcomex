<?php
class Mysql{

    public static function Conectar(){

        
        if(!$con= mysqli_connect(SERVER,USER,PASS,BD)){
            echo "Error en el servidor, verifique sus datos";
        }
        /* Codificar la información de la base de datos a UTF8*/
        mysqli_set_charset($con, "utf8");
        return $con;  
    }

    public static function consulta($query) {
        if (!$consul = mysqli_query(Mysql::Conectar(), $query)) {
            echo 'Error en la consulta SQL ejecutada';
        }
        return $consul;
    }

    public static function Desconectar($bd){

        $des = mysqli_close(Mysql::Conectar());


        return $des;

    }

}

class Imagen {
    public static function procesar_imagen($rutaImagen, $nombreimagen) {
        $autoriza = false;
        $imagen_ticket = "";
        if (isset($_FILES[$nombreimagen]) && !empty($_FILES[$nombreimagen]['tmp_name'])) {
            $archivo = $_FILES[$nombreimagen];
            $nombre = $archivo['name'];
            $tipo = $archivo['type'];
            $size = $archivo['size'];
            $ruta_temporal = $archivo['tmp_name']; 

            if (!empty($ruta_temporal)) {
                $dimensiones = getimagesize($ruta_temporal);
                $carpeta = $rutaImagen;
                
                if ($tipo != "image/jpg" && $tipo != "image/JPG" && $tipo != "image/jpeg" && $tipo != "image/png" && $tipo != "image/gif") {
                    echo "<script>alert('El archivo que tratas de enviar no es una foto o imagen');</script>";
                    $autoriza = false;
                } elseif ($size > 5 * 1024 * 1024) {
                    echo "<script>alert('Error, el tamaño máximo permitido es de 5MB');</script>";
                    $autoriza = false;
                } else {
                    $extension = pathinfo($nombre, PATHINFO_EXTENSION);
                    $nombre_unico = uniqid('', true) . '.' . $extension;
                    $src = $carpeta . '/' . $nombre_unico;
                    
                    if (file_exists($src)) {
                        // Si el archivo ya existe, renombrarlo con un nombre único
                        $nombre_unico = uniqid('', true) . '.' . $extension;
                        $src = $carpeta . '/' . $nombre_unico;
                    }

                    move_uploaded_file($ruta_temporal, $src);
                    $imagen_ticket = $nombreimagen . '/' . $nombre_unico;
                    $autoriza = true;
                }
            }
        } else {
            $autoriza = true;
            $imagen_ticket = "";
        }

        // Retorna los valores calculados
        return array(
            "autoriza" => $autoriza,
            "imagen_ticket" => $imagen_ticket
        );
    }
}

class MysqlQuery {

    public static function limpiarCadena($valor) {
        $valor = str_ireplace("SELECT", "", $valor);
        $valor = str_ireplace("COPY", "", $valor);
        $valor = str_ireplace("UPDATE", "", $valor);
        $valor = str_ireplace("DELETE", "", $valor);
        $valor = str_ireplace("DROP", "", $valor);
        $valor = str_ireplace("DUMP", "", $valor);
        $valor = str_ireplace(" OR ", "", $valor);
        $valor = str_ireplace("%", "", $valor);
        $valor = str_ireplace("LIKE", "", $valor);
        $valor = str_ireplace("--", "", $valor);
        $valor = str_ireplace("^", "", $valor);
        $valor = str_ireplace("[", "", $valor);
        $valor = str_ireplace("]", "", $valor);
        $valor = str_ireplace("\\", "", $valor);
        $valor = str_ireplace("!", "", $valor);
        $valor = str_ireplace("¡", "", $valor);
     //   $valor = str_ireplace("?", "", $valor);
        $valor = str_ireplace("=", "", $valor);
        $valor = str_ireplace("&", "", $valor);
        return $valor;
    }

    public static function RequestGet($val) {
        $data = addslashes($_GET[$val]);
        $datos = MysqlQuery::limpiarCadena($data);
        return $datos;
    }

    public static function RequestPost($val) {
        $data = addslashes($_POST[$val]);
       
        $datos = MysqlQuery::limpiarCadena($data);
        return $datos;
    }


    public static function RequestFile($val){
        $data = addslashes($_FILES[$val]);
        $datos = MysqlQuery::limpiarCadena($data);
        return $datos;        
    }

    public static function Guardar($tabla, $campos, $valores) {
        if (!$sql = Mysql::consulta("INSERT INTO $tabla ($campos) VALUES($valores)"))
         {
            die("Error al insertar los datos en la tabla");
        }
        return $sql;
    }
    public static function Eliminar($tabla, $condicion) {
        if (!$sql = Mysql::consulta("DELETE FROM $tabla WHERE $condicion")) {
            die("Error al eliminar registros en la tabla");
        }
        return $sql;
    }

    public static function Actualizar($tabla, $campos, $condicion) {
        if (!$sql = Mysql::consulta("UPDATE $tabla SET $campos WHERE $condicion")) {
            die("Error al actualizar datos en la tabla");
        }
        return $sql;
    }


    public static function ProcedimientoAlmacenado($nombre, $parametros){
    if(!$sql = Mysql::consulta("CALL $nombre($parametros)")){
        die("Error al ejecutar el procedimiento almacenado");
    }
    return $sql;

    }
}
