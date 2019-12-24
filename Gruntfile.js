// -- Grunt Boilerplate

module.exports = function(grunt) {

    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        // -- SASS Compilation

        'dart-sass': {
            target: {
                files: {
                    'css/main.css': 'scss/main.scss'
                }
            }
        },
        
        // -- CSS Minification

        cssmin: {
            combine: {
                files: {
                    'css/production.css': [
                        'css/main.css',
                    ]
                },
 
                options:{
                    report: 'min'
                }
            }
        },
        
        // -- Javscript Hints

        jshint: {
            options: {
                eqnull: true,
                eqeqeq: false,
            },
            beforeconcat: ['js/plugins.js','js/scripts.js']
        },

        // -- Javascript Concatenation

        concat: {   
            dist: {
                src: [
                    'js/plugins.js',
                    'js/scripts.js'
                ],
                dest: 'js/build/global.js',
            }
        },

        // -- Javascript Minification

        uglify: {
            build: {
                src: 'js/build/global.js',
                dest: 'js/build/global.min.js'
            }
        },

        // -- Watch

        watch: {
 
            scripts: {
                files: ['js/*.js'],
                tasks: ['jshint:beforeconcat','concat','uglify'],
                options: {
                    spawn: false,
                }
            },
 
            css: {
                files: ['scss/*.scss','scss/**/*.scss','css/**/*.css'],
                tasks: ['dart-sass', 'cssmin'],
                options: {
                    spawn: false,
                }
            }
        }

    });

    // -- Plugins

    require('load-grunt-tasks')(grunt);
 
    grunt.registerTask('default', ['jshint:beforeconcat','concat', 'uglify', 'dart-sass', 'cssmin', 'watch']);
};