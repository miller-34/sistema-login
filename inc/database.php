<?php

class database
{
    public function query($sql, $params = [])
    {
        try {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
            $pdo = new PDO($dsn, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);

            $results = $stmt->fetchAll(PDO::FETCH_CLASS);
            return [
                'status' => 'success',
                'data' => $results
            ];

        } catch (\PDOException $err) {
            
            return [
                'status' => 'error',
                'data' => $err->getMessage()
            ];
            
        }
    }
}
