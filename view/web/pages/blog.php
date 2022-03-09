<div class="fh5co-narrow-content">

	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Read Our Blog</h2>

	<div class="row row-bottom-padded-md">

	<?php if(!empty($post)){ foreach($post as $post) {?>

    <div class="col-md-3 col-sm-6 col-padding animate-box" data-animate-effect="fadeInLeft">

      <div class="blog-entry">

        <a style="max-height: 150px;" href="<?php echo $this->getfullhost() ?>/<?php echo $post->slug."-".$post->id ?>.html" class="blog-img"><img src="<?php echo $this->getfullhost() ?>/uploads/post/<?php echo $post->image ?>" class="img-responsive" alt="congngo.com"></a>

        <div class="desc">

          <h3><a href="<?php echo $this->getfullhost() ?>/<?php echo $post->slug."-".$post->id ?>.html"><?php echo $post->title ?></a></h3>

          <span><small>by <?php echo $post->account_name ?> </small> / <small> <?php echo $post->category_name ?> </small> / <small> <i class="icon-comment"></i> 14</small></span>

          <p class="post-desc"><?php echo $post->desc ?></p>

          <a href="<?php echo $this->getfullhost() ?>/<?php echo $post->slug."-".$post->id ?>.html" class="lead">Xem thêm<i class="icon-arrow-right3"></i></a>

        </div>

      </div>

    </div>

   <?php }
    } 

    ?>

   

	</div>
    
</div>
<div class="col-md-12 col-sm-12 text-center">
    <nav aria-label="Page navigation example mt-5">
      <ul class="pagination justify-content-center">
        <li class="page-item <?php if ($page <= 1) {
                                echo 'disabled';
                              } ?>">
          <a class="page-link" href="<?php if ($page <= 1) {
                                        echo '#';
                                      } else {
                                        echo "index.php?controller=pages&action=blog&page=" . $prev;
                                      } ?>">Previous</a>
        </li>
        <?php for ($i = 1; $i <= $total; $i++) : ?>
          <li class="page-item <?php if ($page == $i) {
                                  echo 'active';
                                } ?>">
            <a class="page-link" href="index.php?controller=pages&action=blog&page=<?= $i; ?>"> <?= $i; ?> </a>
          </li>
        <?php endfor; ?>
        <li class="page-item <?php if ($page >= $total) {
                                echo 'disabled';
                              } ?>">
          <a class="page-link" href="<?php if ($page >= $total) {
                                        echo '#';
                                      } else {
                                        echo "index.php?controller=pages&action=blog&page=" . $next;
                                      } ?>">Next</a>
        </li>
      </ul>
    </nav>
    </div>