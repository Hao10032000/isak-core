<?php
class TFForm_Contact_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'tf-form-contact';
    }

    public function get_title() {
        return esc_html__( 'TF Form Contact', 'themesflat-core' );
    }

    public function get_icon() {
        return 'eicon-mail';
    }

    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

    protected function register_controls() {

        // --- TAB: CONTENT ---
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'themesflat-core' ),
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Contact', 'themesflat-core' ),
            ]
        );

        $this->add_control(
            'sub_title_icon',
            [
                'label' => esc_html__( 'Sub Title Icon', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-paper-plane',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Main Title', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( "If you have a project enquiry, please fill the form below", 'themesflat-core' ),
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__( 'Title HTML Tag', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1', 'h2' => 'H2', 'h3' => 'H3', 'h4' => 'H4', 'h5' => 'H5', 'h6' => 'H6',
                ],
                'default' => 'h4',
            ]
        );

        $this->add_control(
            'cf7_shortcode',
            [
                'label' => esc_html__( 'Contact Form 7 Shortcode', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => '[contact-form-7 id="123" title="Contact form 1"]',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
        // --- TAB: STYLE ---

    // 1. Style Section: Content (Container)
    $this->start_controls_section(
        'section_style_content',
        [
            'label' => esc_html__( 'Content Container', 'themesflat-core' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_responsive_control(
        'content_padding',
        [
            'label'      => esc_html__( 'Padding', 'themesflat-core' ),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors'  => [
                '{{WRAPPER}} .section-contact' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'content_margin',
        [
            'label'      => esc_html__( 'Margin', 'themesflat-core' ),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors'  => [
                '{{WRAPPER}} .section-contact' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name'     => 'content_background',
            'label'    => esc_html__( 'Background', 'themesflat-core' ),
            'types'    => [ 'classic', 'gradient' ],
            'selector' => '{{WRAPPER}} .section-contact',
        ]
    );

    $this->end_controls_section();

    // 2. Style Section: Sub Title
    $this->start_controls_section(
        'section_style_sub_title',
        [
            'label' => esc_html__( 'Sub Title', 'themesflat-core' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'sub_title_color',
        [
            'label'     => esc_html__( 'Text Color', 'themesflat-core' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
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
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ 
                '{{WRAPPER}} .sect-tag i' => 'color: {{VALUE}};',
                '{{WRAPPER}} .sect-tag svg' => 'fill: {{VALUE}};'
            ],
        ]
    );

    $this->add_responsive_control(
        'sub_title_icon_size',
        [
            'label'      => esc_html__( 'Icon Size', 'themesflat-core' ),
            'type'       => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em' ],
            'selectors'  => [
                '{{WRAPPER}} .sect-tag i' => 'font-size: {{SIZE}}{{UNIT}};',
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
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
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
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors'  => [ '{{WRAPPER}} .sect-tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]
    );

    $this->add_responsive_control(
        'sub_title_margin',
        [
            'label'      => esc_html__( 'Margin', 'themesflat-core' ),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors'  => [ '{{WRAPPER}} .sect-tag' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]
    );

    $this->end_controls_section();

    // 3. Style Section: Main Title
    $this->start_controls_section(
        'section_style_main_title',
        [
            'label' => esc_html__( 'Main Title', 'themesflat-core' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'main_title_color',
        [
            'label'     => esc_html__( 'Color', 'themesflat-core' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
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
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors'  => [ '{{WRAPPER}} .s-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]
    );

    $this->add_responsive_control(
        'main_title_padding',
        [
            'label'      => esc_html__( 'Padding', 'themesflat-core' ),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors'  => [ '{{WRAPPER}} .s-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]
    );

    $this->end_controls_section();

    // 3. Style Section: Mail
    $this->start_controls_section(
        'section_style_mail',
        [
            'label' => esc_html__( 'Mail', 'themesflat-core' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'mail_color',
        [
            'label'     => esc_html__( 'Color', 'themesflat-core' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .text-body-1' => 'color: {{VALUE}};' ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name'     => 'mail_title_typography',
            'selector' => '{{WRAPPER}} .text-body-1',
        ]
    );


    $this->end_controls_section();

    
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

        <div class="section-contact flat-spacing">
            
            <?php if ( ! empty( $settings['sub_title'] ) ) : ?>
                <div class="sect-tag text-caption fw-medium effectFade fadeUp no-div">
                    <?php if ( ! empty( $settings['sub_title_icon']['value'] ) ) : ?>
                        <?php \Elementor\Icons_Manager::render_icon( $settings['sub_title_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <?php endif; ?>
                    <?php echo esc_html( $settings['sub_title'] ); ?>
                </div>
            <?php endif; ?>

            <?php if ( ! empty( $settings['title'] ) ) : ?>
                <?php 
                    $title_tag = \Elementor\Utils::validate_html_tag( $settings['title_tag'] );
                    printf( '<%1$s class="s-title letter-space--2 split-text effect-blur-fade">%2$s</%1$s>', 
                        $title_tag, 
                        wp_kses_post( nl2br( $settings['title'] ) ) 
                    ); 
                ?>
            <?php endif; ?>

            <div class="form-contact-container">
                <?php 
                if ( ! empty( $settings['cf7_shortcode'] ) ) {
                    echo '<div class="form-contact cf7-wrapper effectFade fadeUp no-div">';
                    echo do_shortcode( $settings['cf7_shortcode'] );
                    echo '</div>';
                } else {
                    // Hiển thị thông báo nhắc nhở chỉ khi ở trong Editor của Elementor
                    if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
                        echo '<div class="alert alert-info">Vui lòng nhập Shortcode Contact Form 7 vào bảng điều khiển.</div>';
                    }
                }
                ?>
            </div>

        </div>
        <?php
    }
}