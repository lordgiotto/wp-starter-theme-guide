<?php
// Configuriamo le funzionalità che il tema supporta
//
// ESEGUITA ALL'HOOK: after_setup_theme
function config_theme_support() {
  if (function_exists('add_theme_support')) {
    // add_theme_support() aggiunge il supporto a funzionalità aggiuntive per il tema
    // È possibile trovare la documentazione qui https://developer.wordpress.org/reference/functions/add_theme_support/
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
      'comment-list',
      'comment-form',
      'search-form',
      'gallery',
      'caption')
    );

    set_post_thumbnail_size(400, 250, true);
    add_image_size('large', 900, '', true);
    add_image_size('medium', 500, '', true);
    add_image_size('small', 250, '', true);
    add_image_size('huge', 1900, '', true);
  }
}
add_action( 'after_setup_theme', 'config_theme_support');

// Impostiamo la dimensione di default delle thumbnails
// Inoltre impostiamo diverse misure alle quali le immagini caricate verranno ridimensionate
// In questo modo, caricando un'immagine larga 3000px, Wordpress creerà anche le seguenti misure:
// - small: larga 250px ed alta proporzionalmente
// - medium: larga 500px ed alta proporzionalmente
// - large: larga 900px ed alta proporzionalmente
// - huge: larga 1900px ed alta proporzionalmente
//
// ESEGUITA ALL'HOOK: after_setup_theme
function config_thumb_sizes() {
    set_post_thumbnail_size(400, 250, true);
    add_image_size('small', 250, '', true);
    add_image_size('medium', 500, '', true);
    add_image_size('large', 900, '', true);
    add_image_size('huge', 1900, '', true);
}
add_action( 'after_setup_theme', 'config_thumb_sizes');

// Carichiamo i CSS che ci servono
// La documentazione sulla funzione per aggiungere stili la trovate qui:
// https://codex.wordpress.org/Function_Reference/wp_register_style
//
// ESEGUITA ALL'HOOK: wp_enqueue_scripts
function add_css() {
  // È possibile aggiungere un file css presente nella cartella del tema
  wp_register_style('normalize', get_template_directory_uri() . '/vendor/normalize/normalize.css', array(), null, 'all');
  wp_enqueue_style('normalize');
  wp_register_style('main', get_template_directory_uri() . '/css/main.css', array('normalize'), null, 'all');
  wp_enqueue_style('main');

  // È possibile anche aggiungere un url remoto (es. Google Fonts)
  // wp_register_style('webfont', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,500,600,700,800,900', array(), null, 'all');
  // wp_enqueue_style('webfont');

  // Inoltre è possibile aggiungere un css solo se una determinata condizione è vera
  // In questo esempio aggiungiamo il file home.css solo se ci troviamo sulla pagina di home
  // if(is_home()) {
  //   wp_register_style('home', get_template_directory_uri() . '/css/home.css', array(), null, 'all');
  //   wp_enqueue_style('home');
  // }
}
add_action( 'wp_enqueue_scripts', 'add_css');

// Carichiamo i JS che ci servono
// La documentazione sulla funzione per aggiungere script la trovate qui:
// https://developer.wordpress.org/reference/functions/wp_register_script/
//
// ESEGUITA ALL'HOOK: wp_enqueue_scripts
function add_js() {
  // È possibile aggiungere un file js presente nella cartella del tema
  wp_register_script('main_js', get_template_directory_uri() . '/js/main.js', array('jquery'), null, true);
  wp_enqueue_script('main_js');

  // È possibile aggiungere un url remoto (es. CDN)
  // wp_register_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js', array('jquery'), null, true);
  // wp_enqueue_script('select2');

  // Inoltre è possibile aggiungere un css solo se una determinata condizione è vera
  // In questo esempio aggiungiamo il file home.css solo se ci troviamo sulla pagina di home
  // if(is_home()) {
  //   wp_register_script('home_js', get_template_directory_uri() . '/js/home.js', array('jquery'), null, true);
  //   wp_enqueue_script('home_js');
  // }
}
add_action( 'wp_enqueue_scripts', 'add_js');

// Una funziona che toglie dalle immagini caricate dentro l'editor di wordpress di avere le dimensioni fissate inline nel tag quando messe nell'HTML.
// Utile per il responsive: spesso le dimensioni inline sono difficili da gestire.
//
// ESEGUITA ALL'HOOK: post_thumbnail_html, image_send_to_editor, wp_get_attachment_link
function remove_inline_image_dimensions( $html ) {
  $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
  return $html;
}
add_filter( 'post_thumbnail_html', 'remove_inline_image_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_inline_image_dimensions', 10 );
add_filter( 'wp_get_attachment_link', 'remove_inline_image_dimensions', 10, 1 );

// Nascondiamo la barra nera di Wordpress, in quanto un utente normale non la vedrà mai e quindi può dare fastidio mentre si lavora sullo stile della pagina.
add_filter('show_admin_bar', '__return_false');

?>
