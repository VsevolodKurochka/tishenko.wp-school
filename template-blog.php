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
	'post_status'		 	=> 'publish',
	'paged' 					=> $paged
);

$context['post'] = $post;

$posts_wp = new WP_Query( $args );

$context['posts'] = Timber::query_posts( $posts_wp );


$context['wp_pagenavi'] = wp_pagenavi(
	[
		'echo' => false,
		'query' => $posts_wp,
	]
);

$context['blog_sidebar'] = Timber::get_widgets('blog_sidebar');

Timber::render( array( 'template-blog.twig' ), $context );