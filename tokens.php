
<?php

require_once("@/header.php");

?>
<!DOCTYPE html>
<html>
<head>
    <title>test</title>
</head>
<body>
<?php

                    if(isset($_POST['modify'])){
                        $token = $_POST['tokens'];
                        if(empty($token)){
                            echo '<div class="alert alert-danger text-center"><strong>Error !</strong><br>All fields is required !</div><meta http-equiv="REFRESH" content="1;url=index.php">';
                            exit();
                        }

                        $array = explode(PHP_EOL, $token);
                        foreach ($array as $account){
                            $sql = $odb -> query("INSERT INTO tokens (token) VALUES ('$account')");
                        }
                        echo '<div class="alert alert-success text-center"><strong>Succes !</strong><br>You just added tokens !</div><meta http-equiv="REFRESH" content="2;url=index.php">';
                    }

                    ?>
                    <div class="block block-fx-pop">
                        <div class="block-content block-content-full">
                            <form method="post">
                                <div class="form-group row text-center">
                                    <div class="col-12">
                                        <label>Tokens</label>
                                        <textarea  class="form-control text-center" name="tokens" rows="10"></textarea>
                                    </div>
                                </div>
                                <center><button type="submit" name="modify" class="btn btn-hero-sm btn-hero-primary mt-2">Add</button></center>
                            </form>
                        </div>
                    </div>
</body>
</html>
