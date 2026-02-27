<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class TFTestimonials_Widget extends Widget_Base {

    public function get_name() {
        return 'tf-testimonial';
    }

    public function get_title() {
        return esc_html__( 'TF Testimonials', 'themesflat-core' );
    }

    public function get_icon() {
        return 'eicon-editor-list-ul';
    }

    public function get_categories() {
        return ['themesflat_addons'];
    }

    public function get_style_depends() { 
        return [ 'swiper-bundle' ];
    }

    public function get_script_depends() {
        return ['swiper-bundle','tf-carousel'];
    }

   protected function register_controls() {

        // --- TAB: CONTENT ---
        $this->start_controls_section(
            'section_header',
            [
                'label' => esc_html__( 'Header & Counter', 'themesflat-core' ),
            ]
        );

$this->add_control(
    'sub_title_icon',
    [
        'label' => esc_html__( 'Icon', 'themesflat-core' ),
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => [
            'value' => 'fas fa-star',
            'library' => 'solid',
        ],
    ]
);

        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'themesflat-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Testimonials', 'themesflat-core' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Main Title', 'themesflat-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( "Here's what people are saying", 'themesflat-core' ),
            ]
        );

        $this->add_control(
            'counter_1_number',
            [
                'label' => esc_html__( 'Counter 1: Number', 'themesflat-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 26,
            ]
        );

        $this->add_control(
            'counter_1_text',
            [
                'label' => esc_html__( 'Counter 1: Text', 'themesflat-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Finalized projects', 'themesflat-core' ),
            ]
        );

        $this->add_control(
            'counter_2_number',
            [
                'label' => esc_html__( 'Counter 2: Number', 'themesflat-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 98,
            ]
        );

        $this->add_control(
            'counter_2_text',
            [
                'label' => esc_html__( 'Counter 2: Text', 'themesflat-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Client satisfaction', 'themesflat-core' ),
            ]
        );

        $this->end_controls_section();

        // Section: Testimonials List (Sử dụng Repeater)
        $this->start_controls_section(
            'section_testimonials',
            [
                'label' => esc_html__( 'Testimonials List', 'themesflat-core' ),
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
    'author_icon',
    [
        'label' => esc_html__( 'Author Badge Icon', 'themesflat-core' ),
        'type' => Controls_Manager::ICONS,
        'default' => [
            'value' => 'fas fa-quote-right',
            'library' => 'solid',
        ],
    ]
);

        $repeater->add_control(
            'item_image',
            [
                'label' => esc_html__( 'Author Image', 'themesflat-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'item_content',
            [
                'label' => esc_html__( 'Content', 'themesflat-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__( 'Testimonial description text goes here...', 'themesflat-core' ),
            ]
        );

        $repeater->add_control(
            'item_name',
            [
                'label' => esc_html__( 'Name', 'themesflat-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Daniel Ruiz', 'themesflat-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'item_designation',
            [
                'label' => esc_html__( 'Designation', 'themesflat-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Head of Product, Tempo App', 'themesflat-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'testimonial_list',
            [
                'label' => esc_html__( 'Items', 'themesflat-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'item_name' => esc_html__( 'Daniel Ruiz', 'themesflat-core' ),
                    ],
                ],
                'title_field' => '{{{ item_name }}}',
            ]
        );

        $this->end_controls_section();

        // --- TAB: STYLE ---
        // --- TAB: STYLE ---

        // 1. Section Content (General)
        $this->start_controls_section(
            'section_style_general',
            [
                'label' => esc_html__( 'Content Container', 'themesflat-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__( 'Padding', 'themesflat-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .section-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label'      => esc_html__( 'Margin', 'themesflat-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .section-testimonial' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'content_background',
                'label'    => esc_html__( 'Background', 'themesflat-core' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .section-testimonial',
            ]
        );

        $this->end_controls_section();

        // 2. Sub Title Style
        $this->start_controls_section(
            'section_style_sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'themesflat-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label'     => esc_html__( 'Text Color', 'themesflat-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .sect-tag' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'sub_title_typography',
                'selector' => '{{WRAPPER}} .sect-tag',
            ]
        );

        $this->add_control(
            'sub_title_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'themesflat-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .sect-tag i, {{WRAPPER}} .sect-tag svg path' => 'color: {{VALUE}}; fill: {{VALUE}};' ],
            ]
        );

      $this->add_responsive_control(
    'sub_title_icon_size',
    [
        'label'      => esc_html__( 'Icon Size', 'themesflat-core' ),
        'type'       => Controls_Manager::SLIDER,
        'size_units' => [ 'px', 'em', 'rem' ],
        'range'      => [
            'px' => [
                'min' => 1,
                'max' => 100,
            ],
        ],
        'selectors'  => [
            '{{WRAPPER}} .sect-tag i'   => 'font-size: {{SIZE}}{{UNIT}};',
            '{{WRAPPER}} .sect-tag svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
        ],
    ]
);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'sub_title_bg',
                'selector' => '{{WRAPPER}} .sect-tag',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'sub_title_border',
                'selector' => '{{WRAPPER}} .sect-tag',
            ]
        );

        $this->add_control(
            'sub_title_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'themesflat-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [ '{{WRAPPER}} .sect-tag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'sub_title_shadow',
                'selector' => '{{WRAPPER}} .sect-tag',
            ]
        );

        $this->add_responsive_control(
            'sub_title_padding',
            [
                'label'      => esc_html__( 'Padding', 'themesflat-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [ '{{WRAPPER}} .sect-tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );
        $this->add_responsive_control(
            'sub_title_margin',
            [
                'label'      => esc_html__( 'Margin', 'themesflat-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [ '{{WRAPPER}} .sect-tag' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->end_controls_section();

        // 3. Main Title Style
        $this->start_controls_section(
            'section_style_main_title',
            [
                'label' => esc_html__( 'Main Title', 'themesflat-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'main_title_color',
            [
                'label'     => esc_html__( 'Color', 'themesflat-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .s-title' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'main_title_typography',
                'selector' => '{{WRAPPER}} .s-title',
            ]
        );

        $this->add_responsive_control(
            'main_title_margin',
            [
                'label'      => esc_html__( 'Margin', 'themesflat-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [ '{{WRAPPER}} .s-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->end_controls_section();

        // 4. Counter Style
        $this->start_controls_section(
            'section_style_counter',
            [
                'label' => esc_html__( 'Counter', 'themesflat-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control( 'heading_num', [ 'label' => 'Number', 'type' => Controls_Manager::HEADING ] );
        $this->add_control( 'num_color', [ 'label' => 'Color', 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .wg-counter .number, {{WRAPPER}} .wg-counter .counter' => 'color: {{VALUE}};' ] ] );
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [ 'name' => 'num_typo', 'selector' => '{{WRAPPER}} .wg-counter .counter' ] );

        $this->add_control( 'heading_text', [ 'label' => 'Text', 'type' => Controls_Manager::HEADING, 'separator' => 'before' ] );
        $this->add_control( 'text_color', [ 'label' => 'Color', 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .wg-counter .text' => 'color: {{VALUE}};' ] ] );
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [ 'name' => 'text_typo', 'selector' => '{{WRAPPER}} .wg-counter .text' ] );

        $this->end_controls_section();

        // 5. Testimonials List Item Styles
        $this->start_controls_section(
            'section_style_list',
            [
                'label' => esc_html__( 'Testimonials List Items', 'themesflat-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Badge Icon
        $this->add_control( 'heading_badge', [ 'label' => 'Author Badge Icon', 'type' => Controls_Manager::HEADING ] );
        $this->add_control( 'badge_color', [ 'label' => 'Color', 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .tes-icon i, {{WRAPPER}} .tes-icon svg' => 'color: {{VALUE}}; fill: {{VALUE}};' ] ] );
        $this->add_responsive_control( 'badge_size', [ 'label' => 'Size', 'type' => Controls_Manager::SLIDER, 'selectors' => [ '{{WRAPPER}} .tes-icon i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .tes-icon svg' => 'width: {{SIZE}}{{UNIT}};' ] ] );
        $this->add_responsive_control( 'badge_margin', [ 'label' => 'Margin', 'type' => Controls_Manager::DIMENSIONS, 'selectors' => [ '{{WRAPPER}} .tes-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );

        // Image
        $this->add_control( 'heading_img', [ 'label' => 'Author Image', 'type' => Controls_Manager::HEADING, 'separator' => 'before' ] );
        $this->add_responsive_control( 'img_padding', [ 'label' => 'Padding', 'type' => Controls_Manager::DIMENSIONS, 'selectors' => [ '{{WRAPPER}} .head-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
        $this->add_control( 'img_radius', [ 'label' => 'Border Radius', 'type' => Controls_Manager::DIMENSIONS, 'selectors' => [ '{{WRAPPER}} .head-image, {{WRAPPER}} .head-image .wrap-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
        $this->add_control( 'img_bg_color', [ 'label' => 'Background Color', 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .head-image' => 'background-color: {{VALUE}};' ] ] );
        $this->add_group_control( \Elementor\Group_Control_Box_Shadow::get_type(), [ 'name' => 'img_shadow', 'selector' => '{{WRAPPER}} .head-image' ] );

        // Content
        $this->add_control( 'heading_content', [ 'label' => 'Content Text', 'type' => Controls_Manager::HEADING, 'separator' => 'before' ] );
        $this->add_control( 'content_color', [ 'label' => 'Color', 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .tes-text' => 'color: {{VALUE}};' ] ] );
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [ 'name' => 'content_typo', 'selector' => '{{WRAPPER}} .tes-text' ] );
        $this->add_responsive_control( 'content_item_margin', [ 'label' => 'Margin', 'type' => Controls_Manager::DIMENSIONS, 'selectors' => [ '{{WRAPPER}} .tes-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );

        // Name
        $this->add_control( 'heading_name', [ 'label' => 'Author Name', 'type' => Controls_Manager::HEADING, 'separator' => 'before' ] );
        $this->add_control( 'name_color', [ 'label' => 'Color', 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .author_name' => 'color: {{VALUE}};' ] ] );
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [ 'name' => 'name_typo', 'selector' => '{{WRAPPER}} .author_name' ] );
        $this->add_responsive_control( 'name_margin', [ 'label' => 'Margin', 'type' => Controls_Manager::DIMENSIONS, 'selectors' => [ '{{WRAPPER}} .author_name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );

        // Designation
        $this->add_control( 'heading_des', [ 'label' => 'Designation', 'type' => Controls_Manager::HEADING, 'separator' => 'before' ] );
        $this->add_control( 'des_color', [ 'label' => 'Color', 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .text-body-3' => 'color: {{VALUE}};' ] ] );
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [ 'name' => 'des_typo', 'selector' => '{{WRAPPER}} .text-body-3' ] );

        $this->end_controls_section();

        // 6. Pagination Style
        $this->start_controls_section(
            'section_style_pagination',
            [
                'label' => esc_html__( 'Number Pagination', 'themesflat-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pag_color',
            [
                'label'     => esc_html__( 'Color', 'themesflat-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .number-pagination' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'pag_typo',
                'selector' => '{{WRAPPER}} .number-pagination',
            ]
        );

        $this->end_controls_section();

        // 7. Navigation Style
        $this->start_controls_section(
            'section_style_nav',
            [
                'label' => esc_html__( 'Navigation', 'themesflat-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'nav_size',
            [
                'label'     => esc_html__( 'Width/Height', 'themesflat-core' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'     => [ 'px' => [ 'min' => 20, 'max' => 100 ] ],
                'selectors' => [
                    '{{WRAPPER}} .sw-nav' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'nav_color',
            [
                'label'     => esc_html__( 'Color', 'themesflat-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .sw-nav' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_control(
            'nav_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'themesflat-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .sw-nav' => 'background-color: {{VALUE}};' ],
            ]
        );

        $this->add_control(
            'nav_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'themesflat-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [ '{{WRAPPER}} .sw-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'nav_shadow',
                'selector' => '{{WRAPPER}} .sw-nav',
            ]
        );

        $this->end_controls_section();
    }

protected function render() {
    $settings = $this->get_settings_for_display();
    ?>
    <div class="section-testimonial flat-spacing">
        
        <div class="sect-tag text-caption fw-medium effectFade fadeUp no-div">
            <?php if ( ! empty( $settings['sub_title_icon']['value'] ) ) : ?>
                <?php \Elementor\Icons_Manager::render_icon( $settings['sub_title_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            <?php endif; ?>
            <?php echo esc_html( $settings['sub_title'] ); ?>
        </div>

        <div class="heading overflow-hidden">
            <div class="head-left">
                <h4 class="s-title letter-space--2 text-black-72 split-text effect-blur-fade">
                    <?php echo wp_kses_post( nl2br( $settings['title'] ) ); ?>
                </h4>

                <div class="box-counter effectFade fadeUp no-div">
                    <div class="wg-counter">
                        <p class="counter h1 d-flex font-2 letter-space--2 text-black-72">
                            <span class="number" data-speed="1000" data-to="<?php echo esc_attr( $settings['counter_1_number'] ); ?>">0</span>
                            +
                        </p>
                        <p class="text text-black-56"><?php echo esc_html( $settings['counter_1_text'] ); ?></p>
                    </div>
                    <div class="wg-counter">
                        <p class="counter h1 d-flex font-2 letter-space--2 text-black-72">
                            <span class="number" data-speed="1000" data-to="<?php echo esc_attr( $settings['counter_2_number'] ); ?>">0</span>
                            %
                        </p>
                        <p class="text text-black-56"><?php echo esc_html( $settings['counter_2_text'] ); ?></p>
                    </div>
                </div>
            </div>

            <div dir="ltr" class="swiper sw-main-image effectFade fadeRight no-div">
                <div class="swiper-wrapper">
                    <?php foreach ( $settings['testimonial_list'] as $item ) : ?>
                        <div class="swiper-slide">
                            <div class="head-image">
                                <div class="wrap-image">
                                    <?php if ( ! empty( $item['item_image']['url'] ) ) : ?>
                                        <img loading="lazy" src="<?php echo esc_url( $item['item_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['item_name'] ); ?>">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="swiper-testimonial_wrap effectFade fadeUp no-div">
            <div dir="ltr" class="swiper tf-swiper swiper-testimonial">
                <div class="swiper-wrapper">
                    <?php foreach ( $settings['testimonial_list'] as $item ) : ?>
                        <div class="swiper-slide">
                            <div class="testimonial-v01">
                                
                                <?php if ( ! empty( $item['author_icon']['value'] ) ) : ?>
                                <div class="tes-icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $item['author_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </div>
                                <?php endif; ?>

                                <h5 class="tes-text letter-space--2 text-black-72">
                                    <?php echo esc_html( $item['item_content'] ); ?>
                                </h5>

                                <div class="tes-author">
                                    <p class="author_name fw-medium text-black-72"><?php echo esc_html( $item['item_name'] ); ?></p>
                                    <p class="text-body-3 text-black-56"><?php echo esc_html( $item['item_designation'] ); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="number-pagination"></div>
            <div class="group-btn">
                <div class="sw-nav sw-nav-prev link">
                    <i class="icon icon-isak-arrow-caret-left"></i>
                </div>
                <div class="sw-nav sw-nav-next link">
                    <i class="icon icon-isak-arrow-caret-right"></i>
                </div>
            </div>
        </div>
    </div>
    <?php
}
}