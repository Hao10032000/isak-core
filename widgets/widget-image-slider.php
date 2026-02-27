<?php
class TFImage_slider_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'tf-image-slider'; // Nên đổi lại để tránh trùng với widget tech-stack
    }
    
    public function get_title() {
        return esc_html__( 'TF Image Slider', 'themesflat-core' );
    }

    public function get_icon() {
        return 'eicon-image-rollover';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

    public function get_style_depends() { 
        return [ 'swiper-bundle' ];
    }

    public function get_script_depends() {
        return ['swiper-bundle','tf-carousel'];
    }

    protected function register_controls() {

        // --- SECTION: IMAGES ---
        $this->start_controls_section(
            'section_images',
            [
                'label' => esc_html__( 'Images Settings', 'themesflat-core' ),
            ]
        );

        $this->add_control(
            'main_image',
            [
                'label' => esc_html__( 'Main Image (Front & Back)', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'description' => esc_html__( 'This image appears on both front and back of the hover effect.', 'themesflat-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'small_image',
            [
                'label' => esc_html__( 'Small Image', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'small_images_list',
            [
                'label' => esc_html__( 'Small Images Gallery', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [ 'small_image' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ] ],
                    [ 'small_image' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ] ],
                ],
                'title_field' => esc_html__( 'Image Item', 'themesflat-core' ),
            ]
        );

        $this->end_controls_section();

        // --- SECTION: STYLE ---
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Style', 'themesflat-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'container_margin',
            [
                'label' => esc_html__( 'Margin', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .wrap-hover-award' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $main_img = !empty($settings['main_image']['url']) ? $settings['main_image']['url'] : '';
        $list = $settings['small_images_list'];
        ?>
        
        <div class="wrap-hover-award d-none d-sm-block">
            <div class="award-inner">
                <div class="award-front">
                    <div class="image">
                        <img loading="lazy" width="237" height="336" src="<?php echo esc_url($main_img); ?>" alt="Front Image">
                    </div>
                </div>
                <div class="award-back">
                    <div class="image">
                        <img loading="lazy" width="237" height="336" src="<?php echo esc_url($main_img); ?>" alt="Back Image">
                    </div>
                    <?php if ( !empty($list) ) : ?>
                        <div class="award-small">
                            <?php foreach ( $list as $item ) : ?>
                                <?php if ( !empty($item['small_image']['url']) ) : ?>
                                    <div class="image-small">
                                        <img loading="lazy" width="158" height="224" src="<?php echo esc_url($item['small_image']['url']); ?>" alt="Small Image">
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if ( !empty($list) ) : ?>
            <div dir="ltr" class="swiper swiper-award d-sm-none">
                <div class="swiper-wrapper">
                    <?php foreach ( $list as $item ) : ?>
                        <?php if ( !empty($item['small_image']['url']) ) : ?>
                            <div class="swiper-slide">
                                <div class="image-small">
                                    <img loading="lazy" width="158" height="224" src="<?php echo esc_url($item['small_image']['url']); ?>" alt="Slide Image">
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="sw-dot-default tf-sw-pagination"></div>
            </div>
        <?php endif; ?>

        <?php
    }
}