<?php

class Log extends DB {

    protected $table = 'send_log';

    public function All() {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->connect()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $stmt;
    }

    public function getLogsByDate($from, $to, $cnt_id = null, $usr_id = null) {
        $bindings = [
            ['key' => ':from', 'val' => $from, 'data_type' => PDO::PARAM_STR],
            ['key' => ':to', 'val' => $to, 'data_type' => PDO::PARAM_STR],
        ];

        $sql = "SELECT count(CASE WHEN log.log_success = 1 THEN log.log_success END) AS success,
                count(CASE WHEN log.log_success = 0 THEN log.log_success END) AS failed, DATE(log.log_created) As date  
                FROM {$this->table} AS log";

        if ($cnt_id){
            $sql .= ' JOIN numbers AS num ON num.num_id = log.num_id WHERE num.cnt_id = :cnt_id 
            AND log.log_created BETWEEN :from AND :to';
            $bindings []= ['key' => ':cnt_id', 'val' => $cnt_id, 'data_type' => PDO::PARAM_INT];
        }else{
            $sql .= " WHERE log.log_created BETWEEN :from AND :to";
        }

        if ($usr_id){
            $sql .= " AND log.usr_id = :usr_id";
            $bindings []= ['key' => ':usr_id', 'val' => $usr_id, 'data_type' => PDO::PARAM_INT];
        }

        $sql .=" GROUP BY date";
        $stmt = $this->connect()->prepare($sql);
        foreach ($bindings as $bind){
            $stmt->bindParam($bind['key'], $bind['val'], $bind['data_type']);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}