<?php
class Category
{
  public $id;
  public $name;
  public $slug;

  function __construct($id, $name, $slug)
  {
    $this->id = $id;
    $this->name = $name;
    $this->slug = $slug;
  }

  static function all()
  {
    $list = [];
    $db = DB::getDB();
    $dbs = $db->query('SELECT * FROM category');

    if (mysqli_num_rows($dbs)) {

      while ($item = $dbs->fetch_assoc()) {
        $list[] = new Category($item['category_id'], $item['category_name'], $item['category_slug']);
      }

      return $list;
    }
    return false;
  }
  static function find($id)
  {
    $db = DB::getDB();
    $dbs = $db->query("SELECT * FROM category WHERE category_id = '$id'");

    if(mysqli_num_rows($dbs)) {
      while ($item = $dbs->fetch_assoc()) {
        if (isset($item['category_id'])) {
          return new Category($item['category_id'], $item['category_name'], $item['category_slug']);
        } else return null;
      }
    }
  }
  static function findBySlug($slug)
  {
    $db = DB::getDB();
    $dbs = $db->query("SELECT * FROM category WHERE category_slug = '$slug'");

    if(mysqli_num_rows($dbs)) {
      while ($item = $dbs->fetch_assoc()) {
        if (isset($item['category_id'])) {
          return new Category($item['category_id'], $item['category_name'], $item['category_slug']);
        } else return null;
      }
    }
  }
  static function insert($name,$slug)
  {
    $db = DB::getDB();
    $dbs = $db->query("INSERT INTO category (category_name, category_slug) VALUES ('$name','$slug')");

    if($dbs) {
       return true;
    }
    return "Có lỗi xảy ra ! Vui lòng thử lại sau";
  }
  static function update($id,$name,$slug)
  {
    $db = DB::getDB();
    $sql = "UPDATE category SET category_name = '$name', category_slug = '$slug' WHERE category_id = $id";
    $dbs = $db->query($sql);
    if($dbs) {
       return true;
    }
    return "Có lỗi xảy ra ! Vui lòng thử lại sau";
  }
  static function destroy($id)
  {

    $db = DB::getDB();
    $dbs = $db->query("DELETE FROM category WHERE category_id = '$id'");
    var_dump($dbs);
    if($dbs) {
      return true;
   }
   return "Có lỗi xảy ra ! Vui lòng thử lại sau";
  }
  static function panigation($limit = 5, $page = 1)
  {
    $result = DB::getDB()->query("SELECT count(category_id) AS id FROM category")->fetch_assoc();
    $totalPages = ceil($result['id'] / $limit);
    $query      = "SELECT * FROM category  LIMIT " . (($page - 1) * $limit) . ", $limit";
    $dbs             = DB::getDB()->query($query);
    if (mysqli_num_rows($dbs)) {
      while ($item = $dbs->fetch_assoc()) {
        $list[] = new category($item['category_id'], $item['category_name'], $item['category_slug']);
      }
      return array( 'list' => $list, 'total' => $totalPages);
    }
    return false;
  }
  
}
