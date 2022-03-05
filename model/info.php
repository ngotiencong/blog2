<?php
class info
{
  public $status;
  public $email;
  public $phone;
  public $adress;
  public $service1;
  public $service2;
  public $service3;
  public $service4;
  function __construct($status,$email,$phone,$adress,$service1,$service2,$service3,$service4)
  {
    $this->status = $status;
    $this->email = $email;
    $this->phone = $phone;
    $this->adress = $adress;
    $this->service1 = $service1;
    $this->service2 = $service2;
    $this->service3 = $service3;
    $this->service4 = $service4;
  }
  static function select()
  {
    $db = DB::getDB();
    $dbs = $db->query("SELECT * FROM info WHERE info_status = 1 LIMIT 1");
    if(!$dbs){
        $sql = "INSERT INTO info (info_status,info_email,info_phone,info_adress,info_service1,info_service2,info_service3,info_service4) VALUES ('1','','','','','','','')";
        $dbs = $db->query($sql);
        $dbs = $db->query("SELECT * FROM info WHERE info_status = 1 LIMIT 1");
    }
    if(mysqli_num_rows($dbs)) {
      while ($item = $dbs->fetch_assoc()) {        
          return new info($item['info_status'], $item['info_email'], $item['info_phone'], $item['info_adress'], $item['info_service1'], $item['info_service2'], $item['info_service3'], $item['info_service4']);
      }
    }
    return false;
  }
  static function update($email,$phone,$adress,$service1,$service2,$service3,$service4)
  {
    $db = DB::getDB();
    $sql = "UPDATE info SET info_email = '$email', info_phone = '$phone', info_adress = '$adress', info_service1 = '$service1',info_service2 = '$service2', info_service3 = '$service3',info_service4 = '$service4' WHERE info_status = 1";
    $dbs = $db->query($sql);
    if($dbs) {
       return true;
    }
    return false;
  }
  
}
