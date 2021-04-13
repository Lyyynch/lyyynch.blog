<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/lyyynch.blog/config/setup.php";

    unset($_SESSION["email_error"]);
    unset($_SESSION["password_error"]);
    unset($_SESSION["login_error"]);

    if (!empty($_POST)) {

        do {
            if (!isset($_POST["email"]) || $_POST["email"] == "") {
                $_SESSION["email_error"] = "Email missing - populate it you peasant";
            }

            if (!isset($_POST["password"]) || $_POST["password"] == "") {
                $_SESSION["password_error"] = "Password missing - populate it you peasant";
            }

            if (isset($_SESSION["email_error"]) || isset($_SESSION["password_error"])) {
                break;
            }

            $userQuery = "SELECT * FROM `users` WHERE email = '" . $_POST["email"] . "'";
            $userResult = $mysqli->query($userQuery);
            $user = $userResult->fetch_assoc();

            if ($user === null) {
                $_SESSION["login_error"] = "Incorrect Credentials";
                break;
            }

            $dbPassword = $user["password"];
            $givenPassword = $_POST["password"];

            if (!password_verify($givenPassword, $dbPassword)) {
                $_SESSION["login_error"] = "Incorrect Credentials";
                break;
            }

            $_SESSION["logged_in"] = true;
            $_SESSION["user_name"] = $user["first_name"] . " " . $user["last_name"];

            break;
        } while (true);
    }
?>

<html>
<?php
$title = 'Admin - Lyyynch Blog';
include '../partials/head.php';
?>

    <body>
        <div class="page-wrapper">
            <?php include '../partials/header.php'; ?>
            <body>
            <?php
                if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true):
            ?>
                <p>You are logged in Mr. <?= $_SESSION["user_name"]; ?></p>
                <a href="logout.php">Click here to logout</a>

            <?php else: ?>
                    <form action="" method="post">
                        <label for="email">E-mail Address</label>
                        <br />
                        <input type="email" id="email" name="email" autocomplete="off" />
                        <?php
                        if (isset($_SESSION["email_error"])) {
                            echo $_SESSION["email_error"];
                        }
                        ?>
                        <br />
                        <label for="password">Password</label>
                        <br />
                        <input type="password" id="password" name="password" />
                        <?php
                        if (isset($_SESSION["password_error"])) {
                            echo $_SESSION["password_error"];
                        }
                        ?>
                        <br />
                        <button>Submit</button>
                        <br />
                        <?php
                        if (isset($_SESSION["login_error"])) {
                            echo $_SESSION["login_error"];
                        }
                        ?>
                    </form>
            <?php endif; ?>




            </body>
            <?php include '../partials/footer.php'; ?>
        </div>
    </body>
</html>