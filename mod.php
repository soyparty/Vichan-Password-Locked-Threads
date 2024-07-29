<?php
session_start();
?>
<html>

<head>
    <title>Encrypt Mod Portal</title>
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
            <hr>
                        <form method="POST" action="">
            <input style = "display:none" type="text" name="log" id = "log2" value = "e" ></input>
            Search <input type="text" name="term"></input>
            <input type="submit" name="submit" value="Go"></input>
            </form>
            <div id = "result"></div>
            <hr>
   </body>
   <script>
       
       function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      document.getElementById("log2").value = c.substring(name.length, c.length);
    }
  }
  return "";
}
getCookie("e");
   </script>
</html>
<?php

if($_SERVER["REQUEST_METHOD"] && isset($_POST["user"]) && isset($_POST["pass"])) {
    
    if($_POST["user"] == "admin" && $_POST["pass"] == "changeme"){
        $dcode = file_get_contents("thread.json");
        $decode = json_decode($dcode,true);
        $link = array_column(array_reverse($decode), "link");
        $seed = array_column(array_reverse($decode), "pass");
        // you can also replace the IV if you need.
        setcookie('e', openssl_encrypt($_SERVER["REMOTE_ADDR"], "AES-128-CTR",
            "[ENTER 2ND PASS]", 0, "0192034627925103"), time() + (86400 * 30), "/");

        for($i = 0; $i < count($link); $i++) {
            echo "<b>password: ".$seed[$i]." : ".$link[$i]."</b><br>";
            
        }
        echo "<hr>";
    }
}
if($_SERVER["REQUEST_METHOD"] && isset($_POST["log"]) && isset($_POST["term"])) {
    
    
        if($_POST["log"] = openssl_decrypt($_COOKIE["e"], "AES-128-CTR",
            "[ENTER 2ND PASS]", 0, "0192034627925103")) {
                $dcode = file_get_contents("thread.json");
        $decode = json_decode($dcode,true);
        $link = array_column(array_reverse($decode), "link");
        $seed = array_column(array_reverse($decode), "pass");
        for($i = 0; $i < count($link); $i++) {
            if($link[$i] = $_POST["term"]){
                echo "<script>let p = document.createElement('p'); p.innerText = 'The password for that thread is: ".$seed[$i]."'; document.getElementById('result').appendChild(p);</script>";
            }
            
        }
            }

}
?>
