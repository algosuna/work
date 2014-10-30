<?php
/*
*	Template Name: Front Page
*/
get_header(); ?>

<?php
$slider_images = ot_get_option('slider_images');
if( $slider_images )
{
    get_template_part('sections/header_one');
}

$about_checkbox     = ot_get_option('about_checkbox');
$services_checkbox  = ot_get_option('services_checkbox');
$client_checkbox    = ot_get_option('client_checkbox');
$portfolio_checkbox = ot_get_option('portfolio_checkbox');
$contact_checkbox   = ot_get_option('contact_checkbox');

if ( !empty($about_checkbox) ) {
    get_template_part('sections/section_about');
}

if ( !empty($services_checkbox) ) {
    get_template_part('sections/section_services');
}

if ( !empty($client_checkbox) ) {
    get_template_part('sections/section_clients');
}

if ( !empty($portfolio_checkbox) ) {
    get_template_part('sections/section_portfolio');
}

if ( !empty($contact_checkbox) ) {
    get_template_part('sections/section_contact');
}

?>

<?php get_footer(); ?>