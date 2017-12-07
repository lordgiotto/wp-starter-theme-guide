<?php get_header(); ?>
<h1 class="page-title">
  TEMPLATE archive-project.php
</h1>
<p>Template dell'archivio dei prodotti</p>

<hr>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
    <h2>
      <a href="<?php the_permalink();?>"><?php the_title(); ?></a>
    </h2>
    <p><?php the_content(); ?></p>
	<?php endwhile; ?>
<?php endif; ?>

<!-- La paginazione automatica: si vedrà solamente se il numero di elememnti supera quello indicato -->
<!-- in impostazioni->lettura->Le pagine del blog visualizzano al massimo -->
<?php the_posts_pagination( array(
    'mid_size' => 2,
    'prev_text' => 'precedente',
    'next_text' => 'sucessivo',
) ); ?>

<?php get_footer(); ?>
