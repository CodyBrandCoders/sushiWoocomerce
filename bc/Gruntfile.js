module.exports = function (grunt) {

    var WP_THEME_PATH = "wp-content/themes/bc-starter";

    grunt.initConfig({
        pkg: grunt.file.readJSON("package.json"),
        less: {
            development: {
                src: WP_THEME_PATH + "/less/main.less",
                dest: WP_THEME_PATH + "/css/main.css"
            },
            production: {
                src: WP_THEME_PATH + "/less/main.less",
                dest: WP_THEME_PATH + "/css/main.min.css",
                options: {
                    cleancss: true,
                    compress: true
                }
            }
        },
        uglify: {
            production: {
                files: [
                    {
                        src: WP_THEME_PATH + "/js/main.js",
                        dest: WP_THEME_PATH + "/js/main.min.js"
                    }
                ]
            }
        },
        clean: [
            WP_THEME_PATH + "/js/main.min.js",
            WP_THEME_PATH + "/css/main.min.css",
        ],
        watch: {
            less: {
                files: [WP_THEME_PATH + "/less/**/*.less"],
                tasks: "less:production"
            },
            uglify : {
              files: [WP_THEME_PATH + "js/main.js"],
              tasks: "uglify:production"
            }
        }
    });

    grunt.loadNpmTasks("grunt-contrib-watch");
    grunt.loadNpmTasks("grunt-contrib-less");
    grunt.loadNpmTasks("grunt-contrib-uglify");
    grunt.loadNpmTasks("grunt-contrib-clean");

    grunt.registerTask("dist", ["requirejs:production", "uglify:production", "less:production"]);

    grunt.registerTask("default", ["dist"]);

};
