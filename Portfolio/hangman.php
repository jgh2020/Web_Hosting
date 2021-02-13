<?php
include "header.php";
?>
<?php 
require_once('./dao/wordDAO.php'); 
?>

	<div id="content" class="clearfix">
        <aside>
            <a href="hangman.php"><input type="button" style="background-color: Orange;" value="Hangman" name="hang" /></a>
			<a href="choice.php"><input type="button" value="Multiple Choice" name="choice" /></a>
			<a href="lotto.php"><input type="button" value="Lotto" name="lotto" /></a>					
        </aside>
		
	<div class="main" style = "background-color : #F5D08A; ">
		<h1>Hangman</h1><button onclick="location.href='hangman.php'" style="float:right; padding: 10px" class="hangbtn" value="New Word">New word</button>
		<br>
	<div style="background-color:sandybrown; border-radius: 8px; border: 2px solid white;">
					
<?php
		$wordDAO = new wordDAO();
		$words = $wordDAO->getWords();	
		$theWord = 0;
		$randomNum = 0;
						
		if($words){
			$randomNum = rand(0, count($words)-1);
			$theWord = $words[$randomNum]->getEngword();
		}
						
		echo '<h2 style=" color:darkred; "> &nbsp; 한글 단어 : '.$words[$randomNum]->getKorword().'</h2>';
		echo '<h4 style=" color:grey; "> &nbsp; * (Only portfolio version has this line) The answer is => '.$words[$randomNum]->getEngword().'</h4>';

		$letters = str_split($theWord);
			
		echo '<table style="margin-left: auto; margin-right: auto;">';
			echo '<tr >';
				echo '<td>';
					for($i=0; $i<count($letters); $i++){						
						if ($letters[$i] == " "){
							echo '<input type="button"  class="cardback" id="'.$i.'" value="'.$letters[$i].'">';
						}else{
							echo '<input type="button"  class="game_card" id="'.$i.'" value="'.$letters[$i].'">';
						}									
					}
				echo '</td>';
				echo '<br>';
			echo '</tr>';
		echo '</table>';
						
		echo '<table style="margin-left: auto; margin-right: auto;">';
			echo '<tr>';								
				echo '<td>Please enter a letter here.<input class="enter" type="text" name="guess" id="guess">
				<input type="button" onclick= "flipo()" name="gbtn" id="gbtn" value="Try" class="hangbtn"></td>';								
			echo '</tr>';							
		echo '</table>';
		
		echo '<table style="float: right;">';
			echo '<tr>';
				echo '<input type="hidden" value="3" id="wasthree">';
				echo '<td style="width:305px;"><b>Your chances left: </b><input style="border: none; background-color: #F5D08A; font-size:25pt;" type="button" id="tryleft" value="💖💖💖"><td>';
				echo '<td></td>';				
			echo '</tr>';
		echo '</table>';
?>
	</div>

<script type = "text/javascript">
		document.getElementById("guess").focus();
		function flipo(){							
			var input = document.getElementById("guess").value;  
			var scriptarray = <?php echo json_encode($letters)?>;
							
			var checkarray = []; 
			for (i=0; i<scriptarray.length; i++){
				checkarray[i] = 0;
			}
			
			var lefttry = document.getElementById("wasthree").value; 
			var isright = false;
							
			for (i=0; i<scriptarray.length; i++){
				if(scriptarray[i].toLowerCase() == input.toLowerCase()){							
					document.getElementById(i).className="cardback";
					isright = true;	
				}
				if(document.getElementById(i).className=="cardback"){
					checkarray[i] = 1;	
				}
			}
							
			var num = 0;
			for (i=0; i<checkarray.length; i++){
				num = num + checkarray[i];
			}
							
			if (num==checkarray.length){
				setTimeout(function(){alert('You Won, Good job!!'); location.href="hangman.php";}, 100);
			}
							
			if (isright == false){
				lefttry--;
				document.getElementById("wasthree").value = lefttry;
								
				if (lefttry == 2){
					document.getElementById("tryleft").value = "💖💖";
				} 
				if (lefttry == 1){
					document.getElementById("tryleft").value = "💖";
				}
				if (lefttry == 0){
					document.getElementById("tryleft").value = "";
					setTimeout(function(){alert('You faliled!!'); location.href="hangman.php";}, 100);
				}
			}
			document.getElementById("guess").value = "";
			document.getElementById("guess").focus();
		}
</script>			       
    </div><!-- End Main -->
	</div><!-- End Content -->
<?php
include "footer.php";
?>