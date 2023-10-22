wp.domReady( () => {
	wp.blocks.unregisterBlockStyle(
		'core/button',
		[ 'default', 'outline', 'squared', 'fill' ]
	);

	wp.blocks.registerBlockStyle(
		'core/button',
		[
			{
				name: 'default',
				label: 'Default',
				isDefault: true,
			},
			{
				name: 'outline',
				label: 'Outline',
			},
			{
				name: 'arrow',
				label: 'Arrow',
			}
		]
	);

	wp.blocks.unregisterBlockStyle(
		'core/separator',
		[ 'default', 'wide', 'dots' ],
	);

	wp.blocks.unregisterBlockStyle(
		'core/quote',
		[ 'default', 'large' ]
	);

	wp.blocks.unregisterBlockType( 'core/media-text' );
	wp.blocks.unregisterBlockType( 'core/search' );
	

} );

wp.hooks.addFilter(
	'blocks.registerBlockType',
	'be/groupAlignments',
	function (settings, name) {
		if (name === 'core/group') { return lodash.assign({}, settings, {
			supports: lodash.assign({}, settings.supports, {
				align: [ 'wide', 'full', 'center' ],
			}),
		});
	}
	return settings;
	}
);

/**
 * Reorders the Gutenberg block categories to prioritize a given category.
 *
 * @param {string} customSlug - The slug of the category to be placed at the top.
 */
function eqdReorderBlockCategories(customSlug) {
    const { getCategories, setCategories } = wp.blocks;

    // Find the category with the given slug
    const customCategory = getCategories().find(category => category.slug === customSlug);

    // Get all other categories excluding the custom one
    const otherCategories = getCategories().filter(category => category.slug !== customSlug);

    // If the custom category exists, reorder the categories list
    if (customCategory) {
        setCategories([customCategory, ...otherCategories]);
    }
}

// Example usage: prioritize the 'custom-blocks' category
eqdReorderBlockCategories('custom-blocks');

