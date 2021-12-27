summaryInclude=60;
var fuseOptions = {
  shouldSort: true,
  includeMatches: true,
  threshold: 0.0,
  tokenize:true,
  location: 0,
  distance: 100,
  maxPatternLength: 32,
  minMatchCharLength: 1,
  keys: [
    {name:"title",weight:0.8},
    {name:"content",weight:0.5},
    {name:"keyword",weight:0.5},
    {name:"tags",weight:0.3},
    {name:"categories",weight:0.3}
  ]
};
var lunrIndex = ''
var pagesIndex
// var lunr = require("hugo-lunr-zh");
var searchQuery = param("s").trim();

$(function(){
	$('#product-recommendation').hide();
    $('#loading-mask').show();
    if( searchQuery ){
        $("#search-query").val(searchQuery);
        executeSearch(searchQuery);
      } else {
        $('#product-recommendation').show()
        $('#loading-mask').hide();
        $('#search-results').append("<p style='margin: auto; text-align: center; margin-top: 80px'>请输入搜索内容</p>");
      }
})


function executeSearch(searchQuery){
  console.log('searchQuery: ', searchQuery);
   $.getJSON( "/index.json", function( data ) {
    pagesIndex = data;
    lunr.zh = function() {
      this.pipeline.reset();
      this.pipeline.add(lunr.zh.trimmer, lunr.stopWordFilter, lunr.stemmer);
    };
    
    lunr.zh.trimmer = function(token) {
      return token.update(str => {
        if (/[\u4E00-\u9FA5\uF900-\uFA2D]/.test(str)) return str;
        return str.replace(/^\W+/, "").replace(/\W+$/, "");
      });
    };
    lunr.Pipeline.registerFunction(lunr.zh.trimmer, "trimmer-zh");

    lunrIndex = lunr(function() {
        this.field("title", {
            boost: 10
        });
        this.field("tags", {
            boost: 5
        });
        this.field("content");
        console.log('this: ', this);
        this.ref("permalink");
        pagesIndex.forEach((page)=> {
            this.add(page);
        });
    });

    var result = search(searchQuery);
    console.log('result: ', result);
    $('#loading-mask').hide();
    $('#product-recommendation').show()
    // if(result.length > 0){
    //   populateResults(result);
    // }else{
    //   $('#search-results').append("<p style='margin-top: 80px;'>没有找到您期望的内容，请尝试其他搜索词，请拨打我们的咨询电话 4008576886，或发邮件至 contactus@yunify.com。</p>");
    // }
  });
}

function search(query) {
  return lunrIndex.search(query).map(function(result) {
    console.log('result: ', result);
      // console.log('result: ', result);
          return pagesIndex.filter(function(page) {
              return page.permalink === result.ref;
          })[0];
      });
}

function populateResults(result){
  $.each(result,function(key,value){
    var contents= value.content;
    var snippet = "";
    var snippetHighlights=[];
    var tags =[];
    if( fuseOptions.tokenize ){
      snippetHighlights.push(searchQuery);
    }else{
      $.each(value.matches,function(matchKey,mvalue){
        if(mvalue.key == "tags" || mvalue.key == "keyword" ){
          snippetHighlights.push(mvalue.value);
        }else if(mvalue.key == "content"){
          start = mvalue.indices[0][0]-summaryInclude>0?mvalue.indices[0][0]-summaryInclude:0;
          end = mvalue.indices[0][1]+summaryInclude<contents.length?mvalue.indices[0][1]+summaryInclude:contents.length;
          snippet += contents.substring(start,end);
          snippetHighlights.push(mvalue.value.substring(mvalue.indices[0][0],mvalue.indices[0][1]-mvalue.indices[0][0]+1));
        }
      });
    }

    if(snippet.length<1){
      snippet += contents.substring(0,summaryInclude*2);
    }
    //pull template from hugo templarte definition
    var templateDefinition = $('#search-result-template').html();
    //replace values
    var output = render(templateDefinition,{key:key,title:value.item.title,link:value.item.permalink,tags:value.item.tags,categories:value.item.categories,snippet:snippet});
    $('#search-results').append(output);

    $.each(snippetHighlights,function(snipkey,snipvalue){
      $("#summary-"+key).mark(snipvalue);
    });

  });
}

function param(name) {
    return decodeURIComponent((location.search.split(name + '=')[1] || '').split('&')[0]).replace(/\+/g, ' ');
}

function render(templateString, data) {
  var conditionalMatches,conditionalPattern,copy;
  conditionalPattern = /\$\{\s*isset ([a-zA-Z]*) \s*\}(.*)\$\{\s*end\s*}/g;
  //since loop below depends on re.lastInxdex, we use a copy to capture any manipulations whilst inside the loop
  copy = templateString;
  while ((conditionalMatches = conditionalPattern.exec(templateString)) !== null) {
    if(data[conditionalMatches[1]]){
      //valid key, remove conditionals, leave contents.
      copy = copy.replace(conditionalMatches[0],conditionalMatches[2]);
    }else{
      //not valid, remove entire section
      copy = copy.replace(conditionalMatches[0],'');
    }
  }
  templateString = copy;
  //now any conditionals removed we can do simple substitution
  var key, find, re;
  for (key in data) {
    find = '\\$\\{\\s*' + key + '\\s*\\}';
    re = new RegExp(find, 'g');
    templateString = templateString.replace(re, data[key]);
  }
  return templateString;
}