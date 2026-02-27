<?php 

/* Custom Post Type

===================================*/

if ( ! class_exists( 'themesflat_custom_post_type' ) ) {

    class themesflat_custom_post_type {

        function __construct() {

            require_once THEMESFLAT_PATH . '/poststype/register-work.php';

            add_filter( 'single_template', array( $this,'themesflat_single_work' ) );

            add_filter( 'taxonomy_template', array( $this,'themesflat_taxonomy_work' ) ); 

            add_filter( 'archive_template', array( $this,'themesflat_archive_work' ) );  

        }        




        /* Temlate work */

        function themesflat_single_work( $single_template ) {

            global $post;

            if ( $post->post_type == 'work' ) $single_template = THEMESFLAT_PATH . '/poststype/inc/single-work.php';

            return $single_template;

        }

        function themesflat_archive_work( $archive_template ) {

            global $post;

            if ( is_post_type_archive ( 'work' ) ) $archive_template = THEMESFLAT_PATH . '/poststype/inc/archive-work.php';

            return $archive_template;

        }

    }

    

}

new themesflat_custom_post_type;
