<html>

<head>
    <title>Crypt Api</title>
    <link rel="icon" type="image/x-icon" href="classic.png">
    <style>
        body {
            background-image:linear-gradient(black, #333333);
                color: white;
    font-weight: bold;
    font-family: arial, helvetica, sans-serif;
    text-align:center;
        }
        .title {
            text-shadow:0 0 5px DarkGray, 0 0 5px gray;
        }
        .title2 {
            color:LightBlue;
            text-shadow:0 0 5px DarkBlue, 0 0 5px blue;
        }
        a {
            color:LightGreen;
            text-shadow:0 0 5px DarkGreen, 0 0 5px green;
        }
    </style>
</head>
<body>
<h1 class = "title2">Janny Login:</h1>
<hr>
            <form method="POST" action="">
            User <input type="text" name="user"></input><br/>
            Pass <input type="password" name="pass"></input><br/>
            <input type="submit" name="submit" value="Go"></input>
            </form>
            <a href = "index.html">Back</a>
            <hr>
   </body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"] && isset($_POST["user"]) && isset($_POST["pass"])) {
    
    if($_POST["user"] == "admin" && $_POST["pass"] == "changeme"){
        $dcode = file_get_contents("thread.json");
        $decode = json_decode($dcode,true);
        $link = array_column(array_reverse($decode), "link");
        $seed = array_column(array_reverse($decode), "pass");
        for($i = 0; $i < count($link); $i++) {
            echo "<b>password: ".$seed[$i]." : ".$link[$i]."</b><br>";
            
        }
        echo "<hr>";
    }
}
?>
