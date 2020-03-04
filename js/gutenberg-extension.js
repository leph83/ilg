wp.domReady( () => {
    wp.blocks.registerBlockStyle( 'cgb/block-wtp-plugin-block', {
        name: 'hero',
        label: 'Hero',
        isDefault: true,
    } );

    wp.blocks.registerBlockStyle( 'cgb/block-wtp-plugin-block', {
        name: 'mediaobject',
        label: 'Media Object',
        isDefault: false,
    } );

    wp.blocks.registerBlockStyle( 'cgb/block-wtp-plugin-block', {
        name: 'mediaobject-reverse',
        label: 'Media Object reverse',
        isDefault: false,
    } );
} );

