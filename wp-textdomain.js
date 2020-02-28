const wpTextdomain = require( 'wp-textdomain' );

wpTextdomain( process.argv[ 2 ], {
    domain: 'klaviyo-for-give',
    fix: true,
} );