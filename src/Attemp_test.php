<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Exam Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 items-center h-screen ">
    <!--  top header -->
    <div class="bg-gradient-to-r from-blue-950 to-blue-900 text-white flex justify-between items-center p-3 w-full">
        <div class="flex items-center">
            <img src="car1.jpg" alt="Website Logo" class="w-12 h-12 rounded-full">
            <p class="text-lg mt-1 font-medium ml-3">XampXpress</p>
        </div>
        
        <div class="text-lg font-semibold text-center">Time Left: <span id="timer">10:00</span></div>
        <div class="flex items-center">
            <img src="car1.jpg" alt="Profile" class="w-10 h-10 ring-2 ring-white border-white">
            <p class="text-lg mt-1 font-medium ml-3">Student Name</p>
        </div>
    </div>
    <div class="bg-white w-full p-4 md:p-6 shadow-lg rounded-lg h-300px">

        

        <!-- Blue Background Header -->
        <div class=" text-black flex  items-center h-12 rounded-md mt-2">
            <h2 class="text-lg md:text-xl justify-center mx-auto font-semibold">JEE-Mains_24507</h2>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col lg:flex-row mt-5 ">

            <!-- Left Section: Question and Answer Options -->
            <div class="w-full lg:w-3/4 p-4 border-b lg:border-b-0 lg:border-r overflow-y-auto">
                <p id="question" class="font-medium text-lg">Loading question...</p>
                <div id="options" class="mt-3 space-y-2"></div>

                <!-- Buttons Row -->
                <div class="mt-16 flex gap-2">
                    <button onclick="prevQuestion()" class="bg-gray-300 px-3 py-1 text-sm rounded">Previous</button>
                    <button onclick="clearResponse()" class="bg-blue-500 text-white px-3 py-1 text-sm rounded">Clear</button>
                    <button onclick="markForReview()" class="bg-yellow-500 text-white px-3 py-1 text-sm rounded">Mark</button>
                </div>
            </div>

            <!-- Right Section: Question Palette -->
            <div class="w-full lg:w-1/5 pl-14 overflow-y-auto">
                <div class="flex justify-between items-center">
                    <h3 class="font-medium text-lg">Question Palette</h3>
                    <button onclick="nextQuestion()" class="bg-green-500 text-white px-4 py-2 text-sm rounded">Next</button>
                </div>

                <!-- Grid for Question Palette (1-30) -->
                <div id="palette" class="grid grid-cols-5 gap-2 mt-4"></div>

                <button onclick="submitTest()" class="mt-4 bg-red-600 text-white w-full py-2 rounded-md">Submit Test</button>
            </div>
        </div>
    </div>

    <script>
        const subjects = {
            Reasoning: generateQuestions("Reasoning"),
            Quantitative: generateQuestions("Quantitative"),
            English: generateQuestions("English"),
            GK: generateQuestions("General Knowledge"),
            Computers: generateQuestions("Computers")
        };

        let currentSubject = "Reasoning";
        let questions = subjects[currentSubject];
        let currentQuestion = 0;
        let selectedAnswers = Array(questions.length).fill(null);

        function generateQuestions(subject) {
            const questions = [];
            for (let i = 1; i <= 30; i++) {
                questions.push({
                    q: Question ${i} for ${subject}?,
                    options: ["Option 1", "Option 2", "Option 3", "Option 4"],
                    correct: Math.floor(Math.random() * 4)
                });
            }
            return questions;
        }

        function loadQuestion() {
            document.getElementById("question").textContent = (currentQuestion + 1) + ". " + questions[currentQuestion].q;
            let optionsDiv = document.getElementById("options");
            optionsDiv.innerHTML = "";
            questions[currentQuestion].options.forEach((option, index) => {
                optionsDiv.innerHTML += `
                    <label class="block border p-2 rounded-md cursor-pointer">
                        <input type="radio" name="option" value="${index}" onclick="selectAnswer(${index})">
                        ${option}
                    </label>
                `;
            });
        }

        function selectAnswer(index) {
            selectedAnswers[currentQuestion] = index;
            updatePalette();
        }

        function prevQuestion() {
            if (currentQuestion > 0) {
                currentQuestion--;
                loadQuestion();
            }
        }

        function nextQuestion() {
            if (currentQuestion < questions.length - 1) {
                currentQuestion++;
                loadQuestion();
            }
        }

        function clearResponse() {
            selectedAnswers[currentQuestion] = null;
            document.querySelectorAll("input[name='option']").forEach(input => input.checked = false);
            updatePalette();
        }

        function markForReview() {
            document.getElementById(q${currentQuestion}).classList.add("bg-yellow-400");
        }

        function submitTest() {
            alert("Test Submitted!");
        }

        function updatePalette() {
            let paletteDiv = document.getElementById("palette");
            paletteDiv.innerHTML = "";
            for (let i = 0; i < questions.length; i++) {
                let color = selectedAnswers[i] !== null ? "bg-green-500" : "bg-gray-300";
                paletteDiv.innerHTML += <button id="q${i}" onclick="jumpToQuestion(${i})" class="w-8 h-8 text-white ${color} rounded-md">${i + 1}</button>;
            }
        }

        function jumpToQuestion(index) {
            currentQuestion = index;
            loadQuestion();
        }

        function startTimer(duration) {
            let time = duration;
            let timerElement = document.getElementById("timer");

            let interval = setInterval(() => {
                let minutes = Math.floor(time / 60);
                let seconds = time % 60;
                let formattedTime = ${minutes}:${seconds < 10 ? '0' + seconds : seconds};

                timerElement.textContent = formattedTime;

                if (time-- <= 0) {
                    clearInterval(interval);
                    alert("Time Over!");
                }
            }, 1000);
        }

        function loadSubject(subject) {
            currentSubject = subject;
            questions = subjects[subject];
            selectedAnswers = Array(questions.length).fill(null);
            currentQuestion = 0;
            loadQuestion();
            updatePalette();
        }

        loadSubject(currentSubject);
        startTimer(600); 
    </script>

</body>

</html>