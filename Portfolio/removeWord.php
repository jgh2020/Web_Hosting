<?php
	require_once('./dao/wordDAO.php'); 
	
	 if($_GET['action'] == "delete"){
        if(isset($_GET['_id'])){
            $wordDAO = new wordDAO();
            $result = $wordDAO->deleteWord($_GET['_id']);
            echo $result;
            if($result){
                header('Location:word_list.php?deleted=true');
            } else {
                header('Location:word_list.php?deleted=false');
            }
        }
    }
?>