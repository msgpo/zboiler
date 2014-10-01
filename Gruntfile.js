module.exports = function (grunt) {

    // Displays the elapsed execution time of grunt tasks
    require('time-grunt')(grunt);

    // Load NPM Tasks
    require('load-grunt-tasks')(grunt, ['grunt-*']);

    // Project configuration.
    grunt.initConfig({

        // Store your Package file so you can reference its specific data whenever necessary
        pkg: grunt.file.readJSON('package.json'),

        /*
        uglify: {
            options: {
              banner: '/*! <%= pkg.name %> | <%= pkg.version %> | <%= grunt.template.today("yyyy-mm-dd") %> /\n'
            },
            dist: {
                src: './<%= pkg.name %>.js',
                dest: './<%= pkg.name %>.min.js'
            }
        },
        */

        exec: {
          build: {
            command: 'node node_modules/grunt-contrib-requirejs/node_modules/.bin/r.js -o require-config.js'
          }
        },

        // Used to connect to a locally running web server (so Jasmine can test against a DOM)
        connect: {
            test: {
                port: 8000
            }
        },

        cssmin: {
            css: {
                src: 'app/styles/**.css',
                dest: 'app/styles/style.min.css'
            }
        },

        jshint: {
            /*
                Note:
                In case there is a /release/ directory found, we don't want to lint that
                so we use the ! (bang) operator to ignore the specified directory
            */
            files: ['Gruntfile.js', 'app/scripts/libs/**/*.js', '!app/scripts/libs/vendor/**.js', '!app/release/**', 'app/scripts/modules/**/*.js'],
            options: {
                curly:   true,
                eqeqeq:  true,
                immed:   true,
                latedef: true,
                newcap:  true,
                noarg:   true,
                sub:     true,
                undef:   true,
                boss:    true,
                eqnull:  true,
                browser: true,

                globals: {
                    // AMD
                    module:     true,
                    require:    true,
                    requirejs:  true,
                    define:     true,

                    // Environments
                    console:    true,

                    // General Purpose Libraries
                    $:          true,
                    jQuery:     true,

                    // Testing
                    sinon:      true,
                    describe:   true,
                    it:         true,
                    expect:     true,
                    beforeEach: true,
                    afterEach:  true
                }
            }
        },

        requirejs: {
            compile: {
                options: {
                    baseUrl: './app/scripts',
                    mainConfigFile: './app/scripts/main.js',
                    dir: './release/',
                    fileExclusionRegExp: /^\.|node_modules|Gruntfile|\.md|package.json/,
                    // optimize: 'none',
                    modules: [
                        {
                            name: 'main'
                            // include: ['module'],
                            // exclude: ['module']
                        }
                    ]
                }
            }
        },

        copy: {
          main: {
            files: [
              //includes files within path
              {expand: true, src: ['*.html'], dest: 'release'},
              {expand: true, src: ['*.php'], dest: 'release'},
              {expand: true, src: ['server/*'], dest: 'release'},
              {expand: true, src: ['includes/*'], dest: 'release'},
              {expand: true, src: ['lib/**'], dest: 'release'},
              {expand: false, src: ['app/styles/style.min.css'], dest: 'release/styles/styles.min.css'},
              {expand: true, src: ['**'], cwd: 'app/fonts/', dest: 'release/fonts/'},
              {expand: true, src: ['**'], cwd: 'app/img/', dest: 'release/img/'}

            ]
          }
        },

        // Run: `grunt watch` from command line for this section to take effect
        watch: {

          // for stylesheets, watch css and less files
          // only run less and cssmin
          // stylesheets: {
          //   files: ['css/*.css'],
          //   tasks: ['cssmin']
          // },

          // for scripts, run jshint and uglify
          scripts: {
            files: ['Gruntfile.js', 'app/scripts/libs/**/*.js', '!app/scripts/libs/vendor/**.js', '!app/release/**', 'app/scripts/modules/**/*.js'],
            tasks: ['jshint']
          }
        }

    });
    
    //To prevent stacking compile of existing file
    grunt.registerTask('killoldfiles', 'Log some stuff.', function() {
      grunt.file.delete('release/scripts/main.js');
      grunt.file.delete('release/styles/style.min.css');
    });


    // Release Task
    grunt.registerTask('release', ['killoldfiles', 'exec', 'jshint', 'cssmin', 'copy']);

    /*
        Notes:

        When registering a new Task we can also pass in any other registered Tasks.
        e.g. grunt.registerTask('release', 'default requirejs'); // when running this task we also run the 'default' Task

        We don't do this above as we would end up running `sass:dev` when we only want to run `sass:dist`
        We could do it and `sass:dist` would run afterwards, but that means we're compiling sass twice which (although in our example quick) is extra compiling time.

        To run specific sub tasks then use a colon, like so...
        grunt sass:dev
        grunt sass:dist
    */

};
