<?php

/**
 * Loan Gutenberg blocks.
 */
class Loader_Gutenberg {

	
	public function __construct() {
		add_action( 'init', array( $this, 'register_blocks' ) ); 
	}

	public function register_blocks() {
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}
		foreach ( glob( get_template_directory() . '/template-parts/blocks/**/block.json' ) as $block ) :
			register_block_type( $block );
		endforeach;
	}

	public static function get_preview_image( $block_image, $block_name ) {
		$output = '';
		if ( ! $block_image ) {
			return $output;
		}

		$image = get_template_directory() . '/template-parts/blocks/' . str_replace( 'acf/', '', $block_name ) . '/' . $block_image;

		if ( file_exists( $image ) ) :
			$imagetime = filemtime( $image );
			$image_src = get_template_directory_uri() . '/template-parts/blocks/' . str_replace( 'acf/', '', $block_name ) . '/' . $block_image;
			$output    = '<img src="' . $image_src . '?v=' . $imagetime . '" />';
		else :
			$output = '<div class="block-editor-inserter__preview-content-missing">' . __( 'No preview available', '' ) . '</div>';
		endif;

		return apply_filters( 'get_preview_image', $output, $block_image, $block_name );
	}
}

new Loader_Gutenberg();
