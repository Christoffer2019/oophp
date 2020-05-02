<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Store data from POST to SESSION when form is sent.
 */
$app->router->post("guess/form-process", function () use ($app) {
    $_SESSION["guessNumber"] = $_POST["guessNumber"] ?? null;
    $_SESSION["guess"] = $_POST["guess"] ?? null;
    $_SESSION["reset"] = $_POST["reset"] ?? null;
    $_SESSION["cheat"] = $_POST["cheat"] ?? null;

    if (isset($_SESSION["reset"])) {
        return $app->response->redirect("guess/startGame");
    }
    return $app->response->redirect("guess/makeGuess");
});



/**
 * Start new game
 */
$app->router->get("guess/startGame", function () use ($app) {
    $title = "Guess Game";
    $_SESSION["reset"] = "true";
    if (isset($_SESSION["guessNumber"])) {
        unset($_SESSION["guessNumber"]);
    }
    if (isset($_SESSION["guess"])) {
        unset($_SESSION["guess"]);
    }
    if (isset($_SESSION["cheat"])) {
        unset($_SESSION["cheat"]);
    }
    if (isset($_SESSION["finishedGame"])) {
        unset($_SESSION["finishedGame"]);
    }

    $_SESSION["game"] = new chly19\Guess\Guess();
    $_SESSION["game"]->random();

    $app->page->add("guess/play");
    $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Make a guess
 */
$app->router->get("guess/makeGuess", function () use ($app) {
    /**
     * Get game status when the user has guessed a number. If the user wins
     * or loses, store status in $_SESSION["finishedGame"].
     */
    $title = "Guess Game";
    if (isset($_SESSION["game"]) && isset($_SESSION["guess"]) &&
    !isset($_SESSION["finishedGame"])) {
        $_SESSION["guessStatus"] = $_SESSION["game"]->makeGuess($_SESSION["guessNumber"]);
        if (strpos($_SESSION["guessStatus"], "lost") || strpos($_SESSION["guessStatus"], "won")) {
            $_SESSION["finishedGame"] = $_SESSION["guessStatus"];
            unset($_SESSION["guessStatus"]);
        }
    }

    $app->page->add("guess/play");
    $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});
