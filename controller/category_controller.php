<?php

require_once('controller/base_controller.php');
require_once('model/category.php');
require_once('helper/validation.php');
class CategoryController extends BaseController
{
  function __construct()
  {
  }
  private function validate()
  {
    if (!empty($_POST)) {
      $val = new Validation();
      $val->name('Tên danh mục')->value($_POST['name'])->pattern('words')->required();
      $val->name('Từ khoá')->value($_POST['slug'])->pattern('slug')->required();
      if ($val->isSuccess()) {
        return true;
      } else {
        return $val->getErrors();
      }
    } else return $this->renderAdmin('admin/pages/error.php');
  }
  public function index()
  {

    $page   = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $category = category::panigation(5, $page);
    $data = array('category' => $category['list'], 'total' => $category['total'], 'page' => $page);
    $this->renderAdmin('admin/pages/category/category_list', $data);
  }
  public function create()
  {
    $this->renderAdmin('admin/pages/category/category_add');
  }
  public function store()
  {
    if ($this->validate() === true) {
      $mess = Category::insert($_POST['name'],$_POST['slug']);
      $data = array('mess' => $mess);
    } else {
      $data = array('mess' => $this->validate());
    }
    $this->renderAdmin('admin/pages/category/category_add', $data);
  }
  public function edit()
  {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $category = Category::find($id);
      $data = array('category' => $category);
      return $this->renderAdmin('admin/pages/category/category_edit', $data);
    }
    return $this->renderAdmin('admin/pages/error.php');
  }
  public function update()
  {
    $val = new Validation();
    //=================================================
    if (isset($_GET['id']) && !empty($_GET['id'])) {
      $id = $_GET['id'];
      if ($this->validate() === true) {
        $mess = Category::update($id,$_POST['name'],$_POST['slug']);
      } else {
        $mess =  $this->validate();
      }
      $data = array('mess' => $mess, 'category' => Category::find($id));
      return $this->renderAdmin('admin/pages/category/category_edit', $data);
    }
    return $this->renderAdmin('admin/pages/error.php');
  }
  public function destroy()
  {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      Category::destroy($id);
      header("location: index.php?controller=category");
    }
  }
}
