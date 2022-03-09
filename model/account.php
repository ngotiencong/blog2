<?php

class account

{

  public $id;

  public $user;

  public $pass;

  public $role;



  function __construct($id, $user, $pass, $role)

  {

    $this->id = $id;

    $this->user = $user;

    $this->pass = $pass;

    $this->role = $role;

  }



  static function all()

  {

    $list = [];

    $db = DB::getDB();

    $dbs = $db->query('SELECT * FROM account');



    if (mysqli_num_rows($dbs)) {



      while ($item = $dbs->fetch_assoc()) {

        $list[] = new account($item['account_id'], $item['account_user'], $item['account_pass'], $item['account_role']);

      }



      return $list;

    }

    return false;

  }

  static function find($id)

  {

    $db = DB::getDB();

    $dbs = $db->query("SELECT * FROM account WHERE account_id = '$id'");



    if(mysqli_num_rows($dbs)) {

      while ($item = $dbs->fetch_assoc()) {

        if (isset($item['account_id'])) {

          return new account($item['account_id'], $item['account_user'], $item['account_pass'], $item['account_role']);

        } else return null;

      }

    }

  }

  static function insert($user,$pass,$role)

  {

    

    $db = DB::getDB();

    $dbs = $db->query("INSERT INTO account (account_user, account_pass,account_role) VALUES ('$user','$pass','$role')");



    if($dbs) {

       return true;

    }

    return array("Có lỗi xảy ra ! Vui lòng thử lại sau");

  }

  static function update($id,$user,$pass,$role)

  {

    $db = DB::getDB();

    $sql = "UPDATE account SET account_user = '$user', account_pass = '$pass', account_role = '$role' WHERE account_id = $id";

    $dbs = $db->query($sql);

    if($dbs) {

       return true;

    }

    return array("Có lỗi xảy ra ! Vui lòng thử lại sau");

  }

  static function destroy($id)

  {



    $db = DB::getDB();

    $dbs = $db->query("DELETE FROM account WHERE account_id = '$id'");

    var_dump($dbs);

    if($dbs) {

      return true;

   }

   return array("Có lỗi xảy ra ! Vui lòng thử lại sau");

  }

  static function panigation($limit = 5, $page = 1)

  {

    $result = DB::getDB()->query("SELECT count(account_id) AS id FROM account")->fetch_assoc();

    $totalPages = ceil($result['id'] / $limit);

    $query      = "SELECT * FROM account  LIMIT " . (($page - 1) * $limit) . ", $limit";

    $dbs             = DB::getDB()->query($query);

    if (mysqli_num_rows($dbs)) {

      while ($item = $dbs->fetch_assoc()) {

        $list[] = new account($item['account_id'], $item['account_user'], $item['account_pass'], $item['account_role']);

      }

      return array( 'list' => $list, 'total' => $totalPages);

    }

    return false;

  }

  static function changePass($id,$pass)

  {

    $db = DB::getDB();

    $sql = "UPDATE account SET  account_pass = '$pass' WHERE account_id = $id";

    $dbs = $db->query($sql);

    if($dbs) {

       return true;

    }

    return array("Có lỗi xảy ra ! Vui lòng thử lại sau");

  }

  

}

