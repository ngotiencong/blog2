<?php

class BaseController

{



  // Hàm hiển thị kết quả ra cho người dùng.s

  function render($file, $data = array())

  {

    // Kiểm tra file gọi đến có tồn tại hay không?

    $view_file = 'view/' . $file . '.php';

    

    if (is_file($view_file)) {

      extract($data);

      ob_start();

      require_once($view_file);

      $content = ob_get_clean();

			

      require_once('view/web/layout/plant.php');



    } else {

      // Nếu file muốn gọi ra không tồn tại thì chuyển hướng đến trang báo lỗi.

     

      header('Location: index.php?controller=pages&action=error');

    }

  }

  function renderAdmin($file, $data = array())

  {

    if(!isset($_SESSION['login']) || $_SESSION['login'] != true){

      header("location: index.php?controller=admin&action=loginPage");

    }

    // Kiểm tra file gọi đến có tồn tại hay không?

    $view_file = 'view/' . $file . '.php';

    

    if (is_file($view_file)) {

     

      

      extract($data);

      ob_start();

      require_once($view_file);

      $content = ob_get_clean();

      require_once('view/admin/layout/plant.php');

      



    } else {

      // Nếu file muốn gọi ra không tồn tại thì chuyển hướng đến trang báo lỗi.

     

      header('Location: index.php?controller=pages&action=error');

    }

  }

  function renderLogin($file, $data = array())

  {



    // if(isset($_SESSION['login']) && $_SESSION['login'] == true){

    //   header("location: index.php?controller=admin");

    // }

    // Kiểm tra file gọi đến có tồn tại hay không?

    $view_file = 'view/' . $file . '.php';

    

    if (is_file($view_file)) {

     

      

      extract($data);

      ob_start();

      require_once($view_file);

      $content = ob_get_clean();

      require_once('view/admin/login/loginPlant.php');



    } else {

      // Nếu file muốn gọi ra không tồn tại thì chuyển hướng đến trang báo lỗi.

     

      header('Location: index.php?controller=pages&action=error');

    }

  }

  function getFullHost()

  {

      $protocole = $_SERVER['REQUEST_SCHEME'].'://';

      $host = $_SERVER['HTTP_HOST'].'/';

      $project = explode('/', $_SERVER['REQUEST_URI'])[1];

      return "/blog";

  }

  

  }

?>