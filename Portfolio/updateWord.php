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
        <h1>Update words in DB</h1>
		<br>
<?php

        try{
            $wordDAO = new wordDAO();
            $hasError = false;
            $errorMessages = Array();
			$oldwordId = 0;
			$oldeng = null;
			$oldkor = null;
			
			if(isset($_GET['_id'])){
		        $oldwordId = $_GET['_id'];	
		    }
			
			if(isset($_GET['eng'])){
		        $oldeng = $_GET['eng'];	
		    }
			
			if(isset($_GET['kor'])){
		        $oldkor = $_GET['kor'];	
		    }
			
			if(isset($_POST['engword']) || isset($_POST['korword'])){         
			
				if($_POST['engword'] == ""){
					$hasError = true;
					$errorMessages['engwordError'] = 'Please enter a English word.';
				}

				if($_POST['korword'] == ""){
					$hasError = true;
					$errorMessages['korwordError'] = "Please enter a Korean word.";
				}

				If (!$hasError) {
					$updateSuccess = $wordDAO->updateWord($_POST['trid'], $_POST['engword'], $_POST['korword']);
					echo "<script>alert(\"Updated successfully.\");</script>";
					echo "<script>location.href='word_list.php'</script>";
				}
			}
		}
		catch(Exception $e){
			echo '<h3>Error on page.</h3>';
			echo '<p>' . $e->getMessage() . '</p>';            
		}
?>			
                    
        <form name="updateword" id="updateword" method="post" action="updateword.php">
            <table>
				<tr style="color:grey;">
					<td>Current English Word :</td>
					<td><?php echo $oldeng ?></td>
				</tr>
                <tr>
                    <td>--> New English Word</td>
                    <td><input type="text" name="engword" id="engword" size='80' style="font-size: 15pt;">
<?php 
					    if(isset($errorMessages['engwordError'])){
							echo '<span style=\'color:red\'>' . $errorMessages['engwordError'] . '</span>';
						}
?>
					</td>
                </tr>
				<tr style="color:grey;">
					<td>Current Korean Word :</td>
					<td><?php echo $oldkor ?></td>
				</tr>
                <tr>
                    <td>--> New Korean Word</td>
                    <td><input type="text" name="korword" id="korword" size='80' style="font-size: 15pt;">
<?php 
						if(isset($errorMessages['korwordError'])){
						echo '<span style=\'color:red\'>' . $errorMessages['korwordError'] . '</span>';
						}
					?>
					</td>
                </tr>
				<tr>
					<td><input type="hidden" name="trid" id="trid" value="<?php echo $oldwordId ?>"></td>
				</tr>
			</table>
			<br><br>
                <input type='submit' name='btnSubmit' id='btnSubmit' value='Update this word' style="font-size: 15pt;">&nbsp;&nbsp;<input type='reset' name="btnReset" id="btnReset" value="Reset Form" style="font-size: 15pt;">		
   			
        </form>
    </div><!-- End Main -->
	</div><!-- End Content -->
<?php
include "footer.php";
?>