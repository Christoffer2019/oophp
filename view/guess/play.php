<?php

namespace Anax\View;

/**
 * Render guess game.
 */

echo "<h1>Gissa mitt nummer</h1>";

/**
 * If $_SESSION["game"] is set, display message and current number of tries left.
 */
if (isset($_SESSION["game"])) {
    $tries = $_SESSION["game"]->tries();
    if ($tries < 2) {
        $tries = "<span class='red p'><strong>$tries</strong></span>";
    }
    echo "<p>Please guess a number between 1 and 100. You have " .
        $tries . " tries left.</p>";
}
?>

<form method="post" action="../../htdocs/guess/form-process">
    <input type="text" name="guessNumber">
    <button type="submit" name="guess" value="true">Make a Guess</button>
    <button type="submit" name="reset" value="true">Reset Game</button>
    <button type="submit" name="cheat" value="true">Cheat</button>
</form>

<?php
if (isset($_SESSION["reset"])) {
    echo "<h3>New Game!</h3>";
    unset($_SESSION["reset"]);
    if (isset($_SESSION["finishedGame"])) {
        unset($_SESSION["finishedGame"]);
    }
}

if (isset($_SESSION["finishedGame"])) {
    echo $_SESSION["finishedGame"];
} else if (isset($_SESSION["guessStatus"])) {
    echo $_SESSION["guessStatus"];
    unset($_SESSION["guessStatus"]);
}

/**
 * When the user clicks on 'cheat' button, display the secret number.
 */
if (isset($_SESSION["cheat"]) && isset($_SESSION["game"]) &&
    !isset($_SESSION["finishedGame"])) {
    echo '<h4>The secret number is ' . $_SESSION["game"]->number() .
        '.</h4>';
}
