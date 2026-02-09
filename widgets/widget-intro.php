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

        $this->add_control('center_icon', [
            'label' => esc_html__('Center Icon (SVG or Image)', 'themesflat-core'),
            'type' => \Elementor\Controls_Manager::MEDIA,
        ]);

        $this->add_control('scribble_img', [
            'label' => esc_html__('Scribble Asset (SVG/PNG)', 'themesflat-core'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'condition' => ['layout_style' => 'type-1']
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
        $this->add_control('circular_box_size', [
            'label' => esc_html__( 'Circular Box Size', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'selectors' => [ '{{WRAPPER}} .wg-curve-text' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ],
        ]);
        $this->add_control('circular_text_color', [
            'label' => esc_html__( 'Circular Text Color', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .text-rotate .text span' => 'color: {{VALUE}};' ]
        ]);
        $this->add_control('center_icon_size', [
            'label' => esc_html__( 'Center Icon Size', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'selectors' => [ '{{WRAPPER}} .wg-curve-text .icon img, {{WRAPPER}} .wg-curve-text .icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ],
        ]);
        $this->add_control('scribble_size', [
            'label' => esc_html__( 'Scribble Size', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'condition' => ['layout_style' => 'type-1'],
            'selectors' => [ '{{WRAPPER}} .scribble-wrap img, {{WRAPPER}} .scribble-wrap svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;' ],
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
                <p class="counter h1 d-flex font-2 letter-space--2">
                    <span class="number" data-speed="1000" data-to="<?php echo esc_attr($s['exp_number']); ?>">0</span>+
                </p>
                <p class="text text-black-56 text-body-3"><?php echo esc_html($s['exp_text']); ?></p>
            </div>
            <div class="wg-counter">
                <p class="counter h1 d-flex font-2 letter-space--2">
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
                        <?php if (!empty($s['scribble_img']['url'])) : ?>
                        <img src="<?php echo esc_url($s['scribble_img']['url']); ?>" alt="scribble">
                        <?php else : ?>
                        <svg class="scribble" viewBox="0 0 772 320" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 104.315C34.6667 116.269 92.8 137.913 144 128.853C208 117.528 317 33.5324 356 27.8698"
                                stroke="#00DE51" stroke-width="40" stroke-linecap="round" />
                        </svg>
                        <?php endif; ?>
                    </div>

                    <div class="wg-curve-text">
                        <div class="icon">
                            <?php if (!empty($s['center_icon']['url'])) : ?>
                            <img src="<?php echo esc_url($s['center_icon']['url']); ?>" alt="icon">
                            <?php endif; ?>
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
                                <?php if (!empty($s['center_icon']['url'])) : ?>
                                <img src="<?php echo esc_url($s['center_icon']['url']); ?>" alt="icon">
                                <?php endif; ?>
                            </div>
                            <div class="text-rotate">
                                <div class="circle">
                                    <div class="text" id="circularText-<?php echo esc_attr($this->get_id()); ?>" data-text="<?php echo esc_attr($s['curve_text']); ?>">
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