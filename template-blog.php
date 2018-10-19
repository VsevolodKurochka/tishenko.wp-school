<?php
/**
* Template Name: Блог
*/

$context = Timber::get_context();
$post = new TimberPost();

$context['post'] = $post;

global $paged;
if (!isset($paged) || !$paged){
    $paged = 1;
}
$args = array(
	'post_type' 			=> 'post',
	'posts_per_page' 	=> 6,
	'post_status'		 	=> 'publish',
	'paged' => $paged
);

$context['post'] = $post;
$context['blog'] = new Timber\PostQuery($args);

Timber::render( array( 'template-blog.twig' ), $context );