<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_GET["gameID"])) {
        header("location: ../search");
        return;
    }

    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

    $gameID = $_GET["gameID"];

    $game = callProcedure("spGetGameFromID", $gameID)[0];

    $gameName = $game["gameName"];
    $developerName = $game["developerName"];
    $gameDescription = $game["gameDescription"];
    $gameGenre = $game["gameGenre"];
    $gameDate = $game["gameDate"];
    $gamePicture = base64_encode($game["gamePicture"]);
    $compatibleWindows = ($game["compatibleWindows"] == 1) ? "<img src=\"../../images/os/windows.svg\">" : "";
    $compatibleMacOS = ($game["compatibleMacOS"] == 1) ? "<img src=\"../../images/os/macos.svg\">" : "";
    $compatibleLinux = ($game["compatibleLinux"] == 1) ? "<img src=\"../../images/os/linux.svg\">" : "";

    $requestID = $game["requestID"];

    if($requestID != NULL) {
        $request = callProcedure("spGetRequestFromID", $requestID)[0];

        $requestAction = ucfirst($request["requestAction"]);
        $requestReason = ucfirst($request["requestReason"]);
    }

    $title = $gameName;
    require(dirname(__DIR__, $steps)."/header/index.php");
?>

<div class="game">
    <form action="game.php? <?php echo "requestID=$requestID" ?>" method="post">
        <?php
            echo "
                <div class=\"game-info\">
                    <h1>$gameName</h1>
                    <h2>$developerName</h2>
                    <h3>$gameDescription</h3>
                    <h4>$gameGenre</h4>
                    <h5>$gameDate</h5>
                    <img src = \"data:image/png;base64,$gamePicture\">
                    <div class=\"icons\">$compatibleWindows $compatibleMacOS $compatibleLinux</div>
                </div>
            ";

            if($requestID != NULL) {
                if ($_SESSION["userRole"] == "admin" || $_SESSION["userID"] == $request["userID"]) {
                    echo "
                        <b>Request Action:</b> $requestAction<br>
                        <b>Request Reason:</b> $requestReason <br>
                    ";
                }
            }

            if(isset($_SESSION["userID"])) {
                if($_SESSION["userRole"] == "admin") {
                    if($requestID != NULL) {
                        echo "
                            <div class=\"request\">
                                <textarea class=\"reason\" style=\"display: block\"name=\"requestReason\" placeholder=\"Reason\" rows=\"8\"></textarea>
                                <button class=\"accept\" name=\"accept\">Accept</button>
                                <button class=\"deny\" name=\"deny\">Deny</button>
                            </div>
                        ";   
                    }
                }
            }
        ?>
    </form>
</div>

<?php
    require(dirname(__DIR__, $steps)."/footer/index.php")
?>