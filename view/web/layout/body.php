
<div id="fh5co-page">
		<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
		<aside id="fh5co-aside" role="complementary" class="border js-fullheight">

			<h4 style="font-size: 3.5rem;" id="fh5co-logo"><a href="<?php echo $this->getfullhost() ?>/">CONGNGO.COM</a></h4>
			<nav id="fh5co-main-menu" role="navigation">
				<ul>
					<li class="fh5co-active"><a href="<?php echo $this->getfullhost() ?>/">Home</a></li>
					<li class="blog"><a href="<?php echo $this->getfullhost() ?>/blog.html">Blog</a>
					<a id="category-btn" href="#"><i class="icomoon icon-arrow-down3"></i></a>
					<ul class="category-list">
					<?php if(!empty($category)){  foreach($category as $category) {?>
						<li class="category-item" ><a href="<?php echo $this->getfullhost() ?>/category/<?php echo $category->slug ?>.html"><?php echo $category->name ?></a></li>
						<?php }} ?>
					</ul>
				
				</li>
					<li><a href="<?php echo $this->getfullhost() ?>/contact.html">Contact</a></li>
					<li><a href="<?php echo $this->getfullhost() ?>/about.html">About</a></li>
					
				</ul>
			</nav>

			<div class="fh5co-footer">
				<p><small>&copy; Copyright 2021 by congngo. All Rights Reserved..</span> <span>Contact me: admin@congngo.com</a> </span></small></p>
				<ul>
					<li><a href="#"><i class="icon-facebook2"></i></a></li>
					<li><a href="#"><i class="icon-twitter2"></i></a></li>
					<li><a href="#"><i class="icon-instagram"></i></a></li>
					<li><a href="#"><i class="icon-linkedin2"></i></a></li>
				</ul>
			</div>

		</aside>

		<div id="fh5co-main">
			<?php echo @$content ?>
		</div>
	
</div>
