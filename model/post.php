<?php
require_once('model/category.php');
require_once('model/account.php');
class post
{
  public $id;
  public $title;
  public $desc;
  public $image;
  public $content;
  public $slug;
  public $category_id;
  public $category_name;
  public $account_id;
  public $account_name;
  function __construct($id, $title ,$desc,$image,$content,$slug,$category_id,$account_id,$category_name = "",$account_name="")
  {
    $this->id = $id;
    $this->title = $title;
    $this->desc = $desc;
    $this->image = $image;
    $this->content = $content;
    $this->slug = $slug;
    $this->category_id = $category_id; 
    $this->account_id = $account_id;
    $this->category_name = $category_name;
    $this->account_name = $account_name;
  }

  static function all()
  {
    $list = [];
    $db = DB::getDB();
    $dbs = $db->query('SELECT * FROM post');

    if (mysqli_num_rows($dbs)) {

      while ($item = $dbs->fetch_assoc()) {
        $list[] = new post($item['post_id'], $item['post_title'], $item['post_desc'], $item['post_image'], $item['post_content'], $item['post_slug'], $item['category_id'], $item['account_id']);
      }

      return $list;
    }   
    return false;
  }
  static function find($id)
  {
    $db = DB::getDB();
    $dbs = $db->query("SELECT * FROM post WHERE post_id = '$id'");

    if(mysqli_num_rows($dbs)) {
      while ($item = $dbs->fetch_assoc()) {
        if (isset($item['post_id'])) {
          $category_name = Category::find($item['category_id'])->name;
          $account_name = account::find($item['account_id'])->user;
          return new post($item['post_id'], $item['post_title'], $item['post_desc'], $item['post_image'], $item['post_content'], $item['post_slug'], $item['category_id'], $item['account_id'],$category_name,$account_name);
        } else return null;
      }
    }
  }
  static function insert($title,$desc,$content,$slug,$category_id,$account_id,$image)
  {
    $db = DB::getDB();
    $dbs = $db->query("INSERT INTO post (post_title, post_desc,post_content, post_image,post_slug,category_id,account_id) VALUES ('$title','$desc','$content','$image','$slug','$category_id','$account_id')");

    if($dbs) {
       return true;
    }
    return array("Có lỗi xảy ra ! Vui lòng thử lại sau");
  }
  static function update($id,$title,$desc,$content,$slug,$category_id,$account_id,$image = false)
  {
    $db = DB::getDB();
    if($image){
      $post = post::find($id);
      if(file_exists($path =  "uploads/post/" . $post->image)) unlink($path);
      $sql = "UPDATE post SET post_title = '$title', post_desc = '$desc', post_content = '$content', post_image = '$image', post_slug = '$slug',category_id = '$category_id' WHERE post_id = '$id'";
    }else{
    $sql = "UPDATE post SET post_title = '$title', post_desc = '$desc', post_content = '$content', post_slug = '$slug',category_id = '$category_id' WHERE post_id = '$id'";
    }
    $dbs = $db->query($sql);
    if($dbs) {
       return true;
    }
    return array("Có lỗi xảy ra ! Vui lòng thử lại sau");
  }
  static function destroy($id)
  {

    $db = DB::getDB();
    $dbs = $db->query("DELETE FROM post WHERE post_id = '$id'");
    var_dump($dbs);
    if($dbs) {
      return true;
   }
   return false;
  }
  static function panigation($limit = 5, $page = 1, $status = 0)
  {
    if(isset($_SESSION['role'])  && $_SESSION['role'] == 1 && $status == 0){
      $account_id = $_SESSION['user_id'];
      $result = DB::getDB()->query("SELECT count(post_id) AS id FROM post WHERE account_id = '$account_id'")->fetch_assoc();
      $query      = "SELECT * FROM post WHERE account_id = '$account_id'  ORDER BY post_id DESC  LIMIT ". (($page - 1) * $limit) . ", $limit";
    }else{
      $result = DB::getDB()->query("SELECT count(post_id) AS id FROM post")->fetch_assoc();
      $query      = "SELECT * FROM post  ORDER BY post_id DESC   LIMIT " . (($page - 1) * $limit) . ", $limit ";
    }
    $totalPages = ceil($result['id'] / $limit);
    $dbs             = DB::getDB()->query($query);
    if (mysqli_num_rows($dbs)) {
      while ($item = $dbs->fetch_assoc()) {
        $category_name = Category::find($item['category_id'])->name;
        $account_name = account::find($item['account_id'])->user;
        $list[] = new post($item['post_id'], $item['post_title'], $item['post_desc'], $item['post_image'], $item['post_content'], $item['post_slug'], $item['category_id'], $item['account_id'],$category_name,$account_name);
      }
      
      return array( 'list' => $list, 'total' => $totalPages);
    }
    return false;
  }
  static function recentPost($limit = 4)
  {

    $query = "SELECT * FROM post order by post_id desc LIMIT ".$limit;
    $dbs = DB::getDB()->query($query);
    
    if (mysqli_num_rows($dbs)) {
      while ($item = $dbs->fetch_assoc()) {
        $category_name = Category::find($item['category_id'])->name;
        $account_name = account::find($item['account_id'])->user;
        $list[] = new post($item['post_id'], $item['post_title'], $item['post_desc'], $item['post_image'], $item['post_content'], $item['post_slug'], $item['category_id'], $item['account_id'],$category_name,$account_name);
      }
      return $list;
    }
   return false;
  }
  static function getPostByCategory($slug,$limit,$page)
  {
    $category = Category::findBySlug($slug);
    if($category){
      $category_id = $category->id;
    }else return false;
    $db = DB::getDB();
    $result = DB::getDB()->query("SELECT count(post_id) AS id FROM post WHERE category_id = '$category_id'")->fetch_assoc();
    $query      = "SELECT * FROM post WHERE category_id = "." '$category_id' ORDER BY post_id DESC LIMIT ". (($page - 1) * $limit) . ", $limit";
    $totalPages = ceil($result['id'] / $limit);
    $dbs = DB::getDB()->query($query);
    if(mysqli_num_rows($dbs)) {
      while ($item = $dbs->fetch_assoc()) {
        if (isset($item['post_id'])) {
          $category_name = Category::find($item['category_id'])->name;
          $account_name = account::find($item['account_id'])->user;
          $list[] = new post($item['post_id'], $item['post_title'], $item['post_desc'], $item['post_image'], $item['post_content'], $item['post_slug'],$item['category_id'], $item['account_id'],$category_name,$account_name);
        } else return false;
      }
      return array( 'list' => $list, 'total' => $totalPages);
    }
  }


}
