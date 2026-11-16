<?php
/**
 * Hariko Blog functions and definitions.
 *
 * @package Hariko_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue child and parent theme styles.
 *
 * The parent theme (Hariko 1.0.13+) registers its stylesheet with the
 * handle "hariko-theme" pointing to assets/css/theme.css. The parent
 * stylesheet is loaded first and the child theme stylesheet depends on
 * it so that child styles always override the parent styles.
 */
add_action( 'wp_enqueue_scripts', 'hariko_blog_enqueue_styles', 5 );
function hariko_blog_enqueue_styles() {
	$parent_handle = 'hariko-theme';
	$parent_theme  = 'hariko';
	$parent_dir    = get_template_directory();

	// Enqueue the parent theme stylesheet first (handle: hariko-theme).
	if ( ! wp_style_is( $parent_handle, 'enqueued' ) ) {
		wp_register_style(
			$parent_handle,
			get_theme_file_uri( $parent_dir . '/assets/css/theme.css' ),
			array(),
			wp_get_theme( $parent_theme )->get( 'Version' )
		);
		wp_enqueue_style( $parent_handle );
	}

	// Child theme stylesheet.
	wp_enqueue_style(
		'hariko_blog-style',
		get_stylesheet_directory_uri() . '/assets/css/style.css',
		array( $parent_handle ),
		wp_get_theme()->get( 'Version' )
	);

	// Block styles.
	$block_styles = array(
		'hariko_blog-block-search'     => 'assets/blocks/core-search.css',
		'hariko_blog-block-navigation' => 'assets/blocks/core-navigation.css',
		'hariko_blog-block-details'    => 'assets/blocks/core-details.css',
		'hariko_blog-block-table'      => 'assets/blocks/core-table.css',
		'hariko_blog-block-heading'    => 'assets/blocks/core-heading.css',
	);

	foreach ( $block_styles as $handle => $src ) {
		wp_enqueue_style(
			$handle,
			get_stylesheet_directory_uri() . '/' . $src,
			array( $parent_handle ),
			wp_get_theme()->get( 'Version' )
		);
	}
}

// フロント側のスタイル
add_action( 'after_setup_theme', 'hariko_blog_support' );
function hariko_blog_support() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'editor-style.css' );
}
