<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class TFService_Widget extends Widget_Base {

    public function get_name() {
        return 'tf-service';
    }

    public function get_title() {
        return esc_html__( 'TF Service', 'themesflat-core' );
    }

    public function get_icon() {
        return 'eicon-editor-list-ul';
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
            'sub_title_icon',
            [
                'label' => esc_html__( 'Sub Title Icon', 'themesflat-core' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-concierge-bell',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'themesflat-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Services', 'themesflat-core' ),
            ]
        );


        $repeater = new Repeater();

        $repeater->add_control(
            'item_title',
            [
                'label' => esc_html__( 'Service Name', 'themesflat-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Web Design' , 'themesflat-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'item_image_1',
            [
                'label' => esc_html__( 'Image 1', 'themesflat-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src() ],
            ]
        );

        $repeater->add_control(
            'item_image_2',
            [
                'label' => esc_html__( 'Image 2', 'themesflat-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src() ],
            ]
        );

        $repeater->add_control(
            'item_tags',
            [
                'label' => esc_html__( 'Tags (Comma separated)', 'themesflat-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_control(
            'item_description',
            [
                'label' => esc_html__( 'Description', 'themesflat-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'service_list',
            [
                'label' => esc_html__( 'Service List', 'themesflat-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [ [ 'item_title' => esc_html__( 'Web Design', 'themesflat-core' ) ] ],
                'title_field' => '{{{ item_title }}}',
            ]
        );

        $this->end_controls_section();

        // --- TAB: STYLE ---

        // 1. SECTION CONTENT (Wrapper)
        $this->start_controls_section(
            'section_style_content',
            [
                'label' => esc_html__( 'Content ', 'themesflat-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__( 'Padding', 'themesflat-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [ '{{WRAPPER}} .section-service' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label'      => esc_html__( 'Margin', 'themesflat-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [ '{{WRAPPER}} .section-service' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'content_background',
                'label'    => esc_html__( 'Background', 'themesflat-core' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .section-service',
            ]
        );
        $this->add_control(
    'line_color',
    [
        'label'     => esc_html__( 'Line Color', 'themesflat-core' ),
        'type'      => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .section-service .br-line' => 'background-color: {{VALUE}};',
        ],
    ]
);

        $this->end_controls_section();

        // 2. SECTION SUB TITLE (The Header Part)
        $this->start_controls_section(
            'section_style_sub',
            [
                'label' => esc_html__( 'Sub Title Section', 'themesflat-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'sub_padding',
            [
                'label'      => esc_html__( 'Padding', 'themesflat-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors'  => [ '{{WRAPPER}} .sect-tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_responsive_control(
            'sub_margin',
            [
                'label'      => esc_html__( 'Margin', 'themesflat-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors'  => [ '{{WRAPPER}} .sect-tag' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'sub_background',
                'selector' => '{{WRAPPER}} .sect-tag',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'sub_border',
                'selector' => '{{WRAPPER}} .sect-tag',
            ]
        );

        $this->add_control(
            'sub_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'themesflat-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [ '{{WRAPPER}} .sect-tag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'sub_box_shadow',
                'selector' => '{{WRAPPER}} .sect-tag',
            ]
        );

        $this->add_control(
            'heading_sub_icon',
            [
                'label'     => esc_html__( 'Icon Style', 'themesflat-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

       $this->add_control(
    'sub_icon_color',
    [
        'label'     => esc_html__( 'Icon Color', 'themesflat-core' ),
        'type'      => \Elementor\Controls_Manager::COLOR, 
        'selectors' => [
            '{{WRAPPER}} .sub-title-icon svg path' => 'fill: {{VALUE}};',
            '{{WRAPPER}} .sub-title-icon'  => 'color: {{VALUE}};',
        ],
    ]
);

        $this->add_responsive_control(
            'sub_icon_size',
            [
                'label'     => esc_html__( 'Icon Size', 'themesflat-core' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [ '{{WRAPPER}} .sub-title-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                                 '{{WRAPPER}} .sub-title-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->add_control(
            'heading_sub_text',
            [
                'label'     => esc_html__( 'Text Style', 'themesflat-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'sub_text_color',
            [
                'label'     => esc_html__( 'Color', 'themesflat-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .sect-tag' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'sub_text_typography',
                'selector' => '{{WRAPPER}} .sect-tag',
            ]
        );

        $this->end_controls_section();

        // 3. SERVICE LIST
        $this->start_controls_section(
            'section_style_list',
            [
                'label' => esc_html__( 'Service List Style', 'themesflat-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // --- Service Item ---
        $this->add_control(
            'heading_item',
            [ 'label' => esc_html__( 'Item Container', 'themesflat-core' ), 'type' => Controls_Manager::HEADING ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => esc_html__( 'Padding', 'themesflat-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [ '{{WRAPPER}} .service-accordion_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_responsive_control(
            'item_margin',
            [
                'label'      => esc_html__( 'Margin', 'themesflat-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [ '{{WRAPPER}} .service-accordion_item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [ 'name' => 'item_bg', 'selector' => '{{WRAPPER}} .service-accordion_item' ]
        );

        // --- Service Name ---
        $this->add_control(
            'heading_name',
            [ 'label' => esc_html__( 'Service Name', 'themesflat-core' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ]
        );
        $this->add_responsive_control(
            'heading_name_padding',
            [
                'label'      => esc_html__( 'Padding', 'themesflat-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [ '{{WRAPPER}} .accordion-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [ 'name' => 'name_typography', 'selector' => '{{WRAPPER}} .accordion-action h4' ]
        );

        $this->add_control(
            'name_color',
            [
                'label'     => esc_html__( 'Color', 'themesflat-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .accordion-action h4' => 'color: {{VALUE}};' ],
            ]
        );

        // --- Icon Toggle ---
        $this->add_control(
            'heading_toggle',
            [ 'label' => esc_html__( 'Icon Toggle', 'themesflat-core' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ]
        );

        $this->add_responsive_control(
            'toggle_size',
            [
                'label'     => esc_html__( 'Width/Height', 'themesflat-core' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [ 
                    '{{WRAPPER}} .service-accordion_item .ic-wrap' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_color',
            [
                'label'     => esc_html__( 'Icon Color', 'themesflat-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
            '{{WRAPPER}} .ic-accordion-custom::before' => 'background-color: {{VALUE}} !important;',
            '{{WRAPPER}} .ic-accordion-custom::after'  => 'background-color: {{VALUE}} !important;',
        ],
            ]
        );

        $this->add_control(
            'toggle_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'themesflat-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .service-accordion_item .ic-wrap' => 'background-color: {{VALUE}};' ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [ 'name' => 'toggle_border', 'selector' => '{{WRAPPER}} .service-accordion_item .ic-wrap' ]
        );

        $this->add_control(
            'toggle_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'themesflat-core' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [ '{{WRAPPER}} .service-accordion_item .ic-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        // --- Image ---
        $this->add_control(
            'heading_image',
            [ 'label' => esc_html__( 'Images Style', 'themesflat-core' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ]
        );

        $this->add_responsive_control(
            'img_padding',
            [
                'label'      => esc_html__( 'Padding', 'themesflat-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [ '{{WRAPPER}} .service-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );
        $this->add_responsive_control(
            'img_margin',
            [
                'label'      => esc_html__( 'Margin', 'themesflat-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [ '{{WRAPPER}} .tf-grid-layout' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_control(
            'img_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'themesflat-core' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [ '{{WRAPPER}} .service-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [ 'name' => 'img_shadow', 'selector' => '{{WRAPPER}} .service-image' ]
        );

        // --- Tags ---
        $this->add_control(
            'heading_tags',
            [ 'label' => esc_html__( 'Tags Style', 'themesflat-core' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ]
        );

        $this->start_controls_tabs( 'tabs_tag_style' );

        
        $this->add_control(
            'tag_color',
            [
                'label'     => esc_html__( 'Color', 'themesflat-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .tag-item' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_control(
            'tag_bg',
            [
                'label'     => esc_html__( 'Background', 'themesflat-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .tag-item' => 'background-color: {{VALUE}};' ],
            ]
        );


        $this->add_control(
            'tag_color_hover',
            [
                'label'     => esc_html__( 'Color Hover', 'themesflat-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .tag-item:hover' => 'color: {{VALUE}}!important;' ],
            ]
        );


        $this->end_controls_tabs();

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [ 'name' => 'tag_typography', 'selector' => '{{WRAPPER}} .tag-item' ]
        );

        $this->add_responsive_control(
            'tag_padding',
            [
                'label'      => esc_html__( 'Padding', 'themesflat-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [ '{{WRAPPER}} .tag-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_control(
            'tag_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'themesflat-core' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [ '{{WRAPPER}} .tag-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        // --- Description ---
        $this->add_control(
            'heading_desc',
            [ 'label' => esc_html__( 'Description Style', 'themesflat-core' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [ 'name' => 'desc_typography', 'selector' => '{{WRAPPER}} .service-desc' ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Color', 'themesflat-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .service-desc' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_responsive_control(
            'desc_margin',
            [
                'label'      => esc_html__( 'Margin', 'themesflat-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [ '{{WRAPPER}} .service-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
<div class="section-service flat-spacing">
    <?php if ( !empty($settings['sub_title']) ) : ?>
    <div class="sect-tag text-caption fw-medium effectFade fadeUp no-div mb-0">
        <span class="sub-title-icon">
            <?php \Elementor\Icons_Manager::render_icon( $settings['sub_title_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </span>
        <?php echo esc_html( $settings['sub_title'] ); ?>
    </div>
    <?php endif; ?>

    <div class="" id="accordion-service">
        <?php 
                $index = 0;
                foreach ( $settings['service_list'] as $item ) : 
                    $index++;
                    $is_show = ($index == 1) ? 'show' : '';
                    $is_collapsed = ($index == 1) ? '' : 'collapsed';
                    $aria_expanded = ($index == 1) ? 'true' : 'false';
                    $item_id = 'service-' . $this->get_id() . $index;
                ?>
        <div class="service-accordion_item scrolling-effect effectBottom" role="presentation">
            <div class="accordion-action <?php echo esc_attr($is_collapsed); ?>"
                data-bs-target="#<?php echo esc_attr($item_id); ?>" role="button" data-bs-toggle="collapse"
                aria-controls="<?php echo esc_attr($item_id); ?>"
                aria-expanded="<?php echo esc_attr($aria_expanded); ?>">

                <h4 class="text letter-space--2 text-black-72"><?php echo esc_html($item['item_title']); ?></h4>
                <div class="ic-wrap">
                    <span class="ic-accordion-custom"></span>
                </div>
            </div>

            <div id="<?php echo esc_attr($item_id); ?>" class="collapse <?php echo esc_attr($is_show); ?>"
                data-bs-parent="#accordion-service">
                <div class="accordion-content">
                    <div class="tf-grid-layout sm-col-2">
                        <?php if ( !empty($item['item_image_1']['url']) ) : ?>
                        <div class="service-image">
                            <div class="wrap_image">
                                <img src="<?php echo esc_url($item['item_image_1']['url']); ?>"
                                    alt="<?php echo esc_attr($item['item_title']); ?>">
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if ( !empty($item['item_image_2']['url']) ) : ?>
                        <div class="service-image">
                            <div class="wrap_image">
                                <img src="<?php echo esc_url($item['item_image_2']['url']); ?>"
                                    alt="<?php echo esc_attr($item['item_title']); ?>">
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <?php if ( !empty($item['item_tags']) ) : ?>
                    <div class="service-tag">
                        <?php 
                                        $tags = explode(',', $item['item_tags']);
                                        foreach ($tags as $tag) : ?>
                        <a href="#" class="tag-item text-body-3 fw-medium text-black-72 link">
                            <?php echo esc_html(trim($tag)); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <?php if ( !empty($item['item_description']) ) : ?>
                    <p class="service-desc text-black-56">
                        <?php echo esc_html($item['item_description']); ?>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="br-line scrolling-effect effectBottom"></div>
        <?php endforeach; ?>
    </div>
</div>
<?php
    }
}