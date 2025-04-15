<?php
session_start();
include "connection.php";

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
} else {
    mysqli_set_charset($conn, "utf8mb4");
}

$user = null;

if (!empty($_SESSION['enrollment_id']) || !empty($_SESSION['email'])) {
    if (!empty($_SESSION['enrollment_id'])) {
        $query = "SELECT fname, email FROM users WHERE enrollment_id = ?";
        $param = $_SESSION['enrollment_id'];
    } else {
        $query = "SELECT fname, email FROM users WHERE email = ?";
        $param = $_SESSION['email'];
    }

    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die("Query preparation failed: " . $conn->error);
    }

    $stmt->bind_param("s", $param);

    if (!$stmt->execute()) {
        die("Query execution failed: " . $stmt->error);
    }

    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "<script>alert('No user found for given session data.');</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('User session not set.');</script>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="output.css">
</head>

<body class="">
    <nav class="flex justify-between h-18 bg-white p-4 text-black shadow-lg text-center text-lg font-semibold">
        <div class="flex items-center">
            <img class="rounded-full size-10" src="Logo.png" alt="Logo">
            <h1 class="pl-2">XamXpress</h1>
        </div>
        <ul class="flex justify-center items-center space-x-10">
            <li><a href="Sdashboard.php">Home</a></li>
            <li><a href="Test_Select.php">Mock Test</a></li>
            <li><a href="result.php">Results</a></li>
            <li><a href="contact1.php">Contact</a></li>
        </ul>
        <div class="relative flex items-center text-center">
            <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
                data-dropdown-placement="bottom-start" class="w-10 h-10 rounded-full cursor-pointer mr-2" src="user-avtar-modified.png"
                alt="User dropdown">
                <p id="userName" name="name"><?php echo isset($user) ? htmlspecialchars($user['fname'], ENT_QUOTES, 'UTF-8') : 'Guest'; ?></p>

            <div id="userDropdown"
                class="z-10 hidden absolute mt-55 mr-10 right-0 bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
                <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">

                <div id="userEmail" class="font-medium truncate" name="email">
                        <?php echo isset($user) ? htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') : 'Not logged in'; ?>
                    </div>
                </div>
                <div class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                    <a href="profile1.php"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                </div>
                <div class="py-1 flex justify-center items-center">
                    <a href="login.php"
                        class="block px-8 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Logout</a>
                    <img src="logout.png" alt="logout" class="w-6 h-6 ml-2">
                </div>
            </div>
        </div>

        <script>
            document.getElementById('avatarButton').addEventListener('click', function (event) {
            event.stopPropagation();
            var dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function (event) {
            var dropdown = document.getElementById('userDropdown');
            if (!dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
            }
        });
        </script>
    </nav>
    <div class="flex justify-center mx-auto mt-20">
        <div id="contact" class=" text-2xl text-center bg-white w-100 h-80 rounded-lg shadow-lg hover:shadow-2xl ">
            <p class="text-2xl font-semibold text-gray-800 pt-20">Contact Support</p>
            <p class="text-gray-600 mt-2 text-2xl">Need help? Reach out to us.</p>
            <p>Gmail: amrit@gmail.com</p>
            <p>Helpline No. 9778388498</p>
        </div>
    </div>
</body>

</html>