<?php

  function autoLoad(string $className){
    if (file_exists("../src/$className.php")){
        require_once "../src/$className.php";
    }
  }

  spl_autoload_register('autoLoad');
  require_once dirname(__DIR__) . '/vendor/autoload.php';

  use Twig\Environment;
  use Twig\Loader\FilesystemLoader;

  $loader = new FilesystemLoader(dirname(__DIR__) . '/templates');
  $twig = new Environment($loader);
  
  $bd = new bdConnector();

  $login = $_GET['login'];
  $password = $_GET['password'];


  $user_id = $bd->Autorization($login, $password);

  $messages = $bd->loadMessages();

  if ($user_id != -123){
    $text = $_GET['message'];
    if (isset($text)){
      if (strlen($text) > 255){
       echo "Сообщение не должно превышать длины 255!"; 
      } else {
        $bd->saveMessages($user_id, $text);
      }
    }
  } else {
    echo "Пара логин-пароль не существует!";
  }
    
  echo $twig->render('index.html.twig', array('messages' => $messages));
?>