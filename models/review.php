<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once(__DIR__ . "/../controllers/helpers/redirect.php");

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
            redirect("../../views/error", "Error! database connection failed." . "<br/>");
            exit;
        }
    }

    public function getRecent()
    {
        try {
            $sth = $this->dbh->prepare('SELECT * from review order by RAND() limit 12');
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            redirect("../../views/error", "Error! database connection failed." . "<br/>" );
            exit;
        }
    }

    public function createNew($review)
    {
        try {
            date_default_timezone_set('UTC');
            $sth = $this->dbh->prepare("insert into review(dep, arr, airline, author, summary, review_text, rating, user_id, timestamp) values (:dep, :arr, :airline, :author, :summary, :review_text, :rating, :user_id, :timestamp)");
            $sth->bindValue('dep', htmlspecialchars($review['dep']));
            $sth->bindValue('arr', htmlspecialchars($review['arr']));
            $sth->bindValue('airline', htmlspecialchars($review['airline']));
            $sth->bindValue('author', htmlspecialchars($review['author']));
            $sth->bindValue('summary', strip_tags($review['summary'], "<p>"));
            $sth->bindValue('review_text', strip_tags($review['review_text'], "<p>"));
            $sth->bindValue('rating', htmlspecialchars($review['rating']));
            $sth->bindValue('user_id', htmlspecialchars($review['id']));
            if (empty($review["timestamp"])) {
                $sth->bindValue('timestamp', date('Y-m-d H:i:s'));
            } else {
                $sth->bindValue('timestamp', $review['timestamp']);
            }
            $sth->execute();
        } catch (PDOException $e) {
            redirect("../../views/error", "Error! database connection failed." . "<br/>" );
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
            redirect("../../views/error", "Error! database connection failed." . "<br/>" );
        }
    }

    public function getUserReviews($user_id)
    {
        try {
            $limit = !empty($_POST["limit-records"]) ? $_POST["limit-records"] : 12;
            $page = !empty($_GET['page']) ? $_GET['page'] : 1;
            $start = ($page - 1) * $limit;
            $sth = $this->dbh->prepare('SELECT * from review where user_id = :user_id  limit :startVal, :limitVal');
            $sth->bindValue('user_id', $user_id);
            $sth->bindValue('startVal', $start, PDO::PARAM_INT);
            $sth->bindValue('limitVal', $limit, PDO::PARAM_INT);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            redirect("../../views/error", "Error! database connection failed." . "<br/>");
        }
    }

    public function getRouteReviews($route)
    {
        try {
            $limit = !empty($_POST["limit-records"]) ? $_POST["limit-records"] : 12;
            $page = !empty($_GET['page']) ? $_GET['page'] : 1;
            $start = ($page - 1) * $limit;
            $sth = $this->dbh->prepare('SELECT * from review where dep = :dep and arr = :arr and airline = :airline limit :startVal, :limitVal');
            $sth->bindValue('dep', $route["dep"]);
            $sth->bindValue('arr', $route["arr"]);
            $sth->bindValue('airline', $route["airline"]);
            $sth->bindValue('startVal', $start, PDO::PARAM_INT);
            $sth->bindValue('limitVal', $limit, PDO::PARAM_INT);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            redirect("../../views/error", "Error! database connection failed." . "<br/>");
        }
    }

    public function getTotalRouteReviews($route)
    {
        try {
            $sth = $this->dbh->prepare('SELECT * from review where dep = :dep and arr = :arr and airline = :airline');
            $sth->bindValue('dep', $route["dep"]);
            $sth->bindValue('arr', $route["arr"]);
            $sth->bindValue('airline', $route["airline"]);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            redirect("../../views/error", "Error! database connection failed." . "<br/>");
        }
    }

    public function getTotalUserReviews($user_id)
    {
        try {
            $sth = $this->dbh->prepare('SELECT * from review where user_id= :user_id');
            $sth->bindValue('user_id', $user_id);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            redirect("../../views/error", "Error! database connection failed." . "<br/>");
        }
    }
    public function update($review)
    {
        try {
            $sth = $this->dbh->prepare("update review set summary = :summary, review_text = :review_text, rating = :rating where id = :id");
            $sth->bindValue('id', htmlspecialchars($review['id']));
            $sth->bindValue('summary', strip_tags($review['summary'], "<p>"));
            $sth->bindValue('review_text', strip_tags($review['review_text'], "<p>"));
            $sth->bindValue('rating', htmlspecialchars($review['rating']));
            $sth->execute();
        } catch (PDOException $e) {
            redirect("../../views/error", "Error! database connection failed." . "<br/>");
        }
    }

    public function delete($id)
    {
        try {
            $sth = $this->dbh->prepare("delete from review where id = :id");
            $sth->bindValue('id', $id);
            $sth->execute();
        } catch (PDOException $e) {
            redirect("../../views/error","Error! database connection failed." . "<br/>");
        }
    }
    public function deleteUserReviews($user_id)
    {
        try {
            $sth = $this->dbh->prepare("delete from review where user_id = :user_id");
            $sth->bindValue('user_id', $user_id);
            $sth->execute();
        } catch (PDOException $e) {
            redirect("../../views/error", "Error! database connection failed." . "<br/>");
        }
    }

    public function search($route)
    {
        try {
            $sth = $this->dbh->prepare('SELECT airline, dep, arr, avg(rating) as rating, count(*) as review_count FROM review where dep = :dep and arr = :arr GROUP BY airline');
            $sth->bindValue('dep', $route['dep']);
            $sth->bindValue('arr', $route['arr']);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            redirect("../../views/error", "Error! database connection failed." . "<br/>");
        }
    }
}

return new Review();
