<?php
/**
 * Register Custom Post Types
 */






/*
function register_team_members_cpt() {
	$labels = array(
		'name'               => _x( 'Team Members', 'post type general name', 'whiteunicorn' ),
		'singular_name'      => _x( 'Team Member', 'post type singular name', 'whiteunicorn' ),
		'menu_name'          => _x( 'Team', 'admin menu', 'whiteunicorn' ),
		'name_admin_bar'     => _x( 'Team', 'add new on admin bar', 'whiteunicorn' ),
		'add_new'            => _x( 'Add Team Member', 'book', 'whiteunicorn' ),
		'add_new_item'       => __( 'Add New Team Member', 'whiteunicorn' ),
		'new_item'           => __( 'New Team Member', 'whiteunicorn' ),
		'edit_item'          => __( 'Edit Team Member', 'whiteunicorn' ),
		'view_item'          => __( 'View Team Members', 'whiteunicorn' ),
		'all_items'          => __( 'All Team Members', 'whiteunicorn' ),
		'search_items'       => __( 'Search Team Members', 'whiteunicorn' ),
		'parent_item_colon'  => __( 'Parent Team Member:', 'whiteunicorn' ),
		'not_found'          => __( 'No Team Members found.', 'whiteunicorn' ),
		'not_found_in_trash' => __( 'No Team Members found in Trash.', 'whiteunicorn' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_position'		 => 1,
		'menu_icon'			 => 'dashicons-admin-users',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'team' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'team_members', $args );
}
add_action( 'init', 'register_team_members_cpt' );
*/
