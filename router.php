<?php
$controllers = array(
  'pages' => ['home','blog','contact','about','error','view_post','view_banner'],
  'admin' => ['index','loginPage','login','logout'],
  'post'  => ['index','create','store','edit','update','destroy'],
  'account'  => ['changePass','change']
);
if(isset($_SESSION['role']) && $_SESSION['role'] == 0){
  $controllers = array_merge($controllers,array(
  'account'  => ['index','create','store','edit','update','destroy','changePass','change'],
  'info' => ['index','store'],
  'banner'  => ['index','create','store','edit','update','destroy'],
  'category'  => ['index','create','store','edit','update','destroy']));
}
// Các controllers trong hệ thống và các action có thể gọi ra từ controller đó.

// Nếu các tham số nhận được từ URL không hợp lệ (không thuộc list controller và action có thể gọi
// thì trang báo lỗi sẽ được gọi ra.

if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
  $controller = 'pages';
  $action = 'error';
}

// Nhúng file định nghĩa controller vào để có thể dùng được class định nghĩa trong file đó
include_once('controller/' . $controller . '_controller.php');
// Tạo ra tên controller class từ các giá trị lấy được từ URL sau đó gọi ra để hiển thị trả về cho người dùng.
$klass = str_replace('_', '', ucwords($controller, '_')) . 'Controller';
$controller = new $klass;
$controller->$action();
?>