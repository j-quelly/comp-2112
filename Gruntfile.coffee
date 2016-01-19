module.exports = (grunt) ->
	grunt.initConfig
		pkg: grunt.file.readJSON("package.json") 
		path: require "path"


		# list our available tasks
		availabletasks:
			tasks:
				options:
					filter: "include", 
					tasks: [ 
						"serve-dev"
					]
					descriptions:
						"serve-dev": "Boots up server and opens your default browser"


		# runs tasks concurrently				
		concurrent:
			dev: [
				"nodemon:dev",
				"watch"
			]
			options:
				logConcurrentOutput: true


		# compile sass to css
		sass:
			dev:
				options:  
					compress: false 
				files: [
					"css<%= path.sep %>styles.css" : "sass<%= path.sep %>styles.scss",
				]


		# compile sass with compass
		compass:
			dev:
				options:
					config: 'config.rb'


		# watches files and runs tasks when the files change
		watch:
			options: 
				livereload: false

			sassfiles:
				files: [
					"sass<%= path.sep %>**<%= path.sep %>*.scss"
				]
				tasks: ['compass:dev']
				options:
					spawn: false


	# require our tasks
	require('time-grunt')(grunt);
	require('load-grunt-tasks')(grunt); 


	# register our grunt tasks
	grunt.registerTask("default", ["availabletasks"])
	# grunt.registerTask("serve-dev", ["string-replace:dev", "wiredep", "sass:dev", "concurrent:dev"])
	# grunt.registerTask("build", ["bower_concat:build", "uglify:build", "cssmin:build", "string-replace:build", "nodemon"])