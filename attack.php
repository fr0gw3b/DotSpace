<?php

require_once("@/header.php");

if(!($user->hasMembership($odb))){
    header('Location: shop.php');
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dot Space - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">

    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.html"><img src="assets/images/icon/logo.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li><a href="index.php"><i class="ti-dashboard"></i> <span>Dashboard</span></a></li>
                            <?php
                                if($user->hasMembership($odb)){
                                    echo '<li><a href="attack.php"><i class="fa fa-fire"></i> <span>Attack Hub</span></a></li>';
                                } else {
                                    echo '<li><a href="shop.php"><i class="fa fa-shipping-fast"></i> <span>Shop</span></a></li>';
                                }
                            ?>
                            <li><a href="logout.php"><i class="fa fa-sign-out-alt"></i> <span>Log Out</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Attack</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span>Attack Hub</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?= htmlentities($_SESSION['username']) ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <div class="row">
                    <!-- seo fact area start -->
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="message" name="message"></div>
                                        <h4 class="header-title"><center>Attack Hub</center></h4>
                                        <form>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">Attack Type</span>
                                                    <select name="select" id="select" aria-describedby="basic-addon1" class="custom-select">
                                                        <option value="" disabled="">➡️ Basic Methods</option>
                                                        <option value="message" selected="">Spammer</option>
                                                        <option value="join">Server Joiner</option>
                                                        <option value="leave">Server Leaver</option>
                                                        <option value="friends">Friends</option>
                                                        <option value="dm" disabled="">Direct Message Spammer [SOON]</option>
                                                    </select>
                                                </div>
                                                <br>
                                                <div id="attackForm"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>             
                </div>
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright Dot Space 2018. All right reserved.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>

    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <!-- start amcharts -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/ammap.js"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- all bar chart -->
    <script src="assets/js/bar-chart.js"></script>
    <!-- all map chart -->
    <script src="assets/js/maps.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>

    <script type="text/javascript">

        const timeoutMessage = "The server took too long to respond."

        const components = {
          invite: `<div class="input-group">
                        <span class="input-group-text">Discord Invite</span>
                        <input id="invite" name="invite" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Ex : qJq5C">
                    </div><br>\n`,

          bots: `<div class="input-group">
                    <span class="input-group-text">Bots</span>
                    <input id="bots" name="bots" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Max : <?php echo $user->GetMaxBots($odb); ?>">
                </div><br>\n`,

          time: `<div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Time (Seconds)</span>
                    <input id="time" name="time" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Max : <?php echo $user->getMaxTime($odb); ?>">
                </div><br>\n`,

          message: `<div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Message</span>
                        <input id="msg" name="msg" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Ex : Raided">
                    </div><br>\n`,

          channel: `
                      <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Channel ID</span>
                        <input type="text" class="form-control" id="channelID" name="channelID" placeholder="Ex: 512528461022101526">
                      </div><br>
                    \n`,
          
          guild: `
                      <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Guild ID</span>
                        <input type="text" class="form-control" id="guildID" name="guildID" placeholder="Ex: 478687499137449984">
                      </div><br>
                    \n`,

          messageID: `<div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Channel ID</span>
                        <input id="messageID" name="messageID" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Ex : 515923533986267136">
                      </div><br>\n`,

          user: `<div class="input-group">
                        <span class="input-group-text">User Tag</span>
                        <input id="user" name="user" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Ex : X-BOT_V2#0001">
                    </div><br>\n`,
          userid: `<div class="input-group">
                        <span class="input-group-text">User ID</span>
                        <input id="userid" name="userid" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Ex : 466891186985425747">
                    </div><br>\n`,
          
          run: `<div>
          <button id="run" onclick="attackListener();" type="button" class="btn btn-lg btn-primary btn-block">
            <span>Send Attack</span>
          </button>
        </div>\n`,

        };

        const attackHTML = {
          message: [
            components.invite, components.channel,
            components.message, components.time, components.bots,
            components.run
          ].join("\n"),

          join: [
            components.invite, components.bots, components.run
          ].join("\n"),

          leave: [
            components.guild, components.run
          ].join("\n"),

          friends: [
            components.user, components.bots, components.run
          ].join("\n"),

        };

        function info(type, bubble, message) {
          $("#message").html(
            `<div class="alert alert-${type} text-center" role="alert">
                <strong>${bubble}</strong> <br> ${message}
            </div>`
          );
        }

        function changeAttackForm(type) {
          const attackForm = $("#attackForm");
          switch (type) {
            case "message":
              attackForm.html(attackHTML.message);
              break;

            case "join":
              attackForm.html(attackHTML.join);
              break;

            case "leave":
              attackForm.html(attackHTML.leave);
              break;

            case "friends":
              attackForm.html(attackHTML.friends);
              break;

            default:
              attackForm.html("");
              break;
          }
        }

        $("#select").change(() => {
            let type = $("#select :selected").val();
            changeAttackForm(type);
        });

        function attackListener() {
            let message = $("#msg").val();
            let invite = $("#invite").val();
            let guildID = $("#guildID").val();
            let type = $("#select :selected").val();
            let time = $("#time").val();
            let bots = $("#bots").val();
            let channelID = $("#channelID").val();
            let user = $("#user").val();
            let userid = $("#userid").val();
            info("success", "Success", "Please wait...");

            let form = {
              type: type,
              bots: bots,
              time: time,
              invite: invite,
              guildID: guildID,
              message: message,
              channelID: channelID,
              user: user,
              userid: userid,
            };

            $.ajax({
              url: "ajax/attack.php",
              type: "post",
              data: form,
            }).done(callback => {
                var resultdata = JSON.parse(callback);
                if(resultdata.status == "non"){
                    info("danger", "Error", resultdata.message);
                } else {
                    info("success", "Success", resultdata.message);
                }
            }).fail(() => {
              info(
                "danger", "Error",
                timeoutMessage,
              );
            });
        }

        changeAttackForm("message");

    </script>
</body>

</html>
