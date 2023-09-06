<?php 
    session_start();

    //generates randomnumber
    function generateRandomNumber() {
        return mt_rand(1, 10); //better performance and randomness
    }

    //Check if 'new game' is clicked and reset score else keep score
    if (isset($_POST['action']) && isset($_SESSION['winner'])) {
        $_SESSION['player1'] = 0;
        $_SESSION['player2'] = 0;
        unset($_SESSION['winner']);
    }

    $randomNumber = generateRandomNumber();

    //score count
    $_SESSION['player1'] = isset($_SESSION['player1']) ? $_SESSION['player1'] : 0;
    $_SESSION['player2'] = isset($_SESSION['player2']) ? $_SESSION['player2'] : 0;

    //playerlogic
    if ($randomNumber >= 1 && $randomNumber <= 5) {
        $_SESSION['player1'] += 1; // increment score
    } else if ($randomNumber >= 6 && $randomNumber <= 10) {
        $_SESSION['player2'] += 1; // increment score
    }

    //check for a winner
    $winner = null;

    // assign winner variable
    $winner = ($_SESSION['player1'] >= 10) ? 'Low Count Player' : (($_SESSION['player2'] >= 10) ? 'High Count Player' : null);

    // save winner in session
    if ($winner) {
        $_SESSION['winner'] = true;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counting Battle</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
        <h1>Counting Battle Game</h1>
        <p><i>Let the randomness begin !</i></p>
        <h2>The random number is:</h2> 
        <p id="number"> <?php echo $randomNumber; ?> </p>
        <p><?php if($winner) {
            echo "The winner is \"<b>$winner</b>\""; } ?></p>
        
        <form method="post">
            <button type="submit" name="action">
                <?php if (!$winner) {
                    echo "Get next number";
                } else if ($winner) {
                    echo "Start new game";
                } ?>
            </button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Low Count Player</th>
                    <th>High Count Player</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $_SESSION['player1'] ?></td>
                    <td><?php echo $_SESSION['player2'] ?></td>
                </tr>
            </tbody>
        </table>
    </section>
</body>
</html>