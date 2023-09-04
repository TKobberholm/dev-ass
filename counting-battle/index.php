<?php 
    session_start();

    //generates randomnumber
    function generateRandomNumber() {
        return mt_rand(1, 10); //better performance and randomness
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
    $winner = ($_SESSION['player1'] >= 10) ? 'Spiller 1' : (($_SESSION['player2'] >= 10) ? 'Spiller 2' : null);

    // reset score if there is a winner
    if ($winner) {
        $_SESSION['player1'] = 0;
        $_SESSION['player2'] = 0;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counting Battle</title>
    <link rel="stylesheet" href="style.css">

    <!-- Popup code -->
    <script>
        function showWinnerPopup() {
            var winner = "<?php echo $winner; ?>";
            if (winner) {
                alert(winner + " won the game!");
            }
        }
    </script>
</head>
<body>
    <section>
        <h1>Counting Battle Game</h1>
        <p><i>Press F5 or click the circling arrow in your browser to reload and count the score!</i></p>
        <h2>The random number is:</h2> 
        <p id="number"> <?php echo $randomNumber; ?> </p>
        
        <table>
<!--        <caption>
                Player score
            </caption> -->
            <thead>
                <tr>
                    <th>Player 1</th>
                    <th>Player 2</th>
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

    <!-- Popup message -->
    <script>
        showWinnerPopup();
    </script>

</body>
</html>