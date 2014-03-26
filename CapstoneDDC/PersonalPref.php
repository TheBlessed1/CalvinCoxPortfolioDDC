<!DOCTYPE html>
<html id = "html">
	<head>
		<script type="text/javascript" src="http://www.google.com/jsapi">
		</script>

		<script type="text/javascript">
				google.load("feeds", "1") //Load Google Ajax Feed API (version 1)
		</script>
	<?php
	require_once("lib/jslibs.php");
	

	echo "<title>Personalize Page
		</title>"
	?>
		
	</head>
	<body>
		<div id="viewport">
			<span id = "regAbout"><p>Registration </br>Login</p>	
			</span>
			<?php
			require_once("lib/header.php");
			?>
			<?php
			require_once("lib/siteMap.php");
			?>
			
			<?php
			/*require_once("lib/RSSWindow.php"); 
			 *putting in RSS feed api for IT window*/
			echo "<aside id = 'RSSWindow'>
				<br /><br />
				<div id='feeddiv'></div>
				<script type='text/javascript'>

					var feedcontainer=document.getElementById('feeddiv')
					var feedurl='http://feeds.bizjournals.com/bizj_albuquerque'
					var feedlimit=30
					var rssoutput='<b>More ABQ Business First News:</b><br /><ul>'

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
			

				</aside>"
			?>
			
			<section id = 'contentWindow'><p>
			<h3>Your Customized Twitter Feeds</h3>
			<?php
				echo 
					"
					<div><b>Latest Healthcare New Mexico Tweets</b>
					<a class='twitter-timeline' href='https://twitter.com/search?
					q=Healthcare+New+Mexico'
					data-widget-id='439301724092645376'
					data-chrome='nofooter'>Tweets about 'Healthcare New Mexico'</a>
					
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
					
						<div><b>2-Latest IT New Mexico Tweets</b>
						<a class='twitter-timeline' href='https://twitter.com/search?
						q=Healthcare+New+Mexico'
						data-widget-id='439301724092645376'
						data-chrome='nofooter'>Tweets about 'Healthcare New Mexico'</a>
					
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
							<div><b>3-Latest Government New Mexico Tweets</b>
							<a class='twitter-timeline' href='https://twitter.com/search?
							q=Healthcare+New+Mexico'
							data-widget-id='439301724092645376'
							data-chrome='nofooter'>Tweets about 'Healthcare New Mexico'</a>
					
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
							</div>
						</div>
					</div>"

			?>
		
			</p>
		</div>
		
			<footer>
				<span id='footSpan'> Contact us info@nmbiznetwork ~ 505.232.1000 &
					<a href='http://www.linkedin.com/'>
					<img src='images/linkedIn.jpeg'	class='footNavTag'>
					</a>
					
					<a href='http://www.googlePlus.com/'>
					<img src='images/googlePlus.jpeg' class='footNavTag'>
					</a>
					
					<a href='http://www.facebook.com/'>
					<img src='images/faceBook.jpeg'	class='footNavTag'>
					</a>
					
					<a href='http://www.rssfeeds.com/'>
					<img src='images/rssFeed.jpeg'	class='footNavTag'>
					</a>
						
					<a href='http://www.twitter.com'>
					<img src='images/twitter.jpeg'	class='footNavTag'>
					</a>
					
				</span>
			</footer>
			</section>";
	</body>
</html>


				