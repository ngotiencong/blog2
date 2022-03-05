<?php
class DB
{
    public static function getDB() {
      $mysqli = new mysqli("localhost","root","1","hoctap");
      mysqli_set_charset($mysqli, 'UTF8');
      return $mysqli;
    }
}