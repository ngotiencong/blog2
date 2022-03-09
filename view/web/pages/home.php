<aside id="fh5co-hero" class="js-fullheight">

  <div class="flexslider js-fullheight">

    <ul class="slides">

      <?php if(!empty($banner)){ foreach($banner as $banner) {?>

      <li style="background-image: url(uploads/banner/<?php echo $banner->image ?>)">

        <div class="overlay"></div>

        <div class="container-fluid">

          <div class="row">

            <div class="col-md-8 col-md-offset-2 text-center js-fullheight slider-text">

              <div class="slider-text-inner">

                <h1><?php echo $banner->title ?></h1>

                <h2><?php echo $banner->note ?></h2>

                <p> <a href="<?php echo $this->getfullhost()."/banner/banner-".$banner->id?>.html" class="btn btn-primary btn-learn">Xem thêm<i class="icon-arrow-right3"></i></a></p>

              </div>

            </div>

          </div>

        </div>

      </li>

      <?php } } ?>

    </ul>

  </div>

</aside>




<div class="fh5co-narrow-content">

  <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Recent Blog</h2>

  <div class="row row-bottom-padded-md">

  <?php if(!empty($post)){ foreach($post as $post) {?>

    <div class="col-md-3 col-sm-6 col-padding animate-box" data-animate-effect="fadeInLeft">

      <div class="blog-entry">

        <a style="max-height: 150px;" href="<?php echo $this->getfullhost()."/".$post->slug."-".$post->id ?>.html" class="blog-img"><img src="uploads/post/<?php echo $post->image ?>" class="img-responsive" alt="congngo.com"></a>

        <div class="desc">

          <h3><a href="<?php echo $this->getfullhost()."/".$post->slug."-".$post->id ?>.html" class="blog-img"><?php echo $post->title ?></a></h3>

          <span><small>by <?php echo $post->account_name ?> </small> / <small> <?php echo $post->category_name ?> </small> / <small> <i class="icon-comment"></i> 14</small></span>

          <p class="post-desc"><?php echo $post->desc ?></p>

          <a href="<?php echo $this->getfullhost()."/".$post->slug."-".$post->id ?>.html" class="lead">Xem thêm<i class="icon-arrow-right3"></i></a>

        </div>

      </div>

    </div>

    <?php }}?>

  </div>

</div>