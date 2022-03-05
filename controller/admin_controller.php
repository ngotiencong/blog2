<?php
require_once('controller/base_controller.php');
require_once('model/account.php');
require_once('helper/validation.php');
class AdminController extends BaseController
{
  function __construct()
  {
    
  }
  private function validate()
  {
    if (!empty($_POST)) {
      $val = new Validation();
      $val->name('Tên đăng nhập')->value($_POST['user'])->pattern('words')->required();
      $val->name('Mật khẩu')->value($_POST['pass'])->pattern('text')->required();
      if ($val->isSuccess()) {
        return true;
      } else {
        return $val->getErrors();
      }
    } else return $this->renderAdmin('admin/pages/error.php');
  }
  private function checkLogin($user,$pass){
    
    $account = account::all();
    if ($account) {
      foreach ($account as $acc) {
        if ($acc->user == $user && password_verify($pass, $acc->pass)) {
          $_SESSION['login'] = true;
          $_SESSION['user'] = $user;
          $_SESSION['user_id'] = $acc->id;
          $_SESSION['role'] = $acc->role;
          return true;
        }
      }
    }
  }
  public function index()
  {
    $data = array();
    $this->renderAdmin('admin/pages/dashboard', $data);
  }

  public function loginPage()
  {
    $this->renderLogin('admin/login/loginPage');
  }
  public function login()
  {
    if ($this->validate() === true) {
      if($this->checkLogin($_POST['user'],$_POST['pass'])){
        header("location: index.php?controller=admin");
      }
    } else return $this->renderLogin('admin/login/loginPage', array('mess' => $this->validate()));
    return $this->renderLogin('admin/login/loginPage', array('mess' => array('tài khoản hoặc mật khẩu không chính xác')));
  }
  public function logout()
  {
      session_destroy();
      return $this->renderLogin('admin/login/loginPage');
  }
}
// function register($username, $password) {
//   $hash = password_hash($password, PASSWORD_BCRYPT);
//   save($username, $hash);
// }

// function login($username, $password) {   
//   $hash = loadHashByUsername($username);
//   if (password_verify($password, $hash)) {
//       //login
//   } else {
//       // failure
//   }
// }