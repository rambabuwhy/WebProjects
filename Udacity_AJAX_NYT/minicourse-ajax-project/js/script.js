
function loadData() {

    var $body = $('body');
    var $wikiElem = $('#wikipedia-links');
    var $nytHeaderElem = $('#nytimes-header');
    var $nytElem = $('#nytimes-articles');
    var $greeting = $('#greeting');

    // clear out old data before new request
    $wikiElem.text("");
    $nytElem.text("");

    var streetStr = $('#street').val();
    var cityStr = $('#city').val();
    var address = streetStr + ', ' + cityStr;

    $greeting.text('So, you want to live at ' + address + '?');


    // load streetview
    var streetviewUrl = 'http://maps.googleapis.com/maps/api/streetview?size=600x400&location=' + address + '';
    $body.append('<img class="bgimg" src="' + streetviewUrl + '">');


    // load nytimes
    
    // YOUR CODE GOES HERE!
	
var url = "https://api.nytimes.com/svc/search/v2/articlesearch.json";
url += '?' + $.param({
  'api-key': "43755a61646642d38a8c5abce4b9d06",
  'q': cityStr
});
	
	//var nytimes = 'https://api.nytimes.com/svc/search/v2/articlesearch.json' + cityStr + '&sort=newest&api-key=43755a61646642d38a8c5abce4b9d06';
	$.getJSON(url,function(data){
		
		$nytHeaderElem.text('Newyork times artical about ' + cityStr);
		articles = data.response.docs;
		for ( var i = 0;i<articles.length;i++)
		{
			
			var article = articles[i];
			$nytElem.append('<li class="article">' +'<a href="' + article.web_url+'">'+article.headline.main+'</a>' +
			'<p>' + article.snippet + '</p>' +'</li>');
			
		};
	}).error(function(e){
		$nytHeaderElem.text('Newyork times artical could not be loaded');
		
});

    return false;
};

$('#form-container').submit(loadData);
