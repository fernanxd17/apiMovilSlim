<?php
    class db {
        private $host = "localhost";
        private $usuario = "root";
        private $password = "1234567890";
        private $base = "tienda";

        public function conectar()
        {
            $con_mysql = "mysql:host=$this->host;dbname=$this->base";
            $con_db = new PDO($con_mysql,$this->usuario,$this->password);
            $con_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //problemas con la codificacion que tiene slim con la base de datos caracteres UTF8
            $con_db->exec("set names utf8");
            return $con_db;

        }

    }
?>