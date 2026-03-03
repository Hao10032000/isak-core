<?php 
/**
 * Widget Name: TF Intro Widget
 * Description: Displays Intro title with GSAP effects and word highlighting.
 */

class TFIntro_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'tf-intro'; }
    public function get_title() { return esc_html__( 'TF Intro', 'themesflat-core' ); }
    public function get_icon() { return 'eicon-header'; }
    public function get_categories() { return [ 'themesflat_addons' ]; }
    
    public function get_style_depends() { return [ 'styles' ]; }
    public function get_script_depends() {
        return [ 'gsapAnimation' ];
    }

    protected function register_controls() {
        // --- SECTION: LAYOUT ---
        $this->start_controls_section('section_layout', [ 'label' => esc_html__( 'Layout', 'themesflat-core' ) ]);
        $this->add_control('layout_style', [
            'label'   => esc_html__( 'Select Style', 'themesflat-core' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => 'type-1',
            'options' => [
                'type-1' => esc_html__( 'Style 1: Minimalist', 'themesflat-core' ),
                'type-2' => esc_html__( 'Style 2: Creative Gallery', 'themesflat-core' ),
                'type-3' => esc_html__( 'Style 3: Personal Portfolio', 'themesflat-core' ),
            ],
        ]);
        $this->end_controls_section();

        // --- SECTION: AUTHOR ---
        $this->start_controls_section('section_author', [
            'label' => esc_html__( 'Intro Author', 'themesflat-core' ),
            'condition' => [ 'layout_style' => ['type-1', 'type-3'] ],
        ]);
        $this->add_control('author_image', [
            'label' => esc_html__( 'Author Image', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
        ]);
        $this->add_control('author_name', [
            'label' => esc_html__( 'Name', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Alexander Isak',
        ]);
        $this->add_control('author_duty', [
            'label' => esc_html__( 'Duty/Job', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'UI Designer & No-Code Developer',
        ]);
        $this->end_controls_section();

        // --- SECTION: CONTENT ---
        $this->start_controls_section('section_content', [ 'label' => esc_html__( 'Main Content', 'themesflat-core' ) ]);
        $this->add_control('main_text', [
            'label' => esc_html__('Main Text', 'themesflat-core'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => 'I’m building websites & brands that people remember',
            'description' => esc_html__('You can use <br> tag for line breaks.', 'themesflat-core'),
        ]);

        // Repeater for Highlight
        $repeater = new \Elementor\Repeater();
        $repeater->add_control('text', [ 
            'label' => esc_html__('Highlight Word', 'themesflat-core'), 
            'type' => \Elementor\Controls_Manager::TEXT, 
            'label_block' => true 
        ]);
        $repeater->add_control('highlight_style', [
            'label'   => esc_html__( 'Style', 'themesflat-core' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => 'style-1',
            'options' => [
                'style-1' => esc_html__( 'White Background (Default)', 'themesflat-core' ),
                'style-2' => esc_html__( 'Black Background (Type-2)', 'themesflat-core' ),
            ],
        ]);
        
        $this->add_control('highlights', [
            'label' => esc_html__('Highlight Settings', 'themesflat-core'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ text }}}',
            'condition' => [ 'layout_style' => ['type-1', 'type-3'] ],
        ]);

        $this->add_control('exp_number', [ 'label' => esc_html__('Exp Number', 'themesflat-core'), 'type' => \Elementor\Controls_Manager::NUMBER, 'default' => 10, 'separator' => 'before' ]);
        $this->add_control('exp_text', [ 'label' => esc_html__('Exp Text', 'themesflat-core'), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Year of experience' ]);
        $this->add_control('award_number', [ 'label' => esc_html__('Awards Number', 'themesflat-core'), 'type' => \Elementor\Controls_Manager::NUMBER, 'default' => 6 ]);
        $this->add_control('award_text', [ 'label' => esc_html__('Awards Text', 'themesflat-core'), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Industry Awards' ]);
        $this->end_controls_section();

        // --- SECTION: GALLERY (For Style 2) ---
        $this->start_controls_section('section_gallery', [
            'label' => esc_html__( 'Gallery Images', 'themesflat-core' ),
            'condition' => [ 'layout_style' => 'type-2' ],
        ]);

        $gallery_repeater = new \Elementor\Repeater();
        $gallery_repeater->add_control('image', [
            'label' => esc_html__( 'Choose Image', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
        ]);

        $this->add_control('gallery_list', [
            'label' => esc_html__( 'Flip Images List', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $gallery_repeater->get_controls(),
            'title_field' => 'Gallery Image',
            'default' => [
                ['image' => ['url' => \Elementor\Utils::get_placeholder_image_src()]],
                ['image' => ['url' => \Elementor\Utils::get_placeholder_image_src()]],
                ['image' => ['url' => \Elementor\Utils::get_placeholder_image_src()]],
            ],
        ]);
        $this->end_controls_section();

        // --- SECTION: SPECIAL ASSETS ---
        $this->start_controls_section('section_assets', [
            'label' => esc_html__( 'Special Assets', 'themesflat-core' ),
            'condition' => [ 'layout_style' => ['type-1', 'type-3'] ],
        ]);
        
        $this->add_control('curve_text', [
            'label' => esc_html__('Circular Text', 'themesflat-core'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'CREATIVE • DIGITAL • DESIGN • ',
        ]);

        $this->add_control('main_3d_image', [
            'label' => esc_html__('Main 3D Image', 'themesflat-core'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'condition' => ['layout_style' => 'type-3']
        ]);
        $this->end_controls_section();

        // --- TAB STYLE ---

        // --- TAB STYLE ---

        // SECTION: CONTAINER (Content Wrapper)
        $this->start_controls_section('section_style_container', [
            'label' => esc_html__( 'Content Container', 'themesflat-core' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);
        $this->add_responsive_control('container_padding', [
            'label' => esc_html__( 'Padding', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors' => [ '{{WRAPPER}} .section-intro' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->add_responsive_control('container_margin', [
            'label' => esc_html__( 'Margin', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors' => [ '{{WRAPPER}} .section-intro' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->add_group_control(\Elementor\Group_Control_Background::get_type(), [
            'name' => 'container_background',
            'selector' => '{{WRAPPER}} .section-intro',
        ]);
        $this->end_controls_section();

        // SECTION: INTRO AUTHOR (Style 1 & 3)
        $this->start_controls_section('section_style_author', [
            'label' => esc_html__( 'Intro Author', 'themesflat-core' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [ 'layout_style' => ['type-1', 'type-3'] ],
        ]);
        $this->add_responsive_control('author_box_padding', [
            'label' => esc_html__( 'Padding', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors' => [ '{{WRAPPER}} .intro-author' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->add_responsive_control('author_box_margin', [
            'label' => esc_html__( 'Margin', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors' => [ '{{WRAPPER}} .intro-author' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);

        $this->add_control('heading_author_image', [ 'label' => esc_html__( 'Author Image', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ]);
        $this->add_responsive_control('author_img_size', [
            'label' => esc_html__( 'Size (W/H)', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'selectors' => [ '{{WRAPPER}} .author-image' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ],
        ]);
        $this->add_control('author_img_radius', [
            'label' => esc_html__( 'Border Radius', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors' => [ '{{WRAPPER}} .author-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->add_group_control(\Elementor\Group_Control_Box_Shadow::get_type(), [
            'name' => 'author_img_shadow',
            'selector' => '{{WRAPPER}} .author-image',
        ]);

        $this->add_control('heading_author_name', [ 'label' => esc_html__( 'Name', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ]);
        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [ 'name' => 'name_typography', 'selector' => '{{WRAPPER}} .info_name' ]);
        $this->add_control('name_color', [ 'label' => esc_html__( 'Color', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .info_name' => 'color: {{VALUE}}!important;' ] ]);

        $this->add_control('heading_author_duty', [ 'label' => esc_html__( 'Duty/Job', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ]);
        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [ 'name' => 'duty_typography', 'selector' => '{{WRAPPER}} .info_duty' ]);
        $this->add_control('duty_color', [ 'label' => esc_html__( 'Color', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .info_duty' => 'color: {{VALUE}}!important;' ] ]);
        $this->end_controls_section();

        // SECTION: MAIN CONTENT (Text & Counters)
        $this->start_controls_section('section_style_main_content', [
            'label' => esc_html__( 'Main Content', 'themesflat-core' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control('heading_main_text', [ 'label' => esc_html__( 'Main Text', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::HEADING ]);
        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [ 'name' => 'main_text_typography', 'selector' => '{{WRAPPER}} .intro-title, {{WRAPPER}} .s-title' ]);
        $this->add_control('main_text_color', [ 'label' => esc_html__( 'Color', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .intro-title, {{WRAPPER}} .s-title' => 'color: {{VALUE}};' ] ]);

        $this->add_control('heading_counter', [ 'label' => esc_html__( 'Counter Settings', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ]);
        $this->add_responsive_control('counter_margin', [
            'label' => esc_html__( 'Margin', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors' => [ '{{WRAPPER}} .box-counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        
        $this->add_control('counter_num_heading', [ 'label' => esc_html__( 'Number', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::HEADING ]);
        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [ 'name' => 'num_typography', 'selector' => '{{WRAPPER}} .wg-counter .number' ]);
        $this->add_control('num_color', [ 'label' => esc_html__( 'Color', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .wg-counter .counter' => 'color: {{VALUE}};' ] ]);

        $this->add_control('counter_text_heading', [ 'label' => esc_html__( 'Text', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::HEADING ]);
        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [ 'name' => 'counter_text_typography', 'selector' => '{{WRAPPER}} .wg-counter .text' ]);
        $this->add_control('counter_text_color', [ 'label' => esc_html__( 'Color', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .wg-counter .text' => 'color: {{VALUE}};' ] ]);
        $this->end_controls_section();

        // SECTION: SPECIAL ASSETS (Style 1 & 3)
        $this->start_controls_section('section_style_assets', [
            'label' => esc_html__( 'Special Assets', 'themesflat-core' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [ 'layout_style' => ['type-1', 'type-3'] ],
        ]);

        $this->add_control('circular_text_color', [
            'label' => esc_html__( 'Circular Text Color', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .text-rotate .text span' => 'color: {{VALUE}};' ]
        ]);
    
        $this->end_controls_section();

        // SECTION: GALLERY (Style 2)
        $this->start_controls_section('section_style_gallery', [
            'label' => esc_html__( 'Gallery Style', 'themesflat-core' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [ 'layout_style' => 'type-2' ],
        ]);
        $this->add_responsive_control('gallery_img_size', [
            'label' => esc_html__( 'Image Size (W/H)', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors' => [ '{{WRAPPER}} .flip-image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; object-fit: cover;' ],
        ]);
        $this->end_controls_section();
       
    }

    protected function get_processed_text($s) {
        $text = $s['main_text'];
        if (!empty($s['highlights']) && ($s['layout_style'] !== 'type-2')) {
            foreach ($s['highlights'] as $item) {
                if (empty($item['text'])) continue;
                $class_name = ($item['highlight_style'] === 'style-2') ? 'type-2' : '';
                $text = str_replace(
                    $item['text'], 
                    '<span class="' . esc_attr($class_name) . '">' . esc_html($item['text']) . '</span>', 
                    $text
                );
            }
        }
        return nl2br($text);
    }

    protected function render_author($s) {
        if (empty($s['author_image']['url'])) return;
        ?>
<div class="intro-author effectFade fadeUp no-div">
    <div class="author-image">
        <img src="<?php echo esc_url($s['author_image']['url']); ?>" alt="author">
    </div>
    <div class="author-info letter-space--05">
        <p class="info_name text-black"><?php echo esc_html($s['author_name']); ?></p>
        <p class="info_duty text-black-50 text-body-3"><?php echo esc_html($s['author_duty']); ?></p>
    </div>
</div>
<?php
    }

    protected function render_counter($s, $extra_class = '') {
        ?>
<div class="box-counter <?php echo esc_attr($extra_class); ?>">
    <div class="wg-counter">
        <p class="counter h1 d-flex font-2 letter-space--2 text-black-72">
            <span class="number" data-speed="1000" data-to="<?php echo esc_attr($s['exp_number']); ?>">0</span>+
        </p>
        <p class="text text-black-56 text-body-3"><?php echo esc_html($s['exp_text']); ?></p>
    </div>
    <div class="wg-counter">
        <p class="counter h1 d-flex font-2 letter-space--2 text-black-72">
            <span class="number" data-speed="1000" data-to="<?php echo esc_attr($s['award_number']); ?>">0</span>x
        </p>
        <p class="text text-black-56 text-body-3"><?php echo esc_html($s['award_text']); ?></p>
    </div>
</div>
<?php
    }

    protected function render() {
        $s = $this->get_settings_for_display();
        $style = $s['layout_style'];
        $processed_text = $this->get_processed_text($s);
        ?>

<div class="tf-intro-widget">
    <?php if ( 'type-1' === $style ) : ?>
    <div class="section-intro flat-spacing">
        <?php $this->render_author($s); ?>

        <h1 class="intro-title letter-space--2 split-text effect-blur-fade">
            <?php echo $processed_text; ?>
        </h1>

        <div class="intro-item">
            <div class="scribble-wrap">
                <svg class="scribble" viewBox="0 0 772 320" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="paint0_linear_268_462" x1="12" y1="107" x2="752" y2="66"
                            gradientUnits="userSpaceOnUse">
                            <stop offset="0" stop-color="#F5F5F5" />
                            <stop class="bred" offset="0.466346" stop-color="#00DE51" />
                            <stop offset="1" stop-color="#F5F5F5" />
                        </linearGradient>
                    </defs>

                    <path id="scribblePath"
                        d="M12 104.315C34.6667 116.269 92.8 137.913 144 128.853C208 117.528 317 33.5324 356 27.8698C395 22.2072 502 20 530 79.1463C557.711 137.682 582 217 477 281.743C423.902 314.483 308 281.433 365 188C422 94.5672 544 65.6205 597 81.6645C650 97.7085 732 88.2708 752 64.6767"
                        stroke="url(#paint0_linear_268_462)" stroke-width="50" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>


            <div class="wg-curve-text">
                <div class="icon">
                    <svg width="66" height="77" viewBox="0 0 66 77" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M36.0087 0.873025C43.5379 -1.39092 54.7025 10.7245 61.1553 28.2867L61.4572 29.1225C67.684 46.6467 66.8028 62.8769 59.3914 65.6003L59.0353 65.7187C57.4604 66.1922 55.7272 66.0345 53.9106 65.3315C52.9107 67.1734 51.5757 68.4719 49.9077 69.0848L49.5517 69.2032C47.8627 69.7111 45.9915 69.494 44.031 68.6556C43.0123 70.6987 41.611 72.1331 39.831 72.7872L39.475 72.9056C37.9 73.3792 36.1669 73.2214 34.3503 72.5184C33.3504 74.3604 32.0154 75.6588 30.3474 76.2717L29.9913 76.3901C22.4621 78.6546 11.2976 66.539 4.84471 48.9764C-1.71056 31.1351 -0.920706 14.4292 6.60864 11.6627L6.96468 11.5444C8.53922 11.071 10.2719 11.2285 12.0881 11.931C13.088 10.089 14.4242 8.79122 16.0923 8.17825L16.4483 8.05992C18.1368 7.55221 20.0078 7.76906 21.9678 8.60692C22.9864 6.56371 24.3889 5.12997 26.169 4.47585L26.525 4.35752C28.0993 3.88414 29.8323 4.04093 31.6481 4.74323C32.648 2.90144 33.9848 1.6043 35.6526 0.991355L36.0087 0.873025ZM35.8705 1.58443C34.3995 2.12506 33.1749 3.2743 32.2327 4.98624C38.9691 7.99365 46.7122 18.2732 51.6716 31.7712L51.9735 32.607C56.6603 45.7969 57.3186 58.2527 54.1982 64.7691C56.0249 65.4639 57.7021 65.5477 59.1734 65.0073C60.8518 64.3905 62.2076 62.9806 63.1915 60.8478C64.1769 58.7115 64.7669 55.8924 64.9241 52.5664C65.2383 45.9169 63.8179 37.3655 60.5622 28.5046C57.3065 19.6437 52.8526 12.2069 48.308 7.34263C46.0347 4.90959 43.7599 3.14315 41.6258 2.153C39.4951 1.16454 37.5489 0.967816 35.8705 1.58443ZM6.82655 12.2558C5.14794 12.8726 3.79152 14.2824 2.80758 16.4156C1.82222 18.552 1.23308 21.3706 1.07586 24.6967C0.761621 31.3462 2.18208 39.8975 5.43778 48.7585C8.69348 57.6194 13.1474 65.0562 17.692 69.9204C19.9653 72.3535 22.2392 74.1202 24.3733 75.1104C26.5043 76.0991 28.4509 76.2954 30.1295 75.6787C31.6006 75.1381 32.8226 73.9877 33.7648 72.2757C27.0291 69.2667 19.2871 58.9881 14.3283 45.4919C9.36933 31.9951 8.61515 19.1484 11.8009 12.4943C9.9744 11.7996 8.29774 11.7153 6.82655 12.2558ZM36.5261 62.8777C36.3921 66.5095 35.7585 69.6155 34.6378 71.956C36.4646 72.6508 38.1418 72.7347 39.6131 72.1942C41.1952 71.6128 42.4898 70.3262 43.4573 68.394C41.2039 67.3015 38.8467 65.4136 36.5261 62.8777ZM46.0097 59.3932C45.883 62.8289 45.3095 65.794 44.2991 68.0858C46.2875 68.9319 48.1076 69.073 49.6898 68.4918C51.1609 67.9512 52.3842 66.8013 53.3264 65.0894C50.9571 64.0312 48.463 62.0742 46.0097 59.3932ZM31.8516 5.74426C30.8663 7.88057 30.277 10.6994 30.1198 14.0253C30.1036 14.3692 30.0931 14.7181 30.0861 15.0719C34.3893 19.9995 38.5256 27.1199 41.5949 35.4736L41.8968 36.3094C44.7598 44.3666 46.1188 52.1502 46.0327 58.4733C46.2671 58.7384 46.501 58.9975 46.736 59.2491C49.0092 61.682 51.2833 63.4488 53.4173 64.439C53.4825 64.4693 53.5487 64.4973 53.6136 64.5261C53.6446 64.4618 53.6776 64.3979 53.7079 64.3323C54.6932 62.1959 55.2833 59.377 55.4405 56.0508C55.7547 49.4014 54.3343 40.8499 51.0786 31.9891C47.8229 23.1282 43.3689 15.6914 38.8243 10.8271C36.5511 8.39407 34.2762 6.62765 32.1421 5.63749C32.0763 5.60697 32.01 5.57889 31.9445 5.54988C31.9136 5.61406 31.8818 5.6787 31.8516 5.74426ZM12.2912 12.9311C11.3059 15.0675 10.7167 17.8862 10.5595 21.2122C10.2453 27.8617 11.6657 36.4131 14.9214 45.274C18.1771 54.1349 22.6311 61.5717 27.1757 66.436C29.4488 68.8689 31.7229 70.6357 33.8569 71.6259C33.9222 71.6562 33.9884 71.6841 34.0533 71.713C34.0843 71.6487 34.1172 71.5848 34.1475 71.5192C35.1329 69.3828 35.7229 66.5639 35.8802 63.2377C35.8964 62.8937 35.9057 62.5446 35.9126 62.1906C31.6099 57.263 27.4742 50.1426 24.4051 41.7895C21.3356 33.4353 19.8764 25.33 19.9657 18.7883C19.7318 18.5237 19.4985 18.265 19.264 18.014C16.9907 15.5809 14.7159 13.8146 12.5818 12.8244C12.516 12.7939 12.4496 12.7658 12.3842 12.7368C12.3532 12.801 12.3215 12.8656 12.2912 12.9311ZM22.2739 9.44015C21.3457 11.5497 20.7883 14.2922 20.6362 17.5098C20.62 17.8537 20.6094 18.2026 20.6025 18.5564C24.9056 23.484 29.042 30.6044 32.1113 38.9581L32.4132 39.7939C35.276 47.8507 36.6347 55.6339 36.5488 61.9569C36.7833 62.2222 37.0172 62.4818 37.2524 62.7336C39.4513 65.0871 41.6518 66.8155 43.7248 67.8223C44.653 65.7128 45.2117 62.9708 45.3638 59.7532C45.38 59.4093 45.3893 59.0601 45.3963 58.7061C41.0935 53.7785 36.9578 46.6581 33.8887 38.305C30.8192 29.9509 29.36 21.8455 29.4493 15.3038C29.2155 15.0393 28.9821 14.7805 28.7476 14.5295C26.5483 12.1756 24.3473 10.4468 22.2739 9.44015ZM20.5948 19.5153C20.6185 25.8361 22.0611 33.5779 24.9981 41.5716C27.935 49.5648 31.8472 56.3989 35.9212 61.2314C35.8973 54.9107 34.4551 47.1693 31.5182 39.176C28.5812 31.1824 24.669 24.3478 20.5948 19.5153ZM30.0776 16.0311C30.1013 22.3518 31.5448 30.0936 34.4818 38.0871C37.4187 46.0804 41.3317 52.914 45.4057 57.7465C45.3818 51.426 43.9387 43.6847 41.0019 35.6915C38.0648 27.6978 34.1518 20.8637 30.0776 16.0311ZM16.3102 8.77132C14.8391 9.31192 13.6146 10.4612 12.6723 12.1731C15.042 13.2311 17.5356 15.1889 19.9894 17.8703C20.1161 14.4345 20.6905 11.4691 21.7009 9.17733C19.7126 8.33121 17.8924 8.19006 16.3102 8.77132ZM26.3869 5.06892C24.8049 5.65025 23.5086 6.93577 22.5411 8.86757C24.7951 9.95982 27.1517 11.8492 29.473 14.3858C29.6069 10.7538 30.2415 7.64767 31.3622 5.30711C29.5355 4.61221 27.8582 4.52839 26.3869 5.06892Z"
                            fill="black" />
                    </svg>
                </div>
                <div class="text-rotate">
                    <div class="circle">
                        <div class="text" data-text="<?php echo esc_attr($s['curve_text']); ?>"></div>
                    </div>
                </div>
            </div>
        </div>

        <?php $this->render_counter($s, 'effectFade fadeUp no-div'); ?>
    </div>

    <?php elseif ( 'type-2' === $style ) : ?>
    <div class="section-intro type-2 flat-spacing">
        <h1 class="s-title text-black-72 letter-space--2 split-text effect-blur-fade">
            <?php echo $processed_text; ?>
        </h1>

        <?php $this->render_counter($s); ?>

        <?php if (!empty($s['gallery_list'])) : ?>
        <div class="flip-image-list gsap-anime-2">
            <?php foreach ($s['gallery_list'] as $item) : 
                        if (empty($item['image']['url'])) continue; ?>
            <div class="flip-image">
                <img loading="lazy" width="300" height="300" src="<?php echo esc_url($item['image']['url']); ?>"
                    alt="Gallery Image">
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

    <?php elseif ( 'type-3' === $style ) : ?>
    <div class="section-intro type-3 flat-spacing">
        <?php $this->render_author($s); ?>

        <h1 class="intro-title letter-space--2 split-text effect-blur-fade">
            <?php echo $processed_text; ?>
        </h1>

        <div class="counter-image-item">
            <?php $this->render_counter($s); ?>
            <div class="image-item">
                <div class="image">
                    <?php if (!empty($s['main_3d_image']['url'])) : ?>
                    <img src="<?php echo esc_url($s['main_3d_image']['url']); ?>" alt="3d-asset">
                    <?php endif; ?>
                </div>
                <div class="wg-curve-text style-2">
                    <div class="icon">
                                            <svg width="66" height="77" viewBox="0 0 66 77" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M36.0087 0.873025C43.5379 -1.39092 54.7025 10.7245 61.1553 28.2867L61.4572 29.1225C67.684 46.6467 66.8028 62.8769 59.3914 65.6003L59.0353 65.7187C57.4604 66.1922 55.7272 66.0345 53.9106 65.3315C52.9107 67.1734 51.5757 68.4719 49.9077 69.0848L49.5517 69.2032C47.8627 69.7111 45.9915 69.494 44.031 68.6556C43.0123 70.6987 41.611 72.1331 39.831 72.7872L39.475 72.9056C37.9 73.3792 36.1669 73.2214 34.3503 72.5184C33.3504 74.3604 32.0154 75.6588 30.3474 76.2717L29.9913 76.3901C22.4621 78.6546 11.2976 66.539 4.84471 48.9764C-1.71056 31.1351 -0.920706 14.4292 6.60864 11.6627L6.96468 11.5444C8.53922 11.071 10.2719 11.2285 12.0881 11.931C13.088 10.089 14.4242 8.79122 16.0923 8.17825L16.4483 8.05992C18.1368 7.55221 20.0078 7.76906 21.9678 8.60692C22.9864 6.56371 24.3889 5.12997 26.169 4.47585L26.525 4.35752C28.0993 3.88414 29.8323 4.04093 31.6481 4.74323C32.648 2.90144 33.9848 1.6043 35.6526 0.991355L36.0087 0.873025ZM35.8705 1.58443C34.3995 2.12506 33.1749 3.2743 32.2327 4.98624C38.9691 7.99365 46.7122 18.2732 51.6716 31.7712L51.9735 32.607C56.6603 45.7969 57.3186 58.2527 54.1982 64.7691C56.0249 65.4639 57.7021 65.5477 59.1734 65.0073C60.8518 64.3905 62.2076 62.9806 63.1915 60.8478C64.1769 58.7115 64.7669 55.8924 64.9241 52.5664C65.2383 45.9169 63.8179 37.3655 60.5622 28.5046C57.3065 19.6437 52.8526 12.2069 48.308 7.34263C46.0347 4.90959 43.7599 3.14315 41.6258 2.153C39.4951 1.16454 37.5489 0.967816 35.8705 1.58443ZM6.82655 12.2558C5.14794 12.8726 3.79152 14.2824 2.80758 16.4156C1.82222 18.552 1.23308 21.3706 1.07586 24.6967C0.761621 31.3462 2.18208 39.8975 5.43778 48.7585C8.69348 57.6194 13.1474 65.0562 17.692 69.9204C19.9653 72.3535 22.2392 74.1202 24.3733 75.1104C26.5043 76.0991 28.4509 76.2954 30.1295 75.6787C31.6006 75.1381 32.8226 73.9877 33.7648 72.2757C27.0291 69.2667 19.2871 58.9881 14.3283 45.4919C9.36933 31.9951 8.61515 19.1484 11.8009 12.4943C9.9744 11.7996 8.29774 11.7153 6.82655 12.2558ZM36.5261 62.8777C36.3921 66.5095 35.7585 69.6155 34.6378 71.956C36.4646 72.6508 38.1418 72.7347 39.6131 72.1942C41.1952 71.6128 42.4898 70.3262 43.4573 68.394C41.2039 67.3015 38.8467 65.4136 36.5261 62.8777ZM46.0097 59.3932C45.883 62.8289 45.3095 65.794 44.2991 68.0858C46.2875 68.9319 48.1076 69.073 49.6898 68.4918C51.1609 67.9512 52.3842 66.8013 53.3264 65.0894C50.9571 64.0312 48.463 62.0742 46.0097 59.3932ZM31.8516 5.74426C30.8663 7.88057 30.277 10.6994 30.1198 14.0253C30.1036 14.3692 30.0931 14.7181 30.0861 15.0719C34.3893 19.9995 38.5256 27.1199 41.5949 35.4736L41.8968 36.3094C44.7598 44.3666 46.1188 52.1502 46.0327 58.4733C46.2671 58.7384 46.501 58.9975 46.736 59.2491C49.0092 61.682 51.2833 63.4488 53.4173 64.439C53.4825 64.4693 53.5487 64.4973 53.6136 64.5261C53.6446 64.4618 53.6776 64.3979 53.7079 64.3323C54.6932 62.1959 55.2833 59.377 55.4405 56.0508C55.7547 49.4014 54.3343 40.8499 51.0786 31.9891C47.8229 23.1282 43.3689 15.6914 38.8243 10.8271C36.5511 8.39407 34.2762 6.62765 32.1421 5.63749C32.0763 5.60697 32.01 5.57889 31.9445 5.54988C31.9136 5.61406 31.8818 5.6787 31.8516 5.74426ZM12.2912 12.9311C11.3059 15.0675 10.7167 17.8862 10.5595 21.2122C10.2453 27.8617 11.6657 36.4131 14.9214 45.274C18.1771 54.1349 22.6311 61.5717 27.1757 66.436C29.4488 68.8689 31.7229 70.6357 33.8569 71.6259C33.9222 71.6562 33.9884 71.6841 34.0533 71.713C34.0843 71.6487 34.1172 71.5848 34.1475 71.5192C35.1329 69.3828 35.7229 66.5639 35.8802 63.2377C35.8964 62.8937 35.9057 62.5446 35.9126 62.1906C31.6099 57.263 27.4742 50.1426 24.4051 41.7895C21.3356 33.4353 19.8764 25.33 19.9657 18.7883C19.7318 18.5237 19.4985 18.265 19.264 18.014C16.9907 15.5809 14.7159 13.8146 12.5818 12.8244C12.516 12.7939 12.4496 12.7658 12.3842 12.7368C12.3532 12.801 12.3215 12.8656 12.2912 12.9311ZM22.2739 9.44015C21.3457 11.5497 20.7883 14.2922 20.6362 17.5098C20.62 17.8537 20.6094 18.2026 20.6025 18.5564C24.9056 23.484 29.042 30.6044 32.1113 38.9581L32.4132 39.7939C35.276 47.8507 36.6347 55.6339 36.5488 61.9569C36.7833 62.2222 37.0172 62.4818 37.2524 62.7336C39.4513 65.0871 41.6518 66.8155 43.7248 67.8223C44.653 65.7128 45.2117 62.9708 45.3638 59.7532C45.38 59.4093 45.3893 59.0601 45.3963 58.7061C41.0935 53.7785 36.9578 46.6581 33.8887 38.305C30.8192 29.9509 29.36 21.8455 29.4493 15.3038C29.2155 15.0393 28.9821 14.7805 28.7476 14.5295C26.5483 12.1756 24.3473 10.4468 22.2739 9.44015ZM20.5948 19.5153C20.6185 25.8361 22.0611 33.5779 24.9981 41.5716C27.935 49.5648 31.8472 56.3989 35.9212 61.2314C35.8973 54.9107 34.4551 47.1693 31.5182 39.176C28.5812 31.1824 24.669 24.3478 20.5948 19.5153ZM30.0776 16.0311C30.1013 22.3518 31.5448 30.0936 34.4818 38.0871C37.4187 46.0804 41.3317 52.914 45.4057 57.7465C45.3818 51.426 43.9387 43.6847 41.0019 35.6915C38.0648 27.6978 34.1518 20.8637 30.0776 16.0311ZM16.3102 8.77132C14.8391 9.31192 13.6146 10.4612 12.6723 12.1731C15.042 13.2311 17.5356 15.1889 19.9894 17.8703C20.1161 14.4345 20.6905 11.4691 21.7009 9.17733C19.7126 8.33121 17.8924 8.19006 16.3102 8.77132ZM26.3869 5.06892C24.8049 5.65025 23.5086 6.93577 22.5411 8.86757C24.7951 9.95982 27.1517 11.8492 29.473 14.3858C29.6069 10.7538 30.2415 7.64767 31.3622 5.30711C29.5355 4.61221 27.8582 4.52839 26.3869 5.06892Z"
                                                    fill="black" />
                                            </svg>
                                        </div>
                    <div class="text-rotate">
                        <div class="circle">
                            <div class="text" id="circularText-<?php echo esc_attr($this->get_id()); ?>"
                                data-text="<?php echo esc_attr($s['curve_text']); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php
    }
}