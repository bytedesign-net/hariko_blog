<?php

add_action( 'wp_enqueue_scripts', 'hariko_blog_enqueue_styles' );
function hariko_blog_enqueue_styles() {
	wp_enqueue_style(
		'hariko-parent-style',
		get_parent_theme_file_uri( 'style.css' )
	);

	wp_enqueue_style(
		'hariko-parent-assets',
		get_parent_theme_file_uri( 'assets/css/style.css' ),
		array( 'hariko-parent-style' )
	);
	
	wp_enqueue_style(
		'hariko_blog-style',
		get_stylesheet_directory_uri() . '/assets/css/style.css',
		array( 'hariko-parent-assets' )
	);

	wp_enqueue_block_style( 'core/search', 'hariko_blog-block-search' );
	wp_enqueue_style( 
		'hariko_blog-block-search', 
		get_theme_file_uri( "assets/blocks/core-search.css" )
	);

	wp_enqueue_block_style( 'core/navigation', 'hariko_blog-block-navigation' );
	wp_enqueue_style( 
		'hariko_blog-block-navigation', 
		get_theme_file_uri( "assets/blocks/core-navigation.css" )
	);

	wp_enqueue_block_style( 'core/details', 'hariko_blog-block-details' );
	wp_enqueue_style( 
		'hariko_blog-block-details', 
		get_theme_file_uri( "assets/blocks/core-details.css" )
	);

	wp_enqueue_block_style( 'core/table', 'hariko_blog-block-table' );
	wp_enqueue_style( 
		'hariko_blog-block-table', 
		get_theme_file_uri( "assets/blocks/core-table.css" )
	);

	wp_enqueue_block_style( 'core/heading', 'hariko_blog-block-heading' );
	wp_enqueue_style( 
		'hariko_blog-block-heading', 
		get_theme_file_uri( "assets/blocks/core-heading.css" )
	);
}

// フロント側のスタイル
add_action( 'after_setup_theme', 'hariko_blog_support' );
function hariko_blog_support() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );
}
