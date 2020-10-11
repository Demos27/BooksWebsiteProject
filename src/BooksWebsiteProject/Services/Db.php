<?php

namespace BooksWebsiteProject\Services;

//use BooksWebsiteProject\Models\Authors\Authors;
use BooksWebsiteProject\Models\Books\Books;

class Db
{
    private static $instancesCount = 0;

    /** @var \PDO */
    private $pdo;

    private static $instance;

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        $dbOptions = (require __DIR__ . '/../../settings.php')['db'];

        $this->pdo = new \PDO(
            'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
            $dbOptions['user'],
            $dbOptions['password']
        );
        $this->pdo->exec('SET NAMES UTF8');
    }

    public function query(string $sql,array $params = [], string $className = 'stdClass'): ?array
    {
        $this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        $sth = $this->pdo->prepare($sql);

        $result = $sth->execute($params);

        if (false === $result) {
            return null;
        }
        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }

    public function getLastInsertId(): int
    {
        return (int) $this->pdo->lastInsertId();
    }
}