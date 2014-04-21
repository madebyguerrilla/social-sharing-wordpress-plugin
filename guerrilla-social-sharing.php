<?php
/*
Plugin Name: Guerrilla's Social Sharing
Plugin URI: http://madebyguerrilla.com
Description: This is a plugin that adds a social sharing box to the end of your WordPress posts (and is mobile responsive).
Version: 1.0.1
Author: Mike Smith
Author URI: http://www.madebyguerrilla.com
*/

/*  Copyright 2014  Mike Smith (email : hi@madebyguerrilla.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* This code adds the social sharing stylesheet to your website */
function guerrilla_social_sharing_style()
{
	wp_register_style( 'guerrilla-social-sharing', plugins_url( '/style.css', __FILE__ ), array(), '20140110', 'all' );
	wp_enqueue_style( 'guerrilla-social-sharing' );
}
add_action( 'wp_enqueue_scripts', 'guerrilla_social_sharing_style' );

/* This code adds the social sharing box to the end of your single posts */
add_filter ('the_content', 'guerrillasocial_add_post_content', 0);
function guerrillasocial_add_post_content($content) {
	if (is_single()) { 
		$pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
		$urlCurrentPage = get_permalink($post->ID);	
		$strPageTitle = get_the_title($post->ID);
				
		$content .= '
		<div class="socialwrapper">
		<p class="likeit"><strong>Like this article? Share it!</strong></p>
		<a href="http://twitter.com/home?status=' . $strPageTitle . '%20' . $urlCurrentPage . '" target="_blank" class="ss_twitter">Twitter</a> <a href="https://www.facebook.com/sharer.php?u=' . $urlCurrentPage . 't=' . $strPageTitle . '" target="_blank" class="ss_facebook">Facebook</a> <a href="http://www.linkedin.com/shareArticle?mini=true&url=' . $urlCurrentPage . '&title=' . $strPageTitle . '" target="_blank" class="ss_linkedin">Linkedin</a> <a href="https://plus.google.com/share?url=' . $urlCurrentPage . '" target="_blank" class="ss_google">Google+</a> <a href="http://pinterest.com/pin/create/link/?url=' . $urlCurrentPage . '&media=' . $pinterestimage[0] . '&description=' . $strPageTitle . '" target="_blank" class="ss_pinterest">Pinterest</a>
		</div>
		';
	}
	return $content;
}
?>