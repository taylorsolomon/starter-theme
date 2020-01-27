<?php

function waepa_add_product_block() {

	// check function exists
	if ( !function_exists('acf_register_block_type') ) {
		return;
	}

	// register a Products block
	acf_register_block_type(array(
		'name'				=> 'product_block',
		'title'				=> __('Product Block'),
		'description'		=> __('A custom product block.'),
		'render_callback'	=> 'waepa_default_custom_block_render_callback', // One callback to
		'category'			=> 'homepage',
		'icon'				=> 'admin-comments',
		'keywords'			=> array( 'products', 'homepage' ),
	));

}

function waepa_add_some_other_block() {

	// check function exists
	if ( !function_exists('acf_register_block_type') ) {
		return;
	}

	acf_register_block_type(array(
		'name'				=> 'some_other_block',
		'title'				=> __('Some Other Block'),
		'description'		=> __('A custom other block.'),
		'render_callback'	=> 'waepa_default_custom_block_render_callback', // Same callback!!!
		'category'			=> 'homepage',
		'icon'				=> 'admin-comments',
		'keywords'			=> array( 'products', 'homepage' ),
	));

}


/**
 *  This is the callback that displays the block.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function waepa_default_custom_block_render_callback( $block, $content = '', $is_preview = false ) {

	// convert name ("acf/product_block") into path friendly slug ("product-block")
	// convert name ("acf/foo_bar") into path friendly slug ("foo-bar")
	$slug = str_replace('acf/', '', $block['name']);
	$slug = str_replace('_', '-', $slug);

	$context = Timber::context();

	// Store block values.
	$context['block'] = $block;

	// Store field values.
	$context['fields'] = get_fields();

	// Store $is_preview value.
	$context['is_preview'] = $is_preview;

	// Render the block.
	Timber::render( "block/${slug}.twig", $context );
}
