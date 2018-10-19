<?php
/**
* Template Name: Блог
*/

$context = Timber::get_context();
$post = new TimberPost();

$context['post'] = $post;

Timber::render( array( 'template-blog.twig' ), $context );