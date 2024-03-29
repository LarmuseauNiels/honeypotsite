<?php
class dbrepo
{
    private static $dbinstance = null;
    private $dbrepo;

    private function __construct()
    {
        try {
            $configs = include('config.php');
            $this->dbrepo = new PDO("mysql:host=$configs[server]; dbname=$configs[database]; charset=utf8mb4",
                'root',
                '',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getdbinstance()
    {
        if (is_null(self::$dbinstance)) {
            self::$dbinstance = new dbrepo();
        }
        return self::$dbinstance;
    }

    public function closeDB()
    {
        self::$dbinstance = null;
    }

    public function addUser($username, $password, $email)
    {
        $username = $this->sanitize($username);
        $password = $this->sanitize($password);
        $email = $this->sanitize($email);

        $password = password_hash($password, PASSWORD_DEFAULT);
        try {
            $sql = "INSERT INTO users(username,password,email)
						VALUES(:username, :password,:email)";
            $stmt = $this->dbrepo->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password",$password);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getUserFromID($userid)
    {
        $userid = $this->sanitize($userid);

        try {
            $sql = "SELECT * FROM users
					WHERE userid = :userid";
            $stmt = $this->dbrepo->prepare($sql);
            $stmt->bindParam(":userid", $userid);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $user;
    }

    public function getUseridFromName($username)
    {
        $username = $this->sanitize($username);

        try {
            $sql = "SELECT userid FROM users
					WHERE username = :username";
            $stmt = $this->dbrepo->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $user;
    }

    public function getUseridFromEmail($email)
    {
        $email = $this->sanitize($email);

        try {
            $sql = "SELECT userid FROM users
					WHERE email = :email";
            $stmt = $this->dbrepo->prepare($sql);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $user;
    }

    public function addMessage($userid,$message)
    {
        $userid = $this->sanitize($userid);
        $message = $this->sanitize($message);

        try {
            $sql = "INSERT INTO messages(userid,message)
						VALUES(:userid, :message)";
            $stmt = $this->dbrepo->prepare($sql);
            $stmt->bindParam(":userid", $userid);
            $stmt->bindParam(":message", $message);
            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getMessages()
    {
        try {
            $sql = "SELECT * FROM messages";
            $stmt = $this->dbrepo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $result;
    }

    public function addFeedback($userid,$message)
    {
        $userid = $this->sanitize($userid);
        $message = $this->sanitize($message);

        try {
            $sql = "INSERT INTO feedback(userid,message)
						VALUES(:userid, :message)";
            $stmt = $this->dbrepo->prepare($sql);
            $stmt->bindParam(":userid", $userid);
            $stmt->bindParam(":message", $message);
            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getFeedback()
    {
        try {
            $sql = "SELECT * FROM feedback";
            $stmt = $this->dbrepo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $result;
    }

    public function addProfileMessage($profileid,$senderid,$message)
    {
        $profileid = $this->sanitize($profileid);
        $senderid = $this->sanitize($senderid);
        $message = $this->sanitize($message);

        try {
            $sql = "INSERT INTO profielmessages(profileid,senderid,message)
						VALUES(:profileid,:senderid,:message)";
            $stmt = $this->dbrepo->prepare($sql);
            $stmt->bindParam(":profileid", $profileid);
            $stmt->bindParam(":senderid", $senderid);
            $stmt->bindParam(":message", $message);
            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getProfileMessagesForUser($profileid)
    {
        $profileid = $this->sanitize($profileid);

        try {
            $sql = "SELECT * FROM profielmessages 
            WHERE profileid = :profileid";
            $stmt = $this->dbrepo->prepare($sql);
            $stmt->bindParam(":profileid", $profileid);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $result;
    }

    public function addPicture($userid,$filepath)
    {
        $userid = $this->sanitize($userid);
        $filepath = $this->sanitize($filepath);
        
        try {
            $sql = "INSERT INTO photo(userid,filepath)
						VALUES(:userid,:filepath)";
            $stmt = $this->dbrepo->prepare($sql);
            $stmt->bindParam(":userid", $userid);
            $stmt->bindParam(":filepath", $filepath);
            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function updatePicture($userid,$filepath)
    {
        $userid = $this->sanitize($userid);
        $filepath = $this->sanitize($filepath);

        try {
            $sql = "UPDATE photo
                        SET filepath =:filepath
						WHERE userid =:userid";
            $stmt = $this->dbrepo->prepare($sql);
            $stmt->bindParam(":filepath", $filepath);
            $stmt->bindParam(":userid", $userid);
            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getPictureForUser($userid)
    {
        $userid = $this->sanitize($userid);

        try {
            $sql = "SELECT filepath FROM photo
					WHERE userid = :userid";
            $stmt = $this->dbrepo->prepare($sql);
            $stmt->bindParam(":userid", $userid);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $user;
    }

    public function authenticateUser($email,$password)
    {
        $email = $this->sanitize($email);
        $password = $this->sanitize($password);

        $row = $this::getUseridFromEmail($email);
        
        if($row != null){
            try {
                $userid = $row->userid;
                $sql = "SELECT password FROM users
                    WHERE userid = :userid";
                    $stmt = $this->dbrepo->prepare($sql);
                    $stmt->bindParam(":userid",$userid);
                    $stmt->execute();
                    $hash = $stmt->fetch(PDO::FETCH_OBJ);
                } catch (PDOException $e) {
                    die($e->getMessage());
                }
                if(password_verify($password,$hash->password)){
                    return $userid; 
                }
                else{return null;}          
            }
            else{return null;}  
    }

    public function deletemessage($messageid)
    {
        $messageid = $this->sanitize($messageid);

        try {
            $sql = "DELETE FROM messages
            WHERE messageid = :messageid;";
            $stmt = $this->dbrepo->prepare($sql);
            $stmt->bindParam(":messageid", $messageid);
            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function deleteprofielmessage($messageid)
    {
        $messageid = $this->sanitize($messageid);

        try {
            $sql = "DELETE FROM profielmessages
            WHERE messageid = :messageid;";
            $stmt = $this->dbrepo->prepare($sql);
            $stmt->bindParam(":messageid", $messageid);
            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getrolefromuserid($userid){
        $userid = $this->sanitize($userid);

        try {
            $sql = "SELECT role FROM users
					WHERE userid = :userid";
            $stmt = $this->dbrepo->prepare($sql);
            $stmt->bindParam(":userid", $userid);
            $stmt->execute();
            $role = $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $role;
    }

    public function getUsers()
    {
        try {
            $sql = "SELECT users.userid,username,filepath FROM users LEFT JOIN photo on users.userid = photo.userid";
            $stmt = $this->dbrepo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $result;
    }

    public function deleteUser($userid)
    {
        $userid = $this->sanitize($userid);

        try {
            $sql = "DELETE FROM users
            WHERE userid = :userid;";
            $stmt = $this->dbrepo->prepare($sql);
            $stmt->bindParam(":userid", $userid);
            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    private function sanitize($var){
        $var = trim($var);
		$var = strip_tags($var);
        $var = htmlspecialchars($var);
        return $var;
    }
}