<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model
 *
 * @author echoes
 */
class Model {

    //put your code here

    private $connectionString;
    private $user;
    private $password;
    private $host;
    private $name;
    private $drive;

    public function __construct() {
        include 'config.php';
        $this->user = $config->dbuser;
        $this->password = $config->dbpassword;
        $this->host = $config->dbhost;
        $this->name = $config->dbname;
        $this->drive = $config->dbdrive;
        if ($this->drive === 'mysql') {
            $this->connectionString = "mysql:host=$this->host;dbname=$this->name;
                  charset=utf8";
        } elseif ($this->drive === 'pgsql') {
            $this->connectionString = "pgsql:host=$this->host;dbname=$this->name;";
        }
    }

    protected function ExecuteQuery($sql, $parameters) {
        $connection = null;
        try {
            $connection = new PDO($this->connectionString, $this->user, $this->password);
            $connection->beginTransaction();
            $preparedStatment = $connection->prepare($sql);
            if ($parameters != null) {
                foreach ($parameters as $key => $value) {
                    $preparedStatment->bindValue($key, $value);
                }
            }

            if ($preparedStatment->execute() == FALSE) {
                throw new PDOException($preparedStatment->errorCode());
            }

            $error = $preparedStatment->errorInfo();
            if ($error[2]) {
                echo "<pre>";
                print_r($error[2]);
                var_dump($preparedStatment->fetchAll());
                var_dump($preparedStatment->debugDumpParams());
                echo "</pre>";
                die;
            } else {
                return $preparedStatment->fetchAll();
            }
        } catch (PDOException $exc) {
            if ((isset($connection)) && ($connection->inTransaction())) {
                $connection->rollBack();
            }
            echo $exc->getMessage();
            die;
            return array();
        } finally {
            if (isset($connection)) {
                unset($connection);
            }
        }
    }

    protected function ExecuteCommand($sql, $parameters, $returnId = false) {
        $connection = null;
        try {
            $connection = new PDO($this->connectionString, $this->user, $this->password);
            $connection->beginTransaction();
            $preparedStatment = $connection->prepare($sql);
            if ($parameters != null) {
                foreach ($parameters as $key => $value) {
                    $preparedStatment->bindValue($key, $value);
                }
            }
            $preparedStatment->execute();
            $error = $preparedStatment->errorInfo();
            if ($error[2]) {
                print_r($error[2]);
                die;
            }

            if ($returnId) {
                $ID = $connection->lastInsertId();
                $connection->commit();
                return $ID;
            } else {
                $connection->commit();
            }
            return $preparedStatment->rowCount();
        } catch (PDOException $exc) {
            if ((isset($connection)) && ($connection->inTransaction())) {
                $connection->rollBack();
            }
            echo $exc->getMessage();
            die;
            return array();
        } finally {
            if (isset($connection)) {
                unset($connection);
            }
        }
    }

}
