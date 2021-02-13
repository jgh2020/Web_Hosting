<?php
include "header.php";
?>
<?php 
require_once('./dao/wordDAO.php'); 
?>


	<div id="content" class="clearfix">
        <aside>
			<a href="word_list.php"><input type="button" value="Whole List of the Words" name="Whole List" /></a>
            <a href="12word(kor).php"><input type="button" value="Random12(Kor)" name="Random12(Kor)" /></a>
			<a href="12word(eng).php"><input type="button" value="Random12(Eng)" name="Random12(Eng)" /></a>
			<a href="addword.php"><input type="button" value="Add New Words" name="Add New Words" /></a>
        </aside>
		
	<div class="main">
<?php
		$keyword = "";
		if(isset($_POST['keyword'])){
            $keyword = $_POST['keyword'];
		}
					
        echo '<h1>Search Result (Keyword : '.$keyword.')</h1>';
		echo '<br>';
					
		$wordDAO = new wordDAO();
        $words = $wordDAO->searchWords($keyword);
		$num = 1;
		
		if($words > 0){
			echo '<div>';
				echo '<table class="wordtable" style="border-radius: 8px; border: 3px solid black;" border="1">';
					echo '<tr><th>No</th><th>English</th><th>뜻</th></tr>';
						foreach($words as $word){
							echo '<tr>';
								echo '<td style="width: 50px; text-align: center;" font-size: 12pt;">' . $num . '</td>';
								echo '<td style="width: 500px; font-size: 12pt;">' . $word->getEngword() . '</td>';
								echo '<td style="width: 500px; font-size: 12pt;">' . $word->getKorword() . '</td>';	
							echo '</tr>';	
							$num++;
						}	
				echo '</table>';
			echo '</div>';
		}
					            
?>			
                    
    </div><!-- End Main -->
	</div><!-- End Content -->
<?php
include "footer.php";
?>