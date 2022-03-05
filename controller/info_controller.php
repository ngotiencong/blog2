<?php
require_once('controller/base_controller.php');
require_once('model/info.php');
class InfoController extends BaseController
{
  function __construct()
  {
    
  }

  public function index()
  {
    
    $data = array(
        'info' => info::select()
    );
    $this->renderAdmin('admin/pages/info_edit',$data);
  }
  public function store()
  {
    //if(isset($_POST['email'])&& isset($_POST['phone'])&& isset($_POST['adress'])&& isset($_POST['service1'])&& isset($_POST['service2'])&& isset($_POST['service3'])&& isset($_POST['service4'])){
        $email = $_POST['email'] ;
        $phone = $_POST['phone'];
        $adress = $_POST['adress'];
        $service1 = $_POST['service1'];
        $service2 = $_POST['service2'];
        $service3 = $_POST['service3'];
        $service4 = $_POST['service4'];
        $result = info::update($email,$phone,$adress,$service1,$service2,$service3,$service4);
        $data = array('info' => info::select(),
        'mess' => true
        );
        $this->renderAdmin('admin/pages/info_edit',$data);
    
    
   
  }
}