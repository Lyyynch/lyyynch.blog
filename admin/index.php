<?php
    if(!empty($_POST)) {
        $submittedName = $_POST['name'];
        echo "Hi $submittedName, nice to meet you!";
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
                    <form action="" method="post">
                        <label for="name">Your Name</label>
                        <br />
                        <input type="text" id="name" name="name" />
                        <br />
                        <button>Submit</button>
                    </form>


                </body>
            <?php include '../partials/footer.php'; ?>
        </div>
    </body>
</html>