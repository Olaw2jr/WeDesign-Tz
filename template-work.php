<?php
/**
 * Template Name: Work
 */

query_posts('post_type=work&posts_per_page=6');
?>

<!-- ******Work list Section****** -->
<section id="work-list" class="section work-list">
    <div class="container text-center">
        <h2 class="title"><?php _e( 'Case Studies', 'sage' ); ?></h2>

        <?php
            $terms = get_terms("work_type");
            $count = count($terms);
            echo '<div id="filters" class="button-group clearfix">';
            echo '<button class="btn button is-checked" data-filter="*"> '. __( "All", "sage" ) . ' </button>';
            if ( $count > 0 ){  
                foreach ( $terms as $term ) {
                            
                    $termname = strtolower($term->name);
                    $termname = str_replace(' ', '-', $termname);
                    echo '<button class="btn button" data-filter=".'.$termname.'">'.$term->name.'</button>';
                }
            }
            echo "</div>";
        ?><!--//filters-->

        <div class="items-wrapper isotope row">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php $terms = get_the_terms( $post->ID, 'work_type' );              
                if ( $terms && ! is_wp_error( $terms ) ) : 
                    $links = array();

                foreach ( $terms as $term ) 
                    {
                        $links[] = $term->name;
                    }
                        $links = str_replace(' ', '-', $links); 
                        $tax = join( " ", $links );     
                else :  
                        $tax = '';  
                endif; ?>
                <div class="item <?php echo strtolower($tax); ?> col-lg-4 col-md-4 col-sm-6 col-sm-12 ">
                    <div class="item-inner">
                        <figure class="figure">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('work-thumbnail', array('class' => 'img-responsive')); ?>
                            </a>
                            <a class="info-mask" href="<?php the_permalink(); ?>">
                                <span class="desc"></span>
                                <span class="btn btn-cta btn-cta-primary" ><?php _e( 'View case study', 'sage' ); ?></span>
                            </a><!--//info-mask-->
                        </figure>
                        <div class="content text-center">
                            <h3 class="sub-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="meta">
                                <?php
                                    $terms_as_text = get_the_term_list($post->ID, 'work_type', '', ' / ','');
                                    echo strip_tags($terms_as_text);
                                ?>
                            </div>
                        </div><!--//content-->                    
                    </div><!--//item-inner-->
                </div><!--//item-->
            <?php endwhile; endif; ?> 

        </div><!--//items-wrapper-->
    </div><!--//container-fluid-->
</section><!--//work-list"-->
