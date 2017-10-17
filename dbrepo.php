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
            $sql = "SELECT * FROM members
					WHERE userid = :userid";
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":userid", $userid, \PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $user;
    }

    public function getUserFromID($userid)
    {
        try {
            $sql = "SELECT * FROM users
					WHERE userid = :userid";
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":userid", $userid, \PDO::PARAM_INT);
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
            $stmt->bindParam(":username", $username, \PDO::PARAM_INT);
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
            $sql = "INSERT INTO messqges(userid,message)
						VALUES(:userid, :message)";
            $stmt = $this->DBtools->prepare($sql);
            $stmt->bindParam(":userid", $userid);
            $stmt->bindParam(":message", $message);
            $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }



}