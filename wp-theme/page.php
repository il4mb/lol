<?php
/*
 * Template Name: A Static Page
 */
get_header(); 

if ( have_posts() ) : while ( have_posts() ) : the_post();       
$content = get_the_content(); // displays whatever you wrote in the wordpress editor
endwhile; endif; //ends the loop


require_once __DIR__."/core/shortcode.php";

echo $content;


get_footer();