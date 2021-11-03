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
