<?php
namespace Config;

use MongoDB\Client;

class Database {
    private static $connection = null;

    public static function getConnection() {
        if (self::$connection === null) {
            $username = 'gabriel';
            $password = 'isocram.,9';
            $cluster = 'Cluster0';
            
            $connectionString = "mongodb+srv://{$username}:{$password}@{$cluster}.mongodb.net/";
            
            try {
                self::$connection = new Client($connectionString);
                return self::$connection->selectDatabase('escola');
            } catch (\Exception $e) {
                die("Erro de conexão: " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}