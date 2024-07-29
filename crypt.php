<?php

$BASE_PASSWORD = "I4mASLvT!!F0r@b1BiS1.F4Ckm.3D4dDy";

if($_SERVER["REQUEST_METHOD"] === "POST" ){
    if(isset($_POST["method"]) && isset($_POST["text"])){
    if(empty($_POST["text"]) === false) {
    if($_POST["method"] == "e") {
        echo openssl_encrypt($_POST["text"], "AES-128-CTR",
            $BASE_PASSWORD, 0, "1036832894143748");
    }
    elseif($_POST["method"] == "d" && isset($_POST["decode"])) {
        $de = openssl_decrypt($_POST["text"], "AES-128-CTR",
            substr($_POST["decode"], 0, strlen($_POST["decode"])/2).$BASE_PASSWORD.substr($_POST["decode"], strlen($_POST["decode"])/2, strlen($_POST["decode"])), 0, "1036832894143748");
            $de2 = explode($de, "|");
            $e = 0;
            $code = json_decode(file_get_contents("active.json"));
            $codes = array_column($code, 'seed');
            $trip = array_column($code, 'trip');
            for($i = 0;$i < count($code); $i++) {
            if(str_contains($de2[1],$trip[$i])){
                $e = 1;
            }}
            if($e = 1) {
                echo openssl_decrypt($_POST["text"], "AES-128-CTR",
            substr($_POST["decode"], 0, strlen($_POST["decode"])/2).$BASE_PASSWORD.substr($_POST["decode"], strlen($_POST["decode"])/2, strlen($_POST["decode"])), 0, "1036832894143748");
            }
            else {
                echo $_POST["text"];
            }
    }
    else {
        echo "<script>alert('no method');</script>";
    }
    }
    else {
        echo "<script>alert('no text');</script>";
    }
}
if(isset($_POST["seed"])){
    $id = uniqid();
   if(empty($_POST["seed"]))  {
        
    }
    else {
        if(isset($_POST["m"]) && $_POST["m"] == "x") {
            $code = json_decode(file_get_contents("active.json"));
            $codes = array_column($code, 'seed');
            $trip = array_column($code, 'trip');
            for($i = 0;$i < count($code); $i++) {
            if(str_contains($_POST["seed"],$codes[$i])){
                
             echo openssl_encrypt(str_replace("|","",$_POST["text"])."|". $trip[$i], "AES-128-CTR",
            substr($_POST["seed"], 0, strlen($_POST["seed"])/2).$BASE_PASSWORD.substr($_POST["seed"], strlen($_POST["seed"])/2, strlen($_POST["seed"])), 0, "1036832894143748");
            }
            }
        }
        else {
    $write = Array( 
"seed" => $_POST["seed"],
"enc" => substr($_POST["seed"], 0, strlen($_POST["seed"])/2).$BASE_PASSWORD.substr($_POST["seed"], strlen($_POST["seed"])/2, strlen($_POST["seed"])),
"trip" => $id,
"thread" => "pending"

);

$test = file_get_contents("active.json");
if(empty($test)) {
$json = json_encode($write);
}
else {
    
    $json = file_get_contents("active.json") . "," . json_encode($write);
}
function evaluate(){$code2 = json_decode(file_get_contents("active.json"));
if(empty($code2)){
    return false;
}
else{
            $codes2 = array_column($code2, 'seed');
           $y = 0;
            for($l = 0;$l < count($code2); $l++) {
            if(in_array($_POST["seed"],$codes2)){
                $y = 1;
            }}
    if($y === 1) {
        return true;
    }
    else {
        return false;
    }
}
} 
if(evaluate()===false){
file_put_contents("active.json", "[". str_replace("]"," ",str_replace("["," ",$json))."]");
echo openssl_encrypt($_POST["text"]."|". $id, "AES-128-CTR",
            substr($_POST["seed"], 0, strlen($_POST["seed"])/2).$BASE_PASSWORD.substr($_POST["seed"], strlen($_POST["seed"])/2, strlen($_POST["seed"])), 0, "1036832894143748");
}
else {
    echo "Password in use, try again";
}
}}}
    
if(isset($_POST["seed"]) && isset($_POST["link"])) {
     $code = json_decode(file_get_contents("active.json"));
            $codes = array_column($code, 'seed');
           
            for($i = 0;$i < count($code); $i++) {
            if(str_contains($_POST["seed"],$codes[$i])){
                $ja = Array(
                    "pass" => $_POST["seed"],
                    "link" => $_POST["link"]
                    );
                    if(str_contains(file_get_contents("thread.json"), json_encode($ja)) === false) {
                        $e = file_get_contents("thread.json");
                        if(empty(file_get_contents("thread.json"))){
                        file_put_contents("thread.json", "[". str_replace("]"," ",str_replace("["," ",$e . json_encode($ja)))."]");
                        }
                            else{
                    file_put_contents("thread.json", "[". str_replace("]"," ",str_replace("["," ",$e . "," . json_encode($ja)))."]");
                        }
                    }
                    
                    break;
            }}
}


}

?>
