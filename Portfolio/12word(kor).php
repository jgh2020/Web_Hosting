<?php 
require_once('./dao/wordDAO.php'); 
require_once('./model/word.php');
?>
<?php
include "header.php";
?>	
	<div id="content" class="clearfix">
        <aside>
            <a href="word_list.php"><input type="button" value="Whole List of the Words" name="Whole List" /></a>
            <a href="12word(kor).php"><input style="background-color:mediumorchid" type="button" value="Random12(Kor)" name="Random12(Kor)" /></a>
			<a href="12word(eng).php"><input type="button" value="Random12(Eng)" name="Random12(Eng)" /></a>
			<a href="addword.php"><input type="button" value="Add New Words" name="Add New Words" /></a>
        </aside>
	<div class="main" style="background-color:mistyrose">
        <h1>Random 10 Words (Korean to English)</h1>
		<br>
	<div style="background-color:Thistle; padding-bottom:10px; border: 3px solid black; border-radius: 8px;">
<?php
		$wordDAO = new wordDAO();
		$words = $wordDAO->getWords();
		$ranarray = array();
		$ranEngarray = array();
		$ranKorarray = array();
						
		for($n=0; $n<12; $n++){
			$randomNum = rand(0, count($words)-1);
			while(in_array($randomNum, $ranarray)){
				$randomNum = rand(0, count($words)-1);
			} 
			$ranarray[$n] = $randomNum;
			$ranEngarray[$n] = $words[$ranarray[$n]]->getEngword();
			$ranKorarray[$n] = $words[$ranarray[$n]]->getKorword();
		}

		echo '<table style="margin-left: auto; margin-right: auto;">';
			echo '<tr>';
				echo '<td>';
					$i = 0;
					if($words){
						while($i < 12){
							echo '<input onclick= "change1('.$i.')" id="'.$i.'" class="main_btn10" type="button" value="'.$ranKorarray[$i].'">';
								$i++;
						}	
					}
				echo '</td>';
			echo '</tr>';
		echo '</table>';
					?>
	</div>

<script type = "text/javascript">
					
		var scriptEngarray = <?php echo json_encode($ranEngarray)?>;
		var scriptKorarray = <?php echo json_encode($ranKorarray)?>;
		
		function change1(i){
			document.getElementById(i).value = scriptEngarray[i];	
			document.getElementById(i).className="main_btn10_back";
			document.getElementById(i).setAttribute("onClick", "change2("+i+")");
		}
									
		function change2(i){
			document.getElementById(i).value = scriptKorarray[i];	
			document.getElementById(i).className="main_btn10";
			document.getElementById(i).setAttribute("onClick", "change1("+i+")");	
		}
</script>

    </div><!-- End Main -->
    </div><!-- End Content -->
<?php
include "footer.php";
?>