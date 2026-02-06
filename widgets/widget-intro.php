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
        $this->start_controls_section(
            'section_layout',
            [ 'label' => esc_html__( 'Layout', 'themesflat-core' ) ]
        );

        $this->add_control(
            'layout_style',
            [
                'label'   => esc_html__( 'Select Style', 'themesflat-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'type-1',
                'options' => [
                    'type-1' => esc_html__( 'Style 1: Minimalist', 'themesflat-core' ),
                    'type-2' => esc_html__( 'Style 2: Creative Gallery', 'themesflat-core' ),
                    'type-3' => esc_html__( 'Style 3: Personal Portfolio', 'themesflat-core' ),
                ],
            ]
        );
        $this->end_controls_section();

        // --- SECTION: AUTHOR ---
        $this->start_controls_section(
            'section_author',
            [
                'label' => esc_html__( 'Intro Author', 'themesflat-core' ),
                'condition' => [ 'layout_style' => ['type-1', 'type-3'] ],
            ]
        );

        $this->add_control(
            'author_image',
            [
                'label' => esc_html__( 'Author Image', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
            ]
        );

        $this->add_control(
            'author_name',
            [
                'label' => esc_html__( 'Name', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Alexander Isak',
            ]
        );

        $this->add_control(
            'author_duty',
            [
                'label' => esc_html__( 'Duty/Job', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'UI Designer & No-Code Developer',
            ]
        );
        $this->end_controls_section();

        // --- SECTION: CONTENT ---
        $this->start_controls_section(
            'section_content',
            [ 'label' => esc_html__( 'Main Content', 'themesflat-core' ) ]
        );

        $this->add_control(
            'main_text',
            [
                'label' => esc_html__('Main Text', 'themesflat-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Start building websites & brands people remember',
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'text',
            [
                'label' => esc_html__('Highlight Text', 'themesflat-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'highlight_style',
            [
                'label' => esc_html__('Style', 'themesflat-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'green-white',
                'options' => [
                    'green-white' => 'Green / White BG',
                    'green-dark'  => 'Green / Dark BG',
                ],
            ]
        );

        $this->add_control(
            'highlights',
            [
                'label' => esc_html__('Highlight Words', 'themesflat-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->add_control( 'exp_number', [ 'label' => 'Experience Number', 'type' => \Elementor\Controls_Manager::NUMBER, 'default' => 10 ] );
        $this->add_control( 'exp_text', [ 'label' => 'Experience Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Year of experience' ] );
        $this->add_control( 'award_number', [ 'label' => 'Awards Number', 'type' => \Elementor\Controls_Manager::NUMBER, 'default' => 6 ] );
        $this->add_control( 'award_text', [ 'label' => 'Awards Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Industry Awards' ] );

        $this->end_controls_section();

        // --- SECTION: SPECIAL ASSETS (Sửa lỗi ID ở đây) ---
        $this->start_controls_section(
            'section_special_assets',
            [
                'label' => esc_html__( 'Special Assets', 'themesflat-core' ),
                'condition' => [ 'layout_style' => ['type-1', 'type-3'] ],
            ]
        );

        $this->add_control( 'upload_svg_scribble', [
            'label' => 'Scribble SVG',
            'type' => \Elementor\Controls_Manager::MEDIA,
        ]);

        $this->add_control( 'upload_svg_curve_icon', [
            'label' => 'Curve Text Icon',
            'type' => \Elementor\Controls_Manager::MEDIA,
        ]);

        $this->add_control( 'curve_text', [
            'label' => 'Circular Text',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'CREATIVE • DIGITAL • DESIGN • ',
        ]);

        $this->end_controls_section();

        // --- SECTION: GALLERY ---
        $this->start_controls_section(
            'section_gallery',
            [ 'label' => 'Gallery (Style 2)', 'condition' => [ 'layout_style' => 'type-2' ] ]
        );
        $this->add_control( 'gallery_list', [
            'label' => 'Images',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => [ ['name' => 'image', 'type' => \Elementor\Controls_Manager::MEDIA] ],
        ]);
        $this->end_controls_section();

        // --- SECTION: BRANDS ---
        $this->start_controls_section(
            'section_brands',
            [ 'label' => 'Clients Brands' ]
        );
        $this->add_control( 'client_text', [ 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Our clients' ] );
        $this->add_control( 'brand_list', [
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => [
                ['name' => 'brand_img', 'label' => 'Light', 'type' => \Elementor\Controls_Manager::MEDIA],
                ['name' => 'brand_img_dark', 'label' => 'Dark', 'type' => \Elementor\Controls_Manager::MEDIA],
            ],
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        $s = $this->get_settings_for_display();
        $style = $s['layout_style'];

        // Xử lý Highlight
        $main_text = $s['main_text'];
        if ( ! empty( $s['highlights'] ) ) {
            foreach ( $s['highlights'] as $item ) {
                if(empty($item['text'])) continue;
                $class = ( $item['highlight_style'] === 'green-dark' ) ? 'type-2' : '';
                $replacement = '<span class="' . esc_attr( $class ) . '">' . esc_html( $item['text'] ) . '</span>';
                $main_text = str_replace( $item['text'], $replacement, $main_text );
            }
        }
        $main_text = nl2br( $main_text );
        ?>

<div class="tf-intro-widget">
    <?php if ( 'type-1' === $style ) : ?>
    <div class="section-intro flat-spacing">
        <div class="intro-author effectFade fadeUp no-div">
            <div class="author-image"><img src="<?php echo esc_url($s['author_image']['url']); ?>"></div>
            <div class="author-info">
                <p class="info_name text-black"><?php echo esc_html($s['author_name']); ?></p>
                <p class="info_duty text-black-50 text-body-3"><?php echo esc_html($s['author_duty']); ?></p>
            </div>
        </div>
        <h1 class="intro-title split-text"><?php echo $main_text; ?></h1>

        <div class="intro-item">
            <div class="scribble-wrap"><img src="<?php echo esc_url($s['upload_svg_scribble']['url']); ?>"></div>
            <div class="wg-curve-text">
                <div class="icon"><img src="<?php echo esc_url($s['upload_svg_curve_icon']['url']); ?>"></div>
                <div class="text-rotate">
                    <div class="circle">
                        <div class="text" data-text="<?php echo esc_attr($s['curve_text']); ?>"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->render_counter($s); ?>
        <?php $this->render_brands($s); ?>
    </div>

    <?php elseif ( 'type-2' === $style ) : ?>
    <div class="section-intro type-2 flat-spacing">
        <h1 class="s-title split-text"><?php echo $main_text; ?></h1>
        <?php $this->render_counter($s); ?>
        <?php if ($s['gallery_list']) : ?>
        <div class="flip-image-list">
            <?php foreach ($s['gallery_list'] as $img) : ?>
            <div class="flip-image"><img src="<?php echo esc_url($img['image']['url']); ?>"></div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php $this->render_brands($s); ?>
    </div>

    <?php elseif ( 'type-3' === $style ) : ?>
    <div class="section-intro type-3 flat-spacing">
        <div class="intro-author">
            <div class="author-image"><img src="<?php echo esc_url($s['author_image']['url']); ?>"></div>
            <div class="author-info">
                <p class="info_name"><?php echo esc_html($s['author_name']); ?></p>
                <p class="info_duty"><?php echo esc_html($s['author_duty']); ?></p>
            </div>
        </div>
        <h1 class="intro-title split-text"><?php echo $main_text; ?></h1>
        <div class="counter-image-item">
            <?php $this->render_counter($s); ?>
            <div class="image-item">
                <div class="image"><img src="<?php echo esc_url($s['upload_svg_scribble']['url']); ?>"></div>
                <div class="wg-curve-text style-2">
                    <div class="icon"><img src="<?php echo esc_url($s['upload_svg_curve_icon']['url']); ?>"></div>
                </div>
            </div>
        </div>
        <?php $this->render_brands($s); ?>
    </div>
    <?php endif; ?>
</div>
<?php
    }

    protected function render_counter($s) {
        ?>
<div class="box-counter">
    <div class="wg-counter">
        <p class="counter h1 d-flex font-2 letter-space--2"><span class="number"
                data-to="<?php echo esc_attr($s['exp_number']); ?>">0</span>+</p>
        <p class="text text-black-56 text-body-3"><?php echo esc_html($s['exp_text']); ?></p>
    </div>
    <div class="wg-counter">
        <p class="counter h1 d-flex font-2 letter-space--2"><span class="number"
                data-to="<?php echo esc_attr($s['award_number']); ?>">0</span>x</p>
        <p class="text text-black-56 text-body-3"><?php echo esc_html($s['award_text']); ?></p>
    </div>
</div>
<?php
    }

    protected function render_brands($s) {
        if ( empty( $s['brand_list'] ) ) return;
        ?>
<p class="intro-client"><i class="icon icon-global-elip"></i><?php echo esc_html($s['client_text']); ?></p>
<div class="infiniteSlide-brand">
    <div class="infiniteSlide" data-clone="3">
        <?php foreach ( $s['brand_list'] as $brand ) : 
                    $img_l = $brand['brand_img']['url'];
                    $img_d = !empty($brand['brand_img_dark']['url']) ? $brand['brand_img_dark']['url'] : $img_l;
                    if($img_l): ?>
        <div class="image-brand" style="display:inline-block;">
            <img class="image-switch" data-dark="<?php echo esc_url($img_d); ?>" src="<?php echo esc_url($img_l); ?>">
        </div>
        <?php endif;
                endforeach; ?>
    </div>
</div>
<?php
    }
}