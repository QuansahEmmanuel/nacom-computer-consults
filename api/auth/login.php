<?php
session_start();                       // Start / resume the session
require_once('../../includes/db.php');


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /* ----------------------------------------------------------
       1.  Sanitise & validate inputs
    ---------------------------------------------------------- */
    $email    = filter_input(INPUT_POST, 'email',    FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        header("Location: ../../views/auth/login.php?msg=Email and password are required.");
        exit;
    }

    /* ----------------------------------------------------------
       2.  Look up the user
    ---------------------------------------------------------- */
    $sql = "SELECT id, email, password, role FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        error_log("Login statement error: " . $conn->error);
        header("Location: ../../views/auth/login.php?msg=An error occurred. Please try again.");
        exit;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows !== 1) {
        // No user found
        $stmt->close();
        header("Location: ../../views/auth/login.php?msg=No user found with that email.");
        exit;
    }

    /* ----------------------------------------------------------
       3.  Check password
    ---------------------------------------------------------- */
    $stmt->bind_result($user_id, $db_email, $db_hashed_password, $role);
    $stmt->fetch();

    if (!password_verify($password, $db_hashed_password)) {
        $stmt->close();
        header("Location: ../../views/auth/login.php?msg=Invalid password.");
        exit;
    }

    /* ----------------------------------------------------------
       4.  Login OK – store session data
    ---------------------------------------------------------- */
    $_SESSION['user_id'] = $user_id;
    $_SESSION['email']   = $db_email;
    $_SESSION['role']    = $role;

    $stmt->close();
    $conn->close();

    /* ----------------------------------------------------------
       5.  Redirect based on role
           (modify the paths to match your folder structure)
    ---------------------------------------------------------- */
    switch ($role) {
        case 'admin':
            header("Location: ../../views/admin/index.php");
            break;
        case 'support':
            header("Location: ../../views/support/index.php");
            break;
        default:               // 'customer' or any other default role
            header("Location: ../public/index.php");
            break;
    }
    exit;

} else {
    // Invalid request method – just bounce to login page
    header("Location: ../../views/auth/login.php");
    exit;
}