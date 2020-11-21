<?php
/**
 * Controller for dice game.
 */


/**
 * Reset session
 * 
 * @return void
 */

function resetSession()
{
    $_SESSION["diceGameReset"] = null;
    $_SESSION["setNumberOfDices"] = null;
    $_SESSION["numberOfDices"] = null;
    $_SESSION["valueIsOne"] = null;
    $_SESSION["rollDices"] = null;
    $_SESSION["cancelRound"] = null;
    $_SESSION["robot"] = null;
    $_SESSION["user"] = null;
    $_SESSION["firstRound"] = null;
    $_SESSION["currentPlayer"] = null;
    $_SESSION["winner"] = null;
    $_SESSION["userName"] = null;
}


/**
 * Start new game. Clear all variables in session.
 */

$app->router->get("dice/startGame", function () use ($app) {
    $title = "Dice Game";

    resetSession();

    $app->page->add("dice/play");
    $app->page->add("dice/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Store data from POST (number of dices per roll, user name and bool to
 * know that these variables are set) to SESSION when form is sent.
 */

$app->router->post("dice/form-process-number-of-dices", function () use ($app) {
    $_SESSION["numberOfDices"] = $_POST["numberOfDices"] ?? null;
    $_SESSION["userName"] = !empty($_POST["userName"]) ? $_POST["userName"] : "You";
    $_SESSION["setNumberOfDices"] = $_POST["setNumberOfDices"] ?? null;
    return $app->response->redirect("dice/playGame");
});


/**
 * Create player objects and indicate the first round by setting
 * $_SESSION["firstRound"] = true. Create FirstRound object to roll one dice
 * per player and then compare the values. The player that gets the highest
 * number will start the game.
 */

$app->router->post("dice/form-process-first-dice-roll", function () use ($app) {
    $_SESSION["robot"] = new chly19\Dice\Robot($_SESSION["numberOfDices"]);
    $_SESSION["user"] = new chly19\Dice\Player($_SESSION["numberOfDices"]);
    $_SESSION["firstRound"] = true;

    $firstRoll = new chly19\Dice\FirstRound();
    $firstRoll->roll();
    $playerStart = $firstRoll->compare();

    if ($playerStart == 1) {
        $_SESSION["currentPlayer"] = "Robot";
        return $app->response->redirect("dice/robot-first-round");
    }
    $_SESSION["currentPlayer"] = $_SESSION["userName"];
    return $app->response->redirect("dice/playGame");
});


/**
 * Add dice/play and dice/debug.
 */

$app->router->get("dice/playGame", function () use ($app) {
    $title = "Dice Game";
    $app->page->add("dice/play");
    $app->page->add("dice/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Roll dices. If at least one of the dices is 1, clear the game round sum.
 * If not, calculate the current game round sum.
 * 
 * If the total sum added by the current game round sum is larger than or
 * equal to 100, calculate the total sum and store the player name in
 * $_SESSION["winner].
 * 
 * When it is the robot's turn, compare the total sum for the players and
 * based on the difference, determine difficulty level for the robot. After
 * every roll for the robot, two conditions determines if the robot will
 * roll the dices again:
 *      1. Check if the rolled dices is not 1.
 *      2. Get bool from the method isThrowingDiceAgain() that calculates the
 *         probability for not getting 1 in the next roll.
 * 
 * @param object $currPlayer        The current player object
 * 
 * @return void
 */

function roll($currPlayer)
{
    do {
        $currPlayer->roll();
        $currPlayer->values();
        $currPlayer->calcRoundGraphic();
        $_SESSION["valueIsOne"] = $currPlayer->valueIsOne();

        if (isset($_SESSION["valueIsOne"])) {
            $currPlayer->clearRound();
        } else {
            $currPlayer->calcRoundSum();
            if (($currPlayer->getRoundSum() + $currPlayer->getTotalSum())
                >= 100) {
                $currPlayer->calcTotalSum();
                $_SESSION["winner"] = $_SESSION["currentPlayer"];
                break;
            }
        }

        if ($_SESSION["currentPlayer"] == "Robot") {
            $currPlayer = calcRobotDifficultyLevel($currPlayer);
        }
    } while ($_SESSION["currentPlayer"] == "Robot" &&
        $currPlayer->isThrowingDiceAgain() &&
        !isset($_SESSION["valueIsOne"]));
}


/**
 * When it is the robot's turn, compare the total sum for the players and
 * based on the difference, determine difficulty level for the robot. Then
 * calculate robot algorithm based on difficulty level.
 * 
 * @param object    $currPlayer         Robot player object
 * 
 * @return object   $currPlayer         Robot player object
 */

function calcRobotDifficultyLevel($currPlayer)
{
    $userTotalSum = $_SESSION["user"]->getTotalSum();
    $robotTotalSum = $currPlayer->getTotalSum();

    if (($userTotalSum > $robotTotalSum) &&
        ($userTotalSum - $robotTotalSum > 15)) {
        $min = 1;
        $level = 4;
    } else if ($robotTotalSum - $userTotalSum > 15) {
        $min = 2;
        $level = 12;
    } else {
        $min = 1;
        $level = 8;
    }

    $currPlayer->calcIfThrowingDiceAgain($min, $level);
    return $currPlayer;
}


/**
 * Game round for the robot's first round.
 */

$app->router->get("dice/robot-first-round", function () use ($app) {
    $title = "Dice Game";
    roll($_SESSION["robot"]);
    $_SESSION["rollDices"] = true;

    $app->page->add("dice/play");
    $app->page->add("dice/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Calculate the total sum when the player has canceled the game round.
 * 
 * @param object $currPlayer        The current player
 * 
 * @return object $currPlayer       The current player
 */

function cancelRound($currPlayer)
{
    $currPlayer->calcTotalSum();
    $currPlayer->clearRound();
    $currPlayer->clearRoundGraphic();

    if ($_SESSION["currentPlayer"] == "Robot") {
        $_SESSION["robot"] = $currPlayer;
        $_SESSION["currentPlayer"] = $_SESSION["userName"];
        $currPlayer = $_SESSION["user"];
        $_SESSION["rollDices"] = null;
    } else {
        $_SESSION["user"] = $currPlayer;
        $_SESSION["currentPlayer"] = "Robot";
        $currPlayer = $_SESSION["robot"];
        $_SESSION["rollDices"] = true;
    }

    $_SESSION["cancelRound"] = null;
    $_SESSION["valueIsOne"] = null;
    return $currPlayer;
}


/**
 * Store data from POST to SESSION when form is sent. Store current player
 * object in $currPlayer.
 */

$app->router->post("dice/form-process-play-game", function () use ($app) {
    $_SESSION["rollDices"] = $_POST["rollDices"] ?? null;
    $_SESSION["diceGameReset"] = $_POST["reset"] ?? null;
    $_SESSION["cancelRound"] = $_POST["cancelRound"] ?? null;
    $_SESSION["firstRound"] = null;

    if ($_SESSION["currentPlayer"] == "Robot") {
        $currPlayer = $_SESSION["robot"];
        $_SESSION["rollDices"] = true;
    } else {
        $currPlayer = $_SESSION["user"];
    }

    if ($_SESSION["cancelRound"]) {
        $currPlayer = cancelRound($currPlayer);
    }

    if (isset($_SESSION["rollDices"])) {
        roll($currPlayer);
    }

    if (isset($_SESSION["diceGameReset"])) {
        resetSession();
        return $app->response->redirect("dice/startGame");
    }
    return $app->response->redirect("dice/playGame");
});
