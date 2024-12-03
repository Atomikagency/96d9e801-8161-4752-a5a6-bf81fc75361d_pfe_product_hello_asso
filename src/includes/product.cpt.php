<?php
// Ajouter une action pour enregistrer le CPT 'product'
add_action('init', 'register_custom_post_type_product');
function register_custom_post_type_product() {
    $labels = array(
        'name'               => 'Products',
        'singular_name'      => 'Product',
        'menu_name'          => 'Products',
        'name_admin_bar'     => 'Product',
        'add_new'            => 'Ajouter un nouveau',
        'add_new_item'       => 'Ajouter un nouveau Product',
        'new_item'           => 'Nouveau Product',
        'edit_item'          => 'Modifier Product',
        'view_item'          => 'Voir Product',
        'all_items'          => 'Tous les Products',
        'search_items'       => 'Chercher Products',
        'not_found'          => 'Aucun Product trouvé.',
        'not_found_in_trash' => 'Aucun Product trouvé dans la corbeille.'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'product'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields')
    );

    register_post_type('product', $args);
}

// Ajouter une metabox pour les champs 'prix' et 'code'
add_action('add_meta_boxes', 'add_product_meta_boxes');
function add_product_meta_boxes() {
    add_meta_box('product_price', 'Prix', 'render_product_price_meta_box', 'product', 'normal', 'default');
    add_meta_box('product_code', 'Code (Shortcode)', 'render_product_code_meta_box', 'product', 'normal', 'default');
}

// Rendu de la metabox 'prix'
function render_product_price_meta_box($post) {
    // Récupérer la valeur actuelle
    $price = get_post_meta($post->ID, '_product_price', true);
    echo '<label for="product_price">Prix :</label> ';
    echo '<input type="text" id="product_price" name="product_price" value="' . esc_attr($price) . '" size="25" />';
}

// Rendu de la metabox 'code'
function render_product_code_meta_box($post) {
    // Récupérer la valeur actuelle
    $code = get_post_meta($post->ID, '_product_code', true);
    echo '<label for="product_code">Code (Shortcode) :</label> ';
    echo '<input type="text" id="product_code" name="product_code" value="' . esc_attr($code) . '" size="25" />';
}

// Sauvegarder les valeurs des metaboxes
add_action('save_post', 'save_product_meta_boxes');
function save_product_meta_boxes($post_id) {
    // Vérifier si le prix est défini et le sauvegarder
    if (isset($_POST['product_price'])) {
        update_post_meta($post_id, '_product_price', sanitize_text_field($_POST['product_price']));
    }

    // Vérifier si le code est défini et le sauvegarder
    if (isset($_POST['product_code'])) {
        update_post_meta($post_id, '_product_code', sanitize_text_field($_POST['product_code']));
    }
}
?>
