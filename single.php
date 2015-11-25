<?php //get_template_part('templates/content-single', get_post_type()); ?>

<div class="breadcrumbs container">
    <ul class="breadcrumbs-list list-inline">
        <li><a href="index-2.html">Home</a><i class="fa fa-angle-right"></i></li>
        <li><a href="work.html">Our work</a><i class="fa fa-angle-right"></i></li>
        <li class="current">Case Study: Velocity web application</li>
    </ul>
</div><!--//breadcrumbs-->

<!-- ******Blog Post****** -->
<div class="blog-post-wrapper container">            
    <div class="row">
        <div class="blog-entry col-md-8 col-sm-8 col-xs-12"> 
             
            <?php while (have_posts())  : the_post(); ?>      
                <article <?php post_class('post'); ?>>
                    <h2 class="title"><?php the_title(); ?></h2>
                    <div class="meta">
                        <ul class="meta-list list-inline">                                       
                        	<li class="post-time post_date date updated" datetime="<?= get_post_time('c', true); ?>"><i class="fa fa-calendar"></i> <?= get_the_date('M d, Y'); ?></li>
                        	<li class="post-author"><i class="fa fa-user"></i> <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>"> <?= get_the_author(); ?></a></li>
                        	<li class="post-comments-link">
                    	        <a href="<?php comments_link(); ?>"><i class="fa fa-comments"></i><?php comments_number('Leave Comment', '1 Comment', '2 Comments'); ?></a>
                    	    </li>
                    	</ul><!--//meta-list-->                           	
                    </div><!--meta-->
                    <div class="content">
                        <p class="post-figure">
                            <img class="img-responsive" src="<?= get_template_directory_uri(); ?>/dist/images/blog/blog-1.jpg" alt="" />
                        </p><!--//post-figure-->

                        <div class="entry-content">
                        	<?php the_content(); ?>
    					</div>
                    </div>
          
                    <div class="clearfix"></div>
                    <nav class="post-nav">
    					<span class="nav-previous"><?php previous_post_link('%link', '<i class="fa fa-long-arrow-left"></i>Previous'); ?></span>
    					<span class="nav-next"><?php next_post_link('%link', 'Next<i class="fa fa-long-arrow-right"></i>'); ?></span>
    				</nav><!--//post-nav-->
    				
    				<?php comments_template('/templates/comments.php'); ?>                                          
                </article><!--//post--> 
        	<?php endwhile; ?>
        	
        </div><!--//blog-entry-->
        
        <aside id="blog-sidebar" class="blog-sidebar col-md-3 col-sm-4 col-xs-12 col-md-offset-1 col-sm-offset-0 col-xs-offset-0">
        
            <section class="widget search">
                <h3 class="title">Search Blog</h3>
                <form class="search-blog-form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search blog...">
                    </div>
                    <button type="submit" class="btn btn-cta btn-cta-secondary"><i class="fa fa-search"></i></button>
                </form>
            </section><!--//search-->

            <section class="widget recent-posts">
                <h3 class="title">Recent Posts</h3>
                <ul class="list-unstyled">
                    <li>
                        <img class="thumb img-responsive" src="<?= get_template_directory_uri(); ?>/dist/images/blog/blog-tiny-thumb-1.jpg" alt="" />
                        <span class="post-info">
                            <a class="post-title" href="#">DevStudio helps XYZ</a><br />
                            <span class="date">18 Feb 2015</span>
                        </span>
                    </li>
                    <li>
                        <img class="thumb img-responsive" src="<?= get_template_directory_uri(); ?>/dist/images/blog/blog-tiny-thumb-2.jpg" alt="" />
                        <span class="post-info">
                            <a class="post-title" href="#">devAid Free Bootstrap Theme</a><br />
                            <span class="date">16 Jan 2014</span>
                        </span>
                    </li>
                    <li>
                        <img class="thumb img-responsive" src="<?= get_template_directory_uri(); ?>/dist/images/blog/blog-tiny-thumb-3.jpg" alt="" />
                        <span class="post-info">
                            <a class="post-title" href="#">Phasellus feugiat arcu eget sem tincidunt </a><br />
                            <span class="date">20 Dec 2014</span>
                        </span>
                    </li>
                    <li>
                        <img class="thumb img-responsive" src="<?= get_template_directory_uri(); ?>/dist/images/blog/blog-tiny-thumb-4.jpg" alt="" />
                        <span class="post-info">
                            <a class="post-title" href="#">Nulla egestas commodo dignissim</a><br />
                            <span class="date">16 Nov 2014</span>
                        </span>
                    </li>
                </ul>
            </section><!--//widget-->

            <section class="widget categories">
                <h3 class="title">Categories</h3>
                <ul class="list-unstyled">
                    <li><a href="#">News</a></li>
                    <li><a href="#">Development</a></li>
                    <li><a href="#">UX Design</a></li>
                    <li><a href="#">Freebies</a></li>
                </ul>
            </section><!--//widget-->   

            <section class="widget archives">
                <h3 class="title">Archives</h3>
                <ul class="list-unstyled">
                    <li><a href="#">2015 </a><span class="count">(2)</span></li>
                    <li><a href="#">2014 </a><span class="count">(12)</span></li>
                    <li><a href="#">2013 </a><span class="count">(6)</span></li>
                </ul>
            </section><!--//widget-->

            <section class="widget instagram">
                <h3 class="title">Find us on Instagram</h3>
                <div id="instafeed" class="instafeed"></div>
            </section><!--//widget--> 

        </aside><!--//blog-side-bar-->               
    </div><!--//row-->
</div><!--//blog-->
