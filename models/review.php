<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

class Review
{
    public $dbh = null;
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
        try {
            $this->dbh = new PDO('mysql:host=' . $_ENV['MY_SQL_HOST'] . ';dbname=' . $_ENV['MY_SQL_DBNAME'], $_ENV['MY_SQL_USER'], $_ENV['MY_SQL_PASSWORD']);
        } catch (PDOException $e) {
            print "Error!: database connection failed" . "<br/>";
            die();
        }
    }

    public function getRecent()
    {
        try {
            $sth = $this->dbh->prepare('SELECT * from review');
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            print "Error!: database connection failed. Can't populate index" . "<br/>";
            die();
        }
    }

    public function createNew($review)
    {
        try {
            $sth = $this->dbh->prepare("insert into review(dep, arr, airline, author, review_text, rating, user_id) values (:dep, :arr, :airline, :author, :review_text, :rating, :user_id)");
            $sth->bindValue('dep', htmlspecialchars($review['dep']));
            $sth->bindValue('arr', htmlspecialchars($review['arr']));
            $sth->bindValue('airline', htmlspecialchars($review['airline']));
            $sth->bindValue('author', htmlspecialchars($review['author']));
            $sth->bindValue('review_text', htmlspecialchars($review['review_text']));
            $sth->bindValue('rating', htmlspecialchars($review['rating']));
            $sth->bindValue('user_id', htmlspecialchars($review['id']));
            $sth->execute();
        } catch (PDOException $e) {
            print "Error!: database connection failed. Can't create new review." . "<br/>";
            die();
        }
    }

    public function show($id)
    {
        try {
            $sth = $this->dbh->prepare('SELECT * from review where id = :id');
            $sth->bindValue('id', $id);
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            print "Error!: database connection failed. Can't show review." . "<br/>";
            die();
        }
    }

    public function getUserReviews($user_id)
    {
        try {
            $sth = $this->dbh->prepare('SELECT * from review where user_id = :user_id');
            $sth->bindValue('user_id', $user_id);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            print "Error!: database connection failed. Can't gather user reviews." . "<br/>";
            die();
        }
    }

    public function update($review)
    {
        try {
            $sth = $this->dbh->prepare("update review set dep = :dep, arr = :arr, airline = :airline, review_text = :review_text, rating = :rating where id = :id");
            $sth->bindValue('id', htmlspecialchars($review['id']));
            $sth->bindValue('dep', htmlspecialchars($review['dep']));
            $sth->bindValue('arr', htmlspecialchars($review['arr']));
            $sth->bindValue('airline', htmlspecialchars($review['airline']));
            $sth->bindValue('review_text', htmlspecialchars($review['review_text']));
            $sth->bindValue('rating', htmlspecialchars($review['rating']));
            $sth->execute();
        } catch (PDOException $e) {
            print "Error!: database connection failed. Can't update review." . "<br/>";
            die();
        }
    }

    public function delete($id)
    {
        try {
            $sth = $this->dbh->prepare("delete from review where id = :id");
            $sth->bindValue('id', $id);
            $sth->execute();
        } catch (PDOException $e) {
            print "Error!: database connection failed. Can't delete review." . "<br/>";
            die();
        }
    }
    public function deleteUserReviews($user_id)
    {
        try {
            $sth = $this->dbh->prepare("delete from review where user_id = :user_id");
            $sth->bindValue('user_id', $user_id);
            $sth->execute();
        } catch (PDOException $e) {
            print "Error!: database connection failed. Can't delete review." . "<br/>";
            die();
        }
    }
}

return new Review();
