<?php
namespace Base;
/**
 * Class DataBase
 */
class DataBase
{
    private $db;

    /**
     * @var \PDO|null
     */
    protected $pdo = null;

    /**
     * DataBase constructor.
     */
    public function __construct()
    {
        $this->pdo = new \PDO('mysql:host=localhost;port=3306;dbname=boutique;charset=utf8', 'root', '');
        
    }

    /**
     * @param $request
     * @param array $args
     * @return bool|false|\PDOStatement
     */
    public function query($request, array $args = [])
    {
        if(!empty($args)){
            $statement =  $this->pdo->prepare($request);
            $statement->execute($args);
        } else {
            $statement = $this->pdo->query($request);
        }

        return $statement ;
    }
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    public function requete($sql, $data = array())
    {
        $req = $this->db->prepare($sql);
        $req -> execute($data);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
}