<!DOCTYPE html>
<html lang="en">
<?php include "header.php"; ?>

    <div id="content" class="clearfix">
        <aside>						
			<div><img src="images/cat.jpg" alt="castle"></div>					
        </aside>
    <div class="main">
        <h2 style="font-family: Tahoma;"><em>Welcome</em></h2>
        <p style="font-size: 13pt;"><b>Hello, My name is Seungkyun Kim (go by James) who applied for your company. This is my portfolio and a website where foreigners study English words. This site is connected to the Mysql DB, and the words provided by this site are from that DB. Because my native language is Korean, this site is currently composed of English and Korean words.</b></p>
		<h5>&nbsp;</h5>
					
		<h2 style="font-family: Tahoma;"><em>Useful Sites</em></h2>
			<a href="https://en.dict.naver.com/#/main" target="_blank"><input type="button" class="main_btn" value="NAVER Dictionary" name="dictionary" /></a>
			<a href="https://papago.naver.com/" target="_blank"><input type="button" class="main_btn" value="PAPAGO Translator" name="translator" /></a>
			<a href="https://translate.google.com/" target="_blank"><input type="button" class="main_btn" value="GOOGLE Translator" name="google" /></a>
			<a href="https://www.mylanguageexchange.com/Country/Canada.asp" target="_blank"><input type="button" class="main_btn" value="Language Exchange" name="exchange" /></a>
			<h3>&nbsp;</h3>
	<div style="float:left;">	
		<h2 style="font-family: Tahoma;"><em>Where to start?</em></h2>
			<ol>
				<li>Main : The main page is where you are now. The main page introduces this web page as a whole.</li>
				<h6>&nbsp;</h6>
				<li>Vocabulary : Here you can see the full vocabularies list. You can add, modify, or delete the list. You can also study 12 random words.</li>
				<h6>&nbsp;</h6>
				<li>Games : You can study words through Hangman game here. You can also generate a set of lottery numbers for fun as a short break.</li>
				<h6>&nbsp;</h6>
				<li>Resume : This is my resume.</li>
				<h6>&nbsp;</h6>
				<li>Search : You can look up the words in the database in English or Korean.</li>
			</ol>
	</div>
		<button class="main_hoo_off" id="hoo"><img src="images/hoohoo.jpg" alt="hoohoo" style="width: 110px; height: auto;"></button>				
		<button class="main_img" onclick= "hooOn()"><img src="images/owl.jpg" alt="owl" style="width: 120px; height: auto;"></button>
                
<script type = "text/javascript">
		function hooOn(){
			document.getElementById('hoo').className="main_hoo_on";
			var audio = new Audio('sound/owl.wav');
			audio.play();
			setTimeout(function(){document.getElementById('hoo').className="main_hoo_off";}, 1000);							
		}
</script>
				
	</div><!-- End Main -->
    </div><!-- End Content -->
			
<?php include "footer.php"; ?>

</html>