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
            self::$dbinstance = new DBtools();
        }
        return self::$dbinstance;
    }

    public function closeDB()
    {
        self::$dbinstance = null;
    }



}