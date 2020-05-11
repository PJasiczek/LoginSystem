<?php
    session_start();
    if(!isset($_SESSION['initiate'])){
        session_regenerate_id();
        $new_session_id = session_id();
        session_write_close();
        session_id($new_session_id);
        session_start();
        $_SESSION['initiate'] = 1;
    }

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Piotr Jasiczek"/>
        <meta name="robots" content="index,follow"/>
        <meta name="description" content=""/>
        <title>Zaloguj się</title>
        <meta name="keywords" content="logowanie"/>
        <meta name="copyright" content="Piotr Jasiczek"/>
        <link rel="stylesheet" href="css/main.css">
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="container_main">
            <div class="container_login">
                <div class="login">
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <div>
                        <div>
                           <input type="text" value="Username" name="login" maxlength="8" size="15"/>
                        </div>
                        <div>
                           <input type="password" value="Password" name="password" maxlength="15" size="15" />
                        </div>
                        <div>
                            <input type="submit" value="Zaloguj się" />
                        </div>
                    </div>
                </form>
                    <?php
                        if(isset($_GET['action']) && ($_GET['action'] == "logout")){                  

                            $_SESSION['online'] = 0;
                            session_destroy();
                            echo "<div style=\" position: absolute; width: 200px; margin-top: 15%; margin: 0 auto; padding-top: 20px; text-align: center; font-family: 'Quicksand', sans-serif; font-size: 10px; color: red;\"><b> Nastąpiło poprawne wylogowanie! </b></div>";                 
                        }
                        if(($_SESSION['online'] == 1) && ($_SESSION['specification_info'] != $_SERVER['HTTP_USER_AGENT'])){

                            $_SESSION['online'] = 0;
                            session_destroy(); 
                            echo "<div style=\" position: absolute; width: 200px; margin-top: 15%; margin: 0 auto; padding-top: 20px; text-align: center; font-family: 'Quicksand', sans-serif; font-size: 10px; color: red;\"><b> Prosimy o ponowne wprowadzenie nazwy użytkownika i hasła. </b></div>";
                        }
                        if(($_SESSION['online'] == 1) && ((time() - $_SESSION['time']) > 300)){

                            $_SESSION['online'] = 0;
                            session_destroy();
                            echo "<div style=\" position: absolute; width: 200px; margin-top: 15%; margin: 0 auto; padding-top: 20px; text-align: center; font-family: 'Quicksand', sans-serif; font-size: 10px; color: red;\"><b> Nastąpiło wylogowanie w wyniku przekroczenia czasu trwania sesji. </b></div>";
                        }
                        
                        if((isset($_POST['login']) && isset($_POST['password'])) || ($_SESSION['online'] == 1)){

                            if((!empty($_POST['login']) && !empty($_POST['password'])) || ($_SESSION['online'] == 1)){

                                if($_SESSION['online'] == 0){
                                    $username = filter_var($_POST['login'],FILTER_SANITIZE_STRING);
                                    $password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
                                }
                                
                                
                                if(($username == "username" && $password == "password") || ($_SESSION['online'] == 1)){
                                    
                                    if($_SESSION['online'] == 0)
                                        $_SESSION['user'] = $username;
                                    
                                    echo "<div style=\" position: absolute; width: 200px; margin-top: 15%; margin: 0 auto; padding-top: 20px; text-align: center; font-family: 'Quicksand', sans-serif; font-size: 10px; color: red;\"><b> Nastąpiło poprawne zalogowanie! </b></div>";
                                    
                                    $_SESSION['time'] = time();
                                    $_SESSION['specification_info'] = $_SERVER['HTTP_USER_AGENT'];
                                    header('Location: login.php');
                                    exit;
                                }else{
                                    echo "<div style=\" position: absolute; width: 200px; margin-top: 15%; margin: 0 auto; padding-top: 20px; text-align: center; font-family: 'Quicksand', sans-serif; font-size: 10px; color: red;\"><b> Wprowadzona nazwa użytkownika lub hasło nie należy do konta. Sprawdź swoją nazwę użytkownika lub hasło i spróbuj ponownie. </b></div>";
                                }
                        }else{
                            echo "<div style=\" position: absolute; width: 200px; margin-top: 15%; margin: 0 auto; padding-top: 20px; text-align: center; font-family: 'Quicksand', sans-serif; font-size: 10px; color: red;\"><b> Nie została podana nazwa użytkownika lub hasło. Spróbuj ponownie. </b></div>";
                        }
                    }              
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>

