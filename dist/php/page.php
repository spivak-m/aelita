<?php
/**
 * Шаблон (single-galery.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
?>
<?php get_header(); ?>

<?php get_template_part('fix-header'); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="page-header page-header--about" style="<?php echo getStyleBG( get_setting('главная_картинка')['sizes']['large'] ); ?>">
    <div class="page-header__wrapper">
    <h2 class="page-header__title"><?php the_title(); ?></h2>
    <p class="page-header__text">
        <?php print_setting( 'описание_страницы' ); ?>
    </p>
    </div>
</div>
<?php get_template_part('booking'); ?>
<section class="page-content">
    <div class="page-content__wrapper block">
    <?php the_content(); ?>
    </div>
</section>
<?php endwhile; endif; ?>

<?php get_footer(); ?>