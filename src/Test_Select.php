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
    <title>Mock Test Selection</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav
        class=" flex justify-between h-18 bg-white p-4 text-black shadow-lg text-center text-lg font-semibold fixed
    w-full">
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
        <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start"
            class="w-10 h-10 rounded-full cursor-pointer mr-2" src="user-avtar-modified.png" alt="User dropdown">
            <p id="userName" name="name"><?php echo isset($user) ? htmlspecialchars($user['fname'], ENT_QUOTES, 'UTF-8') : 'Guest'; ?></p>

        <div id="userDropdown"
            class="z-10 hidden absolute right-0 mt-[5.8cm] mr-[1cm] bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
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
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Logout</a>
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

        home = () => {
            window.location.href = "index.html";
        }
        contact = () => {
            window.location.href = "contact.html";
        }
    </script>
    </nav>
    <div class="bg-gray-100 flex justify-center items-center min-h-screen" >
        <div class="bg-gray-300 p-8 rounded-lg shadow-lg text-center w-[27cm]">
        <h1 class="text-2xl font-bold text-gray-800">Choose Your Mock Test</h1>
        <p class="text-gray-600 mt-2">Select how you want to take your test</p>

        <!-- Test Type Selection -->
         <div class="flex space-x-[5cm]">

             <div class="mt-6 space-x-6 flex">
                 <button onclick="showAIOptions()"
                 class="w-[8cm] flex items-center ml-[2cm]  justify-center space-x-3 px-4 py-3 pr-8 bg-blue-600 text-white rounded-lg shadow-lg hover:bg-blue-700 transition">
                 <i data-lucide="cpu" class="w-4 h-6"></i>
                 <span>AI-Generated Mock Test</span>
                </button>
             </div>
             <div  class="mt-6 space-x-6 flex">
                <button onclick="showTeacherOptions()"
                class="w-[8cm] flex items-center  justify-center space-x-3 px-4 py-3 pr-10 bg-green-600 text-white rounded-lg shadow-lg hover:bg-green-700 transition">
                <i data-lucide="chalkboard-teacher" class="w-4 h-6"></i>
                <span>Teacher-Designed Mock Test</span>
            </button>
        </div>
    </div>

        <!-- AI Difficulty Level Options (Initially Hidden) -->
        <div id="aiOptions" class="hidden mt-6">
            <h2 class="text-xl font-semibold text-gray-800">Select Subject</h2>
            <div class="mt-4 space-y-3">
                <button onclick="location.href='Aimathtest.php'"
                    class="w-full bg-blue-400 text-white py-3 rounded-lg shadow hover:bg-blue-500 transition">
                    <i data-lucide="smile" class="w-5 h-5"></i> Maths
                </button>
                <button onclick="location.href='AIPHYSICSTEST.php'"
                    class="w-full bg-yellow-500 text-white py-3 rounded-lg shadow hover:bg-yellow-600 transition">
                    <i data-lucide="meh" class="w-5 h-5"></i> Physics
                </button>
                <button onclick="location.href='AICHEMTEST.php'"
                    class="w-full bg-pink-500 text-white py-3 rounded-lg shadow hover:bg-pink-600 transition">
                    <i data-lucide="frown" class="w-5 h-5"></i> Chemistry
                </button>
                <button onclick="location.href='AIBIO.php'"
                    class="w-full bg-gray-500 text-white py-3 rounded-lg shadow hover:bg-gray-600 transition">
                    <i data-lucide="frown" class="w-5 h-5"></i> Biology
                </button>
                <button onclick="location.href='AIAPTITUDE.php'"
                    class="w-full bg-green-500 text-white py-3 rounded-lg shadow hover:bg-green-600 transition">
                    <i data-lucide="frown" class="w-5 h-5"></i> Aptitude
                </button>
            </div>
        </div>

        <!-- Teacher-Prepared Mock Tests (Initially Hidden) -->
        <div id="teacherOptions" class="hidden mt-6">
            <h2 class="text-xl font-semibold text-gray-800">Select Your Test</h2>
            <div class="mt-4 space-y-3">
                <button onclick="location.href='teachermath.php'"
                    class="w-full bg-blue-500 text-white py-3 rounded-lg shadow hover:bg-blue-600 transition">
                    <i data-lucide="calculator" class="w-5 h-5"></i> Math Test
                </button>
                <button onclick="location.href='teacherphysics.php'"
                    class="w-full bg-yellow-500 text-white py-3 rounded-lg shadow hover:bg-yellow-600 transition">
                    <i data-lucide="atom" class="w-5 h-5"></i> Physics Test
                </button>
                <button onclick="location.href='teacherchemistry.php'"
                    class="w-full bg-pink-500 text-white py-3 rounded-lg shadow hover:bg-pink-600 transition">
                    <i data-lucide="flask" class="w-5 h-5"></i> Chemistry Test
                </button>
                <button onclick="location.href='teacherbio.php'"
                    class="w-full bg-gray-500 text-white py-3 rounded-lg shadow hover:bg-gray-600 transition">
                    <i data-lucide="flask" class="w-5 h-5"></i> Biology Test
                </button>
                <button onclick="location.href='teacherapti.php'"
                    class="w-full bg-green-500 text-white py-3 rounded-lg shadow hover:bg-green-600 transition">
                    <i data-lucide="flask" class="w-5 h-5"></i> Aptitude Test
                </button>
            </div>
        </div>
    </div>
    </div>

    <script>
        function showAIOptions() {
            document.getElementById('aiOptions').classList.remove('hidden');
            document.getElementById('teacherOptions').classList.add('hidden');
        }

        function showTeacherOptions() {
            document.getElementById('teacherOptions').classList.remove('hidden');
            document.getElementById('aiOptions').classList.add('hidden');
        }

        lucide.createIcons(); // Activate Lucide Icons
    </script>

</body>

</html>