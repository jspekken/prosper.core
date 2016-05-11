var elixir = require('laravel-elixir');

elixir.config.assetsPath = 'src/resources/assets/';

elixir(function(mix) {
    mix.scripts([
        'jquery/dist/jquery.js'
    ], 'public/js/vendor.js', 'resources/assets/components');

    mix.sass('core.scss');
    mix.copy('public/css/core.css', __dirname + '/../../../public/packages/prosper/core/css/core.css');

    mix.browserify('core.js');
    mix.copy('public/js/core.js', __dirname + '/../../../public/packages/prosper/core/js/core.js');
});
