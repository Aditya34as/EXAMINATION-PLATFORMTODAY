<?php include"connection.php"; ?>
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
        ::-webkit-scrollbar {
            display: none;
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
                <div class=" flex space-x-3 m-3 p-4 mr-10" style="margin-right: 100px;">
                    <label class="text-gray-600 text-xs font-bold">Select Your Role:</label>
                    <select class="text-gray-600 text-xs font-bold cursor-pointer" name="role" id="role" required>
                        <option value="student">Student</option>
                        <option value="teacher">Educator</option>
                    </select>
                </div>
                <!-- <p class="text-gray-600 text-xs font-bold">Padh lo chahe kahin se 📚, selection hoga yehin se..😎</p> -->
                
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

                    <a href="Forgot.php" class="text-xs text-gray-600 block text-right mb-5">Forgot Password?</a>

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
    </div>
    <!-- Chatbot Button -->
<button id="chatToggle" onclick="toggleChat()" onmouseover="showTooltip()" onmouseout="hideTooltip()" class="fixed bottom-6 right-6 text-white px-2 py-3 rounded-full shadow-lg transition z-50 flex items-center justify-center">
  <img src="aibot-icon.png" alt="Chatbot Icon" class="w-10 h-10 ml-2 mr-2 animate-ring">
  <div id="chatTooltip" class="absolute bottom-28 right-0  bg-white text-black text-xs rounded-lg p-2 hidden z-50"  style="transform: translateX(-5rem);">
  <span id="tooltipText" class="text-sm font-semibold"></span>
</div>
</button>

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
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg">Send
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

    const tooltip = document.getElementById('chatTooltip');
    tooltip.classList.add('hidden');
  }

  function typeText(text, elementId, callback) {
    const element = document.getElementById(elementId);
    let index = 0;
    element.textContent = ''; // Clear the content
    element.style.whiteSpace = "nowrap"; // Prevent line breaks before starting
    const interval = setInterval(() => {
        if (index < text.length) {
            element.textContent += text[index];
            index++;
        } else {
            clearInterval(interval);
            if (callback) callback();
        }
    }, 100);
}

  function deleteText(elementId) {
    const element = document.getElementById(elementId);
    const interval = setInterval(() => {
      if (element.textContent.length > 0) {
        element.textContent = element.textContent.slice(0, -1);
      } else {
        clearInterval(interval);
      }
    }, 50);
  }

  window.onload = function () {
    const tooltip = document.getElementById('chatTooltip');
    tooltip.classList.remove('hidden');
    const message = "Hello, how can I assist you today?";
    const tooltipText = document.getElementById("tooltipText");
    tooltipText.style.fontFamily = "'Arial', sans-serif";
    typeText(message, "tooltipText", () => {
      setTimeout(() => {
        deleteText("tooltipText");
        setTimeout(() => {
          tooltip.classList.add('hidden');
        }, 1000);
      }, 5000);
    });
  };

  function sendMessage(event) {
    event.preventDefault();
    const input = document.getElementById("userInput");
    const message = input.value.trim();
    if (message === "") return;

    const chatMessages = document.getElementById("chatMessages");

    const userMsg = document.createElement("div");
    userMsg.className = "flex items-start justify-end space-x-2";
    userMsg.innerHTML = ` 
      <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-lg max-w-[70%] text-sm">
        ${message}
      </div>
      <img src="user-avtar-modified.png" alt="User" class="w-6 h-6 rounded-full">
    `;
    chatMessages.appendChild(userMsg);

    const botReply = document.createElement("div");
    botReply.className = "flex items-start space-x-2";
    setTimeout(() => {
      botReply.innerHTML = `
        <img src="aibot-icon.png" alt="Bot" class="w-6 h-6 rounded-full">
        <div class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg max-w-[70%] text-sm">
          🤖 Bot: Thanks for your query! We'll get back to you soon.
        </div>
      `;
      chatMessages.appendChild(botReply);
      chatMessages.scrollTop = chatMessages.scrollHeight;
    }, 600);

    input.value = "";
  }
    </script>

</body>

</html>
<?php
if (isset($_POST['signin'])) {
    $educatorid = $_POST['educatorid'];
    $password = $_POST['password'];

    // Check if the educator ID and password match in the database
    $query = "SELECT * FROM teacher WHERE educatorid='$educatorid' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Successful login, redirect to dashboard
        header("Location: Dashboard.php");
        exit();
    } else {
        // Invalid credentials, show an error message
        echo "<script>alert('Invalid Educator ID or Password');</script>";
    }
} else if (isset($_POST["signup"])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Insert the new user into the database
    $query = "INSERT INTO users (fname, lname, email, phone, password) VALUES ('$fname', '$lname', '$email', '$phone', '$password')";
    if (mysqli_query($conn, $query)) {
        // Successful registration, redirect to login page or show success message
        echo "<script>alert('Registration successful! You can now log in.');</script>";
    } else {
        // Registration failed, show an error message
        echo "<script>alert('Registration failed. Please try again.');</script>";
    }
} else if (isset($_POST["forgotpass"])) {
    $email = $_POST['email'];
    // Check if the email exists in the database
    $query = "SELECT * FROM teacher WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Email exists, send password reset link or show success message
        echo "<script>alert('Password reset link has been sent to your email.');</script>";
    } else {
        // Email not found, show an error message
        echo "<script>alert('Email not found. Please check and try again.');</script>";
    }
} else if (isset($_POST["forgotpass"])) {
    $email = $_POST['email'];
    // Check if the email exists in the database
    $query = "SELECT * FROM teacher WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Email exists, send password reset link or show success message
        echo "<script>alert('Password reset link has been sent to your email.');</script>";
    } else {
        // Email not found, show an error message
        echo "<script>alert('Email not found. Please check and try again.');</script>";
    }
} else {
    echo "";
   
    exit();

}
?>