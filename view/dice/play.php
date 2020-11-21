<?php

namespace Anax\View;

/**
 * View for dice game.
 */

echo "<h1>Dice Game 100</h1>" .
    "<i><a class='red' href='../games/dice-game'>Game Rules</a></i>";

/**
 * Is true when the game has started and player objects are created.
 */

if (isset($_SESSION["robot"])) {
    /**
     * In the first game round, a message shows which player that will start
     * the game, based on $_SESSION['currentPlayer'].
     */

    if (isset($_SESSION["firstRound"])) {
        if ($_SESSION['currentPlayer'] == "You") {
            $start = "start";
        } else {
            $start = "starts";
        }

        echo "<h3 class='red'>" . $_SESSION['currentPlayer'] . " " . $start .
            " the game!</h3>";
    }

    /**
     * Based on $_SESSION['currentPlayer'], update some variables.
     */

    if ($_SESSION['currentPlayer'] == "Robot") {
        $currentPlayer = $_SESSION["robot"];
        $emphasizeRobot = "red";
        $emphasizeUser = null;
        $nextPlayer = "user";
    } else {
        $currentPlayer = $_SESSION["user"];
        $emphasizeUser = "red";
        $emphasizeRobot = null;
        $nextPlayer = "robot";
    }

    /**
     * Show total points for the players and emphasize the current player with
     * red text.
     */

    echo "<h3><span class='" . $emphasizeRobot .
        "'><i class='fas fa-robot'></i> Robot " .
        $_SESSION["robot"]->getTotalSum() . "</span> | <span class='" .
        $emphasizeUser . "'><i class='fas fa-user'></i> " .
        $_SESSION["userName"] . " " . $_SESSION["user"]->getTotalSum() .
        "</span></h3>";

    /**
     * Form for buttons for rolling dices, cancel game round and resetting
     * the game.
     */

    echo '<form method="post" action="../../htdocs/dice/form-process-play-' .
        'game">';

    /**
     * Show button for rolling dices if the current player is user, the rolled
     * dices is not 1 and no player has won.
     */

    if ((!isset($_SESSION["valueIsOne"]) && $_SESSION["currentPlayer"] == 
        $_SESSION["userName"] && !isset($_SESSION["winner"]))) {
        echo '<button type="submit" name="rollDices" value="true">' .
            '<i class="fas fa-dice"></i> Roll</button>';
    }

    /** 
     * If one of condition (A) and (B and (B1 or B2)) is true, then show button
     * for canceling the current round and give the turn to the next player.
     * 
     * Condition A: The current player is robot and no player has won
     * Condition B: The current player is user and no player has won
     *      Condition B1: The current game round sum is larger than 0
     *      Condition B2: The rolled dices is 1.
     */

    if (($_SESSION["currentPlayer"] == "Robot" && !isset($_SESSION["winner"]))
        || (($_SESSION["user"]->getRoundSum() > 0 || $_SESSION["valueIsOne"])
        && $_SESSION["currentPlayer"] == $_SESSION["userName"] &&
        !isset($_SESSION["winner"]))) {
            echo "<button type='submit' name='cancelRound' value='true'>" .
            "<i class='fas fa-" . $nextPlayer . "'></i>" .
            " <i class='fas fa-arrow-right'></i> Next</button>";
    }

    /**
     * Reset button for starting a new game any time.
     */

    echo '<button type="submit" name="reset" value="true" class="red-bg">' .
        '<i class="fas fa-times"></i> Reset</button>' .
    '</form>';

    /**
     * When the current player has rolled the dices, show graphic
     * representation of all dices in the current game round. If a dice is 1,
     * it will have red background.
     */

    if ($_SESSION["rollDices"]) {
        $roundGraphic = $currentPlayer->getRoundGraphic();
        foreach ($roundGraphic as $roll) {
            echo "<div>";
            foreach ($roll as $dice) {
                if ($dice == "one") {
                    $alert = "red";
                } else {
                    $alert = null;
                }
                echo  "<i class='" . $alert . " fas fa-dice-" .
                    $dice . " fa-4x'></i>";
            }
            echo "</div>";
        }
    }

    /**
     * If a player has won, show a message and an image. Otherwise, show
     * the current game round sum.
     */

    if (isset($_SESSION["winner"])) {
        echo "<h3 class='red'>" . $_SESSION["winner"] . " won!</h3>";
        if ($_SESSION["winner"] == "Robot") {
            echo "<img src='../../htdocs/img/minimalistic/robot.png' " .
                "alt='Image of robot'>" .
                "<p>Image by mvolz from <a href='https://pixabay.com/'>" .
                "Pixabay</a>";
        } else {
            echo "<img src='../../htdocs/img/minimalistic/winner.jpg' " .
                "alt='Image of player winning the game'>" .
                "<p>Image by Peggy und Marco Lachmann-Anke from " .
                "<a href='https://pixabay.com/'>Pixabay</a>";
        }
    } else {
        echo "<h3>Round sum: " . $currentPlayer->getRoundSum() . "</h3>";
    }
} else if (isset($_SESSION["setNumberOfDices"])) {
    /**
     * When number of dices per roll and player name is set, show button for
     * rolling dice to determine which player that will start the game.
     */

    echo '<p>Please roll the dice to decide which player that will start ' .
        'the game.</p>' .
        '<form method="post" action="../../htdocs/dice/form-process-first-' .
        'dice-roll">' .
            '<button type="submit" name="startGame" value="true">' .
                '<i class="fas fa-dice"></i> Roll' .
            '</button>' .
        '</form>';
} else {
    /**
     * Before the game starts, the player can choose number of dices per roll
     * and write player name (optional).
     */

    echo '<h3>New Game</h3>' .
        '<form class="diceGame" method="post" action="../../htdocs/dice/' .
        'form-process-number-of-dices">' .
            '<label for="numberOfDices">Number of dices per roll</label>' .
            '<select id="numberOfDices" name="numberOfDices">' .
                '<option value="1">1</option>' .
                '<option value="2">2</option>' .
                '<option value="3">3</option>' .
                '<option value="4">4</option>' .
            '</select>' .
            '<label for="userName">Player Name (optional)</label>' .
            '<input id="userName" type="text" name="userName">' .
            '<button id="setNumberOfDices" type="submit" ' .
            'name="setNumberOfDices" value="true">Start the game!</button>' .
        '</form>';
}
