<?php

namespace Repse\Sa\databese;

use PDO;
use PDOException;
use Envms\FluentPDO\Query;

class DB{

    protected string $dbHost;
    protected string $dbName;
    protected string $dbUsername ;
    protected string $dbCharset;
    protected null|string $dbPassword;
    public $con;
    
    public function __construct(){

        $this->dbHost = $_ENV['DB_HOST'];
        $this->dbName = $_ENV['DB_NAME'];
        $this->dbUsername = $_ENV['DB_USER'];
        $this->dbCharset = 'utf8mb4';
        $this->dbPassword = $_ENV['DB_PASS'] ?? null;
        $this->con = $this->connect();
    }

    public function connect()
    {
        try{

            $dns = 'mysql:host='.$this->dbHost.';dbname='.$this->dbName.';charset='.$this->dbCharset;
            $db = new PDO($dns,$this->dbUsername,$this->dbPassword);
            #set atrr for pdo
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); #for public change EXCEPTION to SILENT
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC); 
            $fpdo = new Query($db);
                return $fpdo;

        }catch(PDOException $exception){

            if($exception->getCode() == 2002)
                echo '<b>PLease conctact admin with message Database conection doesnt exist';
            $err = $exception->getMessage() . (int)$exception->getCode();
            throw new PDOException($err);    
        }
    }

    public function getMemeberData($username)
    {
        $stmt = $this->con->from('members')->where('username',$username);
        $result = $sttm->fetch();
        $this->con->close();
        return $result;
    }

    public function getID($username)
    {
        $stmt = $this->con->from('members')->where('username',$username);
        $result = $stmt->fetch('memberID');
        return $result;
    }
}
