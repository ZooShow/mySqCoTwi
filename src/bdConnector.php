<?php

class bdConnector
{
    public function Autorization($login, $pas){
        $user = 'USER';
        $password = 'pswrd';
        $db = 'Messenger';
        $host = 'localhost';
        $charset = 'utf8';
        $pdo = new PDO("mysql:host=$host;dbname=$db;cahrset=$charset", $user, $password);
        $query = "SELECT * FROM USER WHERE LOGGIN = ". "'$login'". " AND PASSWORD ="."'$pas';";

        $usr = $pdo->query($query);

        $a = 0;
        $id;
        while ($row = $usr->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['USER_ID'];
            $a++;
        }

        $usr = null;
        $pdo = null;

        if ($a == 1){
            return $id;
        } else {
            
            return -123;
        }
    }
    
    public function saveMessages($userID, $text){
        $user = 'USER';
        $password = 'pswrd';
        $db = 'Messenger';
        $host = 'localhost';
        $charset = 'utf8';
        $pdo = new PDO("mysql:host=$host;dbname=$db;cahrset=$charset", $user, $password);
        $query = "INSERT INTO MESSAGES (USER_ID, MESSAGE) VALUES ($userID, " . "'$text'". ");";
        $pdo->exec($query);
        $pdo = null; 
    }
    
    public function loadMessages(){
        $user = 'USER';
        $password = 'pswrd';
        $db = 'Messenger';
        $host = 'localhost';
        $charset = 'utf8';
        $pdo = new PDO("mysql:host=$host;dbname=$db;cahrset=$charset", $user, $password);
        $query = "SELECT U.LOGGIN, M.MESSAGE FROM USER AS U INNER JOIN MESSAGES AS M ON U.USER_ID=M.USER_ID;";
        
        $messages = $pdo->query($query)->fetchAll();
               
        
        $pdo = null;
        return $messages;
    }
}

?>