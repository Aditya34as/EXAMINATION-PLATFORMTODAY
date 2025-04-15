
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XamXpress</title>
    <link rel="stylesheet" href="output.css">

    <link rel="icon" href="Logo.png" type="image/png">
    <style>
        @keyframes ring {
            0% {
            transform: rotate(0);
            }
            15% {
            transform: rotate(15deg);
            }
            30% {
            transform: rotate(-10deg);
            }
            45% {
            transform: rotate(5deg);
            }
            60% {
            transform: rotate(-5deg);
            }
            75% {
            transform: rotate(3deg);
            }
            100% {
            transform: rotate(0);
            }
        }

        .animate-ring {
            animation: ring 1.5s ease-in-out infinite;
        }

        @keyframes typing {
            0% {
            width: 0;
            }
            50% {
            width: 100%;
            }
            60% {
            width: 100%;
            }
            100% {
            width: 0;
            }
        }

        @keyframes blink {
            0% {
            border-color: black;
            }
            50% {
            border-color: transparent;
            }
            100% {
            border-color: black;
            }
        }

        .typing-text::after {
            content: '';
            display: inline-block;
            margin-left: 4px;
            animation: blink 0.7s infinite;
        }

        .typing-text {
            overflow: hidden;
            white-space: nowrap;
            border-right: 2px solid;
            display: inline-block;
            animation: typing 10s steps(40, end) infinite alternate, blink 0.7s infinite;
        }

        /* main White div */
        .wrapper {

            overflow: hidden;

        }

        .forms-container {
            width: 50%;
            position: absolute;
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .form {
            width: 100%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: white;
            opacity: 1;
            transition: opacity 0.3s ease-in-out;
        }

        /* for blue panel */
        .blue-panel {


            transition: transform 0.5s ease-in-out;
        }

        .wrapper.active .forms-container {
            transform: translateX(100%);
        }

        .wrapper.active .blue-panel {
            transform: translateX(-118%);
        }

        .wrapper .sign-up-form {
            opacity: 0;
            position: absolute;
            visibility: hidden;
        }

        .wrapper.active .sign-in-form {
            opacity: 0;
            position: absolute;
            visibility: hidden;
        }

        .wrapper.active .sign-up-form {
            opacity: 1;
            position: relative;
            visibility: visible;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-gray-200 to-blue-200 flex items-center justify-center mt-30 ">

    <div class="absolute top-10 text-center ">
        <h1 class="text-3xl font-bold text-blue-950 w-160">
            <span class="typing-text">XamXpress – Fast, Accurate, Instant Success!</span>
        </h1>
    </div>

    <!-- Main Wrapper -->
    <div class="wrapper h-120 w-195 bg-white flex relative shadow-xl hover:shadow-2xl rounded-4xl" id="wrapper">
        <!-- Forms Container -->
        <div class="forms-container">
            <!-- Sign In Form -->
            <div class="form sign-in-form">
                <h1 class="text-3xl font-bold mb-4 mt-10">Sign In</h1>
                <p class="text-gray-600 text-xs mt-5 mr-35 font-bold mb-5">Login as Student?
                    <a href="Stlogin.php" class="text-blue-800 font-bold underline ">Click here</a>
                </p>
                <form action="signup.php" method="POST" class="w-full">
                    <div class="mb-4">
                        <label class="text-gray-600 font-bold text-xs">Educator ID</label>
                        <div class="flex items-center border-b-2 border-gray-400">
                            <img src="user.png" class="h-4 w-4 mr-2">
                            <input type="email" placeholder="Enter Email" class="w-full focus:outline-none text-xs pb-2" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="text-gray-600 font-bold text-xs leading-10">Password</label>
                        <div class="flex items-center border-b-2 border-gray-400">
                            <img src="padlock.png" class="h-4 w-4 mr-2">
                            <input type="password" placeholder="Enter Your Password" class="w-full focus:outline-none text-xs pb-2" required>
                        </div>
                    </div>

                    <a href="forgotpass.php" class="text-xs text-gray-600 block text-right mb-5">Forgot Password?</a>

                    <button class="w-50 ml-15 mt-10 bg-blue-800 text-white font-bold py-2 rounded-3xl hover:shadow-lg">
                        Sign In
                    </button>
                </form>


            </div>

            <!-- Sign Up Form -->
            <div class="form sign-up-form">
                <h1 class="text-3xl font-bold mb-4">Create Account</h1>
                <form action="EdLogin.html" method="POST" class="w-full">
                    <div class="flex space-x-4 mb-4">
                        <div>
                            <label class="text-gray-600 font-bold text-xs">First Name</label>
                            <div class="flex items-center border-b-2 border-gray-400">
                                <img src="user.png" class="h-4 w-4 mr-2">
                                <input type="text" placeholder="First Name" class="w-full focus:outline-none text-xs mb-2">
                            </div>
                        </div>
                        <div>
                            <label class="text-gray-600 font-bold text-xs">Last Name</label>
                            <div class="flex items-center border-b-2 border-gray-400">
                                <img src="user.png" class="h-4 w-4 mr-2">
                                <input type="text" placeholder="Last Name" class="w-full focus:outline-none text-xs mb-2" pattern="^[A-Za-z\s]+$" required  oninvalid="this.setCustomValidity('Please enter a valid name with alphabetic characters only.')" oninput="this.setCustomValidity('')" class="pl-2 text-xs focus:outline-none">

                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="text-gray-600 font-bold text-xs">Email</label>
                        <div class="flex items-center border-b-2 border-gray-400">
                            <img src="padlock.png" class="h-4 w-4 mr-2">
                            <input type="email" placeholder="Enter Email" class="w-full focus:outline-none text-xs mb-2">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="text-gray-600 font-bold text-xs ">Phone Number</label>
                        <div class="flex items-center border-b-2 border-gray-400">
                            <img src="padlock.png" class="h-4 w-4 mr-2">
                            <input type="tel" placeholder="Phone Number" id="phone" name="phone" pattern="^\d{10}$" maxlength="10" required  oninvalid="this.setCustomValidity('Kindly enter numeric characters only (10 digits).')" oninput="this.setCustomValidity('')" class="w-full pl-1 text-xs focus:outline-none mb-2">
                        </div>
                    </div>
                    <div>
                        <label class="text-gray-600 font-bold text-xs">Password</label>
                        <div class="flex items-center border-b-2 border-gray-400">
                            <img src="padlock.png" class="h-4 w-4 mr-2">
                            <input type="password" placeholder="Enter Password" id="password" name="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}$" required oninvalid="this.setCustomValidity('Password must contain at least 8 characters, including uppercase, lowercase, and a special character.')" oninput="this.setCustomValidity('')" class="pl-1 text-xs focus:outline-none w-full  mb-2">

                        </div>
                        <div class="mt-3">
                            <input type="checkbox" id="TandC" name="TandC" value="TandC" required>
                            <label for="TandC"> I accept the <a class="text-blue-800" href="">Terms and Conditions</a></label>
                        </div>
                    </div>
                    <button class="w-50 ml-12 bg-blue-800 text-white font-bold py-2 rounded-3xl hover:shadow-lg mt-9">
                        Sign Up
                    </button>
                </form>

            </div>
        </div>

        <!-- Blue Background Panel -->
        <div
            class="blue-panel bg-gradient-to-r from-blue-900 to-blue-950 h-120 w-90 rounded-3xl text-white items-center flex justify-center absolute right-0">
            <div class="block text-center">
                <div class=" w-75 pl-20">
                    <h2 class="typing-text text-3xl font-bold">Welcome User</h2>
                </div>
                <p class="text-white text-sm text-center pt-3  pl-8 pr-8 mt-5 font-sans">
                    We helps you to prepare the best for exams. Boost your score.
                </p>
                <button id="signUpBtn" onclick="toggleForm()"
                    class="mt-20 w-36 py-2 border text-white font-bold border-white bg-blue-900 rounded-3xl hover:bg-blue-800 cursor-pointer hover:shadow-2xl">
                    Sign Up
                </button>
                <button id="signInBtn" onclick="toggleForm()"
                    class="mt-20 w-36 py-2 border border-white font-bold text-white rounded-3xl bg-blue-900 hover:bg-blue-800 cursor-pointer hidden hover:shadow-2xl">
                    Sign In
                </button>
            </div>
        </div>
        <!-- Chat Button -->
        <div class="relative min-h-screen bg-gray-100">
            <div class="fixed bottom-6 right-6 flex items-center space-x-2">
            <div id="chatTooltip" class="bg-white text-gray-800 text-xs rounded-lg py-2 px-3 shadow-lg border hidden">
                <span id="tooltipText"></span>
            </div>
            <button 
                onclick="toggleChat()" 
                onmouseover="showTooltip()" 
                onmouseout="hideTooltip()" 
                class="size-15 border-2 transition-transform duration-300 hover:scale-105 hover:z-10 text-white p-4 rounded-full shadow-lg z-100 cursor-pointer animate-ring">
                <img src="aibot-icon.png" alt="AI Bot Icon" class="w-15 h-14 absolute inset-0 m-auto rounded-full cursor-pointer">
                <i data-lucide="bot" class="w-6 h-6"></i>
            </button>
            </div>
        </div>
    </div>
    <!-- Chat Window -->
        <div id="chatWindow" class="hidden fixed bottom-20 right-6 w-80 bg-white border border-gray-300 rounded-lg shadow-xl flex-col z-50">
            <div class="bg-blue-600 text-white px-4 py-2 rounded-t-lg flex items-center justify-between">
            <span class="font-semibold">Exam Assistant</span>
            <button onclick="toggleChat()"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>

            <div class="p-4 h-64 overflow-y-auto text-sm space-y-2" id="chatMessages">
            <div class="text-gray-500">👋 Hi! How can I help you with your exam queries?</div>
            </div>

            <form onsubmit="sendMessage(event)" class="p-3 border-t flex items-center gap-2">
            <input id="userInput" type="text" placeholder="Type your message..." 
                class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-400" required />
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg">
                <i data-lucide="send" class="w-4 h-4"></i>
            </button>
            </form>
        </div>

        <script>
            function toggleForm() {
                const wrapper = document.getElementById('wrapper');
                const signUpBtn = document.getElementById('signUpBtn');
                const signInBtn = document.getElementById('signInBtn');

                wrapper.classList.toggle('active');
                signUpBtn.classList.toggle('hidden');
                signInBtn.classList.toggle('hidden');
            }
            function showTooltip() {
            const tooltip = document.getElementById('chatTooltip');
            const tooltipText = document.getElementById('tooltipText');
            tooltipText.textContent = "Click to chat!";
            tooltip.classList.remove('hidden');
            }

            function hideTooltip() {
            const tooltip = document.getElementById('chatTooltip');
            tooltip.classList.add('hidden');
            }

            function toggleChat() {
            const chatWindow = document.getElementById("chatWindow");
            chatWindow.classList.toggle("hidden");

            // Hide tooltip when chat is opened
            const tooltip = document.getElementById('chatTooltip');
            tooltip.classList.add('hidden');
            }

            // Typing animation for tooltip text
            function typeText(text, elementId, callback) {
            const element = document.getElementById(elementId);
            let index = 0;
            const interval = setInterval(() => {
                if (index < text.length) {
                element.textContent += text[index];
                index++;
                } else {
                clearInterval(interval);
                if (callback) callback();
                }
            }, 100); // Typing speed
            }

            // Deleting animation for tooltip text
            function deleteText(elementId) {
            const element = document.getElementById(elementId);
            const interval = setInterval(() => {
                if (element.textContent.length > 0) {
                element.textContent = element.textContent.slice(0, -1);
                } else {
                clearInterval(interval);
                }
            }, 50); // Deleting speed
            }

            // Show tooltip automatically on page load with typing animation
            window.onload = function() {
            const tooltip = document.getElementById('chatTooltip');
            tooltip.classList.remove('hidden');
            const message = "Hello, how can I assist you today?";
            const tooltipText = document.getElementById("tooltipText");
            tooltipText.style.fontFamily = "'Arial', sans-serif"; // Change font style
            typeText(message, "tooltipText", () => {
                setTimeout(() => {
                deleteText("tooltipText");
                setTimeout(() => {
                    tooltip.classList.add('hidden');
                }, 1000); // Delay before hiding tooltip
                }, 5000); // Delay before deleting text
            });
            };
            function sendMessage(event) {
            event.preventDefault();
            const input = document.getElementById("userInput");
            const message = input.value.trim();
            if (message === "") return;

            const chatMessages = document.getElementById("chatMessages");
            const userMsg = document.createElement("div");
            userMsg.className = "text-right text-blue-600";
            userMsg.textContent = "You: " + message;
            chatMessages.appendChild(userMsg);

            const botReply = document.createElement("div");
            botReply.className = "text-left text-gray-600";
            setTimeout(() => {
                botReply.textContent = "🤖 Bot: Thanks for your query! We'll get back to you soon.";
                chatMessages.appendChild(botReply);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }, 600);

            input.value = "";
            }
        </script>

</body>

</html>
<?php
// if (isset($_POST['signin'])) {
//     $educatorid = $_POST['educatorid'];
//     $password = $_POST['password'];

//     // Check if the educator ID and password match in the database
//     $query = "SELECT * FROM teacher WHERE educatorid='$educatorid' AND password='$password'";
//     $result = mysqli_query($conn, $query);

//     if (mysqli_num_rows($result) > 0) {
//         // Successful login, redirect to dashboard
//         header("Location: Dashboard.php");
//         exit();
//     } else {
//         // Invalid credentials, show an error message
//         echo "<script>alert('Invalid Educator ID or Password');</script>";
//     }
// } else if (isset($_POST["signup"])) {
//     $fname = $_POST['fname'];
//     $lname = $_POST['lname'];
//     $email = $_POST['email'];
//     $phone = $_POST['phone'];
//     $password = $_POST['password'];

//     // Insert the new user into the database
//     $query = "INSERT INTO users (fname, lname, email, phone, password) VALUES ('$fname', '$lname', '$email', '$phone', '$password')";
//     if (mysqli_query($conn, $query)) {
//         // Successful registration, redirect to login page or show success message
//         echo "<script>alert('Registration successful! You can now log in.');</script>";
//     } else {
//         // Registration failed, show an error message
//         echo "<script>alert('Registration failed. Please try again.');</script>";
//     }
// } else if (isset($_POST["forgotpass"])) {
//     $email = $_POST['email'];
//     // Check if the email exists in the database
//     $query = "SELECT * FROM teacher WHERE email='$email'";
//     $result = mysqli_query($conn, $query);

//     if (mysqli_num_rows($result) > 0) {
//         // Email exists, send password reset link or show success message
//         echo "<script>alert('Password reset link has been sent to your email.');</script>";
//     } else {
//         // Email not found, show an error message
//         echo "<script>alert('Email not found. Please check and try again.');</script>";
//     }
// } else if (isset($_POST["forgotpass"])) {
//     $email = $_POST['email'];
//     // Check if the email exists in the database
//     $query = "SELECT * FROM teacher WHERE email='$email'";
//     $result = mysqli_query($conn, $query);

//     if (mysqli_num_rows($result) > 0) {
//         // Email exists, send password reset link or show success message
//         echo "<script>alert('Password reset link has been sent to your email.');</script>";
//     } else {
//         // Email not found, show an error message
//         echo "<script>alert('Email not found. Please check and try again.');</script>";
//     }
// } else {
//     echo "";
   
//     exit();

// }
?>