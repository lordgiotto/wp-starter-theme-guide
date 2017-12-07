<?php /* Template Name: Custom Template */ ?>

<?php get_header(); ?>
<h1 class="page-title">
  TEMPLATE CUSTOM_NAME.php
</h1>
<p>Template della pagina personalizzato. Viene utilizzato quando viene caricata una pagina e quella pagina ha indicato nell'interfaccia di backoffice che deve utilizzare questo specifico template.</p>
<p>
  Per creare un nuovo template di pagina, basta creare un file con qualsiasi nome e mettere come prima riga il commento <br>
    <code>
      /* Template Name: Custom Template */
    </code>
</p>

<hr>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
    <h2>
      <?php the_title(); ?>
    </h2>
    <p><?php the_content(); ?></p>
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
