<?php
require_once 'config.php';

class Model
{
    protected $db;

    function __construct()
    {
        $this->db = new PDO(
            "mysql:host=" . MYSQL_HOST .
                ";dbname=" . MYSQL_DB . ";charset=utf8",
            MYSQL_USER,
            MYSQL_PASS
        );

        $this->deploy();
    }

    private function deploy()
    {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
          $password = '$2a$12$sueSEU0qRVxmHEMjz7eMae4pkFdf20gdVUeaH8Yd1BdC0kBMNvLtG';
          $sql = <<<END
END;
            $this->db->exec($sql);
        }
    }
}
