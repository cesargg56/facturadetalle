<?php

    
class Conexion{

    
    private static $conexion;


    public static function abrir_conexion(){
        if(!self::$conexion){
            try{
                require_once 'confi.php';
                self::$conexion = new PDO("mysql:host=localhost; port=3307; dbname=bd_progra", "root", "admon");    
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conexion->exec("SET CHARSET utf8");
            
            }   catch(PDOException $ex){
                echo"error log_".$ex->getMessage();
                echo "<br/>Error al obtener la conexion<br/>";
        }   
    }
    }
    public static function cerrar_conexion(){
        if(isset(self::$conexion)){
            self::$conexion = null;
            echo"";
    }
}

    public static function obtener_conexion(){
        return self::$conexion;
    }
}