<?php
// création de la classe de singleton pour l'instanciation de la base de données

class Database
{
    private static $instance = null;
    private $pdo;

    // Le constructeur est privé pour empêcher l'instanciation en dehors de la classe
    private function __construct($config)
    {
        $dsn = "mysql:host={$config['host']};dbname={$config['db']};charset={$config['charset']}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $config['user'], $config['pass'], $options);
        } catch (PDOException $e) {
            echo "dans le catch";
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    // Méthode pour obtenir l'instance unique de la classe
    private static function getInstance()
    {
        if (self::$instance === null) {
            $config = require __DIR__ . '/config.php';
            self::$instance = new Database($config);
        }
        return self::$instance;
    }

    // Méthode publique pour obtenir la connexion PDO
    public static function getConnection()
    {
        return self::getInstance()->getPdo();
    }

    /**Méthode pour obtenir l'objet PDO. 
    associé à l'instance courante de la classe singleton.
    Cela signifie que la méthode getPdo() retourne l'objet PDO
     qui a été créé lors de la création de l'instance courante de la classe singleton.*/
    public function getPdo()
    {
        return $this->pdo;
    }
}
