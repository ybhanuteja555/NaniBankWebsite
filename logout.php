<!DOCTYPE html>
<html>
    <head>
        <title>
            Bank Website
        </title>
    </head>
    <body>
        <?php
            session_start();

            $_SESSION = array();
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            
            // Destroy the session
            session_destroy();
            
            // Redirect to a login page or home page after logout
            header("Location: login.html");
            exit();
        ?>
    </body>
</html>