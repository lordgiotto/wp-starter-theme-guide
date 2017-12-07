<?php get_header(); ?>
<h1 class="page-title">
  TEMPLATE front-page.php
</h1>
<p>Questo può contenere sia la lista degli articoli, che il contenuto di una pagina statica.</p>
<p>L'opzione da modificare per cambiare questo comportamento è "La tua homepage mostra" nella sezione di backoffice Impostazioni->Lettura</p>

<h2>E se volessi un template separato nel caso l'utente voglia vedere la lista degli articoli o una pagina statica?</h2>
<p>Allora i template da usare sono diversi.</p>
<p>Innanzitutto il template front-page.php deve essere cancellato, e altri due template saranno usati in base alla scelta dell'utente di cosa vedere in home page:</p>

<ul>
  <li>Se l'utente scelierà <b>Gli ultimi articoli</b> varrà usato il template <code>home.php</code></li>
  <li>Se l'utente scelierà <b>Una pagina statica</b> varrà usato il template <code>page.php</code> (che è il template generico usato per le pagine)</li>
</ul>

<p><em>Potete trovare maggiori informazioni sulla gerarchia dei template sulla <a href="https://developer.wordpress.org/themes/basics/template-hierarchy/#home-page-display" target="_blank">documentazione</a></em></p>

<h2>Ed il loop di wordpress cosa conterrà in questa pagina?</h2>
<p>Dipende: nel caso l'utente abbia selezionato "Gli ultimi articoli" conterrà n elementi di tipo post, dove n è il massimo numero di elementi per pagina.</p>
<p>Nel caso l'utente abbia selezionato "Una pagina statica" conterrà un solo elemento, e cioè la pagina selezionata.</p>

<h2>Quindi che fare?</h2>
<p>Conviene, nella maggior parte dei casi, utilizzare il template front-page.php come pagina statica ed utilizzare un <a href="https://codex.wordpress.org/Class_Reference/WP_Query" target="_blank">loop manuale</a> per presentare eventualmente altri contenuti specifici.</p>

<hr>

<!-- Due esempi di loop manuali: il primo prende gli ultimi 5 articoli, il secondo gli ultimi 3 progetti (che sono un post_type creato da noi in inc/cpt_project.php) -->
<?php
$post_query = new WP_Query(array(
	'post_type'              => array( 'post' ),
	'posts_per_page'         => '5',
));
?>
<h3>Ultimi 5 articoli</h3>
<?php if ( $post_query->have_posts() ) : ?>
	<?php while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
    <h4>
      <a href="<?php the_permalink();?>"><?php the_title(); ?></a>
    </h4>
    <p><?php the_content(); ?></p>
	<?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>

<hr>

<?php
$project_query = new WP_Query(array(
	'post_type'              => array( 'project' ),
	'posts_per_page'         => '3',
));
?>
<h3>Ultimi 3 Progetti</h3>
<?php if ( $project_query->have_posts() ) : ?>
	<?php while ( $project_query->have_posts() ) : $project_query->the_post(); ?>
    <h4>
      <a href="<?php the_permalink();?>"><?php the_title(); ?></a>
    </h4>
    <?php the_content(); ?>
	<?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<hr>
<p>
  <small><a href="<?php echo get_post_type_archive_link('project'); ?>">vai all'archivio</a></small>
</p>

<?php get_footer(); ?>
