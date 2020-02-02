<?php
class DBFactory
{

  private $host,
            $dbname,
            $root,
            $root_password; // Password: MAC = "root" ; Linux = ""


  public function __construct(array $data)
  {
    $this->hydrate($data);
  }

  public function hydrate(array $data) 
  {
    if (!empty($data)) 
    {
        foreach ($data as $key => $value) 
        {
          $method = 'set'.ucfirst($key);
          if (method_exists($this, $method))
          {
              $this->$method($value);
          }
          else
          {
            return "<br>Misstyping Setters/key<br>";
          }
        }
    }
    else
    {
      return "<br>Array empty, expect data.<br>";
    }
  }

  // Getters
  public function host()
  {
    return $this->host;
  }

  public function dbname()
  {
    return $this->dbname;
  }

  public function root()
  {
    return $this->root;
  }

  public function rootPassword()
  {
    return $this->root_password;
  }

  // Setters
  public function setHost($host)
  {
    $this->host = $host;
  }

  public function setDbname($dbname)
  {
    $this->dbname = $dbname;
  }

  public function setRoot($root)
  {
    $this->root = $root;
  }

  public function setRoot_password($root_password)
  {
    $this->root_password = $root_password;
  }



  public function getMysqlConnexionWithPDO()
  {
    $db = new PDO("mysql:host={$this->host()};dbname={$this->dbname()}", $this->root(), $this->rootPassword());
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $this->checkConnection($db);
    return $db;
  }
  
  public function getMysqlConnexionWithMySQLi()
  {
    $db = new MySQLi($host, $root, $root_password, $dbname);
    $this->checkConnection($db);
    return $db;
  }

  public function checkConnection($db)
  {
    if( $db == TRUE )
    {
      echo 'Connected successfully<br>';
    }
    else
    {
      echo 'Connection failled<br>';
    }
  }

}

