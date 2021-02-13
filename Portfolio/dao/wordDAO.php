<?php
require_once('abstractDAO.php');
require_once('./model/word.php');

class wordDAO extends abstractDAO {
        
    function __construct() {
        try{
            parent::__construct();
        } catch(mysqli_sql_exception $e){
            throw $e;
        }
    }
   
    public function getWords(){
        $result = $this->mysqli->query('SELECT * FROM wordlist');
        $words = Array();
        
        if($result->num_rows >= 1){
            while($row = $result->fetch_assoc()){
                $word = new Word($row['_id'], $row['engword'], $row['korword']);
                $words[] = $word;
            }
            $result->free();
            return $words;
        }
        $result->free();
        return false;
    }
	
	public function searchWords($keyword){
		
		if ($keyword == ""){
			$keyword = "Wrong keyword /?///";
		}
		
		if ($keyword == "'"){
			$keyword = "''";
		}
		
		
		$result = $this->mysqli->query("SELECT * FROM wordlist where engword like '%$keyword%' or korword like '%$keyword%'");
        $words = Array();
        
        if($result->num_rows >= 1){
            while($row = $result->fetch_assoc()){
                $word = new Word($row['_id'], $row['engword'], $row['korword']);
                $words[] = $word;
            }
            $result->free();
			
            return $words;
        }
        $result->free();
        return false;
    }
	
	public function deleteWord($wordId){
        if(!$this->mysqli->connect_errno){
			
            $query = 'DELETE FROM wordlist WHERE _id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('i', $wordId);
            $stmt->execute();
            if($stmt->error){
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
	
public function addWord($word){
      
        if(!$this->mysqli->connect_errno){

            $query = 'INSERT INTO wordlist (engword, korword) VALUES (?,?)';
           
            $stmt = $this->mysqli->prepare($query);
            if($stmt){
				$engword = $word->getEngword();
				$korword = $word->getKorword();
				
            $stmt->bind_param('ss', $engword, $korword);
			
            $stmt->execute();
				if($stmt->error){
					return $stmt->error;
				} else {
                return '"'.$word->getEngword().', '.$word->getKorword().'" has been added into the DB successfully!';
				}
			} else {
				$error = $this->mysqli->errno . ' ' . $this->mysqli->error;
				echo $error;
				return $error;
			}
		 }else {
        return 'Could not connect to Database.';
        }
    }
	
	public function updateWord($oldid, $neweng, $newkor){
        if(!$this->mysqli->connect_errno){

			$query = 'UPDATE wordlist SET engword = ?, korword = ? WHERE (_id = ?)'; 
            $stmt = $this->mysqli->prepare($query);
            if($stmt){
				
				$stmt->bind_param('sss', $neweng, $newkor, $oldid);
				$stmt->execute();
					if($stmt->error){
						return $stmt->error;
					} else {
						return 'The word has been updated to "'.$neweng.', '.$newkor.'"successfully!';
					}
			} else {
				$error = $this->mysqli->errno . ' ' . $this->mysqli->error;
				echo $error;
				return $error;
			}
		}else {
			return 'Could not connect to Database.';
        }
    }

	public function getWord($wordId){
        $query = 'SELECT * FROM wordlist WHERE _id = ?';
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('i', $wordId);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $temp = $result->fetch_assoc();
            $word = new Word($temp['_id'], $temp['engword'], $temp['korword']);
            $result->free();
            return $word;
        }else return null;
    }	
}
?>
