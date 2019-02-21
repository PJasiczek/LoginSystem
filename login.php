<?php
    session_start();
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Piotr Jasiczek"/>
        <meta name="robots" content="index,follow"/>
        <meta name="description" content=""/>
        <title> Wyślij plik </title>
        <meta name="keywords" content="logowanie"/>
        <meta name="copyright" content="Piotr Jasiczek"/>
        <link rel="stylesheet" href="css/main.css">
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="container_upload_file_main">
            <?php
                echo "<span class='container_logout'> <a href='index.php?action=logout'> <i style='font-size:15px; color:black' class='fa'>&#xf08b;</i> </a> Witaj ".ucwords($_SESSION['user'])." ! </span>";
            ?>
            <div class="container_upload_file">
                <div class="upload_file">
                    <form action="login.php" method="post" enctype="multipart/form-data">
                    <div>
                        <div>
                            <input type="hidden" name="MAX_FILE_SIZE" value="30720" />
                        </div>
                        <div>
                            <input type="file" name="file" />
                        </div>
                         <?php
                            if(isset($_FILES['file'])){
                                switch($_FILES['file']['error']){

                                    case 0:
                                    {
                                        if($_FILES['file']['type'] == "image/jpeg" || $_FILES['file']['type'] == "image/png" || $_FILES['file']['type'] == "video/mp4"){
                                                move_uploaded_file($_FILES['file']['tmp_name'], "send_image/".md5(rand()*rand()+rand()).$_FILES['file']['name']);
                                                echo "<div style=\" position: absolute; width: 700px; margin: 0 auto; padding-top: 20px; text-align: center; font-family: 'Quicksand', sans-serif; font-size: 12px; color: red;\"><b> Plik ". $_FILES['file']['name']." został przesłany z powodzeniem </b></div>";
                                            }else{
                                                echo "<div style=\" position: absolute; width: 200px; margin: 0 auto; padding-top: 20px; text-align: center; font-family: 'Quicksand', sans-serif; font-size: 12px; color: red;\"><b> Nieobsługiwany typ pliku </b></div>";
                                            }
                                    }
                                    break;

                                    case 1:
                                    {
                                        echo "<div style=\" position: absolute; width: 200px; margin: 0 auto; padding-top: 10px; text-align: center; font-family: 'Quicksand', sans-serif; font-size: 12px; color: red;\"><b> Za duży rozmiar pliku </b></div>";
                                    }
                                    break;

                                    case 2:
                                    {
                                        echo "<div style=\" position: absolute; width: 200px; margin: 0 auto; padding-top: 10px; text-align: center; font-family: 'Quicksand', sans-serif; font-size: 12px; color: red;\"><b> Za duży rozmiar pliku </b></div>";
                                    }
                                    break;

                                    case 3:
                                    {
                                        echo "<div style=\" position: absolute; width: 200px; margin: 0 auto; padding-top: 10px; text-align: center; font-family: 'Quicksand', sans-serif; font-size: 12px; color: red;\"><b> Przesłany plik został tylko częściowo przesłany </b></div>";
                                    }
                                    break;

                                    case 4:
                                    {
                                        echo "<div style=\" position: absolute; width: 200px; margin: 0 auto; padding-top: 10px; text-align: center; font-family: 'Quicksand', sans-serif; font-size: 12px; color: red;\"><b> Żaden plik nie został przesłany </b></div>";
                                    }
                                    break;
                                }
                            }
                        ?>
                        <div>
                            <input type="submit" value="Wyślij plik" />
                        </div>
                    </div>
                    </form>
                </div>
           </div>
        </div>
    </body>
</html>