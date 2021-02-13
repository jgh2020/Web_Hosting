<?php
include "header.php";
?>

	<div id="content" class="clearfix">
        <aside>
            <a href="hangman.php"><input type="button" value="Hangman" name="hang" /></a>
			<a href="choice.php"><input type="button" value="Multiple Choice" name="choice" /></a>
			<a href="lotto.php"><input style="background-color: Orange;" type="button" value="Lotto" name="lotto" /></a>					
        </aside>
		
	<div class="main" style = "background-color : #F5D08A;">
		<h1>Lotto Number Generator (Just for fun!)</h1>
		<br>
	<div style="background-color:sandybrown; height:445px; border-radius: 8px; border: 2px solid white;">
					
   	    <form action="lotto.php" method="post">
			<table>
				<tr>
					<td style="font-size:22pt;" rowspan="2"><b>Lotto Type:</b></td>
					<td style="font-size:18pt;">Lotto 6/49<input type="radio" name="lottotype" id="lottotype" value="6" checked></td>
				</tr>
				<tr>
					<td style="font-size:18pt;">Lotto Max<input type="radio" name="lottotype" id="lottotype" value="7"></td>
				</tr>
						
			</table>
			<br>
			<table style="margin-left: auto; margin-right: auto; float:bottom;">
				<td><input type="submit" name="btn" value="Generate Numbers" class="hangbtn" style="background-color:Crimson"></td>
				<td><input type="button" onclick="colchan()" value="Check the Numbers" class="hangbtn"></td>
			</table>
		</form>
					
<?php		
	
		function generate(){
			
			sleep(1);
			
			echo nl2br("\n");
			echo nl2br("\n");
					
			$matchnum = 0;
										
			if(isset($_POST['lottotype'])){
				$matchnum = $_POST['lottotype'];
				echo '<input type="hidden" value="'.$matchnum.'" id="machingnumber">';
			}
					
			$ranarray = array();
					
			for($n=0; $n<$matchnum; $n++){
						
				if ($matchnum == 6){
					$newnum1 = rand(1, 49);
					while(in_array($newnum1, $ranarray)){
						$newnum1 = rand(1, 49);
					} $ranarray[$n] = $newnum1;
				} 
						
				if ($matchnum == 7){
					$newnum2 = rand(1, 50);
					while(in_array($newnum2, $ranarray)){
						$newnum1 = rand(1, 50);
					} $ranarray[$n] = $newnum2;
				}
			}
					
			sort($ranarray);
					
			echo '<table style="margin-left: auto; margin-right: auto;">';
				echo '<tr>';				
					for($i=0; $i<$matchnum; $i++){
						echo '<td class="unvi" id="'.$i.'">'.$ranarray[$i].'</td>';
					}		
				echo '</tr>';	
			echo '</table>';					
			echo '<table style="margin-left: auto; margin-right: auto;">';
				echo '<tr >';				
					echo '<td style="font-size:20pt;" class="star" id="star">Winning %</td>';
						$rannum = rand(3, 5);
						echo '<input type="hidden" value="'.$rannum.'" id="fivestars">';
							
						for ($i=10; $i<$rannum+10; $i++){
							echo '<td class="star" id="'.$i.'">&#9733;</td>';
						}
						for ($n=10+$rannum; $n<15; $n++){
							echo '<td class="star" id="'.$n.'">&#9734;</td>';
						}							
				echo '</tr>';
			echo '</table>';

		}
				
		if(isset($_POST['btn'])){    
			generate();
		} 	
?>
		
<script type = "text/javascript"> 	
		var gap = 1000;
		var seven = document.getElementById("machingnumber").value;
		var iffive = document.getElementById("fivestars").value;
		var tg = 6;
			
			function colchan(){
				setTimeout(function(){document.getElementById(0).className="visu1";}, gap*1);
				setTimeout(function(){document.getElementById(1).className="visu2";}, gap*2);
				setTimeout(function(){document.getElementById(2).className="visu3";}, gap*3);
				setTimeout(function(){document.getElementById(3).className="visu4";}, gap*4);
				setTimeout(function(){document.getElementById(4).className="visu5";}, gap*5);
				setTimeout(function(){document.getElementById(5).className="visu1";}, gap*6);	
				if (seven == 7){
					setTimeout(function(){document.getElementById(6).className="visu2";}, gap*7);
					tg = 7;
				}
				starcol();
			}
				
			function starcol(){	
				setTimeout(function(){document.getElementById('star').className="starwhite";}, gap*(tg+1));
				setTimeout(function(){document.getElementById(10).className="starwhite";}, gap*(tg+1));
				setTimeout(function(){document.getElementById(11).className="starwhite";}, gap*(tg+1));
				setTimeout(function(){document.getElementById(12).className="starwhite";}, gap*(tg+1));
				setTimeout(function(){document.getElementById(13).className="starwhite";}, gap*(tg+1));
				setTimeout(function(){document.getElementById(14).className="starwhite";}, gap*(tg+1));
				if (iffive == 5){
					tg++;
					starcol2();
				}
			}
			
			function starcol2(){		
				setTimeout(function(){document.getElementById('star').className="starblack";}, gap*(tg+1));
				setTimeout(function(){document.getElementById(10).className="starblack";}, gap*(tg+1));
				setTimeout(function(){document.getElementById(11).className="starblack";}, gap*(tg+1));
				setTimeout(function(){document.getElementById(12).className="starblack";}, gap*(tg+1));
				setTimeout(function(){document.getElementById(13).className="starblack";}, gap*(tg+1));
				setTimeout(function(){document.getElementById(14).className="starblack";}, gap*(tg+1));
				if (gap*(tg+1) >= 13000){gap = 500;}
					tg++;
				if (tg < 80){
					starcol();
				}
			}
</script>

	</div>	
    </div><!-- End Main -->
	</div><!-- End Content -->				
<?php
include "footer.php";
?>