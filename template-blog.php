<?php
/**
* Template Name: Блог
*/

$context = Timber::get_context();
$post = new TimberPost();

$context['post'] = $post;

$context['posts'] = new Timber\PostQuery();

print_r($context['posts']);

Timber::render( array( 'template-blog.twig' ), $context );