<?php
wp_enqueue_style( 'tf-work');
get_header(); 

?>

<div class="container">

    <div class="row">

        <div class="col-md-12">

            <div class="wrap-content-area">
<!-- 
                <div id="primary" class="content-area"> -->

                    <main id="main" class="main-content" role="main">

                        <div class="entry-content">

                            <?php while ( have_posts() ) : the_post(); 
						
							    $desc = get_post_meta( get_the_ID(), '_work_short_desc', true );
                                $year = get_post_meta( get_the_ID(), '_work_ref', true );
                                $role = get_post_meta( get_the_ID(), '_work_position', true );
                                $img  = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                                $tags = get_the_terms( get_the_ID(), 'work_tag' );
                                $image_id = get_post_meta( get_the_ID(), '_work_image_id', true );
						    ?>
                            <div class="single-content-work-over">
                                <div class="image">
                                    <img src="<?php echo esc_url($img); ?>" alt="<?php the_title(); ?>">
                                </div>
                                
                                <div class="content ">
                                    <h3 class="title">
                                        <?php echo get_the_title(); ?>
                                    </h3>
                                    <p class="w-desc text-body-3"><?php echo esc_html( $desc ); ?></p>
                                    <div class="w-highlight">
                                        <div class="box-high">
                                            <p class="text-body-3"><?php echo esc_html('Year' ); ?></p>
                                            <p class="text-body-1"><?php echo esc_html($year); ?></p>
                                        </div>
                                        <div class="box-high">
                                            <p class="text-body-3"><?php echo esc_html( 'Role' ); ?></p>
                                            <p class="text-body-1"><?php echo esc_html($role); ?></p>
                                        </div>
                                    </div>
                                    <div class="w-tag-list">
                                        
                                        <?php
                                        if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) {
                                            foreach ( $tags as $tag ) : ?>
                                            <div class="tag"><span><?php echo esc_html($tag->name); ?></span></div>
                                        <?php endforeach; } ?>
                                    </div>
                                </div>
                                          
                            </div>
                            <?php the_content(); ?>               

                            <?php endwhile; ?>


                        </div><!-- ./entry-content -->

                    </main><!-- #main -->

                <!-- </div> -->
                <!-- #primary -->

            </div>

        </div>

    </div>

</div>



<?php get_footer(); ?>