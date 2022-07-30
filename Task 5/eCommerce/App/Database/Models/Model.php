<?php

  namespace App\Database\Models;
  use App\Database\Config\Connection;
  class Model extends Connection{
     const TABLE='';
     public static function SelectAll(){
        $query = "SELECT * FROM ". static::TABLE;
        return $query;
     }
     public static function Find(int $id){
        $query = "SELECT * FROM ". static::TABLE. "WHERE id = {$id}";
        return $query;
     }
  }
