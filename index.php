<?php get_header(); ?>
<h1 class="page-title">
  TEMPLATE index.php
</h1>
<p>Template generico, utilizzato solo se nessun template più specifico viene trovato.</p>
<p>
  <em>È meglio tenere questo template il più generico possibile, in quanto è solo un fallback che viene usato se non avete creato un template specifico.</em>
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
