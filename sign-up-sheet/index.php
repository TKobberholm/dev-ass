<?php 
    session_start();

    //check if formular is send
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //check if data is send
        if (isset($_POST['firstname'], $_POST['lastname'])) {
            //save data to session array
            $_SESSION['users'][] = ['firstname' => $_POST['firstname'], 'lastname' => $_POST['lastname']];
        }

        //check if delete all button is clicked
        if (isset($_POST['delete-all-users'])) {
            unset ($_SESSION['users']);
        }

        //check if delete user button is clicked
        if (isset($_POST['delete-user'])) {
            $index = $_POST['delete-user'];
            unset($_SESSION['users'][$index]);
        /* reset array vs index
            $_SESSION['users'] = array_values($_SESSION['users']);
        */
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up Sheet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
        <div id="signup-container">
            <h1>Sign up here</h1>
            <form method="post">
                <label for="firstname">Firstname:</label>
                <input type="text" id="firstname" name="firstname" placeholder="Type your firstname here" required><br/><br/>

                <label for="lastname">Lastname:</label>
                <input type="text" id="lastname" name="lastname" placeholder="Type your lastname here" required><br/><br/>

                <input type="submit" id="add-user" value="Add new user">
            </form>

            <form method="post">
                <input type="submit" id="delete-a" value="Delete all users" name="delete-all-users">
            </form>
        </div>
    </section>

    <section>
        <?php 
            if (!empty($_SESSION['users'])) {
                echo "<table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Action</th>
                            </tr>
                        <thead>";
                foreach ($_SESSION['users'] as $index => $user) {
                    echo "<tr>
                            <td>$index</td>
                            <td>{$user['firstname']}</td>
                            <td>{$user['lastname']}</td>
                            <td>
                                <form style=\"display: inline\" method=\"post\">
                                    <input type=\"hidden\" name=\"delete-user\" value=\"$index\">
                                    <input type=\"submit\" id=\"delete-u\" value=\"Delete user\">
                                </form>
                            </td>
                        </tr>";
                }
                echo "</tbody></table>";
            }
        ?>
    </section>
</body>
</html>
