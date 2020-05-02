<?php
/**
 * Main module for Guessing Game.
 */
include __DIR__ . "/config.php";
include __DIR__ . "/autoload.php";
include __DIR__ . "/session.php";
include __DIR__ . "/view/header.php";

echo "<main>";
echo "<h1>Guess my Number</h1>";

/**
 * Start a new game when the user has clicked on 'reset game' button or
 * when the user plays the game for the first time.
 */
if (!isset($_SESSION["newGame"]) || isset($_SESSION["reset"])) {
    unset($_SESSION["finishedGame"]);
    $_SESSION["newGame"] = true;

    $_SESSION["game"] = new Guess();
    $_SESSION["game"]->random();

    $newGameMessage = "<h3>New Game!</h3>";
}

/**
 * Get game status when the user has guessed a number. If the user wins
 * or loses, store status in $_SESSION["finishedGame"].
 */
if (isset($_SESSION["game"]) && isset($_SESSION["guess"]) && 
    !isset($_SESSION["finishedGame"])) {
    $guessStatus = $_SESSION["game"]->makeGuess($_SESSION["guessNumber"]);
    if (strpos($guessStatus, "lost") || strpos($guessStatus, "won")) {
        $_SESSION["finishedGame"] = $guessStatus;
    }
}

/**
 * If $_SESSION["game"] is set, display message and current number of tries left.
 */
if (isset($_SESSION["game"])) {
    echo "<p>Please guess a number between 1 and 100. You have " .
        $_SESSION["game"]->tries() . " tries left.</p>";
}

include __DIR__ . "/view/form.php";

/**
 * If the game is finished, display game status until the user clicks on
 * 'reset game' button. Otherwise display game status until the user
 * clicks on a button.
 */
if (isset($_SESSION["finishedGame"])) {
    echo $_SESSION["finishedGame"];
} else {
    echo ($newGameMessage ?? null) . ($guessStatus ?? null);
}

/**
 * When the user clicks on 'cheat' button, display the secret number.
 */
if (isset($_SESSION["cheat"]) && isset($_SESSION["game"]) && 
    !isset($_SESSION["finishedGame"])) {
    echo '<h3>The secret number is ' . $_SESSION["game"]->number() . 
        '.</h3>';
}
echo "</main>";

include __DIR__ . "/view/footer.php";
