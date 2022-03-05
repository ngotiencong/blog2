<?php



require_once('controller/base_controller.php');

require_once('model/account.php');

require_once('helper/validation.php');

class accountController extends BaseController

{

  function __construct()

  {

    

  }

  private function validate()

  {

    if (!empty($_POST)) {

      $val = new validation();

      $val->name('Tên đăng nhập')->value($_POST['user'])->pattern('words')->required();

      $val->name('Mật khẩu')->value($_POST['pass'])->pattern('text')->required();

      $val->name('Vai trò')->value((isset($_POST['role'])) ? $_POST['role'] : "")->pattern('int')->required();

      if ($val->isSuccess()) {

        return true;

      } else {

        return $val->getErrors();

      }

    } else return $this->renderAdmin('admin/pages/error.php');

  }

  private function checkpass($id,$current_pass){

    if (password_verify($current_pass, account::find($id)->pass)) return true;

  }

  public function index()

  {



    $page   = (isset($_GET['page'])) ? $_GET['page'] : 1;

    $account = account::panigation(5, $page);

    $data = array('account' => $account['list'], 'total' => $account['total'], 'page' => $page);

    $this->renderAdmin('admin/pages/account/account_list', $data);

  }

  public function create()

  {

    $this->renderAdmin('admin/pages/account/account_add');

  }

  public function store()

  {

    if ($this->validate() === true) {

      $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);

      $mess = account::insert($_POST['user'],$pass,$_POST['role']);

      $data = array('mess' => $mess);

    } else {

      $data = array('mess' => $this->validate());

    }

    $this->renderAdmin('admin/pages/account/account_add', $data);

  }

  public function edit()

  {

    if (isset($_GET['id'])) {

      $id = $_GET['id'];

      $account = account::find($id);

      $data = array('account' => $account);

      return $this->renderAdmin('admin/pages/account/account_edit', $data);

    }

    return $this->renderAdmin('admin/pages/error.php');

  }

  public function update()

  {

    //=================================================

    if (isset($_GET['id']) && !empty($_GET['id'])) {

      $id = $_GET['id'];

      if ($this->validate() === true ) {

        if($this->checkpass($id,$_POST['pass_current'])){

        $mess = account::update($id,$_POST['user'],password_hash($_POST['pass'], PASSWORD_BCRYPT),$_POST['role']);

        }else $mess = array('Mật khẩu cũ không đúng');

        

      } else {

        $mess =  $this->validate();

      }

      $data = array('mess' => $mess, 'account' => account::find($id));

      return $this->renderAdmin('admin/pages/account/account_edit', $data);

    }

    return $this->renderAdmin('admin/pages/error.php');

  }

  public function destroy()

  {

    if (isset($_GET['id'])) {

      

      $id = $_GET['id'];

      if( $id != $_SESSION['user_id']){

        account::destroy($id);

      }

      header("location: index.php?controller=account");

    }

  }

  public function changePass()

  {

    $this->renderAdmin('admin/pages/account/account_changePass');

  }

  public function change()

  {

      if($this->checkpass($_SESSION['user_id'],$_POST['pass_current'])){

        $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);

        $mess = account::changePass($_SESSION['user_id'],$pass);

      }else $mess = array('Mật khẩu cũ không đúng');

    return $this->renderAdmin('admin/pages/account/account_changePass' ,array('mess' => $mess));

  }

}

