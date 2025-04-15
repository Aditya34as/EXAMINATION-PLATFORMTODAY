<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        ::-webkit-scrollbar {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="output.css">
    <script>
        function updateStats(totalTests, averageScore, accuracy) {
            document.getElementById('total-tests').innerText = totalTests;
            document.getElementById('average-score').innerText = averageScore;
            document.getElementById('accuracy').innerText = `${accuracy}%`;

            document.querySelector('circle#accuracy-circle').style.setProperty('--progress', accuracy);
        }

        // Example: Update stats (You can call this function based on the actual data)
        updateStats(10, 85, 75);
        function unlockBadge(badgeName, emoji, bgColor, textColor) {
    const badgeContainer = document.getElementById('dynamic-badges');
    const badge = document.createElement('div');
    badge.className = `flex items-center ${bgColor} ${textColor} text-sm font-medium px-3 py-1 rounded-full`;
    badge.innerHTML = `${emoji} ${badgeName}`;
    badgeContainer.appendChild(badge);
  }

  // Example: Unlock badges based on tests attempted
  let testsAttempted = 5;  // This can be fetched dynamically from backend

  if (testsAttempted >= 1) unlockBadge('First Attempt', '🥇', 'bg-purple-100', 'text-purple-600');
  if (testsAttempted >= 5) unlockBadge('Test Warrior', '⚔️', 'bg-red-100', 'text-red-600');
  if (testsAttempted >= 10) unlockBadge('Elite Tester', '👑', 'bg-indigo-100', 'text-indigo-600');
  let badges = JSON.parse(localStorage.getItem('badges')) || [];

  function saveBadge(name, emoji, bgColor, textColor) {
    if (!badges.includes(name)) {
      badges.push(name);
      localStorage.setItem('badges', JSON.stringify(badges));
      unlockBadge(name, emoji, bgColor, textColor);
    }
  }

  // Example Usage
  saveBadge('Quiz Master', '🧠', 'bg-blue-100', 'text-blue-600');
  function getTodayDate() {
    return new Date().toISOString().split('T')[0];
}

function updateStreak() {
    let today = getTodayDate(), lastAttempt = localStorage.getItem('lastAttempt');
    let streak = parseInt(localStorage.getItem('currentStreak')) || 0;
    let longest = parseInt(localStorage.getItem('longestStreak')) || 0;

    if (lastAttempt !== today) {
        streak = (lastAttempt === getYesterdayDate()) ? streak + 1 : 1;
        localStorage.setItem('lastAttempt', today);
        localStorage.setItem('currentStreak', streak);
        localStorage.setItem('longestStreak', Math.max(streak, longest));
    }

    document.getElementById('currentStreak').innerText = streak;
    document.getElementById('longestStreak').innerText = longest;
}

function getYesterdayDate() {
    let d = new Date();
    d.setDate(d.getDate() - 1);
    return d.toISOString().split('T')[0];
}

window.onload = updateStreak;

    </script>
</head>

<body>
    <!-- Navbar -->
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
                data-dropdown-placement="bottom-start" class="w-10 h-10 rounded-full cursor-pointer mr-2" src="Logo.png"
                alt="User dropdown">
            <p id="userName">Amrit Raj</p>
            <div id="userDropdown"
                class="z-10 hidden absolute mt-55 mr-10 right-0 bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
                <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                    <div id="userEmail" class="font-medium truncate">Amrit@xyz.com</div>
                </div>
                <div class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                    <a href="profile1.php"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                </div>
                <div class="py-1 flex justify-center items-center">
                    <a href="#"
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
        </script>
    </nav>

    <div class="flex">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="output.css">
        </head>

        <body>
            <div class="flex ">

                <div
                    class=" transition-transform duration-300 hover:scale-105 hover:z-10  ml-15 mt-10 rounded-xl border-white border-2 shadow-2xl shadow-gray-400 h-[14cm] w-[10cm] ">
                    <a href="abc" class="text-lg text-blue-800 font-bold flex justify-end mr-5 mt-5 hover:underline">Edit</a>
                    <div class="pl-[3cm]">
                        <img src="User.png" class="rounded-full mt-4 size-35 ring-3 ring-gray-300 mb-4">
                        <label class="text-sm cursor-pointer bg-blue-500 text-white px-2 py-2 ml-5 relative rounded-md hover:bg-blue-600">
                            Upload Image
                            <input type="file" id="imageUpload" accept="image/*" class="hidden">
                          </label>
                    </div>
                    <br>
                    <div class="font-bold text-xl text-center">
                        Amrit Raj<br>
                    </div>
                    <div class="text-center">
                        Student at XYZ University<br>
                    </div>
                    <div class="flex space-x-2 ml-23 mt-5">
                        <img src="identity.png" class="size-5">
                        <p>Student ID:1235639</p>
                       
                    </div>
                   
                        <div class="flex space-x-2 pl-23 mt-5">
                            <img src="phone-call.png" class="size-5">
                            <p class="text-center">Mob: +9194*****61</p>
                        </div>
                        <div class="flex space-x-2 pl-23 mt-5">
                            <img src="email.png" class="size-5">
                            <p class="text-center">Email: amrit@gmail.com</p>
                        </div>
                        <div class="flex space-x-2 pl-23 mt-5">
                            <img src="calendar.png" class="size-5">
                            <p class="text-center">DOB: 07-04-2004</p>
                        </div>
                    <br>
                    

                </div>
                <div>

                    <div
                        class="border-white transition-transform duration-300 hover:scale-105 hover:z-10 shadow-2xl shadow-gray-400 rounded-xl ml-8 mt-10 h-20 w-205 pl-10 pt-6 font-semibold">
                       
                        <div class="flex space-x-15">
                            <a href="apnacademic.php" class="text-sm">Academic Details</a>
                            <a href="apnadoc.php" class="text-sm">Documents & Certificates</a>
                            <a href="Examhistory.php" class="text-sm">Exam Information</a>
                            
                            <div class="flex space-x-2">
                                <a href="profile1.php" class="text-sm">Preference & Settings</a>
                                <img src="settings1.png" onclick="" class="size-5">
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- <body class="bg-azure p-6"> -->
                        <div>
                        <div class="max-w-md mx-auto p-6 rounded-xl shadow-2xl  shadow-gray-500  transition-transform duration-300 hover:scale-105 hover:z-10">
                            <h2 class="text-2xl font-semibold mb-4">Preferences & Settings</h2>
                            
                            <div class="mb-4">
                                <label for="language" class="block font-medium">Language Preferences:</label>
                                <select id="language" class="w-full p-2 border border-gray-200 rounded mt-1 cursor-pointer">
                                    <option value="english">English</option>
                                    <option value="hindi">Hindi</option>
                                    <option value="spanish">Spanish</option>
                                    <option value="french">French</option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block font-medium">Change Password:</label>
                                <input type="password" placeholder="Old Password" class="w-full p-2 border border-gray-200 rounded mt-1">
                                <input type="password" placeholder="New Password" class="w-full p-2 border border-gray-200 rounded mt-2">
                                <input type="password" placeholder="Confirm Password" class="w-full p-2 border border-gray-200 rounded mt-2">
                            </div>
                            
                            <div class="mb-4">
                                <label class="block font-medium">Notification Settings:</label>
                                <div class="flex items-center mt-2">
                                    <input type="checkbox" id="email" class="mr-2">
                                    <label for="email">Email Notifications</label>
                                </div>
                                <div class="flex items-center mt-2">
                                    <input type="checkbox" id="sms" class="mr-2">
                                    <label for="sms">SMS Alerts</label>
                                </div>
                            </div>
                            
                           
                            
                            <button class="w-full bg-blue-500 text-white p-3 rounded hover:bg-blue-700">Save Changes</button>
                        </div>
                        </div>
                    
        
</body>

</html>