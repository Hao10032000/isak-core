<?php
class TFAbout_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tf-about';
	}

	public function get_title() {
		return esc_html__( 'TF About Section', 'themesflat-core' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'themesflat_addons' ];
	}

	// public function get_style_depends() { return [ 'styles' ]; }
    // public function get_script_depends() {
    //     return [ 
    //         'change-text', 'gsap', 
    //         'ScrollTrigger', 'ScrollToPlugin', 'ScrollSmooth', 
    //         'ScrollSmoother', 'SplitText', 'gsapAnimation',
    //         'main'
    //     ];
    // }

	// ============================
	// CONTROLS
	// ============================
	protected function register_controls() {

        // --- Content Section ---
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
                'label' => esc_html__( 'Tag Icon', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-user-circle',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'tag_text',
            [
                'label'   => esc_html__( 'Tag Label', 'themesflat-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'About', 'themesflat-core' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label'   => esc_html__( 'Title', 'themesflat-core' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Designing brands and websites...', 'themesflat-core' ),
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'   => esc_html__( 'Title HTML Tag', 'themesflat-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'p'    => 'p',
                    'span' => 'span',
                ],
                'default' => 'h4',
            ]
        );

        $this->add_control(
            'description',
            [
                'label'   => esc_html__( 'Description', 'themesflat-core' ),
                'type'    => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'I combine web design, brand identity, and no-code development to help businesses move faster.', 'themesflat-core' ),
            ]
        );

        $this->end_controls_section();

        // --- Awards Section ---
        $this->start_controls_section(
            'award_section',
            [
                'label' => esc_html__( 'Awards List', 'themesflat-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
       $this->add_control(
            'show_awards',
            [
                'label'        => esc_html__( 'Show Awards', 'themesflat-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'themesflat-core' ),
                'label_off'    => esc_html__( 'Hide', 'themesflat-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'award_name', [
                'label'       => esc_html__( 'Award Name', 'themesflat-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Website of the Day' , 'themesflat-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'award_org', [
                'label'   => esc_html__( 'Organization', 'themesflat-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'CSSDA' , 'themesflat-core' ),
            ]
        );

        $repeater->add_control(
            'award_year', [
                'label'   => esc_html__( 'Year', 'themesflat-core' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '2019' , 'themesflat-core' ),
            ]
        );

        $repeater->add_control(
            'award_image',
            [
                'label'   => esc_html__( 'Hover Image', 'themesflat-core' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'award_list',
            [
                'label'       => esc_html__( 'Award Items', 'themesflat-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'award_name' => esc_html__( 'Website of the Day', 'themesflat-core' ),
                        'award_org'  => esc_html__( 'CSSDA', 'themesflat-core' ),
                        'award_year' => '2019',
                    ],
                ],
                'title_field' => '{{{ award_name }}}',
            ]
        );

        $this->end_controls_section();

		// --- Style Section: Section Container ---
        $this->start_controls_section(
            'section_container',
            [
                'label' => esc_html__( 'Section Container', 'themesflat-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'section_background',
                'label'    => esc_html__( 'Background', 'themesflat-core' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .section-about',
            ]
        );

        $this->add_responsive_control(
            'section_padding',
            [
                'label'      => esc_html__( 'Padding', 'themesflat-core' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors'  => [
                    '{{WRAPPER}} .section-about' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'section_margin',
            [
                'label'      => esc_html__( 'Margin', 'themesflat-core' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors'  => [
                    '{{WRAPPER}} .section-about' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		 $this->end_controls_section();

		$this->start_controls_section(
            'section_tag_style',
            [
                'label' => esc_html__( 'Tag', 'themesflat-core' ),
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

        $this->end_controls_section();

        // --- Style Section: Title & Description ---
        $this->start_controls_section(
            'section_title_desc_style',
            [
                'label' => esc_html__( 'Title & Description', 'themesflat-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_title',
            [
                'label' => esc_html__( 'Title', 'themesflat-core' ),
                'type'  => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .s-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', 'themesflat-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .s-title' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => esc_html__( 'Padding', 'themesflat-core' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [ '{{WRAPPER}} .s-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => esc_html__( 'Margin', 'themesflat-core' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [ '{{WRAPPER}} .s-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_control(
            'heading_description',
            [
                'label'     => esc_html__( 'Description', 'themesflat-core' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'selector' => '{{WRAPPER}} .s-desc',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => esc_html__( 'Color', 'themesflat-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .s-desc' => 'color: {{VALUE}};' ],
            ]
        );

        $this->add_responsive_control(
            'description_padding',
            [
                'label'      => esc_html__( 'Padding', 'themesflat-core' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [ '{{WRAPPER}} .s-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_responsive_control(
            'description_margin',
            [
                'label'      => esc_html__( 'Margin', 'themesflat-core' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [ '{{WRAPPER}} .s-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->end_controls_section();

        // --- Style Section: Award Items ---
        $this->start_controls_section(
            'section_awards_style',
            [
                'label' => esc_html__( 'Award Items', 'themesflat-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'award_item_border',
                'selector' => '{{WRAPPER}} .award-item',
            ]
        );

        $this->add_responsive_control(
            'award_item_padding',
            [
                'label'      => esc_html__( 'Padding', 'themesflat-core' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [ '{{WRAPPER}} .award-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );

        $this->add_responsive_control(
            'award_item_margin',
            [
                'label'      => esc_html__( 'Margin', 'themesflat-core' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [ '{{WRAPPER}} .award-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            ]
        );
		// Award Name Style
        $this->add_control( 'heading_award_name', [ 'label' => esc_html__( 'Award Name', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ] );
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [ 'name' => 'award_name_typography', 'selector' => '{{WRAPPER}} .award_name' ] );
        $this->add_control( 'award_name_color', [ 'label' => esc_html__( 'Color', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .award_name' => 'color: {{VALUE}};' ] ] );
        $this->add_responsive_control( 'award_name_margin', [ 'label' => esc_html__( 'Margin', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::DIMENSIONS, 'selectors' => [ '{{WRAPPER}} .award_name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );

        // Organization Style
        $this->add_control( 'heading_award_org', [ 'label' => esc_html__( 'Organization', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ] );
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [ 'name' => 'award_org_typography', 'selector' => '{{WRAPPER}} .award_desc' ] );
        $this->add_control( 'award_org_color', [ 'label' => esc_html__( 'Color', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .award_desc' => 'color: {{VALUE}};' ] ] );
        $this->add_responsive_control( 'award_org_margin', [ 'label' => esc_html__( 'Margin', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::DIMENSIONS, 'selectors' => [ '{{WRAPPER}} .award_desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );

        // Year Style
        $this->add_control( 'heading_award_year', [ 'label' => esc_html__( 'Year', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ] );
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [ 'name' => 'award_year_typography', 'selector' => '{{WRAPPER}} .award_year' ] );
        $this->add_control( 'award_year_color', [ 'label' => esc_html__( 'Color', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .award_year' => 'color: {{VALUE}};' ] ] );
        $this->add_responsive_control( 'award_year_margin', [ 'label' => esc_html__( 'Margin', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::DIMENSIONS, 'selectors' => [ '{{WRAPPER}} .award_year' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );

        // Hover Image Style
        $this->add_control( 'heading_hover_image', [ 'label' => esc_html__( 'Hover Image', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ] );
        $this->add_responsive_control( 'hover_image_width', [ 'label' => esc_html__( 'Width', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::SLIDER, 'size_units' => [ 'px', '%' ], 'range' => [ 'px' => [ 'max' => 500 ] ], 'selectors' => [ '{{WRAPPER}} .award_img img' => 'width: {{SIZE}}{{UNIT}}; height: auto;' ] ] );
        $this->add_responsive_control( 'hover_image_height', [ 'label' => esc_html__( 'Height', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::SLIDER, 'size_units' => [ 'px' ], 'range' => [ 'px' => [ 'max' => 500 ] ], 'selectors' => [ '{{WRAPPER}} .award_img img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;' ] ] );
        $this->add_control( 'hover_image_border_radius', [ 'label' => esc_html__( 'Border Radius', 'themesflat-core' ), 'type' => \Elementor\Controls_Manager::DIMENSIONS, 'selectors' => [ '{{WRAPPER}} .award_img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );

		$this->end_controls_section();
	}


	// ============================
	// RENDER
	// ============================
	protected function render() {
        $settings = $this->get_settings_for_display();
        
        // Define the HTML tag dynamically
        $header_tag = $settings['title_tag'];
        ?>
<div class="section-about flat-spacing">
    <div class="sect-tag text-caption fw-medium effectFade fadeUp no-div">
        <?php if ( ! empty( $settings['tag_icon']['value'] ) ) : ?>
        <span class="tag-icon">
            <?php \Elementor\Icons_Manager::render_icon( $settings['tag_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </span>
        <?php endif; ?>
        <?php echo esc_html( $settings['tag_text'] ); ?>
    </div>

    <<?php echo esc_attr( $header_tag ); ?> class="s-title letter-space--2 text-black-72 split-text effect-blur-fade">
        <?php echo wp_kses_post( $settings['title'] ); ?>
    </<?php echo esc_attr( $header_tag ); ?>>

    <div class="s-desc text-black-56 scrolling-effect effectTop">
        <?php echo wp_kses_post( $settings['description'] ); ?>
    </div>

    <?php 
if ( 'yes' === $settings['show_awards'] && ! empty( $settings['award_list'] ) ) : 
?>
    <ul class="award-list">
        <?php foreach ( $settings['award_list'] as $item ) : ?>
            <li class="award-item hover-cursor-img elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                <div class="left">
                    <h6 class="award_name letter-space--2 text-black-72">
                        <?php echo esc_html( $item['award_name'] ); ?>
                    </h6>
                    <p class="award_desc text-black-56">
                        <?php echo esc_html( $item['award_org'] ); ?>
                    </p>
                </div>
                
                <h6 class="award_year text-black-72">
                    <?php echo esc_html( $item['award_year'] ); ?>
                </h6>

                <?php if ( ! empty( $item['award_image']['url'] ) ) : ?>
                    <div class="award_img hover-image">
                        <img loading="lazy" width="158" height="224" 
                             src="<?php echo esc_url( $item['award_image']['url'] ); ?>"
                             alt="<?php echo esc_attr( $item['award_name'] ); ?>">
                    </div>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
</div>
<?php
    }
}