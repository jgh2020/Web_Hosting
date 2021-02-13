<?php
include "header.php";
?>
<?php 
require_once('./dao/wordDAO.php'); 
?>

	<div id="content" class="clearfix">
		<aside>
			<a href="hangman.php"><input type="button" value="Hangman" name="hang" /></a>
			<a href="choice.php"><input type="button" style="background-color: Orange;" value="Multiple Choice" name="choice" /></a>
			<a href="lotto.php"><input type="button" value="Lotto" name="lotto" /></a>
		</aside>
		
	<div class="main" style = "background-color : #F5D08A; ">
		<h1>Multiple Choice</h1><button onclick="document.getElementById('scorepost').submit();" style="float:right; padding: 10px" class="hangbtn" value="New Word">New word</button>
		<br>
	<div style="background-color:sandybrown; height:445px; border-radius: 8px; border: 2px solid white;">
					
<?php
					
		$scoreStart = 0;
		if(isset($_POST['score'])){
			$scoreStart = $_POST['score'];
		} 

		$wordDAO = new wordDAO();
		$words = $wordDAO->getWords();	
		$answerKor = '';
		$answerEng = '';
		$answerNum = 0;
		$notAnswersarray = array();
		$oneSetarray = array();

		if($words){
			$answerNum = rand(0, count($words)-1);
			$answerKor = $words[$answerNum]->getKorword();
			$answerEng = $words[$answerNum]->getEngword();
		}
						
		unset($words[$answerNum]);
						
		for($i=0; $i<4; $i++){ 
			$newRanEng = $words[array_rand($words)]->getEngword();
			while(in_array($newRanEng, $notAnswersarray)){
				$newRanEng = $words[array_rand($words)]->getEngword();
			} $notAnswersarray[$i] = $newRanEng;				
		}	
						
		$oneSetarray = array($answerEng, $notAnswersarray[0], $notAnswersarray[1], $notAnswersarray[2], $notAnswersarray[3]);

		shuffle($oneSetarray);
				
		echo '<h1 style=" color:black; "> &nbsp; Choose the right answer, please.</h1>';
		echo '<br>';
		echo '<h2 style=" color:darkred; "> &nbsp; 한글 단어 : '.$answerKor.'</h2>';
		echo '<h4 style=" color:grey; "> &nbsp; * (Only portfolio version has this line) The answer is => '.$answerEng.'</h4>';

		echo '<table style="margin-left: auto; margin-right: auto;">';
		echo '<br>';
		echo '<br>';
			
								
			for($i=0; $i<5; $i++){
				echo '<tr >';
					echo '<input type="button" onclick="choiceOne('.$i.')" class="choice" id="'.$i.'" value="'.$oneSetarray[$i].'">';
				echo '</tr>';
				echo '<br>';
			}
		
		echo '</table>';
		echo '<form name="scorepost" id="scorepost" method="post" action="choice.php">';
			echo '<table>';
				echo '<tr>';
					if ($scoreStart >= 0){
						echo '<input class="score" id="score" name="score" value="'.$scoreStart.'">';
					} else echo '<input class="score_minus" id="score" name="score" value="'.$scoreStart.'">';
				echo '</tr>';
			echo '</table>';
			echo '</form>';			
?>
	</div>

<script type = "text/javascript">
						
		function choiceOne(i){	
						
			var answer = '<?php echo $answerEng; ?>' ;
			var score = document.getElementById('score').value;
						
			if (document.getElementById(i).value == answer){
				document.getElementById(i).className="choice_right";
				document.getElementById('score').value = Number(score) + 10;
				if (document.getElementById('score').value >= 0){
					document.getElementById('score').className="score";
				}
				setTimeout(function(){alert("That's right!!"); document.scorepost.submit();}, 100);
			}
			else {
				document.getElementById(i).className="choice_wrong";
				document.getElementById('score').value = Number(score) - 10;
				if (document.getElementById('score').value < 0){
					document.getElementById('score').className="score_minus";
				}
			}		
		}					
</script>
			       
    </div><!-- End Main -->
	</div><!-- End Content -->
<?php
include "footer.php";
?>