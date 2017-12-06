'use strict';

module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		project: {
			app      : [''],
			src      : ['src'],
			assets   : ['assets'],
			sass     : ['<%= project.src %>/sass/style.scss'],
			font_src : ['bower_components/font-awesome/fonts/*'],
			vendorJS : [
				'bower_components/fastclick/lib/fastclick.js',
				'bower_components/foundation/js/foundation.min.js',
				'bower_components/jQuery-One-Page-Nav/jquery.nav.js',
				'bower_components/jquery-placeholder/jquery.placeholder.js',
				'bower_components/jquery.cookie/jquery.cookie.js',
				'bower_components/jquery.countdown/dist/jquery.countdown.min.js',
				'bower_components/jquery.fitvids/jquery.fitvids.js',
				'bower_components/jquery.stellar/jquery.stellar.min.js',
				'bower_components/modernizr/modernizr.js',
				'bower_components/OwlCarousel/owl-carousel/owl.carousel.min.js',
				'bower_components/waypoints/lib/jquery.waypoints.min.js',
				'bower_components/html5shiv/dist/html5shiv.min.js',
				'bower_components/wpl-common/google-maps/google-maps.js'
			],
			vendorPHP: [
				'bower_components/wpl-common/google-maps/google-maps.php'
			]
		},

		sass: {
			dev: {
				options: {
					outputStyle: 'expanded',
					compass: false,
					sourceMap: true
				},
				files: {
					'style.css':'<%= project.sass %>'
				}
			},
			dist: {
				options: {
					outputStyle: 'compressed',
					compass: false,
					sourceMap: false
				},
				files: {
					'style.css':'<%= project.sass %>'
				}
			}
		},

		bless: {
			css: {
				options: {
					cacheBuster: false
				},
				files: {
					'ie.css':'style.css'
		 		}
			}
		},

		sync: {
			fonts: {
				files: [{
					expand: true,
					flatten: true,
					src: '<%= project.font_src %>',
					dest: '<%= project.assets %>/fonts',
				}],
			},
			js: {
				files: [{
					expand: true,
					flatten: true,
					src: '<%= project.vendorJS %>',
					dest: '<%= project.assets %>/javascript/vendor',
				}],
			},
			php: {
				files: [{
					expand: true,
					flatten: true,
					src: '<%= project.vendorPHP %>',
					dest: 'inc',
				}],
			}
		},

		pot: {
			options: {
				text_domain: 'conference-wpl',
				dest: 'languages/',
				keywords: [ // WordPress i18n functions
					'__:1',
					'_e:1',
					'_x:1,2c',
					'esc_html__:1',
					'esc_html_e:1',
					'esc_html_x:1,2c',
					'esc_attr__:1', 
					'esc_attr_e:1', 
					'esc_attr_x:1,2c', 
					'_ex:1,2c',
					'_n:1,2', 
					'_nx:1,2,4c',
					'_n_noop:1,2',
					'_nx_noop:1,2,3c'
				]
			},
			files: {
				src:	[ '**/*.php', '!bower_components/**/*', '!node_modules/**/*', '!option-tree/**/*', '!inc/plugins/class-tgm-plugin-activation.php' ], // Parse all php files
				expand: true
			}
		},

		watch: {
			sass: {
				files: '<%= project.src %>/sass/**/*.{scss,sass}',
				tasks: ['sass:dev', 'bless']
			}
		}
	});

	grunt.loadNpmTasks('grunt-sass');
	grunt.loadNpmTasks('grunt-sync');
	grunt.loadNpmTasks('grunt-bless');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-pot');

	grunt.registerTask('build', ['sass:dist', 'bless', 'sync', 'pot']);

	grunt.registerTask('default', ['sass:dev', 'bless', 'sync' ,'watch']);
};
