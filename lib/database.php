<?php

    namespace CYBORG\Lib;

    class Database{
        private $host = "localhost";
        private $port = 3306;
        private $username = "root";
        private $password = "";
        private $dbName = "cyborg_games";

        private \PDO $connection;
        
        public function __construct(string $host="", int $port=3306, string $username="", string $password="", string $dbName=""){
            if(!empty($host)){
                $this->host = $host;
            }
            if(!empty($port)){
                $this->port = $port;
            }
            if(!empty($username)){
                $this->username = $username;
            }
            if(!empty($password)){
                $this->password = $password;
            }
            if(!empty($dbName)){
                $this->dbName = $dbName;
            }
            try{
                $this->connection = new \PDO("mysql:host=$this->host;
                port=$this->port;
                dbname=$this->dbName",
                $this->username,
                $this->password);

                $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch(\PDOException $e){
                echo "Connection failed: " . $e->getMessage();
            }
        }

        public function getProfileData(int $id): array{
            $query = "SELECT p.*, 
            (SELECT COUNT(*) FROM profile_following WHERE profile_id = p.id) as following_count,
            (SELECT COUNT(*) FROM profile_games WHERE profile_id = p.id) as games_count
            FROM profiles p 
            WHERE p.id = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->execute(["id" => $id]);
            $currentUser = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $currentUser !== false ? $currentUser : [];
        }

        public function getMostPopularGames(): array{
            $query = "SELECT games.id, games.unique_name, games.name, games.downloads, games.game_header, ROUND(AVG(ratings.rating), 1) as average_rating,categories.category as category,
            (games.downloads / 1000000 * AVG(ratings.rating)*10) as popularity_score        
            FROM games
            INNER JOIN game_ratings ratings ON ratings.game_id = games.id
            INNER JOIN categories ON categories.id = games.category_id
            GROUP BY games.id 
            ORDER BY popularity_score DESC 
            LIMIT 6";

            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getGameDetail(int $id): array{
            $query = "SELECT games.*, ROUND(AVG(ratings.rating), 1) as average_rating, categories.category as category 
            FROM games 
            LEFT JOIN game_ratings ratings ON ratings.game_id = games.id 
            LEFT JOIN categories ON categories.id = games.category_id
            WHERE games.id = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->execute(["id" => $id]);
            $game = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (count(array_filter($game, function($value) { return $value !== null; })) === 0) {
                return [];
            }
            return $game;
        }

        public function getRelatedGames(int $categoryId, int $id): array{
            $query = "SELECT games.id, games.name, games.game_header from games Where category_id = :categoryId AND id != :id LIMIT 6";
            $stmt = $this->connection->prepare($query);
            $stmt->execute(["categoryId" => $categoryId, "id" => $id]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getMostRecentGames(): array{
            $query = "SELECT games.id, games.name, games.game_header, games.release_date ,categories.category as category from games
            INNER JOIN categories ON categories.id = games.category_id
            ORDER BY games.release_date DESC
            LIMIT 3";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function downloadGame(int $gameId, int $profileId): void{
            $query = "INSERT INTO profile_games (profile_id, game_id) VALUES (:profileId, :gameId)";
            $stmt = $this->connection->prepare($query);
            $stmt->execute(["profileId" => $profileId, "gameId" => $gameId]);
        }
    }
?>