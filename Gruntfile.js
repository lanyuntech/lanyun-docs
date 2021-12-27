var toml = require("toml");
var S = require("string");
var path = require('path');

var CONTENT_PATH_PREFIX = "./content";

module.exports = function(grunt) {

    grunt.registerTask("lunr-index", function() {

        grunt.log.writeln("Build pages index");

        var indexPages = function() {
            var pagesIndex = [];
            grunt.file.recurse(CONTENT_PATH_PREFIX, function(abspath, rootdir, subdir, filename) {
                // console.log('abspath: ', abspath);
                grunt.verbose.writeln("Parse file:", abspath);
         
                var ext = path.extname(abspath);
             
                if (ext != '.md' || abspath?.includes('_index')){
                    return
                }
                // console.log('abspath: ', abspath);
                // console.log('ext: ', ext);
                pagesIndex.push(processFile(abspath, filename));
            });

            return pagesIndex;
        };

        var processFile = function(abspath, filename) {
            var pageIndex;

            if (S(filename).endsWith(".html")) {
                pageIndex = processHTMLFile(abspath, filename);
            } else {
                console.log('2: ', );
                pageIndex = processMDFile(abspath, filename);
                
            }
            
            return pageIndex;
        };

        var processHTMLFile = function(abspath, filename) {
            var content = grunt.file.read(abspath);
            var pageName = S(filename).chompRight(".html").s;
            var href = S(abspath)
                .chompLeft(CONTENT_PATH_PREFIX).s;
            return {
                title: pageName,
                href: href,
                content: S(content).trim().stripTags().stripPunctuation().s
            };
        };

        var processMDFile = function(abspath, filename) {
            var content = grunt.file.read(abspath);
           
            var pageIndex;
            // First separate the Front Matter from the content and parse it
            content = content.split("+++");
            console.log('content: ', content);
            var frontMatter;
            try {
                frontMatter = toml.parse(content[1]);
            } catch (e) {
                console.log(e.message);
            }

            var href = S(abspath).chompLeft(CONTENT_PATH_PREFIX).chompRight(".md").s;
            // href for index.md files stops at the folder name
            if (filename === "index.md") {
                href = S(abspath).chompLeft(CONTENT_PATH_PREFIX).chompRight(filename).s;
            }
  
            // console.log('frontMatter: ', frontMatter);

            // Build Lunr index for this page
            pageIndex = {
                title: frontMatter.title,
                tags: frontMatter.tags,
                href: href,
                content: S(content[2]).trim().stripTags().stripPunctuation().s
            };

            return pageIndex;
        };

        console.log('indexPages: ', indexPages());

        grunt.file.write("static/js/lunr/PagesIndex.json", JSON.stringify(indexPages()));
        grunt.log.ok("Index built");
    });
};