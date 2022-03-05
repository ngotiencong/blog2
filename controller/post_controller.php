<?php
require_once('controller/base_controller.php');
require_once('model/post.php');
require_once('model/category.php');
require_once('helper/validation.php');
require_once('helper/upload.php');
class PostController extends BaseController
{
  private $category;
  function __construct()
  {
    $this->category = Category::all();
  }
  private function validate()
  {
    if (!empty($_POST)) {
      $val = new Validation();
      $val->name('Tiêu đề')->value((isset($_POST['title'])) ? $_POST['title'] : "")->required();
      $val->name('Mô tả')->value((isset($_POST['desc'])) ? $_POST['desc'] : "")->required();
      $val->name('Nội dung')->value((isset($_POST['content'])) ? $_POST['content'] : "")->required();
      $val->name('Từ khoá')->value((isset($_POST['slug'])) ? $_POST['slug'] : "")->pattern('slug')->required();
      $val->name('Danh mục')->value((isset($_POST['category_id'])) ? $_POST['category_id'] : "")->pattern('int')->required();
      if ($val->isSuccess()) {
        return true;
      } else {
        return $val->getErrors();
      }
    } else return $this->renderAdmin('admin/pages/error.php');
  }
  public function index()
  {
    $page       = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $post = post::panigation(5, $page);
    $data = array('post' => $post['list'], 'total' => $post['total'], 'page' => $page);
    $this->renderAdmin('admin/pages/post/post_list', $data);
  }
  public function create()
  {
    $data = array('category' => $this->category);
    $this->renderAdmin('admin/pages/post/post_add', $data);
  }
  public function store()
  {
    if ($this->validate() === true) {
      $upload = upload::uploadImage('img', 'post/');
      if ($upload['status']) {
        $mess = post::insert($_POST['title'], $_POST['desc'], $_POST['content'], $_POST['slug'], $_POST['category_id'],$_SESSION['user_id'], $upload['file']);
        $data = array('mess' => $mess, 'category' => $this->category);
        return $this->renderAdmin('admin/pages/post/post_add', $data);
      }else return $this->renderAdmin('admin/pages/post/post_add', array('mess' => $upload['error'], 'category' => $this->category));
    }else {
      return $this->renderAdmin('admin/pages/post/post_add', array('mess' => $this->validate(), 'category' => $this->category));
    }
  }
  public function edit()
  {

    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $post = post::find($id);
      $data = array('post' => $post, 'category' => $this->category);
      return $this->renderAdmin('admin/pages/post/post_edit', $data);
    }
    return $this->renderAdmin('admin/pages/error.php');
  }
  public function update()
  {
    if (isset($_GET['id']) && !empty($_GET['id'])) {

      $id = $_GET['id'];
     if ($this->validate() === true) {
        if (!empty($_FILES['img']['name'])) {
          $upload = upload::uploadImage('img', 'post/');
          if ($upload['status']) {
            $mess = post::update($id,$_POST['title'], $_POST['desc'], $_POST['content'], $_POST['slug'], $_POST['category_id'],$_SESSION['user_id'], $upload['file']);
            $data =  array('mess' => $mess, 'post' => post::find($id), 'category' => $this->category);
          }else  $data =  array('mess' => $upload['error'], 'post' => post::find($id), 'category' => $this->category);
        }else{
        $mess = post::update($id,$_POST['title'], $_POST['desc'], $_POST['content'], $_POST['slug'], $_POST['category_id'],$_SESSION['user_id']);
        $data = array('mess' => $mess, 'post' => post::find($id), 'category' => $this->category);
        }
      } else {
        $data = array('mess' => $this->validate(), 'post' => post::find($id), 'category' => $this->category);
      }
      return $this->renderAdmin('admin/pages/post/post_edit', $data);
    }
    return $this->renderAdmin('admin/pages/error.php');
  }
  public function destroy()
  {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $post = post::find($id);
      unlink("uploads/post/" . $post->image);
      post::destroy($id);
      header("location: index.php?controller=post");
    }
  }
}
