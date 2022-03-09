<?php



require_once('controller/base_controller.php');

require_once('model/category.php');

require_once('model/post.php');

require_once('model/banner.php');

require_once('model/info.php');

class PagesController extends BaseController

{

  function __construct()

  {
  }



  public function home()

  {

    $data = array(

      'category' => Category::all(),

      'post' => post::recentPost(8),

      'banner' => Banner::all(),

      'info' => info::select()

    );

    $this->render('web/pages/home', $data);
  }

  public function blog()

  {

    $page       = (isset($_GET['page'])) ? $_GET['page'] : 1;



    if (isset($_GET['category_slug'])) {

      $post = post::getPostByCategory($_GET['category_slug'], 8, $page);
    } else {

      $post = post::panigation(8, $page, 1);
    }
    if ($post) {
      $data = array(

        'category' => Category::all(),

        'post' => $post['list'],

        'total' => $post['total'],

        'page' => $page

      );

      return $this->render('web/pages/blog', $data);
    } else return $this->render('web/pages/error');
  }

  public function view_post()

  {

    if (isset($_GET['id'])) {
      $post = Post::find($_GET['id']);
      if ($post) {
        $data = array(

          'category' => Category::all(),

          'post' => Post::find($_GET['id']),

          'last_post' => Post::recentPost(5)

        );

        return $this->render('web/pages/post', $data);
      } else return $this->render('web/pages/error');
    }

    $this->render('web/pages/error');
  }

  public function view_banner()

  {
    $banner = banner::find($_GET['id']);
    if (isset($_GET['id'])) {
      if ($banner) {
        $data = array(

          'category' => Category::all(),

          'banner' => banner::find($_GET['id']),

          'last_post' => Post::recentPost(5)

        );

        return $this->render('web/pages/view_banner', $data);
      } else return $this->render('web/pages/error');
    }

     return $this->render('web/pages/error');
  }

  public function contact()

  {

    $data = array(

      'category' => Category::all(),

      'info' => info::select()

    );

    $this->render('web/pages/contact', $data);
  }

  public function about()

  {

    $data = array(

      'category' => Category::all()

    );

    $this->render('web/pages/about', $data);
  }



  public function error()

  {

    $data = array(

      'category' => Category::all()

    );

    $this->render('web/pages/error', $data);
  }
}
