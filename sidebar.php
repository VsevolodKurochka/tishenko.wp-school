<?php
/**
 * The Template for the sidebar containing the main widget area
 *
 *
 * @package  WordPress
 * @subpackage  Timber
 */

$data['blog_sidebar'] = Timber::get_widgets('blog_sidebar');

Timber::render( array( 'sidebar.twig' ), $data );