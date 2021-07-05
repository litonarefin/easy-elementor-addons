const mix = require('laravel-mix');

const wpPot = require('wp-pot');

mix.options({
    autoprefixer: {
        remove: false
    },
    processCssUrls: false,
});



// Disable notification on dev mode
if ( process.env.NODE_ENV.trim() !== 'production' ) mix.disableNotifications();

if ( process.env.NODE_ENV.trim() === 'production' ) {
	// Language pot file generator
	wpPot({
		destFile: 'languages/master-addons.pot',
		domain: 'master-addons',
		package: 'MasterAddons',
		src: '**/*.php'
	});

}

// Main Stylesheet
mix.sass( 'assets/scss/style.scss', 'assets/css/master-addons.css' );


// Element Stylesheet
// mix.sass( 'assets/scss/dual-heading.scss', 'assets/css/elements/dual-heading.css' );
