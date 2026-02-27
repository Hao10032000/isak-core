<?php
class TFTech_Stack_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tf-tech-stack';
    }
    
    public function get_title() {
        return esc_html__( 'TF Tech Stack', 'themesflat-core' );
    }

    public function get_icon() {
        return 'eicon-t-letter';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
    }
     public function get_script_depends() {
        return [ 'gsapAnimation'];
    }

	protected function register_controls() {

        // --- TAB: CONTENT ---
       $this->start_controls_section(
            'section_content',
            [ 'label' => esc_html__( 'Content', 'themesflat-core' ) ]
        );

        $this->add_control(
            'sub_title_icon',
            [
                'label' => esc_html__( 'Sub Title Icon', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [ 'value' => 'icon-tech-stack', 'library' => 'theme_icon_extend' ],
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Tech Stack', 'themesflat-core' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'See how my expertise with these tools drives better results', 'themesflat-core' ),
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__( 'Title HTML Tag', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [ 'h1' => 'H1', 'h2' => 'H2', 'h3' => 'H3', 'h4' => 'H4', 'h5' => 'H5', 'h6' => 'H6' ],
                'default' => 'h4',
            ]
        );

        // --- REPEATER ---
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'item_media_type',
            [
                'label' => esc_html__( 'Media Type', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'image' => esc_html__( 'Image', 'themesflat-core' ),
                    'icon'  => esc_html__( 'Icon', 'themesflat-core' ),
                ],
                'default' => 'image',
            ]
        );

        // Ảnh cho Light Mode
        $repeater->add_control(
            'item_image',
            [
                'label' => esc_html__( 'Image (Light)', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [ 'item_media_type' => 'image' ],
            ]
        );

        // Ảnh cho Dark Mode (Sử dụng thuộc tính data-dark)
        $repeater->add_control(
            'item_image_dark',
            [
                'label' => esc_html__( 'Image (Dark)', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [ 'item_media_type' => 'image' ],
            ]
        );

        $repeater->add_control(
            'item_icon',
            [
                'label' => esc_html__( 'Icon', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'condition' => [ 'item_media_type' => 'icon' ],
            ]
        );

        $repeater->add_control('item_name', [
            'label' => esc_html__( 'Tech Name', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Figma',
        ]);

        $repeater->add_control('item_duty', [
            'label' => esc_html__( 'Description', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Leading design tool',
        ]);

        $repeater->add_control('item_percent', [
            'label' => esc_html__( 'Percentage', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 80,
        ]);

        $this->add_control(
            'tech_list',
            [
                'label' => esc_html__( 'Tech List', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [ ['item_name' => 'Figma'], ],
                'title_field' => '{{{ item_name }}}',
            ]
        );

        $this->end_controls_section();

        // --- TAB STYLE: CONTAINER ---
        $this->start_controls_section(
            'style_container',
            [
                'label' => esc_html__( 'Content Container', 'themesflat-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label' => esc_html__( 'Padding', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [ '{{WRAPPER}} .section-tech-stack' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_responsive_control(
            'container_margin',
            [
                'label' => esc_html__( 'Margin', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [ '{{WRAPPER}} .section-tech-stack' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'selector' => '{{WRAPPER}} .section-tech-stack',
            ]
        );

        $this->end_controls_section();

        // --- TAB STYLE: HEADING (SUB & TITLE) ---
        $this->start_controls_section(
            'style_heading',
            [
                'label' => esc_html__( 'Heading', 'themesflat-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control( 'heading_sub_style', [ 'label' => esc_html__( 'Sub Title', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::HEADING ] );

        $this->add_responsive_control(
            'sub_padding',
            [
                'label' => esc_html__( 'Padding', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [ '{{WRAPPER}} .sect-tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [ 'name' => 'sub_typography', 'selector' => '{{WRAPPER}} .sect-tag' ]
        );

        $this->add_control(
            'sub_color',
            [
                'label' => esc_html__( 'Color', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .sect-tag' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [ 'name' => 'sub_border', 'selector' => '{{WRAPPER}} .sect-tag' ]
        );

        $this->add_control(
            'sub_radius',
            [
                'label' => esc_html__( 'Border Radius', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [ '{{WRAPPER}} .sect-tag' => 'border-radius: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [ 'name' => 'sub_shadow', 'selector' => '{{WRAPPER}} .sect-tag' ]
        );

        $this->add_control( 'heading_sub_icon_style', [ 'label' => esc_html__( 'Sub Title Icon', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ] );
        
        $this->add_control(
            'sub_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .sect-tag i, {{WRAPPER}} .sect-tag svg path' => 'color: {{VALUE}}; fill: {{VALUE}};' ],
            ]
        );

        $this->add_responsive_control(
            'sub_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [ '{{WRAPPER}} .sect-tag i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .sect-tag svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->add_control( 'heading_title_style', [ 'label' => esc_html__( 'Main Title', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ] );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [ 'name' => 'title_typography', 'selector' => '{{WRAPPER}} .s-title' ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .s-title' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'Margin', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [ '{{WRAPPER}} .s-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->end_controls_section();

        // --- TAB STYLE: TECH LIST ---
        $this->start_controls_section(
            'style_tech_list',
            [
                'label' => esc_html__( 'Tech List', 'themesflat-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'list_gap',
            [
                'label' => esc_html__( 'Gap Items', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [ 'size' => 32 ],
                'selectors' => [ '{{WRAPPER}} .tech-list' => 'display: grid; gap: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->add_control( 'heading_item_icon', [ 'label' => esc_html__( 'Icon/Image Box', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ] );

        $this->add_responsive_control(
            'icon_box_size',
            [
                'label' => esc_html__( 'Box Width/Height', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [ '{{WRAPPER}} .tech_image' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; display: flex; align-items: center; justify-content: center;' ],
            ]
        );

        $this->add_control(
            'icon_box_bg',
            [
                'label' => esc_html__( 'Background Color', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .tech_image' => 'background-color: {{VALUE}};' ],
            ]
        );

        $this->add_control(
            'icon_box_radius',
            [
                'label' => esc_html__( 'Border Radius', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [ '{{WRAPPER}} .tech_image' => 'border-radius: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [ 'name' => 'icon_box_shadow', 'selector' => '{{WRAPPER}} .tech_image' ]
        );

        $this->add_responsive_control(
            'img_size',
            [
                'label' => esc_html__( 'Image Size (px)', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [ '{{WRAPPER}} .tech_image img' => 'width: {{SIZE}}px; height: auto;' ],
            ]
        );

        $this->add_control( 'heading_tech_name', [ 'label' => esc_html__( 'Tech Name', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ] );
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [ 'name' => 'name_typography', 'selector' => '{{WRAPPER}} .info__name' ] );
        $this->add_control( 'name_color', [ 'label' => 'Color', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .info__name' => 'color: {{VALUE}};' ] ] );

        $this->add_control( 'heading_desc', [ 'label' => esc_html__( 'Description', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ] );
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [ 'name' => 'desc_typography', 'selector' => '{{WRAPPER}} .info__duty' ] );
        $this->add_control( 'desc_color', [ 'label' => 'Color', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .info__duty' => 'color: {{VALUE}};' ] ] );

        $this->end_controls_section();

        // --- TAB STYLE: PERCENTAGE ---
        $this->start_controls_section(
            'style_percentage',
            [
                'label' => esc_html__( 'Percentage Style', 'themesflat-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control( 'heading_progress_bar', [ 'label' => 'Tech Progress (Wrap)', 'type' => \Elementor\Controls_Manager::HEADING ] );
        $this->add_responsive_control( 'progress_wrap_padding', [ 'label' => 'Padding', 'type' => \Elementor\Controls_Manager::DIMENSIONS, 'selectors' => [ '{{WRAPPER}} .tech-progress' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
        $this->add_control( 'progress_wrap_bg', [ 'label' => 'Background', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .tech-progress' => 'background-color: {{VALUE}};' ] ] );
        $this->add_control( 'progress_wrap_radius', [ 'label' => 'Border Radius', 'type' => \Elementor\Controls_Manager::SLIDER, 'selectors' => [ '{{WRAPPER}} .tech-progress' => 'border-radius: {{SIZE}}{{UNIT}};' ] ] );

        $this->add_control( 'heading_line', [ 'label' => 'Progress Line (Background)', 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ] );
        $this->add_control( 'line_bg', [ 'label' => 'Line Color', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .progress-line' => 'background-color: {{VALUE}};' ] ] );
        $this->add_control( 'line_radius', [ 'label' => 'Border Radius', 'type' => \Elementor\Controls_Manager::SLIDER, 'selectors' => [ '{{WRAPPER}} .progress-line' => 'border-radius: {{SIZE}}{{UNIT}};' ] ] );

        $this->add_control( 'heading_num', [ 'label' => 'Progress Number (Badge)', 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ] );
        $this->add_control( 'num_color', [ 'label' => 'Text Color', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .progress-num' => 'color: {{VALUE}};' ] ] );
        $this->add_control( 'num_bg', [ 'label' => 'Background Color', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .progress-num' => 'background-color: {{VALUE}};' ] ] );
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [ 'name' => 'num_typography', 'selector' => '{{WRAPPER}} .progress-num' ] );
        $this->add_group_control( \Elementor\Group_Control_Box_Shadow::get_type(), [ 'name' => 'num_shadow', 'selector' => '{{WRAPPER}} .progress-num' ] );

        $this->end_controls_section();

        // --- STYLE: LINE COLOR ---
        $this->start_controls_section(
            'style_line',
            [
                'label' => esc_html__( 'Separator Line', 'themesflat-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'line_color',
            [
                'label' => esc_html__( 'Line Color', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .br-line' => 'background-color: {{VALUE}};' ],
            ]
        );

        $this->end_controls_section();
    }

protected function render() {
        $settings = $this->get_settings_for_display();
        $title_tag = $settings['title_tag'];
        ?>
        <div class="section-tech-stack flat-spacing">

            <?php if ( ! empty( $settings['sub_title'] ) ) : ?>
                <div class="sect-tag text-caption fw-medium effectFade fadeUp no-div">
                    <?php if ( ! empty( $settings['sub_title_icon']['value'] ) ) : ?>
                        <?php \Elementor\Icons_Manager::render_icon( $settings['sub_title_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <?php endif; ?>
                    <?php echo esc_html( $settings['sub_title'] ); ?>
                </div>
            <?php endif; ?>

            <?php if ( ! empty( $settings['title'] ) ) : ?>
                <<?php echo esc_attr($title_tag); ?> class="s-title letter-space--2 text-black-72 split-text effect-blur-fade">
                    <?php echo wp_kses_post( $settings['title'] ); ?>
                </<?php echo esc_attr($title_tag); ?>>
            <?php endif; ?>

            <?php if ( ! empty( $settings['tech_list'] ) ) : ?>
                <ul class="tech-list">
                    <?php foreach ( $settings['tech_list'] as $index => $item ) : ?>
                        <li class="wg-tech">
                            <div class="tech-infor effectFade fadeUp no-div">
                                <div class="tech_image">
                                    <?php if ( 'image' === $item['item_media_type'] ) : 
                                        $dark_url = ! empty( $item['item_image_dark']['url'] ) ? esc_url( $item['item_image_dark']['url'] ) : '';
                                        ?>
                                        <img class="<?php echo !empty($dark_url) ? 'image-switch' : ''; ?>" 
                                             <?php if(!empty($dark_url)) echo 'data-dark="' . $dark_url . '"'; ?>
                                             src="<?php echo esc_url( $item['item_image']['url'] ); ?>" 
                                             alt="<?php echo esc_attr( $item['item_name'] ); ?>"
                                             loading="lazy">
                                    <?php else : ?>
                                        <span class="tech-icon-wrapper">
                                            <?php \Elementor\Icons_Manager::render_icon( $item['item_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="tech_info">
                                    <p class="info__name fw-medium text-black-72"><?php echo esc_html( $item['item_name'] ); ?></p>
                                    <p class="info__duty text-black-56 text-body-3"><?php echo esc_html( $item['item_duty'] ); ?></p>
                                </div>
                            </div>
                            <div class="tech-progress">
                                <div class="progress-line" data-progress="<?php echo esc_attr( $item['item_percent'] ); ?>">
                                    <p class="progress-num text-caption">
                                        <span class="counter">
                                            <span class="number" data-speed="1500" data-to="<?php echo esc_attr( $item['item_percent'] ); ?>">10</span>%
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </li>

                        <?php if ( $index < count( $settings['tech_list'] ) - 1 ) : ?>
                            <li class="br-line"></li>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        <?php
    }
}