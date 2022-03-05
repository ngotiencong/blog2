<?php
class Banner
{
  public $id;
  public $name;
  public $title;
  public $image;
  public $note;
  public $content;

  function __construct($id, $name, $title, $image, $note,$content)
  {
    $this->id = $id;
    $this->name = $name;
    $this->title = $title;
    $this->image = $image;
    $this->note = $note;
    $this->content = $content;
  }

  static function all()
  {
    $list = [];
    $db = DB::getDB();
    $dbs = $db->query('SELECT * FROM banner');

    if (mysqli_num_rows($dbs)) {

      while ($item = $dbs->fetch_assoc()) {
        $list[] = new banner($item['banner_id'], $item['banner_name'], $item['banner_title'], $item['banner_image'], $item['banner_note'], $item['banner_content']);
      }

      return $list;
    }
    return false;
  }
  static function find($id)
  {
    $db = DB::getDB();
    $dbs = $db->query("SELECT * FROM banner WHERE banner_id = '$id'");

    if (mysqli_num_rows($dbs)) {
      while ($item = $dbs->fetch_assoc()) {
        if (isset($item['banner_id'])) {
          return new banner($item['banner_id'], $item['banner_name'], $item['banner_title'], $item['banner_image'], $item['banner_note'], $item['banner_content']);
        } else return null;
      }
    }
  }
  static function insert($name,$title,$note,$content,$image)
  {
    $db = DB::getDB();
    $dbs = $db->query("INSERT INTO banner (banner_name, banner_title,banner_note,banner_content, banner_image) VALUES ('$name','$title','$note','$content','$image')");

    if($dbs) {
       return true;
    }
    return array("Có lỗi xảy ra ! Vui lòng thử lại sau");
  }
  static function update($id,$name,$title,$note,$content,$image = false)
  {
    $db = DB::getDB();
    if($image){
      $banner = banner::find($id);
      if(file_exists($path =  "uploads/banner/" . $banner->image)) unlink($path);
      $sql = "UPDATE banner SET banner_name = '$name', banner_title = '$title', banner_note = '$note',banner_content = '$content', banner_image = '$image' WHERE banner_id = '$id'";
    }else{
    $sql = "UPDATE banner SET banner_name = '$name', banner_title = '$title', banner_note = '$note',banner_content = '$content' WHERE banner_id = '$id'";
    }
    $dbs = $db->query($sql);
    if($dbs) {
       return true;
    }
    return "Có lỗi xảy ra ! Vui lòng thử lại sau";
  }
  
  static function destroy($id)
  {

    $db = DB::getDB();
    $dbs = $db->query("DELETE FROM banner WHERE banner_id = '$id'");
    var_dump($dbs);
    if ($dbs) {
      return true;
    }
    return false;
  }
  static function panigation($limit = 5, $page = 1)
  {
    $result = DB::getDB()->query("SELECT count(banner_id) AS id FROM banner")->fetch_assoc();
    $totalPages = ceil($result['id'] / $limit);
    $query      = "SELECT * FROM banner  LIMIT " . (($page - 1) * $limit) . ", $limit";
    $dbs             = DB::getDB()->query($query);
    if (mysqli_num_rows($dbs)) {
      while ($item = $dbs->fetch_assoc()) {
        $list[] = new banner($item['banner_id'], $item['banner_name'], $item['banner_title'], $item['banner_image'], $item['banner_note'], $item['banner_content']);
      }
      return array( 'list' => $list, 'total' => $totalPages);
    }
    return false;
  }
}
