<?php 
class TFIntro_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'tf-intro'; }
    public function get_title() { return esc_html__( 'TF Intro', 'themesflat-core' ); }
    public function get_icon() { return 'eicon-header'; }
    public function get_categories() { return [ 'themesflat_addons' ]; }
    
    public function get_style_depends() { return [ 'styles' ]; }
    public function get_script_depends() {
        return [ 
            'infinityslide', 'countto', 'change-text', 'gsap', 
            'ScrollTrigger', 'ScrollToPlugin', 'ScrollSmooth', 
            'ScrollSmoother', 'SplitText', 'gsapAnimation', 
            'main', 'swiper-bundle'
        ];
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
            'default' => 'Start building websites & brands people remember',
        ]);

        $repeater = new \Elementor\Repeater();
        $repeater->add_control('text', [ 'label' => 'Highlight Word', 'type' => \Elementor\Controls_Manager::TEXT, 'label_block' => true ]);
        
        $this->add_control('highlights', [
            'label' => esc_html__('Highlight Settings', 'themesflat-core'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ text }}}',
            'condition' => [ 'layout_style' => ['type-1', 'type-3'] ], // Chỉ hiện ở Style 1 và 3
        ]);

        $this->add_control('exp_number', [ 'label' => 'Exp Number', 'type' => \Elementor\Controls_Manager::NUMBER, 'default' => 10, 'separator' => 'before' ]);
        $this->add_control('exp_text', [ 'label' => 'Exp Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Year of experience' ]);
        $this->add_control('award_number', [ 'label' => 'Awards Number', 'type' => \Elementor\Controls_Manager::NUMBER, 'default' => 6 ]);
        $this->add_control('award_text', [ 'label' => 'Awards Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Industry Awards' ]);
        $this->end_controls_section();

        // --- SECTION: SPECIAL ASSETS ---
        $this->start_controls_section('section_assets', [
            'label' => esc_html__( 'Special Assets', 'themesflat-core' ),
            'condition' => [ 'layout_style' => ['type-1', 'type-3'] ],
        ]);
        
        $this->add_control('curve_text', [
            'label' => 'Circular Text',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'CREATIVE • DIGITAL • DESIGN • ',
        ]);

        $this->add_control('center_icon', [
            'label' => 'Center Icon (SVG or Image)',
            'type' => \Elementor\Controls_Manager::MEDIA,
            'description' => 'Icon ở giữa vòng tròn xoay',
        ]);

        $this->add_control('scribble_img', [
            'label' => 'Scribble Asset (SVG/PNG)',
            'type' => \Elementor\Controls_Manager::MEDIA,
            'description' => 'Đường kẻ nguệch ngoạc trang trí',
            'condition' => ['layout_style' => 'type-1']
        ]);

        $this->add_control('main_3d_image', [
            'label' => 'Main 3D Image',
            'type' => \Elementor\Controls_Manager::MEDIA,
            'condition' => ['layout_style' => 'type-3']
        ]);
        $this->end_controls_section();

        // --- SECTION: GALLERY ---
        $this->start_controls_section('section_gallery', [
            'label' => 'Flip Gallery',
            'condition' => [ 'layout_style' => 'type-2' ]
        ]);
        $this->add_control('gallery_list', [
            'label' => 'Images',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => [
                [
                    'name' => 'image',
                    'label' => 'Choose Image',
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
                ],
            ],
        ]);
        $this->end_controls_section();
        // ================= STYLE TABS =================

        // --- SECTION: CONTENT STYLE (General) ---
        $this->start_controls_section('section_content_style', [
            'label' => esc_html__( 'Content Container', 'themesflat-core' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);
        $this->add_responsive_control('content_padding', [
            'label' => 'Padding',
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors' => [ '{{WRAPPER}} .flat-spacing' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->add_responsive_control('content_margin', [
            'label' => 'Margin',
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors' => [ '{{WRAPPER}} .flat-spacing' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->add_group_control(\Elementor\Group_Control_Background::get_type(), [
            'name' => 'content_background',
            'selector' => '{{WRAPPER}} .flat-spacing',
        ]);
        $this->end_controls_section();

        // --- SECTION: AUTHOR STYLE (Style 1 & 3) ---
        $this->start_controls_section('author_style', [
            'label' => 'Intro Author',
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [ 'layout_style' => ['type-1', 'type-3'] ],
        ]);
        $this->add_control('author_img_heading', [ 'label' => 'Image', 'type' => \Elementor\Controls_Manager::HEADING ]);
        $this->add_responsive_control('author_img_size', [
            'label' => 'Size (W x H)',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'selectors' => [ '{{WRAPPER}} .author-image' => 'width: {{SIZE}}px; height: {{SIZE}}px;' ],
        ]);
        $this->add_control('author_img_radius', [
            'label' => 'Border Radius',
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors' => [ '{{WRAPPER}} .author-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->add_group_control(\Elementor\Group_Control_Box_Shadow::get_type(), [
            'name' => 'author_img_shadow',
            'selector' => '{{WRAPPER}} .author-image',
        ]);

        $this->add_control('author_name_heading', [ 'label' => 'Name', 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ]);
        $this->add_control('author_name_color', [ 'label' => 'Color', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .info_name' => 'color: {{VALUE}} !important;' ] ]);
        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [ 'name' => 'author_name_typo', 'selector' => '{{WRAPPER}} .info_name' ]);
        $this->add_responsive_control('author_name_spacing', [ 'label' => 'Margin', 'type' => \Elementor\Controls_Manager::DIMENSIONS, 'selectors' => [ '{{WRAPPER}} .info_name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ]);

        $this->add_control('author_duty_heading', [ 'label' => 'Duty/Job', 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ]);
        $this->add_control('author_duty_color', [ 'label' => 'Color', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .info_duty' => 'color: {{VALUE}} !important;' ] ]);
        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [ 'name' => 'author_duty_typo', 'selector' => '{{WRAPPER}} .info_duty' ]);
        $this->end_controls_section();

        // --- SECTION: MAIN TEXT STYLE ---
        $this->start_controls_section('main_text_style', [
            'label' => 'Main Text',
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control('main_text_color', [ 'label' => 'Color', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .intro-title, {{WRAPPER}} .s-title' => 'color: {{VALUE}};' ] ]);
        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [ 'name' => 'main_text_typo', 'selector' => '{{WRAPPER}} .intro-title, {{WRAPPER}} .s-title' ]);
        $this->add_responsive_control('main_text_margin', [ 'label' => 'Margin', 'type' => \Elementor\Controls_Manager::DIMENSIONS, 'selectors' => [ '{{WRAPPER}} .intro-title, {{WRAPPER}} .s-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ]);
        $this->end_controls_section();

        // --- SECTION: COUNTER STYLE ---
        $this->start_controls_section('counter_style', [
            'label' => 'Counter',
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control('num_color', [ 'label' => 'Number Color', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .wg-counter .counter' => 'color: {{VALUE}};' ] ]);
        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [ 'name' => 'num_typo', 'selector' => '{{WRAPPER}} .wg-counter .counter' ]);
        $this->add_control('txt_color', [ 'label' => 'Text Color', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .wg-counter .text' => 'color: {{VALUE}};' ] ]);
        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [ 'name' => 'txt_typo', 'selector' => '{{WRAPPER}} .wg-counter .text' ]);
        $this->end_controls_section();

        // --- SECTION: SPECIAL ASSETS STYLE ---
        $this->start_controls_section('assets_style', [
            'label' => 'Special Assets',
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [ 'layout_style' => ['type-1', 'type-3'] ],
        ]);
        $this->add_control('circ_heading', [ 'label' => 'Circular Wrap', 'type' => \Elementor\Controls_Manager::HEADING ]);
        $this->add_responsive_control('circ_size', [
            'label' => 'Wrap Size',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'selectors' => [ '{{WRAPPER}} .wg-curve-text .text-rotate' => 'width: {{SIZE}}px; height: {{SIZE}}px;' ],
        ]);

        $this->add_control('circ_txt_heading', [ 'label' => 'Circular Text', 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ]);
        $this->add_control('circ_txt_color', [ 'label' => 'Color', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .wg-curve-text .text' => 'color: {{VALUE}};' ] ]);
        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [ 'name' => 'circ_txt_typo', 'selector' => '{{WRAPPER}} .wg-curve-text .text' ]);

        $this->add_control('center_icon_heading', [ 'label' => 'Center Icon', 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ]);
        $this->add_responsive_control('center_icon_size', [
            'label' => 'Icon Size',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'selectors' => [ '{{WRAPPER}} .wg-curve-text .icon img, {{WRAPPER}} .wg-curve-text .icon svg' => 'width: {{SIZE}}px; height: {{SIZE}}px;' ],
        ]);

        $this->add_control('scribble_heading', [ 'label' => 'Scribble Asset', 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ]);
        $this->add_responsive_control('scribble_width', [
            'label' => 'Width',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [ 'px' => [ 'min' => 100, 'max' => 1000 ] ],
            'selectors' => [ '{{WRAPPER}} .scribble' => 'width: {{SIZE}}px;' ],
        ]);
        $this->end_controls_section();

        // --- SECTION: GALLERY STYLE ---
        $this->start_controls_section('gallery_style', [
            'label' => 'Flip Gallery',
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [ 'layout_style' => 'type-2' ],
        ]);
        $this->add_responsive_control('gallery_img_size', [
            'label' => 'Image Size (W x H)',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'selectors' => [ '{{WRAPPER}} .flip-image img' => 'width: {{SIZE}}px; height: auto;' ],
        ]);
        $this->end_controls_section();
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

    protected function get_processed_text($s) {
        $text = $s['main_text'];
        if (!empty($s['highlights']) && ($s['layout_style'] !== 'type-2')) {
            foreach ($s['highlights'] as $item) {
                if (empty($item['text'])) continue;
                $text = str_replace($item['text'], '<span class="text-highlight">'.esc_html($item['text']).'</span>', $text);
            }
        }
        return nl2br($text);
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
                                <img src="<?php echo esc_url($s['scribble_img']['url']); ?>" alt="scribble" class="scribble">
                            <?php else : ?>
                                <svg class="scribble" viewBox="0 0 772 320" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 104.315C34.6667 116.269 92.8 137.913 144 128.853C208 117.528 317 33.5324 356 27.8698" stroke="#00DE51" stroke-width="40" stroke-linecap="round" />
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
                                    <img src="<?php echo esc_url($item['image']['url']); ?>" alt="gallery">
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
                                        <div class="text" data-text="<?php echo esc_attr($s['curve_text']); ?>"></div>
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