<?php

class Database
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('sqlite:' . __DIR__ . '/database.sqlite');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->initGameTable();
    }

    private function initGameTable(): void
    {
        $this->pdo->exec('CREATE TABLE IF NOT EXISTS game (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(255) NOT NULL,
            image VARCHAR(255) NOT NULL,
            description TEXT,
            price FLOAT NOT NULL,
            release_date DATE NOT NULL
        )');
        $this->pdo->exec('CREATE TABLE IF NOT EXISTS user (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            password VARCHAR(255) NOT NULL,
            username VARCHAR(255) NOT NULL UNIQUE
        )');
    }

    public function getGames($start = null, $limit = null): array
    {
        $sql = 'SELECT * FROM game';
        if ($start !== null && $limit !== null) {
            $sql .= ' LIMIT ' . $start . ', ' . $limit;
        }
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getGame($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM game WHERE id = :id');
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function getGameTableSize()
    {
        return $this->pdo->query('SELECT COUNT(*) FROM game')
            ->fetchColumn();
    }

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function register($username, $password)
    {
        if ($this->checkField($username, true, 2, 255) || $this->checkField($password, true, 8)) {
            $statement = $this->pdo->prepare('INSERT INTO user (username, password) VALUES (:username, :password)');
            $statement->bindValue(':username', htmlspecialchars($username), PDO::PARAM_STR);
            $statement->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
            return $statement->execute();
        }

        return false;
    }

    /**
     * @param $field
     * @param $isRequired
     * @param $minLength
     * @param $maxLength
     * @param $regex
     *
     * @return bool
     */
    private function checkField($field, $isRequired, $minLength = null, $maxLength = null, $regex = null)
    {
        if ($isRequired && empty($field)) {
            return false;
        }
        if ($minLength && strlen($field) < $minLength) {
            return false;
        }

        if ($maxLength && strlen($field) > $maxLength) {
            return false;
        }

        if ($regex && !preg_match($regex, $field)) {
            return false;
        }

        return true;
    }

    public function login($username, $password)
    {
        $statement = $this->pdo->prepare('SELECT * FROM user WHERE username = :username');
        $statement->bindValue(':username', htmlspecialchars($username), PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch();

        if ($user) {
            return password_verify($password, $user['password']);
        }

        return false;
    }

    public function insertGame($name, $picture, $description, $price, $releaseDate)
    {
        if (
            $this->checkField($name, true, 2, 255) &&
            $this->checkField($description, false) &&
            $this->checkField($price, true, 1, 255, '/^[0-9,.]+$/') &&
            $this->checkField($releaseDate, true, 1, 255, '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/')
        ) {
            try {
                $pictureName = $this->savePicture($picture);

                if (!$pictureName) {
                    return false;
                }

                $statement = $this->pdo->prepare('INSERT INTO game (name, image, description, price, release_date) VALUES (:name, :image, :description, :price, :release_date)');
                $statement->bindValue(':name', htmlspecialchars($name), PDO::PARAM_STR);
                $statement->bindValue(':image', $pictureName, PDO::PARAM_STR);
                $statement->bindValue(':description', htmlspecialchars($description), PDO::PARAM_STR);
                $statement->bindValue(':price', $price, PDO::PARAM_INT);
                $statement->bindValue(':release_date', $releaseDate, PDO::PARAM_STR);
                return $statement->execute();
            } catch (Exception $e) {
                return false;
            }
        }

        return false;
    }

    public function savePicture($picture)
    {
        $extension = pathinfo($picture['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $extension;
        $result = move_uploaded_file($picture['tmp_name'], __DIR__ . '/../../public/uploads/' . $filename);

        if (!$result) {
            return false;
        }

        return $filename;
    }
}
