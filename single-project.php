<?php get_header(); ?>
<h1 class="page-title">
  TEMPLATE single-project.php
</h1>
<p>Template del singolo post di tipologia "project"</p>

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
