<?php
function register_project_cpt() {
  $labels = array(
      'name'                => 'Progetti',
      'menu_name'           => 'Progetti',
  );
  $args = array(
    'label'               => 'Progetti',
    'description'         => 'I Progetti',
    'labels'              => $labels,
    'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'menu_position'       => 8,
    'menu_icon'           => 'dashicons-admin-customizer',
    'show_in_admin_bar'   => true,
    'show_in_nav_menus'   => true,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
  );
  register_post_type( 'project',  $args );
}
add_action( 'init', 'register_project_cpt' );

?>
