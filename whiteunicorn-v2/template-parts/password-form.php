<?php
/**
 * Template part for displaying the password form for password protected pages or posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WhiteUnicorn
 */

// if ( post_password_required() ) { ... content below }
?>

<div id="wp-password-required-content">
    <section class="hero-simple">
        <div class="shell">
            <h1><?php the_title(); ?></h1>
        </div>
    </section>

    <div class="wp-password-form">
        <div class="shell">
            <?= get_the_password_form(); ?>
        </div>
    </div>	
</div>