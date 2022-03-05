<?php
require_once('controller/base_controller.php');
require_once('model/banner.php');
require_once('helper/validation.php');
require_once('helper/upload.php');
class bannerController extends BaseController
{
  function __construct()
  {
  }
  private function validate()
  {
    if (!empty($_POST)) {
      $val = new Validation();
      $val->name('Tên banner')->value((isset($_POST['name'])) ? $_POST['name'] : "")->pattern('words')->required();
      $val->name('Tiêu đề')->value((isset($_POST['title'])) ? $_POST['title'] : "")->pattern('words')->required();
      $val->name('Mô tả')->value((isset($_POST['note'])) ? $_POST['note'] : "")->pattern('words')->required();
      $val->name('Nội dung')->value((isset($_POST['content'])) ? $_POST['content'] : "")->required();
      if ($val->isSuccess()) {
        return true;
      } else {
        return $val->getErrors();
      }
    } else return $this->renderAdmin('admin/pages/error.php');
  }
  public function index()
  {
     $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
     $banner = banner::panigation(5,$page);
     $data = array('banner' => $banner['list'],'total' => $banner['total'],'page' => $page);
     $this->renderAdmin('admin/pages/banner/banner_list', $data);
  }
  public function create()
  {
    $this->renderAdmin('admin/pages/banner/banner_add');
  }
  public function store()
  {
    if ($this->validate() === true) {
      $upload = upload::uploadImage('img', 'banner/');
      if ($upload['status']) {
        $mess = banner::insert($_POST['name'], $_POST['title'], $_POST['note'],$_POST['content'],$upload['file']);
        $data = array('mess' => $mess);
        return $this->renderAdmin('admin/pages/banner/banner_add', $data);
      }else return $this->renderAdmin('admin/pages/banner/banner_add', array('mess' => $upload['error']));
    }else {
      
      return $this->renderAdmin('admin/pages/banner/banner_add', array('mess' => $this->validate()));
    }
  }
  public function edit()
  {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $banner = banner::find($id);
      $data = array('banner' => $banner);
      return $this->renderAdmin('admin/pages/banner/banner_edit', $data);
    }
    header("location:javascript://history.go(-1)");
  }
  public function update()
  {
    if (isset($_GET['id']) && !empty($_GET['id'])) {

      $id = $_GET['id'];
     if ($this->validate() === true) {
        if (!empty($_FILES['img']['name'])) {
          $upload = upload::uploadImage('img', 'banner/');
          if ($upload['status']) {
            $mess = banner::update($id,$_POST['name'], $_POST['title'], $_POST['note'],$_POST['content'],$upload['file']);
            $data =  array('mess' => $mess, 'banner' => banner::find($id));
          }else  $data =  array('mess' => $upload['error'], 'banner' => banner::find($id));
        }else{
        $mess = banner::update($id,$_POST['name'], $_POST['title'], $_POST['note'],$_POST['content']);
        $data = array('mess' => $mess, 'banner' => banner::find($id));
        }
      } else {
        $data = array('mess' => $this->validate(), 'banner' => banner::find($id));
      }
      return $this->renderAdmin('admin/pages/banner/banner_edit', $data);
    }
    return $this->renderAdmin('admin/pages/error.php');
  }
  public function destroy()
  {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $banner = banner::find($id);
      unlink("uploads/banner/" . $banner->image);
      banner::destroy($id);
      header("location: index.php?controller=banner");
    }
  }
}
