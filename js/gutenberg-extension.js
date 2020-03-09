wp.domReady( () => {
    wp.blocks.registerBlockStyle( 'wtp/block', {
        name: 'default',
        label: 'Default',
        isDefault: true,
    } );

    wp.blocks.registerBlockStyle( 'wtp/block', {
        name: 'hero',
        label: 'Hero',
        isDefault: false,
    } );

    wp.blocks.registerBlockStyle( 'wtp/block', {
        name: 'mediaobject',
        label: 'Media Object',
        isDefault: false,
    } );

    wp.blocks.registerBlockStyle( 'wtp/block', {
        name: 'mediaobject-reverse',
        label: 'Media Object reverse',
        isDefault: false,
    } );

    wp.blocks.registerBlockStyle( 'wtp/section', {
        name: 'grid',
        label: 'Grid',
        isDefault: false,
    } );
} );

