<?php
namespace core\components;

use \Illuminate\Database\Capsule\Manager as Capsule;
use \Exception;

Class DatabaseException extends \Exception {}

Class Database
{

    private $config;
    private static $capsule;
    private $connection;
    private static $instance;
    private $schemaManager;

    public static function getInstance()
    {
        if (!is_null(self::$instance)) {
            return self::$instance;
        } else {
            $capsule = new Capsule();
            return new self($capsule);
        }
    }

    private function __construct(Capsule $capsule)
    {
        if (file_exists('./config/database.php'))
            $this->config = include('./config/database.php');
        elseif (file_exists('./app/config/database.php'))
            $this->config = include('./app/config/database.php');

        self::$capsule = $capsule;
        $defaultDB = $this->config['default'];
        if (!empty($this->config['connections'][$defaultDB])) {
            try {
                $capsule->addConnection($this->config['connections'][$defaultDB]);
                $capsule->bootEloquent();
                $this->connection = $capsule->getConnection();
                $this->schemaManager = $this->connection->getDoctrineSchemaManager();
            } catch (\PDOException $e) {
                throw new DatabaseException("Error with database connection : ".$e->getMessage(), 1);
                
            }


        } else {

        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function getSchema()
    {
        return Capsule::schema();
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getSchemaManager()
    {
        return $this->schemaManager;
    }

}