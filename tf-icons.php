<?php 

add_filter( 'elementor/icons_manager/additional_tabs', 'themesflat_iconpicker_register' );



function themesflat_iconpicker_register( $icons = array() ) {

	

	$icons['theme_icon_extend'] = array(

		'name'          => 'theme_icon_extend',

		'label'         => esc_html__( 'Isak Icon Extends', 'themesflat-elementor' ),

		'labelIcon'     => 'icon-isak-tech-stack',

		'prefix'        => '',

		'displayPrefix' => '',

		'url'           => THEMESFLAT_LINK . 'css/icon-isak.css',

		'fetchJson'     => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME . 'assets/css/isak_fonts.json',

		'ver'           => '1.0.0',

	);


	return $icons;

}
