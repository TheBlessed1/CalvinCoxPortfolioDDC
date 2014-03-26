<!DOCTYPE html>
<html id = "html">
	<head>
	<?php
	require_once("phpMods/jslibs.php");
	GLOBAL $title;
	$title = "IT Key Players";
	echo "<title>$title
		</title>"
	?>
		
	</head>
	<body>
		<div id="viewport">
			<span id = "regAbout"><p>Registration </br>Login </br>About Us</p>	
			</span>
			<?php
			require_once("phpMods/header.php");
			?>
			<?php
			require_once("phpMods/siteMap.php");
			?>
			
			<?php
			require_once("phpMods/RSSWindow.php");
			?>
			
			<section id = 'contentWindow'><p>
			<h3>Top 20 Information Technology Companies in New Mexico</h3>
			
				<table>
					<tr><th></th><th>Company</hd><th>Employees</th></tr>
					<tr><td>1</td><td>Intel</td><td>3500</td></tr>
					<tr><td>2</td><td>Verizon Wireless Customer Service Center</td><td>1400</td></tr>
					<tr><td>3</td><td>Citicards</td><td>1274</td></tr>
					<tr><td>4</td><td>ClientLogic</td><td>920</td></tr>
					<tr><td>5</td><td>Ktech Corp.</td><td>660</td></tr>
					<tr><td>6</td><td>Comcast</td><td>647</td></tr>
					<tr><td>7</td><td>Emcore</td><td>632</td></tr>
					<tr><td>8</td><td>CVI Laser Corp.</td><td>200</td></tr>
					<tr><td>9</td><td>SBS Technologies</td><td>175</td></tr>
					<tr><td>10</td><td>Applied Technology Associates</td><td>150</td></tr>
					<tr><td>11</td><td>Applied Research Associates, Inc.</td><td>100</td></tr>
					<tr><td>12</td><td>Thomson Elite</td><td>75</td></tr>
					<tr><td>13</td><td>POD, Inc</td><td>63</td></tr>
					<tr><td>14</td><td>Apogen Technologies </td><td>60</td></tr>
					<tr><td>15</td><td>MIMICS, Inc. Business Information</td><td>50</td></tr>
					<tr><td>16</td><td>Secure Data Recovery Services - Albuquerque</td><td>50</td></tr>
					<tr><td>17</td><td>Senspex Incorporated</td><td>46</td></tr>
					<tr><td>18</td><td>Advanced Network Management</td><td>22</td></tr>
					<tr><td>19</td><td>SmartPay Merchant Services</td><td>20</td></tr>
					<tr><td>20</td><td>505 Web Design</td><td>10</td></tr>	
			</table>
		
			
			</p>
		</div>
		
						<footer id = 'footer'><span> Contact us info@nmbiznetwork ~ 505.232.1000 &    <a href='http://www.linkedin.com/'><img src='../images/linkedIn.jpeg' height='30px' width='30px'><a href='http://www.googlePlus.com/'><img src='../images/googlePlus.jpeg' height='30px' width='30px'> <a href='http://www.facebook.com/'><img src='../images/faceBook.jpeg' height='30px' width='30px'>
				<a href='http://www.rssfeeds.com/'><img src='../images/rssFeed.jpeg' height='30px' width='30px'><a href='http://www.twitter.com/'><img src='../images/twitter.jpeg' height='30px' width='30px'>  </span>
								</footer>
			</section>";
	</body>
</html>


				