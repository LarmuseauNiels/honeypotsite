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
                $configs[username],
                $configs[password],
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
        try {
            $sql = "INSERT INTO users(username,password,email)
						VALUES(:username, :password,:email)";
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getUserFromID($userid)
    {
        try {
            $sql = "SELECT * FROM users
					WHERE userid = :userid";
            $stmt = $this->DBtools->prepare($sql);
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
        try {
            $sql = "SELECT userid FROM users
					WHERE username = :username";
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $user;
    }

    public function addMessage($userid,$message)
    {
        try {
            $sql = "INSERT INTO messages(userid,message)
						VALUES(:userid, :message)";
            $stmt = $this->DBtools->prepare($sql);
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
            $stmt = $this->DBtools->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $result;
    }

    public function addFeedback($userid,$message)
    {
        try {
            $sql = "INSERT INTO feedback(userid,message)
						VALUES(:userid, :message)";
            $stmt = $this->DBtools->prepare($sql);
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
            $stmt = $this->DBtools->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $result;
    }

    public function addProfileMessage($profileid,$senderid,$message)
    {
        try {
            $sql = "INSERT INTO profielmessages(profileid,senderid,message)
						VALUES(:profileid,:senderid,:message)";
            $stmt = $this->DBtools->prepare($sql);
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
        try {
            $sql = "SELECT * FROM profielmessages 
            WHERE profileid = :profileid";
            $stmt = $this->DBtools->prepare($sql);
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
        try {
            $sql = "INSERT INTO photo(userid,filepath)
						VALUES(:userid,:filepath)";
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":userid", $userid);
            $stmt->bindParam(":filepath", $filepath);
            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getPictureForUser($userid)
    {
        try {
            $sql = "SELECT filepath FROM photo
					WHERE userid = :userid";
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":userid", $userid);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $user;
    }

    public function authenticateUser($username,$password)
    {
        //todo
    }
    
}