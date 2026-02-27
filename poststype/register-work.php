<?php
/**
 * =====================================================
 * CUSTOM POST TYPE: WORK (ELEMENTOR READY)
 * =====================================================
 */

/**
 * 1. Register CPT: Work
 */
function create_work_cpt() {

    $labels = array(
        'name'          => 'Works',
        'singular_name' => 'Work',
        'menu_name'     => 'Works',
        'add_new'       => 'Add New',
        'add_new_item'  => 'Add New Work',
        'edit_item'     => 'Edit Work',
        'new_item'      => 'New Work',
        'view_item'     => 'View Work',
        'all_items'     => 'All Works',
    );

    $args = array(
        'label'              => 'Work',
        'labels'             => $labels,

        // 🔥 BẮT BUỘC CHO ELEMENTOR
        'show_in_rest'       => true,

        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-businessman',
        'has_archive'        => true,
        'publicly_queryable' => true,

        // Elementor cần editor
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'revisions',
        ),
    );

    register_post_type( 'work', $args );
}
add_action( 'init', 'create_work_cpt' );


/**
 * =====================================================
 * 2. TAXONOMY
 * =====================================================
 */
function create_work_taxonomies() {

    register_taxonomy( 'work_tag', 'work', array(
        'label'        => 'Tags',
        'hierarchical' => false,
        'show_ui'      => true,
        'show_in_rest' => true,
        'rewrite'      => array( 'slug' => 'work-tag' ),
    ));
}
add_action( 'init', 'create_work_taxonomies' );


/**
 * =====================================================
 * 3. META BOXES (ALL IN SIDE)
 * =====================================================
 */
function work_add_meta_boxes() {

    // Short Description (SIDE)
    add_meta_box(
        'work_short_desc_meta',
        'Short Description',
        'work_short_desc_callback',
        'work',
        'side',
        'high'
    );

    // Year / Ref
    add_meta_box(
        'work_ref_meta',
        'Year / Ref',
        'work_ref_callback',
        'work',
        'side',
        'default'
    );

    // Position
    add_meta_box(
        'work_position_meta',
        'Position / Role',
        'work_position_callback',
        'work',
        'side',
        'default'
    );

     add_meta_box(
        'work_image_meta',
        'Work Image',
        'work_image_callback',
        'work',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'work_add_meta_boxes' );


/**
 * Render: Short Description
 */
function work_short_desc_callback( $post ) {
    wp_nonce_field( 'work_save_meta', 'work_meta_nonce' );
    $value = get_post_meta( $post->ID, '_work_short_desc', true );
    ?>
    <textarea
        name="work_short_desc"
        rows="4"
        style="width:100%;"
        placeholder="Short description..."
    ><?php echo esc_textarea( $value ); ?></textarea>
    <?php
}

/**
 * Render: Year / Ref
 */
function work_ref_callback( $post ) {
    $value = get_post_meta( $post->ID, '_work_ref', true );
    ?>
    <input
        type="number"
        name="work_ref"
        value="<?php echo esc_attr( $value ); ?>"
        style="width:100%;"
        placeholder="Ex: 2024"
    >
    <?php
}

/**
 * Render: Position
 */
function work_position_callback( $post ) {
    $value = get_post_meta( $post->ID, '_work_position', true );
    ?>
    <input
        type="text"
        name="work_position"
        value="<?php echo esc_attr( $value ); ?>"
        style="width:100%;"
        placeholder="Ex: Frontend Developer"
    >
    <?php
}

function work_image_callback( $post ) {

    $image_id  = get_post_meta( $post->ID, '_work_image_id', true );
    $image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'medium' ) : '';
    ?>

    <div class="work-image-wrapper">
        <img
            id="work-image-preview"
            src="<?php echo esc_url( $image_url ); ?>"
            style="width:100%; <?php echo $image_url ? '' : 'display:none;'; ?>"
        />

        <input type="hidden" id="work_image_id" name="work_image_id" value="<?php echo esc_attr( $image_id ); ?>">

        <button type="button" class="button button-primary" id="work-image-upload" style="margin-top:10px;">
            <?php echo esc_html__( 'Select Image','themesflat' ); ?>
        </button>

        <button type="button" class="button" id="work-image-remove" style="margin-top:10px; <?php echo $image_url ? '' : 'display:none;'; ?>">
            <?php echo esc_html__( 'Remove Image','themesflat' ); ?>
        </button>
    </div>

    <?php
}

/**
 * =====================================================
 * 4. SAVE META DATA
 * =====================================================
 */
function work_save_meta_data( $post_id ) {

    if ( ! isset( $_POST['work_meta_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['work_meta_nonce'], 'work_save_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['work_short_desc'] ) ) {
        update_post_meta(
            $post_id,
            '_work_short_desc',
            sanitize_textarea_field( $_POST['work_short_desc'] )
        );
    }

    if ( isset( $_POST['work_ref'] ) ) {
        update_post_meta(
            $post_id,
            '_work_ref',
            sanitize_text_field( $_POST['work_ref'] )
        );
    }

    if ( isset( $_POST['work_position'] ) ) {
        update_post_meta(
            $post_id,
            '_work_position',
            sanitize_text_field( $_POST['work_position'] )
        );
    }

    if ( isset( $_POST['work_image_id'] ) ) {
        update_post_meta(
            $post_id,
            '_work_image_id',
            intval( $_POST['work_image_id'] )
        );
    }
}
add_action( 'save_post', 'work_save_meta_data' );

function work_image_admin_scripts( $hook ) {

    // Chỉ load ở trang edit / add post
    if ( ! in_array( $hook, [ 'post.php', 'post-new.php' ] ) ) {
        return;
    }

    $screen = get_current_screen();
    if ( $screen->post_type !== 'work' ) {
        return;
    }

    wp_enqueue_media();

    wp_add_inline_script(
        'jquery-core',
        "
        jQuery(document).ready(function ($) {

            let frame;

            $('#work-image-upload').on('click', function (e) {
                e.preventDefault();

                if (frame) {
                    frame.open();
                    return;
                }

                frame = wp.media({
                    title: 'Select Work Image',
                    button: { text: 'Use this image' },
                    multiple: false
                });

                frame.on('select', function () {
                    const attachment = frame.state().get('selection').first().toJSON();

                    $('#work_image_id').val(attachment.id);
                    $('#work-image-preview').attr('src', attachment.url).show();
                    $('#work-image-remove').show();
                });

                frame.open();
            });

            $('#work-image-remove').on('click', function (e) {
                e.preventDefault();
                $('#work_image_id').val('');
                $('#work-image-preview').hide();
                $(this).hide();
            });

        });
        "
    );
}
add_action( 'admin_enqueue_scripts', 'work_image_admin_scripts' );

/**
 * =====================================================
 * 5. FORCE ELEMENTOR SUPPORT
 * =====================================================
 */
add_action( 'init', function () {
    if ( post_type_exists( 'work' ) ) {
        add_post_type_support( 'work', 'elementor' );
    }
}, 99 );
