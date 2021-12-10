<?php
include __DIR__ . "/header.php";
<<<<<<< HEAD
=======
include "Functies.php";
>>>>>>> Stan
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
}
$email = $password = "";
$email_err = $password_err = $login_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);
    }

    // Kijken of email leeg is
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Wanneer geen error
    if(empty($email_err) && empty($password_err)){
        // Inloggegevens ophalen
        $sql = "SELECT id, email, password FROM users WHERE email = ?";

        if($stmt = mysqli_prepare($databaseConnection, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = $email;

            // Uitvoering
            if(mysqli_stmt_execute($stmt)){
                // Opslaan
                mysqli_stmt_store_result($stmt);
                // Kijken naar email dan naar wachtwoord
                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Hier is hij goedgekeurt
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
<<<<<<< HEAD
=======
                            getCart3($databaseConnection);
>>>>>>> Stan
                            header("location: index.php");
                        } else{
                            $login_err = "Invalid email or password.";
                        }
                    }
                } else{
                    // email bestaat niet
                    $login_err = "Invalid email or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
<div class="wrapper">
    <h2>Login</h2>
    <p>Please fill in your credentials to login.</p>

    <?php
    if(!empty($login_err)){
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>email</label>
            <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
            <span class="invalid-feedback"><?php echo $email_err; ?></span>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>
<<<<<<< HEAD
        <p>Don't have an account? <a href="registeer.php">Sign up now</a>.</p>
=======
        <p>Don't have an account? <a href="registreer.php">Sign up now</a>.</p>
>>>>>>> Stan
    </form>
</div>
</body>
</html>
<?php
include __DIR__ . "/footer.php";