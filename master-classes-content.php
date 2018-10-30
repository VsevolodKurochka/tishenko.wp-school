<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.2
 */

$templates = array( 'archive-master-classes.twig');

$context = Timber::get_context();

$context['title'] = 'Архив';

if ( is_day() ) {
	$context['title'] = 'Архив: '.get_the_date( 'D M Y' );
} else if ( is_month() ) {
	$context['title'] = 'Архив: '.get_the_date( 'M Y' );
} else if ( is_year() ) {
	$context['title'] = 'Архив: '.get_the_date( 'Y' );
} else if ( is_tag() ) {
	$context['title'] = single_tag_title( '', false );
} else if( is_tax() ){
	$context['title'] = single_term_title( '', false );
} else if ( is_category() ) {
	$context['title'] = single_cat_title( '', false );
	array_unshift( $templates, 'archive-' . get_query_var( 'cat' ) . '.twig' );
} else if ( is_post_type_archive() ) {
	$context['title'] = post_type_archive_title( '', false );
	array_unshift( $templates, 'archive-' . get_post_type() . '.twig' );
}

//$context['background'] = get_template_directory_uri() . '/static/build/img/bg-food-' . rand(1, 3) . '.jpg';
$tax_tag = 'mc-tag';
$tax_category = 'mc-category';

$context['tax_tag'] = $tax_tag;
$context['tax_category'] = $tax_category;
//$context['test'] = get_queried_object();

$context['mc_terms'] = get_terms( array(
	'taxonomy' => $tax_tag,
	'hide_empty' => true
));

$context['mc_categories'] = get_terms( array(
	'taxonomy' => $tax_category,
	'hide_empty' => true
));

$context['mc_sidebar'] = Timber::get_widgets('mc_sidebar');


$context['posts'] = new Timber\PostQuery();

Timber::render( $templates, $context );