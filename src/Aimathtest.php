<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Exam Portal - Maths Test</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        ::-webkit-scrollbar {
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-gray-100 items-center h-screen ">
    <!--  top header -->
    <div class="bg-gradient-to-r from-blue-950 to-blue-900 text-white flex justify-between items-center p-3 h-14 w-full ">
        <div class="flex items-center">
            <img src="Logo.png" alt="Website Logo" class="w-12 h-12 rounded-full">
            <p class="text-lg mt-1 font-medium ml-3">XampXpress</p>
        </div>
        <div class="flex items-center">
            <img src="My Pic.jpg" alt="Profile" class="w-10 h-10 ring-2 ring-white border-white">
            <p class="text-lg mt-1 font-medium ml-3">Student Name</p>
        </div>
    </div>

    <div class="bg-white w-full p-4 md:p-6 shadow-lg rounded-lg h-300px">
        <div class=" text-black flex items-center h-12 rounded-md mt-2">
            <h2 class="text-lg md:text-xl justify-center mx-auto font-semibold">Aptitude_Test_30Q</h2>
            <div class="text-lg font-semibold pr-[1cm] mt-[-1cm]">Time Left: <span id="timer">10:00</span></div>
        </div>

        <div class="flex flex-col lg:flex-row mt-11">
            <div class="w-full h-[14cm] lg:w-3/4 p-4 border-b lg:border-b-0 lg:border-r overflow-y-auto">
                <p id="question" class="font-medium text-lg">Loading question...</p>
                <div id="options" class="mt-3 space-y-2"></div>

                <div class="mt-36 flex pr-20 justify-between gap-2">
                    <div>
                        <button onclick="clearResponse()" class="bg-blue-500 text-white px-5 py-1 text-md rounded">Clear</button>
                        <button onclick="markForReview()" class="bg-yellow-500 text-white px-5 py-1 text-md rounded ml-4">Mark</button>
                    </div>
                    <div>
                        <button onclick="prevQuestion()" class="bg-gray-300 px-4 py-1 gap-5 text-md rounded">Previous</button>
                        <button onclick="nextQuestion()" class="bg-green-500 text-white px-4 py-1 text-md rounded ml-4">Next</button>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/5 ml-10 mt-[-1cm] pl-14 overflow-y-auto ">
                <div class="flex justify-center items-center">
                    <h3 class="font-medium text-lg">Question Palette</h3>
                </div>
                <div id="palette" class="grid grid-cols-5 gap-2 mt-4"></div>
                <button onclick="submitTest()" class="mt-6 bg-red-600 text-white w-full py-2 rounded-md">Submit Test</button>

     <!-- Webcam Monitoring Box (Bottom-right Corner) -->

  <div class="absolute mt-5  flex flex-col items-center space-y-2">
    <p class="text-sm font-medium text-gray-700">📹 Monitoring...</p>
    <video id="video" class="w-60 h-40 rounded bg-black" autoplay playsinline></video>
  </div>

  <script>
    const video = document.getElementById('video');

    // Auto-start webcam on page load
    window.addEventListener('DOMContentLoaded', async () => {
      try {
        const stream = await navigator.mediaDevices.getUserMedia({ video: true });
        video.srcObject = stream;
      } catch (error) {
        alert('Could not access the webcam.');
        console.error(error);
      }
    });
  </script>


            </div>
        </div>
    </div>

    <script>
        const subjects = {
            Mathematics: generateMathQuestions()
        };

        let currentSubject = "Mathematics";
        let questions = subjects[currentSubject];
        let currentQuestion = 0;
        let selectedAnswers = Array(questions.length).fill(null);
        let skippedQuestions = new Set();

        function generateMathQuestions() {
            return [
                { q: "What is 2 + 2?", options: ["3", "4", "5", "6"], correct: 1 },
                { q: "What is the square root of 16?", options: ["2", "3", "4", "5"], correct: 2 },
                { q: "What is 7 * 6?", options: ["42", "36", "48", "40"], correct: 0 },
                { q: "What is the derivative of x^2?", options: ["x", "2x", "x^2", "2"], correct: 1 },
                { q: "What is 10 / 2?", options: ["2", "4", "5", "10"], correct: 2 },
                { q: "Solve for x: 2x = 8", options: ["2", "4", "6", "8"], correct: 1 },
                { q: "What is the area of a circle with radius 1?", options: ["π", "2π", "πr", "πr^2"], correct: 0 },
                { q: "What is the integral of 1/x?", options: ["ln|x|", "1/x^2", "x", "x^2"], correct: 0 },
                { q: "What is 3^2?", options: ["6", "9", "12", "3"], correct: 1 },
                { q: "What is 5 + 7?", options: ["11", "12", "13", "14"], correct: 1 },
                { q: "What is the factorial of 4?", options: ["16", "12", "24", "10"], correct: 2 },
                { q: "What is 100 ÷ 10?", options: ["10", "1", "5", "20"], correct: 0 },
                { q: "What is 6^2?", options: ["36", "30", "12", "18"], correct: 0 },
                { q: "What is the cube root of 27?", options: ["2", "3", "6", "4"], correct: 1 },
                { q: "What is 8 - 3?", options: ["5", "4", "6", "3"], correct: 0 },
                { q: "What is 12 % 5?", options: ["1", "2", "3", "4"], correct: 2 },
                { q: "What is the value of π (approx)?", options: ["3.14", "2.71", "1.41", "1.61"], correct: 0 },
                { q: "What is sin(90°)?", options: ["0", "1", "√3", "1/2"], correct: 1 },
                { q: "What is log(1)?", options: ["0", "1", "Undefined", "∞"], correct: 0 },
                { q: "What is 9 * 9?", options: ["81", "72", "90", "99"], correct: 0 },
                { q: "What is 14 - 6?", options: ["7", "8", "9", "10"], correct: 1 },
                { q: "What is 3 * 5 + 2?", options: ["17", "15", "13", "12"], correct: 0 },
                { q: "What is 11 squared?", options: ["121", "111", "100", "110"], correct: 0 },
                { q: "What is the next prime after 7?", options: ["9", "10", "11", "13"], correct: 2 },
                { q: "What is 2^5?", options: ["32", "16", "64", "24"], correct: 0 },
                { q: "What is the slope of a vertical line?", options: ["0", "1", "∞", "-1"], correct: 2 },
                { q: "What is 0 factorial (0!)?", options: ["0", "1", "Undefined", "Infinity"], correct: 1 },
                { q: "What is 2/4 in simplest form?", options: ["1/2", "2/4", "1/4", "2/3"], correct: 0 },
                { q: "What is 1 + 1?", options: ["1", "2", "3", "4"], correct: 1 },
                { q: "What is √81?", options: ["7", "8", "9", "10"], correct: 2 }
            ];
        }
        function loadQuestion() {
    // Show loading spinner
    let optionsDiv = document.getElementById("options");
    optionsDiv.innerHTML = `
        <div class="flex justify-center items-center h-20">
            <div class="flex space-x-2">
                <div class="animate-ping h-6 w-6 bg-blue-500 rounded-full"></div>
                <div class="animate-ping h-6 w-6 bg-blue-500 rounded-full"></div>
                <div class="animate-ping h-6 w-6 bg-blue-500 rounded-full"></div>
            </div>
        </div>
    `;

    // Simulate a delay for loading
    setTimeout(() => {
        document.getElementById("question").textContent = (currentQuestion + 1) + ". " + questions[currentQuestion].q;
        optionsDiv.innerHTML = "";
        questions[currentQuestion].options.forEach((option, index) => {
            const isChecked = selectedAnswers[currentQuestion] === index ? "checked" : "";
            optionsDiv.innerHTML += `
                <label class="block border p-2 rounded-md cursor-pointer">
                    <input type="radio" name="option" value="${index}" onclick="selectOption(${index})" ${isChecked}>
                    ${option}
                </label>
            `;
        });
    }, 500); // Adjust delay as needed
}

        function selectOption(index) {
            selectedAnswers[currentQuestion] = index;
            skippedQuestions.delete(currentQuestion);
            updatePalette();
        }

        function prevQuestion() {
            if (currentQuestion > 0) {
                currentQuestion--;
                loadQuestion();
                updatePalette();
            }
        }

        function nextQuestion() {
            if (selectedAnswers[currentQuestion] === null) {
                skippedQuestions.add(currentQuestion);
            }
            if (currentQuestion < questions.length - 1) {
                currentQuestion++;
                loadQuestion();
                updatePalette();
            }
        }

        function clearResponse() {
            selectedAnswers[currentQuestion] = null;
            document.querySelectorAll("input[name='option']").forEach(input => input.checked = false);
            updatePalette();
        }

        function markForReview() {
            document.getElementById(`q${currentQuestion}`).classList.add("bg-yellow-400");
        }

        function submitTest() {
    let correct = 0, incorrect = 0, skipped = 0;

    questions.forEach((q, i) => {
        if (selectedAnswers[i] === null) {
            skipped++;
        } else if (selectedAnswers[i] === q.correct) {
            correct++;
        } else {
            incorrect++;
        }
    });

    localStorage.setItem("correct", correct);
    localStorage.setItem("incorrect", incorrect);
    locESULTrage.setItem("skipped", skipped);

    window.location.href = "RESULT.html";
}

        function updatePalette() {
            let paletteDiv = document.getElementById("palette");
            paletteDiv.innerHTML = "";
            for (let i = 0; i < questions.length; i++) {
                let color = "bg-gray-300";
                if (selectedAnswers[i] !== null) {
                    color = "bg-green-500";
                } else if (skippedQuestions.has(i)) {
                    color = "bg-red-500";
                }
                paletteDiv.innerHTML += `<button id="q${i}" onclick="jumpToQuestion(${i})" class="w-8 h-8 text-white ${color} rounded-md">${i + 1}</button>`;
            }
        }

        function jumpToQuestion(index) {
            currentQuestion = index;
            loadQuestion();
            updatePalette();
        }

        loadQuestion();
        updatePalette();
        
        function startTimer(duration) {
            let time = duration;
            let timerElement = document.getElementById("timer");

            let interval = setInterval(() => {
                let minutes = Math.floor(time / 60);
                let seconds = time % 60;
                let formattedTime = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;

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
