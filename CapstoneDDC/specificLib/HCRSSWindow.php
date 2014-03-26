<?php
echo 
"<aside id = 'RSSWindow'>
<br />
<div id='feeddiv'></div>
     <script type='text/javascript'>
     	var feedcontainer=document.getElementById('feeddiv')
     	var feedurl='http://feeds.bizjournals.com/bizj_albuquerque'
     	var feedlimit=5
     	var rssoutput='<b>Latest ABQ Business First News:</b><br /><ul>'
     	function rssfeedsetup()
     	{
     		var feedpointer=new google.feeds.Feed(feedurl) //Google Feed API method
     		feedpointer.setNumEntries(feedlimit) //Google Feed API method
     		feedpointer.load(displayfeed) //Google Feed API method
     	}
     	function displayfeed(result)
     	{
     		if (!result.error)
     		{
     		var thefeeds=result.feed.entries
     		for (var i=0; i<thefeeds.length; i++)
     			rssoutput+='<li><a href=' + thefeeds[i].link 
     								+ '>' + thefeeds[i].title 
     								+ '</a></li><br/>'
     		rssoutput+='</ul>'
     		feedcontainer.innerHTML=rssoutput
     		}
     		else
     		alert('Error fetching feeds!')
     	}
     	window.onload=function()
     	{
     		rssfeedsetup()
     	}
     </script>
     <b>Latest Information Technology Tweets</b>
     <a class='twitter-timeline' href='https://twitter.com/search?
     q=Information+Technology' 
     data-widget-id='439162690812919808' 
     data-chrome='nofooter'>Tweets about 'Information Technology'</a>
     
     <script>
     !function(d,s,id)
     {
     var js,fjs=d.getElementsByTagName(s)[0],
     p=/^http:/.test(d.location)?'http':'https';
     if(!d.getElementById(id))
     		{
     		js=d.createElement(s);
     		js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
     		fjs.parentNode.insertBefore(js,fjs);
     		}
     }
     (document,'script','twitter-wjs');
     </script>
</aside>"
?>