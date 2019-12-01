<?php

class users {

    function UserIsConnected()

    {
        if(isset($_SESSION['username']) && isset($_SESSION['id']) && isset($_SESSION['mail'])){
            return true;
        }else{
            return false;
        }
    }

    function hasMembership($odb)

    {

        $SQL = $odb -> prepare("SELECT `expire` FROM `users` WHERE `ID` = :id");

        $SQL -> execute(array(':id' => $_SESSION['id']));

        $expire = $SQL -> fetchColumn(0);

        if (time() < $expire)

        {

            return true;

        }

        else

        {

            $SQLupdate = $odb -> prepare("UPDATE `users` SET `membership` = 0 WHERE `ID` = :id");

            $SQLupdate -> execute(array(':id' => $_SESSION['id']));

            return false;

        }

    }

    function getMemberShip($odb)

    {

        $SQL = $odb -> prepare("SELECT `membership` FROM `users` WHERE `ID` = :id");

        $SQL -> execute(array(':id' => $_SESSION['id']));

        return $SQL -> fetchColumn(0);     
    }

    function getMaxTime($odb)

    {

        $user = new users;

        $SQL = $odb -> prepare("SELECT `time` FROM `plans` WHERE `id` = :id");

        $SQL -> execute(array(':id' => $user->getMemberShip($odb)));

        return $SQL -> fetchColumn(0);   
    }

    function GetMaxBots($odb)

    {
        $user = new users;

        $SQL = $odb -> prepare("SELECT `bots` FROM `plans` WHERE `id` = :id");

        $SQL -> execute(array(':id' => $user->getMemberShip($odb)));

        return $SQL -> fetchColumn(0);   
    }

}

function alert($type, $strong, $message)

{
    $alert = '
        <div class="alert alert-'. $type .'" role="alert">
            <center><strong>'. $strong .'</strong> <br> '. $message .'</center>
        </div>
    ';
    echo $alert;
}

function setInterval($f, $milliseconds)
{
    $seconds=(int)$milliseconds;
    do{
        $f;
    } while (time() <= $seconds);
}
