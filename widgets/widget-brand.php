<?php 
class TFBrand_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'tf-split-text'; }
    public function get_title() { return esc_html__( 'TF Brand', 'themesflat-core' ); }
    public function get_icon() { return 'eicon-banner'; }
    public function get_categories() { return [ 'themesflat_addons' ]; }
    
    public function get_style_depends() { return [ 'styles' ]; }
    public function get_script_depends() {
      
        return [ 
            'gsap', 
            'ScrollTrigger', 
            'SplitText', 
            'infinityslide',
            'main' 
        ];
    }

    protected function register_controls() {

        // --- SECTION: CONTENT ---
        $this->start_controls_section('section_content', [
            'label' => esc_html__( 'Content', 'themesflat-core' ),
        ]);

        $this->add_control('title_text', [
            'label' => 'Title Text',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Our clients (2015-25©)',
            'label_block' => true,
        ]);

        $this->add_control('custom_icon', [
            'label' => 'Custom Icon (SVG/Image)',
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'icon-global-elip',
                'library' => 'custom-icons',
            ],
        ]);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('brand_logo', [
            'label' => 'Brand Logo (Light)',
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
        ]);

        $repeater->add_control('brand_logo_dark', [
            'label' => 'Brand Logo (Dark Mode)',
            'type' => \Elementor\Controls_Manager::MEDIA,
            'description' => 'Sử dụng cho thuộc tính data-dark',
        ]);

        $repeater->add_control('logo_width', [
            'label' => 'Logo Width',
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 132,
        ]);

        $this->add_control('brands', [
            'label' => esc_html__( 'Brand List', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [ 'logo_width' => 132 ],
                [ 'logo_width' => 122 ],
            ],
            'title_field' => 'Brand Item',
        ]);

        $this->end_controls_section();

        // --- SECTION: STYLE ---
        $this->start_controls_section('section_style', [
            'label' => esc_html__( 'Style', 'themesflat-core' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('brand_padding', [
            'label' => 'Padding',
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors' => [ '{{WRAPPER}} .infiniteSlide-brand' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);

        $this->add_control('title_heading', [ 'label' => 'Title Style', 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ]);
        $this->add_control('title_color', [ 'label' => 'Color', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .intro-client' => 'color: {{VALUE}};' ] ]);
        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [ 'name' => 'title_typo', 'selector' => '{{WRAPPER}} .intro-client' ]);

        $this->add_control('icon_heading', [ 'label' => 'Icon Style', 'type' => \Elementor\Controls_Manager::HEADING, 'separator' => 'before' ]);
        $this->add_responsive_control('icon_size', [
            'label' => 'Icon Size',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'selectors' => [ '{{WRAPPER}} .intro-client i, {{WRAPPER}} .intro-client svg' => 'font-size: {{SIZE}}px; width: {{SIZE}}px;' ],
        ]);
        $this->add_control('icon_color', [ 'label' => 'Icon Color', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .intro-client i, {{WRAPPER}} .intro-client svg' => 'color: {{VALUE}}; fill: {{VALUE}};' ] ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        // Thêm class .split-text và một hiệu ứng (ví dụ effect-fade) để JS bắt được
        ?>
        <p class="intro-client split-text effect-fade letter-space--05 text-body-3">
            <?php if ( ! empty( $settings['custom_icon']['value'] ) ) : ?>
                <span class="icon-wrap">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['custom_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </span>
            <?php else : ?>
                <i class="icon icon-global-elip"></i>
            <?php endif; ?>
            <?php echo esc_html($settings['title_text']); ?>
        </p>

        <div class="infiniteSlide-brand">
            <div class="infiniteSlide" data-clone="3" data-speed="50"> 
                <?php 
                for ($i = 0; $i < 3; $i++) : 
                    foreach ( $settings['brands'] as $item ) : 
                        $logo_url = !empty($item['brand_logo']['url']) ? $item['brand_logo']['url'] : '';
                        $dark_url = !empty($item['brand_logo_dark']['url']) ? $item['brand_logo_dark']['url'] : $logo_url;
                        ?>
                        <div class="image-brand">
                            <img class="image-switch" 
                                 data-dark="<?php echo esc_url($dark_url); ?>" 
                                 width="<?php echo esc_attr($item['logo_width']); ?>" 
                                 src="<?php echo esc_url($logo_url); ?>" 
                                 alt="Brand Logo">
                        </div>
                    <?php 
                    endforeach; 
                endfor; 
                ?>
            </div>
        </div>
        <?php
    }
}