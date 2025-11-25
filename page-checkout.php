<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package snov.group
 */

get_header();
?>

<div class="container page-cart__breadcrumb"><?php woocommerce_breadcrumb(); ?></div>

<main class="container">
    <div class="page-cart__header custom-checkout__title">
        <?php the_title('<h2 class="h2 section-title__h2 section-title--semibold">', '</h2>'); ?>
    </div>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; else: ?>

        <р>Записей нет.</р>

    <?php endif; ?>
</main>

<?php
get_footer();
