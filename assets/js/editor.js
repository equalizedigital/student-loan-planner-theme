wp.domReady(() => {
	wp.blocks.unregisterBlockStyle('core/button', [
		'default',
		'outline',
		'squared',
		'fill',
	]);

	wp.blocks.registerBlockStyle('core/button', [
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
		},
	]);

	wp.blocks.unregisterBlockStyle('core/separator', [
		'default',
		'wide',
		'dots',
	]);

	wp.blocks.unregisterBlockStyle('core/quote', ['default', 'large']);

	wp.blocks.unregisterBlockType('core/media-text');
	wp.blocks.unregisterBlockType('core/search');
});

wp.hooks.addFilter(
	'blocks.registerBlockType',
	'be/groupAlignments',
	function (settings, name) {
		if (name === 'core/group') {
			return lodash.assign({}, settings, {
				supports: lodash.assign({}, settings.supports, {
					align: ['wide', 'full', 'center'],
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
	const customCategory = getCategories().find(
		(category) => category.slug === customSlug
	);

	// Get all other categories excluding the custom one
	const otherCategories = getCategories().filter(
		(category) => category.slug !== customSlug
	);

	// If the custom category exists, reorder the categories list
	if (customCategory) {
		setCategories([customCategory, ...otherCategories]);
	}
}

// Example usage: prioritize the 'custom-blocks' category
eqdReorderBlockCategories('custom-blocks');

/**
 * Event listener to dynamically update the background image of a preview container
 * in the block editor based on the mouseover event on block items.
 *
 * This provides a dynamic preview mechanism in the block editor based on the block the user is hovering over.
 */
document.addEventListener('mouseover', function (e) {
	// Selector to preview block where you want to show background image.
	const previewContainer = document.querySelector(
		'.block-editor-inserter__preview-content-missing'
	);

	if (!previewContainer) {
		return;
	}

	if (e.target.closest('.block-editor-block-types-list__item')) {
		const hoveredBlock = e.target.closest(
			'.block-editor-block-types-list__item'
		);

		// to find a name of the block we can extract it from block classes.

		// Retrieve classes from the block on which the mouse is hovered.
		const blockClasses = hoveredBlock.className.split(' ');

		// Finding a class that starts with "editor-block-list-item-acf-".
		const blockClass = blockClasses.find((cls) =>
			cls.startsWith('editor-block-list-item-acf-')
		);

		// If such a class is found, extract the name from it.
		if (blockClass) {
			const blockName = blockClass.replace(
				'editor-block-list-item-acf-',
				''
			);

			// Get the image URL for this block
			const imageUrl = wp.data
				.select('core/blocks')
				.getBlockType('acf/' + blockName)?.attributes
				?.previewImage?.default;

			// adding our styles if there is a link to the picture.
			if (imageUrl) {
				previewContainer.style.background = `url(${imageUrl}) no-repeat center`;
				previewContainer.style.backgroundSize = 'contain';
				previewContainer.style.fontSize = '0px';
			} else {
				// remove our styles if there is no link.
				previewContainer.style.background = '';
				previewContainer.style.backgroundSize = '';
				previewContainer.style.fontSize = '';
			}
		}
	}
});
