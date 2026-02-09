<?php
class TFEducation_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tf-education';
	}

	public function get_title() {
		return esc_html__( 'TF Education', 'themesflat-core' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return [ 'themesflat_addons' ];
	}
    public function get_script_depends() {
        return [ 'gsapAnimation' ];
    }
    

	protected function register_controls() {

        // --- TAB CONTENT ---
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'themesflat-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tag_icon',
            [
                'label'   => esc_html__( 'Tag Icon', 'themesflat-core' ),
                'type'    => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'icon-edu', // Assuming this is your custom font icon
                    'library' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'tag_text',
            [
                'label'   => esc_html__( 'Tag Label', 'themesflat-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Education & Experience', 'themesflat-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'date',
            [
                'label'   => esc_html__( 'Date Range', 'themesflat-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '2023 - Now', 'themesflat-core' ),
            ]
        );

        $repeater->add_control(
            'light_logo',
            [
                'label'   => esc_html__( 'Logo (Light Mode)', 'themesflat-core' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
            ]
        );

        $repeater->add_control(
            'dark_logo',
            [
                'label'   => esc_html__( 'Logo (Dark Mode)', 'themesflat-core' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'description' => esc_html__( 'Logo used when the site is in dark mode (data-dark attribute)', 'themesflat-core' ),
                'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
            ]
        );

        $repeater->add_control(
            'role',
            [
                'label'   => esc_html__( 'Role/Title', 'themesflat-core' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Independent Designer & No-Code Developer', 'themesflat-core' ),
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label'   => esc_html__( 'Description', 'themesflat-core' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Helping startups and creative teams launch websites...', 'themesflat-core' ),
            ]
        );

        $this->add_control(
            'timeline_items',
            [
                'label'       => esc_html__( 'Timeline Items', 'themesflat-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [ 'role' => 'Independent Designer', 'date' => '2023 - Now' ],
                ],
                'title_field' => '{{{ role }}}',
            ]
        );

        $this->end_controls_section();

        // --- TAB STYLE ---

        // Section Style
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Section Container', 'themesflat-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'section_bg',
                'selector' => '{{WRAPPER}} .section-education-experience',
            ]
        );

        $this->add_responsive_control(
            'section_padding',
            [
                'label'      => esc_html__( 'Padding', 'themesflat-core' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors'  => [ '{{WRAPPER}} .section-education-experience' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_responsive_control(
            'section_margin',
            [
                'label'      => esc_html__( 'Margin', 'themesflat-core' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors'  => [ '{{WRAPPER}} .section-education-experience' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->end_controls_section();

        // Tag & Timeline Line Style
        $this->start_controls_section(
            'tag_timeline_style',
            [
                'label' => esc_html__( 'Tag & Timeline Line', 'themesflat-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'tag_background',
                'label'    => esc_html__( 'Background', 'themesflat-core' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .sect-tag',
            ]
        );

        $this->add_responsive_control(
            'tag_padding',
            [
                'label'      => esc_html__( 'Padding', 'themesflat-core' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [ '{{WRAPPER}} .sect-tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_responsive_control(
            'tag_margin',
            [
                'label'      => esc_html__( 'Margin', 'themesflat-core' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [ '{{WRAPPER}} .sect-tag' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_control(
            'tag_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'themesflat-core' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [ '{{WRAPPER}} .sect-tag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tag_box_shadow',
                'selector' => '{{WRAPPER}} .sect-tag',
            ]
        );

        $this->add_control(
            'heading_tag_icon',
            [
                'label'     => esc_html__( 'Tag Icon', 'themesflat-core' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

       $this->add_responsive_control(
            'tag_icon_size',
            [
                'label'     => esc_html__( 'Icon Size', 'themesflat-core' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [ '{{WRAPPER}} .sect-tag i, {{WRAPPER}} .sect-tag svg' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ],
            ]
        );

        $this->add_control(
            'tag_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'themesflat-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .sect-tag i, {{WRAPPER}} .sect-tag svg path' => 'color: {{VALUE}}; fill: {{VALUE}};' ],
            ]
        );

        $this->add_control(
            'heading_tag_label',
            [
                'label'     => esc_html__( 'Tag Label', 'themesflat-core' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tag_label_typography',
                'selector' => '{{WRAPPER}} .sect-tag',
            ]
        );

        $this->add_control(
            'tag_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'themesflat-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .sect-tag' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_control(
            'line_color',
            [
                'label'     => esc_html__( 'Progress Line Color', 'themesflat-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .timeline-line .prg-line' => 'background-color: {{VALUE}};' ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'dot_color',
            [
                'label'     => esc_html__( 'Dot Color', 'themesflat-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .timeline-dot' => 'background-color: {{VALUE}};' ],
            ]
        );

        $this->end_controls_section();

        // Item Content Style
        $this->start_controls_section(
            'item_content_style',
            [
                'label' => esc_html__( 'Item Content', 'themesflat-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

       // Date Style
        $this->add_control( 'heading_date', [ 'label' => esc_html__( 'Date', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::HEADING ] );
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [ 'name' => 'date_typo', 'selector' => '{{WRAPPER}} .timeline-date' ] );
        $this->add_control( 'date_color', [ 'label' => esc_html__( 'Date Color', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .timeline-date' => 'color: {{VALUE}};' ] ] );

        // Role/Title Style
        $this->add_control( 
            'heading_role', 
            [ 
                'label' => esc_html__( 'Role/Title', 'themesflat-core' ), 
                'type' => \Elementor\Controls_Manager::HEADING, 
                'separator' => 'before' 
            ] 
        );
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [ 'name' => 'role_typo', 'selector' => '{{WRAPPER}} .timeline-role' ] );
        $this->add_control( 'role_color', [ 'label' => esc_html__( 'Role Color', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .timeline-role' => 'color: {{VALUE}};' ] ] );
        
        $this->add_responsive_control(
            'role_padding',
            [
                'label'      => esc_html__( 'Role Padding', 'themesflat-core' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [ '{{WRAPPER}} .timeline-role' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_responsive_control(
            'role_margin',
            [
                'label'      => esc_html__( 'Role Margin', 'themesflat-core' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [ '{{WRAPPER}} .timeline-role' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        // Description Style
        $this->add_control( 
            'heading_desc', 
            [ 
                'label' => esc_html__( 'Description', 'themesflat-core' ), 
                'type' => \Elementor\Controls_Manager::HEADING, 
                'separator' => 'before' 
            ] 
        );
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [ 'name' => 'desc_typo', 'selector' => '{{WRAPPER}} .timeline-desc' ] );
        $this->add_control( 'desc_color', [ 'label' => esc_html__( 'Desc Color', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .timeline-desc' => 'color: {{VALUE}};' ] ] );

        $this->add_responsive_control(
            'desc_padding',
            [
                'label'      => esc_html__( 'Description Padding', 'themesflat-core' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [ '{{WRAPPER}} .timeline-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_responsive_control(
            'desc_margin',
            [
                'label'      => esc_html__( 'Description Margin', 'themesflat-core' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [ '{{WRAPPER}} .timeline-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->end_controls_section();
    }

	/*==============================
	= RENDER
	==============================*/
	protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div id="education" class="section-education-experience flat-spacing">
            <div class="sect-tag text-caption fw-medium effectFade fadeUp no-div">
                <?php if ( ! empty( $settings['tag_icon']['value'] ) ) : ?>
                    <?php \Elementor\Icons_Manager::render_icon( $settings['tag_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                <?php endif; ?>
                <?php echo esc_html( $settings['tag_text'] ); ?>
            </div>

            <div class="timeline scroll-down">
                <div class="timeline-line">
                    <div class="prg-line"></div>
                </div>

                <?php if ( ! empty( $settings['timeline_items'] ) ) : 
                    foreach ( $settings['timeline_items'] as $item ) : 
                        $light_url = !empty($item['light_logo']['url']) ? $item['light_logo']['url'] : '';
                        $dark_url = !empty($item['dark_logo']['url']) ? $item['dark_logo']['url'] : $light_url;
                ?>
                    <div class="timeline-item effectFade fadeUp no-div elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                        <p class="timeline-date text-black-56"><?php echo esc_html( $item['date'] ); ?></p>
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="icon">
                                <img class="image-switch" 
                                     data-dark="<?php echo esc_url( $dark_url ); ?>" 
                                     src="<?php echo esc_url( $light_url ); ?>" 
                                     alt="Logo" loading="lazy">
                            </div>
                            <p class="timeline-role fw-medium text-black-72"><?php echo esc_html( $item['role'] ); ?></p>
                            <p class="timeline-desc text-body-3 text-black-56">
                                <?php echo esc_html( $item['description'] ); ?>
                            </p>
                        </div>
                    </div>
                <?php 
                    endforeach; 
                endif; 
                ?>
            </div>
        </div>
        <?php
    }
}