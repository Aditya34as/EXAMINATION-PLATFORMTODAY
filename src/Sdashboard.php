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
    <title>Exam Dashboard</title>
    <link rel="stylesheet" href="output.css">
    <style>
        ::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav
        class="flex justify-between h-18 bg-white p-4 text-black shadow-lg text-center text-lg font-semibold fixed w-full">
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
            home = () => {
                window.location.href = "index.html";
            }
            contact = () => {
                window.location.href = "contact.html";
            }
        </script>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen flex w-full">
        <div class="max-w-6xl mx-auto mt-23 ml-0 px-4">
            <!-- Available Exams Section -->
            <section class="mb-5">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Available Exams</h2>
                <div class="grid md:grid-cols-4 gap-4 ">
                    <div class="bg-white shadow-lg rounded-lg p-4 hover:shadow-xl transition">
                        <h3 class="text-xl font-semibold text-gray-800">JEE Mains</h3>
                        <p class="text-gray-600 mt-2">Duration: 3 Hours</p>
                        <p class="text-gray-600 mt-1">Subjects: Physics, Chemistry, Mathematics</p>
                        <p class="text-gray-600 mt-2">Level: Undergraduate</p>
                        <button type="submit" class="mt-5 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 cursor-pointer" ><a href="testingpreview.php">Start Exam</a></button>
                    </div>
                    <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition">
                        <h3 class="text-xl font-semibold text-gray-800">JEE Advanced</h3>
                        <p class="text-gray-600 mt-2">Duration: 3 Hours</p>
                        <p class="text-gray-600 mt-1">Subjects: Physics, Chemistry, Mathematics</p>
                        <p class="text-gray-600 mt-1">Level: Undergraduate</p>
                        <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 cursor-pointer"><a href="testingpreview.php">Start Exam</a></button>
                    </div>
                    <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition">
                        <h3 class="text-xl font-semibold text-gray-800">SSC CGL</h3>
                        <p class="text-gray-600 mt-2">Duration: 2 Hours</p>
                        <p class="text-gray-600 mt-1">Subjects: General Awareness, Quantitative Aptitude, English</p>
                        <p class="text-gray-600 mt-1">Level: Graduate</p>
                        <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 cursor-pointer"><a href="testingpreview.php">Start Exam</a></button>
                    </div>
                </div>
            </section>

            <!-- Upcoming Exams Section -->
            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Upcoming Exams</h2>
                <div class="grid md:grid-cols-4 gap-6 ">
                    <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition">
                        <h3 class="text-xl font-semibold text-gray-800">UPSC Prelims</h3>
                        <p class="text-gray-600 mt-2">Date: 15th June</p>
                        <p class="text-gray-600 mt-1">Subjects: General Studies, CSAT</p>
                        <p class="text-gray-600 mt-1">Level: Graduate</p>
                        <button class="mt-4 bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">View Details</button>
                    </div>
                    <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition">
                        <h3 class="text-xl font-semibold text-gray-800">NEET UG</h3>
                        <p class="text-gray-600 mt-2">Date: 5th July</p>
                        <p class="text-gray-600 mt-1">Subjects: Physics, Chemistry, Biology</p>
                        <p class="text-gray-600 mt-1">Level: Undergraduate</p>
                        <button class="mt-4 bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">View Details</button>
                    </div>
                    <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition">
                        <h3 class="text-xl font-semibold text-gray-800">GATE</h3>
                        <p class="text-gray-600 mt-2">Date: 20th August</p>
                        <p class="text-gray-600 mt-1">Subjects: Engineering, Science</p>
                        <p class="text-gray-600 mt-7">Level: Graduate</p>
                        <button class="mt-4 bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">View Details</button>
                    </div>
                </div>
            </section>

        </div>

        <!-- Calendar -->

        <div class="flex flex-row md:flex-col gap-8 mr-5 mt-30">
            <!-- Calendar Section -->
            <div class="max-w-md bg-white shadow-lg rounded-lg p-4">
                <div class="flex justify-between items-center mb-2">
                    <button id="prevMonth" class="px-2 py-1 bg-blue-500 text-white text-sm rounded">←</button>
                    <h2 id="calendarTitle" class="text-lg font-semibold"></h2>
                    <button id="nextMonth" class="px-2 py-1 bg-blue-500 text-white text-sm rounded">→</button>
                </div>

                <div class="grid grid-cols-7 text-center text-xs font-semibold">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>

                <div id="calendarGrid" class="grid grid-cols-7 gap-1 mt-1"></div>
            </div>

            <!-- Upcoming Exams Section -->
            <div class="max-w-md w-full bg-white shadow-lg rounded-lg p-4">
                <h2 class="text-xl font-bold mb-4">Upcoming Exams</h2>
                <ul id="examList" class="divide-y divide-black">
                    <li class="text-gray-500 p-2">Select a date to view exams.</li>
                </ul>
            </div>
        </div>

    </div>

    <script>
        const calendarTitle = document.getElementById("calendarTitle");
        const calendarGrid = document.getElementById("calendarGrid");
        const prevMonthBtn = document.getElementById("prevMonth");
        const nextMonthBtn = document.getElementById("nextMonth");

        let currentDate = new Date();

        prevMonthBtn.addEventListener("click", () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });

        nextMonthBtn.addEventListener("click", () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });

        const examList = document.getElementById("examList");

        const exams = [
        { date: "2025-04-10", name: "Mathematics Test", time: "10:00 AM - 12:00 PM", duration: "2 Hours", subject: "Mathematics", mode: "Online", type: "MCQ" },
        { date: "2025-04-15", name: "Physics Exam", time: "2:00 PM - 4:00 PM", duration: "2 Hours", subject: "Physics", mode: "Offline", type: "Descriptive" }
        ];
        function showExams(selectedDate) {
    const upcomingExamsDiv = document.getElementById("upcomingExams");
    upcomingExamsDiv.innerHTML = "";

    exams.forEach(exam => {
        if (exam.date === selectedDate) {
            upcomingExamsDiv.innerHTML += `
                <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                    <h3 class="text-lg font-semibold text-blue-600">${exam.name}</h3>
                    <p class="text-sm text-gray-700">📅 ${exam.date} | ⏰ ${exam.time}</p>
                    <p class="text-sm text-gray-700">📚 Subject: ${exam.subject}</p>
                    <p class="text-sm text-gray-700">⌛ Duration: ${exam.duration}</p>
                    <p class="text-sm text-gray-700">📝 Type: ${exam.type} | 🎯 Mode: ${exam.mode}</p>
                </div>
            `;
        }
    });
}

        function renderCalendar() {
            calendarGrid.innerHTML = "";
            const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
            const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);

            calendarTitle.textContent = firstDay.toLocaleString("default", { month: "long", year: "numeric" });

            let startDay = firstDay.getDay();
            for (let i = 0; i < startDay; i++) {
                let emptyCell = document.createElement("div");
                emptyCell.classList.add("text-gray-400", "text-sm");
                calendarGrid.appendChild(emptyCell);
            }

            for (let day = 1; day <= lastDay.getDate(); day++) {
                let dayCell = document.createElement("div");
                dayCell.textContent = day;
                dayCell.classList.add("p-2", "text-sm", "bg-blue-100", "text-center", "rounded", "cursor-pointer", "hover:bg-blue-200");

                let formattedDate = `${currentDate.getFullYear()}-${String(currentDate.getMonth() + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                dayCell.dataset.date = formattedDate;

                dayCell.addEventListener("click", function () {
                    updateExamList(formattedDate);
                });

                calendarGrid.appendChild(dayCell);
            }
        }

        function updateExamList(selectedDate) {
            const filteredExams = exams.filter(exam => exam.date === selectedDate);

            examList.innerHTML = filteredExams.length > 0
                ? filteredExams.map(exam => `
                    <li class="p-2">
                        <h3 class="text-lg font-semibold text-blue-600">${exam.name}</h3>
                        <p class="text-sm text-gray-700">📅 ${exam.date} | ⏰ ${exam.time}</p>
                        <p class="text-sm text-gray-700">📚 Subject: ${exam.subject}</p>
                        <p class="text-sm text-gray-700">⌛ Duration: ${exam.duration}</p>
                        <p class="text-sm text-gray-700">📝 Type: ${exam.type} | 🎯 Mode: ${exam.mode}</p>
                    </li>
                `).join("")
                : `<li class="text-gray-500 p-2">No exams found for the selected date.</li>`;
        }

        renderCalendar();
    </script>

    <!-- Footer -->

    <footer class="bg-gray-800 w-full text-white scroll-py-0.5 flex flex-col items-center mt-0">
        <div class="w-full text-center">
            <h3 class="text-md font-semibold mb-1">Supported Exams</h3>
        </div>
        <div class="flex justify-center gap-4">
            <div class="flex items-center text-sm font-serif">
                <img src="JEE-Main.png" alt="JEE-Main" class="h-5 rounded-full">
                <p class="ml-2">JEE-Main</p>
            </div>
            <div class="flex items-center text-sm font-serif">
                <img src="UPSC.jpg" alt="UPSC" class="h-5 rounded-full">
                <p class="ml-2">UPSC</p>
            </div>
            <div class="flex items-center text-sm font-serif">
                <img src="CDS.jpg" alt="CDS" class="h-5 rounded-full">
                <p class="ml-2">CDS</p>
            </div>
            <div class="flex items-center text-sm font-serif">
                <img src="CA.png" alt="CA" class="h-5 w-5 rounded-full">
                <p class="ml-2">CA</p>
            </div>
        </div>
        <div class="w-full text-center mt-1">
            <p class="text-gray-400 text-xs">© 2025 Online Exam Platform. All Rights Reserved.</p>
        </div>
    </footer>
    </div>
    </footer>

</body>

</html>