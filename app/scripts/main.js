require.config({
    //except, if the module ID starts with "things below",
    //load it from the things below directory. paths
    //config is relative to the baseUrl, and
    //never includes a ".js" extension since
    //the paths config could be for a directory.
    paths: {

    },

    shim: {
        'libs/vendor/jquery': {
            exports: '$'
        },
        'libs/vendor/lodash': {
            exports: '_'
        },
        'lib/vendor/bootstrap': {
            deps: ['libs/vendor/jquery']
        }
    }
});

require([
    'libs/vendor/jquery',
    'libs/vendor/lodash',
    'libs/vendor/bootstrap',
    'app'
], function ($, _, Bootstrap, App) {
    var app = new App();
    app.init();
});
