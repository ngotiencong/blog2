
<div class="fh5co-narrow-content">
    <div class="row">
        <div class="col-md-9 mb40">
            <article>
                
                <div class="post-content">
                    <h2><?php echo $post->title; ?></h2>
                    <ul class="post-meta list-inline">
                        <li class="list-inline-item">
                            <i class="fa fa-user-circle-o"></i> <a href="#">Tác giả: <?php echo $post->account_name; ?></a>
                        </li>
                        <li class="list-inline-item">
                            <i class="fa fa-calendar-o"></i> <a href="index.php?controller=pages&action=blog&category_id=<?php echo $post->category_id ?>"><?php echo $post->category_name; ?></a>
                        </li>
                    </ul>
                    <div class="post_content"><?php echo $post->content; ?></div>
                    
                    <hr class="mb40">
                    
                </div>
            </article>
            <!-- post article-->

        </div>
        <div class="col-md-3 mb40">
            <!--/col-->
            <div class="mb40">
                <h3 class="sidebar-title">Danh mục</h3>
                <ul class="list-unstyled categories">
                  
                <?php foreach($category as $cats) {?>
					        	<li class="" ><a href="<?php echo $this->getfullhost() ?>/category/<?php echo $cats->slug ?>.html"><?php echo $cats->name ?></a></li>
						<?php } ?>
                </ul>
            </div>
            <!--/col-->
            <div>
                <h3 class="sidebar-title">Bài viết mới</h3>
                <ul class="list-unstyled">
                <?php foreach($last_post as $post) {  ?>
                    <li class="media" style="display:flex; align-items: flex-start">
                        <img class="d-flex mr-3 img-fluid" style="margin-right: 10px;" width="64" src="<?php echo $this->getfullhost() ?>/uploads/post/<?php echo $post->image ?>" alt="Generic placeholder image">
                        <div class="media-body">
                            <h5 class="mt-0 mb-1"><a href="<?php echo $this->getfullhost()?>/blog/<?php echo $post->slug.'-'.$post->id?>.html"><?php echo $post->title ?></a></h5> <?php echo $post->category_name ?>
                        </div>
                    </li>

                <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>


