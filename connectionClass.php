<?php
class connection{

      public $con;
      private $dbName;

      function __construct(){
          $this->dbName = "D:\DITLANTAS\data\mydatabase.mdb";
       }

      function connect(){
          $this->con = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=$this->dbName; Uid=Admin; Pwd=;");
          $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
          return $this->con;
         }   
      }

      if (!ini_get('display_errors')) {
      ini_set('display_errors', '1');
      }
?>