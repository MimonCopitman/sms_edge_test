<?php

class DB {
    private $user;
    private $pwd;
    private $db;
    private $host;
    private $charset;

    protected function connect() {
        $this->user = 'root';
        $this->pwd = 'root';
        $this->db = 'sms_edge';
        $this->host = 'localhost';
        $this->charset = 'utf8mb4';

        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
            $pdo = New PDO($dsn, $this->user, $this->pwd);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Connection failed: {$e->getMessage()}");
        }
    }

    public function all() {
        $sql = "SELECT * FROM {$this->table}";
        return self::connect()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}