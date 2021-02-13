<?php 
require_once('./dao/wordDAO.php'); 
require_once('./model/word.php');
?>
<?php
include "header.php";
?>

<script type = "text/javascript">
		function confirmDelete(wordName){
			return confirm("Do you wish to delete the word below?" + "\n" + wordName);		
		}
</script>
	
    <div id="content" class="clearfix">
        <aside>
            <a href="word_list.php"><input style="background-color:mediumorchid" type="button" value="Whole List of the Words" name="Whole List" /></a>
            <a href="12word(kor).php"><input type="button" value="Random12(Kor)" name="Random12(Kor)" /></a>
			<a href="12word(eng).php"><input type="button" value="Random12(Eng)" name="Random12(Eng)" /></a>
			<a href="addword.php"><input type="button" value="Add New Words" name="Add New Words" /></a>
        </aside>
    <div class="main">
        <h1>List of Words</h1>
		<br>
	<div style="border-radius: 8px; border: 2px solid black;">
<?php
		if(isset($_GET['deleted'])){
			if($_GET['deleted'] == true){
				echo "<script>alert(\"Deleted successfully.\");</script>";
			}
		}
?>
					
<?php

		$wordDAO = new wordDAO();
		$words = $wordDAO->getWords();						
		$numofwords = count($words);
		$numofshow = 10; // Change for setting : 1/2 ****************************************************
		$firstpage = 1;
		$numofpages = ceil($numofwords/$numofshow);
		$pagelimit = 10; // Change for setting **********************************************************
		$startnum = 0;
		$startnumforplus = 0;
						
		if(isset($_GET['start'])){
			$startnum = $_GET['start'];	
		}
						
		if(isset($_GET['minus'])){
			if ($_GET['minus'] != 0){
				$startnum = $_GET['minus'] - $numofshow;
			}
		}
		if(isset($_GET['plus'])){
			if ($numofwords > $_GET['plus'] + $numofshow){
				$startnum = $_GET['plus'] + $numofshow;
			} else $startnum = $_GET['plus'];
		}
						
		if ($numofwords - $startnum < $numofshow){
			$numofshow = $numofwords%$numofshow;
		}
		$num = $startnum + 1;	
						
		if($words){
			echo '<table class="wordtable" border="1">';
			echo '<tr><th>No</th><th>English</th><th>뜻</th><th>Update</th><th>Delete</th></tr>';
			for($n = $startnum; $n < $startnum + $numofshow; $n++){
				echo '<tr>';
					echo '<td style="width: 50px; text-align: center;" font-size: 11pt;">' . $num . '</td>';
					echo '<td style="width: 500px; font-size: 11pt;">' . $words[$n]->getEngword() . '</td>';
					echo '<td style="width: 500px; font-size: 11pt;">' . $words[$n]->getKorword() . '</td>';	
					echo '<td>
						<a href="updateWord.php?_id=' . $words[$n]->getId() . '&eng=' . $words[$n]->getEngword() . '&kor=' . $words[$n]->getKorword() . '">
						<input style=\'width:50pt\' type=\'button\' value=\'Update\'></a>
						</td>';
					echo '<td>
						<a onclick="return confirmDelete(\''. $words[$n]->getEngword() . '\')"
						href="removeWord.php?action=delete&_id=' . $words[$n]->getId() . '">
						<input style=\'width:50pt\' type=\'button\' value=\'Delete\'></a>
						</td>';
				echo '</tr>';	
				$num++;
			}
			echo '</table>';
?>	
	</div>
<?php		
			$numofshow = 10; // Change for setting : 2/2 ****************************************************
	
				$currentpage = ceil(($startnum+1)/$numofshow);
				$firstpage = (ceil(($startnum+1)/($numofshow*$pagelimit))-1)*$pagelimit + 1;
			
			if ($numofpages - $firstpage +1 < $pagelimit){
				$pagelimit = $numofpages - $firstpage + 1;
			}
			echo '<table style="margin-left: auto; margin-right: auto; margin-top:15px;">';
			
				echo '<tr class="paging">';
					echo '<td ><a href="word_list.php?minus='.$startnum.'"><-</td>';
						$startnumforplus = $startnum;
						for($i = $firstpage; $i < $firstpage + $pagelimit; $i++){
							$startnum = ($i-1)*$numofshow;
							
							if (ceil(($startnum+1)/$numofshow) == $currentpage){
								echo '<td><a href="word_list.php?start='.$startnum.'" style="font-weight: bold;">['.$i.']</td>';
							} else echo '<td><a href="word_list.php?start='.$startnum.'">'.$i.'</td>';
						}
					echo '<td><a href="word_list.php?plus='.$startnumforplus.'">-></td>';
				echo '</tr>';
			echo '</table>';
		}
?>

    </div><!-- End Main -->
    </div><!-- End Content -->
<?php
include "footer.php";
?>