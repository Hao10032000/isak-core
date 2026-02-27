<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit;

class TFWork_Widget extends Widget_Base {

    public function get_name() {
        return 'tf-work';
    }

    public function get_title() {
        return esc_html__( 'TF Work', 'themesflat-core' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

    public function get_style_depends() { 
        return [ 'tf-work' ];
    }

    /* ================= CONTROLS ================= */

    protected function register_controls() {

    /* ---------- QUERY ---------- */
    $this->start_controls_section(
        'section_query',
        ['label' => esc_html__('Query', 'themesflat-core')]
    );

    $this->add_control(
        'posts_per_page',
        [
            'label' => esc_html__('Posts Per Page', 'themesflat-core'),
            'type' => Controls_Manager::NUMBER,
            'default' => 3,
        ]
    );

    $this->add_control(
        'order_by',
        [
            'label' => esc_html__('Order By', 'themesflat-core'),
            'type' => Controls_Manager::SELECT,
            'default' => 'date',
            'options' => [
                'date'  => 'Date',
                'ID'    => 'ID',
                'title' => 'Title',
            ],
        ]
    );

    $this->add_control(
        'order',
        [
            'label' => esc_html__('Order', 'themesflat-core'),
            'type' => Controls_Manager::SELECT,
            'default' => 'DESC',
            'options' => [
                'ASC'  => 'ASC',
                'DESC' => 'DESC',
            ],
        ]
    );

    $this->add_control(
        'work_tags',
        [
            'label' => esc_html__('Work Tags', 'themesflat-core'),
            'type' => Controls_Manager::SELECT2,
            'options' => tf_get_taxonomy_terms('work_tag'),
            'multiple' => true,
            'label_block' => true,
        ]
    );

    $this->end_controls_section();

    /* ---------- CONTENT ---------- */
    $this->start_controls_section(
        'section_content',
        ['label' => esc_html__('Content', 'themesflat-core')]
    );

    $this->add_control(
        'section_title',
        [
            'label' => esc_html__('Section Title', 'themesflat-core'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Work Highlights',
        ]
    );

    $this->add_control(
        'show_desc',
        [
            'label' => esc_html__('Show Description', 'themesflat-core'),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]
    );

    $this->add_control(
        'label_year',
        [
            'label' => esc_html__('Label Year', 'themesflat-core'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Year',
        ]
    );

    $this->add_control(
        'show_year',
        [
            'label' => esc_html__('Show Year', 'themesflat-core'),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]
    );

    $this->add_control(
        'label_role',
        [
            'label' => esc_html__('Label Role', 'themesflat-core'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Role',
        ]
    );

     $this->add_control(
        'show_role',
        [
            'label' => esc_html__('Show Role', 'themesflat-core'),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]
    );

    $this->add_control(
        'show_tags',
        [
            'label' => esc_html__('Show Tags', 'themesflat-core'),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]
    );

    $this->add_control( 
        'button_text',
        [
            'label' => esc_html__( 'Button Text', 'themesflat-core' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__( 'View Work', 'themesflat-core' ),
        ]
    );	

    $this->end_controls_section();

    /* ---------- STYLE: TITLE ---------- */

     $this->start_controls_section(
        'section_style_heading',
        [
            'label' => esc_html__('Heading Section', 'themesflat-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'heading_color',
        [
            'label' => esc_html__('Color', 'themesflat-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .section-work .sect-tag' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'heading_bgcolor',
        [
            'label' => esc_html__('Background Color', 'themesflat-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .section-work .sect-tag' => 'background: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'heading_typography',
            'selector' => '{{WRAPPER}} .section-work .sect-tag',
        ]
    );
    $this->end_controls_section();
    $this->start_controls_section(
        'section_style_title',
        [
            'label' => esc_html__('Title', 'themesflat-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'title_color',
        [
            'label' => esc_html__('Color', 'themesflat-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .w-title' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'title_typography',
            'selector' => '{{WRAPPER}} .w-title',
        ]
    );

    $this->end_controls_section();

    /* ---------- STYLE: DESC ---------- */
    $this->start_controls_section(
        'section_style_desc',
        [
            'label' => esc_html__('Description', 'themesflat-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'desc_color',
        [
            'label' => esc_html__('Color', 'themesflat-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .w-desc' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'desc_typography',
            'selector' => '{{WRAPPER}} .w-desc',
        ]
    );

    $this->end_controls_section();
    /* ---------- STYLE: Meta ---------- */
    $this->start_controls_section(
        'section_style_meta',
        [
            'label' => esc_html__('Meta', 'themesflat-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'meta_color',
        [
            'label' => esc_html__('Color Label', 'themesflat-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wg-work .w-highlight .text-body-3.text-white-56' => 'color: {{VALUE}}',
            ],
        ]
    );

     $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'meta_typography',
            'selector' => '{{WRAPPER}} .wg-work .w-highlight .text-body-3.text-white-56',
        ]
    );

    $this->add_control(
        'meta2_color',
        [
            'label' => esc_html__('Color Text', 'themesflat-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wg-work .w-highlight .text-body-1.text-white-72' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'meta2_typography',
            'selector' => '{{WRAPPER}} .wg-work .w-highlight .text-body-1.text-white-72',
        ]
    );

   $this->end_controls_section();
    /* ---------- STYLE: Tag ---------- */
    $this->start_controls_section(
        'section_style_tag',
        [
            'label' => esc_html__('Tag', 'themesflat-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'tag_color',
        [
            'label' => esc_html__('Color', 'themesflat-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wg-work .w-tag-list .tag ' => 'color: {{VALUE}}',
            ],
        ]
    );

     $this->add_control(
        'tag_bgcolor',
        [
            'label' => esc_html__('Background Color', 'themesflat-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wg-work .w-tag-list .tag ' => 'background: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'tag_typography',
            'selector' => '{{WRAPPER}} .wg-work .w-tag-list .tag ',
        ]
    );
    $this->end_controls_section();
    /* ---------- STYLE: Button ---------- */
    $this->start_controls_section(
        'section_style_button',
        [
            'label' => esc_html__('Button', 'themesflat-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'button_color',
        [
            'label' => esc_html__('Color', 'themesflat-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wg-work .tf-btn-action.style-white .ic-wrap,{{WRAPPER}}  .wg-work .tf-btn-action.style-white .text ' => 'color: {{VALUE}}',
            ],
        ]
    );

     $this->add_control(
        'button_bgcolor',
        [
            'label' => esc_html__('Background Color', 'themesflat-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wg-work .tf-btn-action.style-white .ic-wrap,{{WRAPPER}}  .wg-work .tf-btn-action.style-white .text ' => 'background: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'button_typography',
            'selector' => '{{WRAPPER}} .wg-work .tf-btn-action.style-white .ic-wrap,{{WRAPPER}}  .wg-work .tf-btn-action.style-white .text ',
        ]
    );
    $this->end_controls_section();
    /* ---------- STYLE: Pagination ---------- */
    $this->start_controls_section(
        'section_style_pagi',
        [
            'label' => esc_html__('Pagination', 'themesflat-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'pagi_color',
        [
            'label' => esc_html__('Color', 'themesflat-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .text-white-40' => 'color: {{VALUE}}',
            ],
        ]
    );

     $this->add_control(
        'pagi_bgcolor',
        [
            'label' => esc_html__('Color Active', 'themesflat-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wg-work .text-white-72' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'pagi_typography',
            'selector' => '{{WRAPPER}} .text-white-40text-white-40',
        ]
    );


    $this->end_controls_section();
    }

    /* ================= RENDER ================= */

    protected function render() {

        $settings = $this->get_settings_for_display();

        $args = [
            'post_type' => 'work',
            'posts_per_page' => $settings['posts_per_page'],
            'orderby' => $settings['order_by'],
            'order' => $settings['order'],
        ];

        if ( ! empty( $settings['work_tags'] ) ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'work_tag',
                    'field'    => 'slug',
                    'terms'    => $settings['work_tags'],
                ]
            ];
        }

        $query = new WP_Query( $args );
        if ( ! $query->have_posts() ) return;
        ?>

<div class="section-work flat-spacing">
    <div class="sect-tag text-caption fw-medium">
        <i class="icon icon-isak-high-light"></i>
        <?php echo esc_html( $settings['section_title'] ); ?>
    </div>

    <div class="work-list element-sticky">
        <?php
        $i = 1;
        $total = $query->post_count;

        while ( $query->have_posts() ) :
            $query->the_post();

            $desc = get_post_meta( get_the_ID(), '_work_short_desc', true );
            $year = get_post_meta( get_the_ID(), '_work_ref', true );
            $role = get_post_meta( get_the_ID(), '_work_position', true );
            $img  = get_the_post_thumbnail_url( get_the_ID(), 'large' );
            $tags = get_the_terms( get_the_ID(), 'work_tag' );
            $image_id = get_post_meta( get_the_ID(), '_work_image_id', true );
           
        ?>
        <div class="sticky-item">
            <div class="wg-work">
                <div class="work-image">
                    <img src="<?php echo esc_url($img); ?>" alt="<?php the_title(); ?>">
                </div>

                <div class="wrap">
                    <div class="work-content">
                        <div class="w-image">
                            <img src="<?php echo esc_url($img); ?>" alt="<?php the_title(); ?>">
                        </div>
                        <div class="content">
                            <div class="content-top">
                                <?php
                                if ( $image_id ) : ?>
                                    <div class="w-logo">
                                        <?php  echo wp_get_attachment_image( $image_id, 'full' ); ?>
                                    </div>
                                <?php endif; ?>
                                <h4 class="w-title letter-space--2 text-white-72">
                                <?php the_title(); ?>
                                </h4>
                            <?php if ( $settings['show_desc'] === 'yes' ) : ?>
                                    <p class="w-desc text-white-56 text-body-3"><?php echo esc_html( $desc ); ?></p>
                                <?php endif; ?>
                                <?php if ( $settings['show_year'] === 'yes' || $settings['show_role'] === 'yes') : ?>
                                    <div class="w-highlight">
                                        <?php if ( $settings['show_year'] === 'yes' ) : ?>
                                            <div class="box-high">
                                                <p class="text-body-3 text-white-56"><?php echo esc_html( $settings['label_year'] ); ?></p>
                                                <p class="text-body-1 text-white-72"><?php echo esc_html($year); ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ( $settings['show_role'] === 'yes' ) : ?>
                                            <div class="box-high">
                                                <p class="text-body-3 text-white-56"><?php echo esc_html( $settings['label_role'] ); ?></p>
                                                <p class="text-body-1 text-white-72"><?php echo esc_html($role); ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ( $settings['show_tags'] === 'yes' && $tags ) : 
                                    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                                    ?>
                                    
                                    <div class="w-tag-list">
                                        <?php foreach ( $tags as $tag ) : ?>
                                            <div class="tag"><span><?php echo esc_html($tag->name); ?></span></div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php } endif; ?>
                            </div>
                            <div class="content-bottom">
                                <div class="br-line"></div>
                                <div class="group-action">
                                    <a href="<?php the_permalink(); ?>" class="tf-btn-action style-white">
                                        <span class="ic-wrap">
                                            <i class="icon icon-isak-arrow-right-top"></i>
                                        </span>
                                        <span class="text text-body-3 letter-space--05 fw-medium">
                                          <?php echo esc_html($settings['button_text']); ?>
                                        </span>
                                        <span class="ic-wrap">
                                            <i class="icon icon-isak-arrow-right-top"></i>
                                        </span>
                                    </a>
                                    <p class="text-white-40">
                                        <span class="text-white-72"><?php echo $i; ?></span> / <?php echo $total; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $i++; endwhile; wp_reset_postdata(); ?>
    </div>
</div>

<?php }
}
