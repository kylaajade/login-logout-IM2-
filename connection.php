<?php
$newconnection = new Connection();
Class Connection{
    private $server = "mysql:host=localhost;dbname=store_db";
    private $user = "root";
    private $pass = "";

private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ);
protected $con;

public function OpenConnection(){
    try{
        $this->con = new PDO($this->server, $this->user, $this->pass, $this->options); return $this->con;
    }
    catch(PDOException $e){
        echo "There is some problem is the connection: ".$e -> getMessage();
    }
}
public function closeConnection(){$this -> con = null;}
public function userLogin()
    {
        $connection = $this->openConnection();
        if (isset($_POST['user_login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $connection->prepare('SELECT * FROM user_table WHERE username=:username AND password=:password');
            $user->execute(['username' => $username, 'password' => $password]);
            $result = $user->fetch();
            if ($result) {
                $_SESSION['name'] = $result->name;
                header('Location: index.php');
            } else {
                header('Location: login.php');
            }
        }
    }
    public function useLogout()
    {
        if (isset($_POST['user_out'])) {
            session_destroy();
            header('Location: login.php');
        }
    }
}

 ?>