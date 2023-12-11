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

        public function getProfileData(string $uniqueName): array{
            $query = "SELECT p.*, 
            (SELECT COUNT(*) FROM profile_following WHERE profile_id = p.id) as following_count,
            (SELECT COUNT(*) FROM profile_games WHERE profile_id = p.id) as games_count
            FROM profiles p 
            WHERE p.unique_name = :uniqueName";
            $stmt = $this->connection->prepare($query);
            $stmt->execute(["uniqueName" => $uniqueName]);
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

        public function getDownloadedGames(int $currentUserId): array{
            $query = "SELECT DISTINCT game_id from profile_games WHERE profile_id = :currentUserId";
            $stmt = $this->connection->prepare($query);
            $stmt->execute(["currentUserId" => $currentUserId]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getProfileGames(int $profileId): array{
            $query = "SELECT DISTINCT games.id, games.name, games.game_header, categories.category FROM games 
            INNER JOIN profile_games ON profile_games.game_id = games.id 
            INNER JOIN categories ON categories.id = games.category_id  
            WHERE profile_games.profile_id = :profileId";
            $stmt = $this->connection->prepare($query);
            $stmt->execute(["profileId" => $profileId]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function downloadGame(int $gameId, int $profileId): void{
            $query = "INSERT INTO profile_games (profile_id, game_id) VALUES (:profileId, :gameId)";
            $stmt = $this->connection->prepare($query);
            $stmt->execute(["profileId" => $profileId, "gameId" => $gameId]);
        }

        public function uninstallGame(int $gameId, int $profileId): void{
            $query = "DELETE FROM profile_games WHERE profile_id = :profileId AND game_id = :gameId";
            $stmt = $this->connection->prepare($query);
            $stmt->execute(["profileId" => $profileId, "gameId" => $gameId]);
        }

        public function updateProfileInfo(int $id, string $nickname, string $bio): void{
            $query = "UPDATE profiles SET nickname = :nickname, bio = :bio WHERE id = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->execute(["nickname" => $nickname, "bio" => $bio, "id" => $id]);
        }

        public function createAccount(string $nickname, string $uniqueName, string $password): ?string{
            $userMatchQuery = "SELECT * FROM profiles WHERE unique_name = :uniqueName";
            $stmt = $this->connection->prepare($userMatchQuery);
            $stmt->execute(["uniqueName" => $uniqueName]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            if($user !== false){
                return "User with this login already exists.";
            } else {
                $query = "INSERT INTO profiles (nickname, unique_name, password, profile_picture) VALUES (:nickname, :uniqueName, :password, 'default.jpg')";
                $stmt = $this->connection->prepare($query);
                $stmt->execute(["nickname" => $nickname, "uniqueName" => $uniqueName, "password" => $password]);
                return null;
            }
        }
    }
?>