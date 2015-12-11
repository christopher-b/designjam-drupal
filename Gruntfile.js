module.exports = function(grunt) {
  grunt.initConfig({
    pkg:
      grunt.file.readJSON('package.json'),
      // shell: {
      //   patternlab: {
      //     command: "php styleguide/core/builder.php -gp"
      //   }
      // },
      sass: {
        dist: {
          files: {
            'css/style.css' : 'css/style.scss',
            // 'css/styleguide.css' : 'css/styleguide.scss'
          }
        }
      },
      watch: {
        // html: {
        //   files: [
        //     'styleguide/source/_patterns/**/*.mustache',
        //     'styleguide/source/**/*.json',
        //     'styleguide/source/_data/*',
        //   ],
        //   tasks: ['shell:patternlab'],
        //   options: {
        //     spawn: false
        //   }
        // },
        css: {
          files: '**/*.scss',
          tasks: ['sass']
        }
      }
  });

  // Plugins
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-shell');
  grunt.loadNpmTasks('grunt-contrib-sass');

  // Tasks
  grunt.registerTask('default', ['watch']);
  // grunt.registerTask('default', ['watch', 'shell:patternlab']);
};
