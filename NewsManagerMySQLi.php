<?php 

class NewsManagerMySQLi extends NewsManager
{

  protected $db;

  public function __construct(MySQLi $db)
  {
    $this->db = $db;
    $this->createTableNews($db);
  }


  public function createTableNews($db)
  {
    try 
    {
      $this->db->query("CREATE TABLE IF NOT EXISTS `news` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `autor` VARCHAR(30) NOT NULL,
        `title` VARCHAR(30) NOT NULL,
        `contained` TEXT NOT NULL,
        `dateCreation` INT NOT NULL,
        `dateModification` INT NOT NULL DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    } 
    catch (PDOException $e) 
    {
      die("DB ERROR: ". $e->getMessage());
    }
  }

  public function add(News $news)
  {
/*     $time = time();
    $contained = $news->contained();
    $title = $news->title();
    $autor = $news->autor();
    $null = NULL;

    
    $query = "INSERT INTO `news`(`autor`, `title`, `contained`, `dateCreation`, `dateModification`) VALUES (?,?,?,?,?)";

    $req = $this->db->prepare($query);

    $req->bind_param('sssii', 
                      $autor, 
                      $title, 
                      $contained,
                      $time,
                      $null
                    );

    $req->execute();
    print_r($news); */
  }

  public function count()
  {

  }

  public function delete($id)
  {

  }
  public function getList($start = -1, $limit = -1)
  {

  }

  public function getUnique($id)
  {
    $query = 'SELECT id, autor, title, contained, dateCreation, dateModification FROM news WHERE id = ?';

    $req = $this->db->prepare($query);
    $req->bind_param('i', $id); //'s'->string & 'i'->integer
    $req->execute();
    $result = $req->get_result();

    return $result->fetch_assoc();
  }

  public function save(News $news)
  {

  }

  public function update(News $news)
  {

  }

}