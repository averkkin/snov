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

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="header container">

    <nav class="header__menu">
        <ul class="header__menu-items">
            <li class="header__menu-item">Каталог</li>
            <li class="header__menu-item">О нас</li>
            <li class="header__menu-item">Контакты</li>
            <li class="header__menu-item">B2B</li>
        </ul>
    </nav>

    <img src="" alt="" class="header__logo logo">

    <nav class="header__menu">
        <ul class="header__menu-items">
            <li class="header__menu-item">Cертификат</li>
            <li class="header__menu-item">Личный кабинет</li>
            <li class="header__menu-item">Корзина (0)</li>
        </ul>
    </nav>

</header>

<!-- #masthead -->
