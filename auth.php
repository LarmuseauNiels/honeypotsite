<?php

class auth
{
    private $userid;
    private $role;
    public function __construct()
    {
        $this->userid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : null;
        if($this->userid == null){$this->role = 'g';}
        else{
            $db = dbrepo::getdbinstance();
            $this->role = $db->getrolefromuserid($this->userid);
            $db->closeDB();
        }
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getLogedin(){
        return ($this->userid != null);
    }

    public function getRole()
    {
        return $this->role;
    }


    public function logoff()
    {
        unset($_SESSION["userid"]);
        $this->userid = null;
    }

    public function login($email,$password)
    {
        $db = dbrepo::getdbinstance();
        $this->userid = $db->authenticateUser($email,$password);
        $_SESSION["userid"] = $this->userid;
        if($this->userid == null){$this->role = 'g';}
        else{
            $db = dbrepo::getdbinstance();
            $this->role = $db->getrolefromuserid($this->userid);
            $db->closeDB();
        }
        
    }

}