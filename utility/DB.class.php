<?php

class DB{
	
	private $host = "localhost";
        private $user = "root";
        //private $user = "bwi_vz_pruef1";
	private $pwd = "";
        //private $pwd = "bwi_vz_pruef1";
        private $dbname = "bwi_ss18_pruef_personal";
	private $conn = null;
	
	function doConnect(){
		$this->conn = new mysqli($this->host,$this->user,$this->pwd, $this->dbname);
	}	
	
	function getMitarbeiter($id){
            $this->doConnect();
            $query = "SELECT * FROM mitarbeiter WHERE personalID = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($personalid, $vorname, $nachname, $beruf, $geburtsdatum);
            $stmt->fetch();
            if($personalid==null && $vorname==null && $nachname==null && $geburtsdatum==null && $beruf==null){
                $this->conn->close();
                return false;
            }
            $mitarbeiter = new Mitarbeiter($personalid, $vorname, $nachname, $geburtsdatum, $beruf);
            $this->conn->close();
            return $mitarbeiter;
        }
        
        function writeMitarbeiter($mitarbeiter){
            $this->doConnect();
            $query = "INSERT INTO mitarbeiter VALUES(?,?,?,?,?)";
            $stmt = $this->conn->prepare($query);
            $id = $mitarbeiter->getPersonalid();
            $vorname = $mitarbeiter->getVorname();
            $nachname = $mitarbeiter->getNachname();
            $geburtsdatum = $mitarbeiter->getGeburtsdatum();
            $beruf = $mitarbeiter->getBeruf();
            $stmt->bind_param("issss", $id,$vorname,$nachname,$beruf, $geburtsdatum);
            $stmt->execute();
            $this->conn->close();
        }
	
	
	
	
        
        
}

?>