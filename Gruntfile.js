'use strict';

// Packages
const fiberLibrary = require('fibers');
const sassLibrary = require('node-sass');

module.exports = function(grunt) {

  // load all tasks
  require('load-grunt-tasks')(grunt, {scope: 'devDependencies'});
  
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    watch: {
      files: ['assets/scss/**/*.scss', 'assets/js/**/*.js'],
      tasks: ['sass', 'postcss', 'cssmin', 'concat', 'uglify'],
      options: {
        livereload: true,
      },
    },
    sass: {
      default: {
        options : {
          implementation: sassLibrary,
          fiber: fiberLibrary,
          style : 'expanded',
          sourceMap: true
        },
        files: {
          'style.css':'scss/style.scss',
        }
      }
    },
    postcss: {
      options: {
        map: true,
        processors: [
          require('autoprefixer')({browsers: 'last 2 versions, > 2%'}),
        ]
      },
      dist: {
        files: [{
          src: ['style.css', 'style.css'],
        }]
      }
    },
    concat: {
      default: {
        files: {
          'js/combined-min.js' : [
            'js/skip-link-focus-fix.js',
            'js/jquery.fitvids.js',
            'js/navigation.js'
          ]
        },
      }
    },
    uglify: {
      options: {
        mangle: {
          reserved: ['jQuery']
        },
        drop_console: false,
        drop_debugger: false
      },
      default: {
        files: {
          'js/combined-min.js': 'js/combined-min.js',
        }
      }
    },
    // https://www.npmjs.org/package/grunt-wp-i18n
    makepot: {
      target: {
        options: {
          domainPath: '/languages/',    // Where to save the POT file.
          potFilename: 'govpress.pot',   // Name of the POT file.
          type: 'wp-theme'  // Type of project (wp-plugin or wp-theme).
        }
      }
    },
    cssjanus: {
      theme: {
        options: {
          swapLtrRtlInUrl: false
        },
        files: [{ src: 'style.css', dest: 'style-rtl.css'}]
      }
    }
  });
  
  grunt.registerTask( 'default', [
    'sass',
    'postcss'
  ]);
  
  grunt.registerTask( 'release', [
    'sass',
    'postcss',
    'concat',
    'uglify',
    'makepot',
    'cssjanus'
  ]);

};
