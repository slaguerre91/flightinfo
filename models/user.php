<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

class User
{
    public $dbh = null;
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
        try {
            $this->dbh = new PDO('mysql:host=' . $_ENV['MY_SQL_HOST'] . ';dbname=' . $_ENV['MY_SQL_DBNAME'], $_ENV['MY_SQL_USER'], $_ENV['MY_SQL_PASSWORD']);
        } catch (PDOException $e) {
            $_SESSION["flash_message"] = "Error! database connection failed" . "<br/>";
            header("Location: ../../views/error");
            exit;
        }
    }

    public function login($user)
    {
        try {
            $sth = $this->dbh->prepare("select * from user where username = :username");
            $sth->bindValue('username', $user["username"]);
            $sth->execute();
            if ($sth->rowCount() == 0) {
                $result = "login failed";
            } else {
                $result = $sth->fetch(PDO::FETCH_ASSOC);
                if (!password_verify($user["password"], $result["password"])) {
                    $result = "login failed";
                }
            }
            return $result;
        } catch (PDOException $e) {
            $_SESSION["flash_message"] = "Error! database connection failed" . "<br/>";
            header("Location: ../../views/error");
            exit;
        }
    }
    public function register($user)
    {
        try {
            $sth = $this->dbh->prepare("select * from user where username = :username");
            $sth->bindValue('username', $user["username"]);
            $sth->execute();
            if ($sth->rowCount() > 0) {
                $result = "User already exists";
            } else {
                $sth = $this->dbh->prepare("insert into user(username, password) values (:username, :password)");
                $hash = password_hash($user["password"], PASSWORD_DEFAULT);
                $sth->bindValue('username', htmlspecialchars($user['username']));
                $sth->bindValue('password', $hash);
                $sth->execute();
                $sth = $this->dbh->prepare("select * from user where Id = :id");
                $id = $this->dbh->lastInsertId();
                $sth->bindValue('id', $id);
                $sth->execute();
                $result = $sth->fetch(PDO::FETCH_ASSOC);
            }
            return $result;
        } catch (PDOException $e) {
            $_SESSION["flash_message"] = "Error! database connection failed" . "<br/>";
            header("Location: ../../views/error");
            exit;
        }
    }

    public function show($id)
    {
        try {
            $sth = $this->dbh->prepare("select * from user where id = :id");
            $sth->bindValue('id', $id);
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $_SESSION["flash_message"] = "Error! database connection failed" . "<br/>";
            header("Location: ../../views/error");
            exit;
        }
    }

    public function delete($id)
    {
        try {
            $sth = $this->dbh->prepare("delete from user where id = :id");
            $sth->bindValue('id', $id);
            $sth->execute();
        } catch (PDOException $e) {
            $_SESSION["flash_message"] = "Error! database connection failed" . "<br/>";
            header("Location: ../../views/error");
            exit;
        }
    }

    public function seedUsers($users)
    {
        //IMPORTANT - Should only be accessible to Admin user. 
        $currUser[] = [];
        for ($i = 0; $i < count($users["username"]); $i++) {
            $currUser["username"] = $users["username"][$i];
            $currUser["password"] = $users["password"][$i];
            $currUser["thumbnail"] = $users["thumbnail"][$i];
            $this->register($currUser);
        }
    }


    public function seedRandom()
    {
        //Generate random user for seeding purposes
        try {
            $sth = $this->dbh->query("select username, id from user ORDER BY RAND ( ) LIMIT 1  ");
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $_SESSION["flash_message"] = "Error! database connection failed" . "<br/>";
            header("Location: ../../views/error");
            exit;
        }
    }
}
return new User();
