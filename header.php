<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package snov.group
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <style>
        :root {
            --icon-path-bullit: url(<?php echo get_template_directory_uri(); ?>/assets/icons/bullit.svg);
        }
    </style>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="header container" id="header">

    <nav class="header__menu">
        <ul class="header__menu-items">
            <li class="hidden-tablet"><a href="/shop">Каталог</a></li>
            <li class="hidden-tablet"><a href="/about">О нас</a></li>
            <li class="hidden-tablet"><a href="/contact">Контакты</a></li>
            <li class="hidden-tablet"><a href="/b2b">B2B</a></li>
        </ul>
        <button class="visible-tablet burger-button" type="button">Меню</button>
    </nav>

    <a href="<?php echo home_url('/'); ?>"><img src="<?php echo get_template_directory_uri();?>/assets/icons/logo.svg" alt="Логотип СНОВ" aria-label="Логотип СНОВ" class="header__logo logo" width="163" height="35"></a>

    <nav class="header__menu">
        <ul class="header__menu-items">
            <li class="hidden-tablet"><a href="/gift-certificate">Cертификат</a></li>
            <li class="hidden-tablet"><a href="">Личный кабинет</a></li>
            <li><a href="">Корзина (0)</a></li>
        </ul>
    </nav>

</header><!-- #masthead -->

