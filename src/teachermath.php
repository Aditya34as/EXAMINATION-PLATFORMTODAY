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
        { q: "If f(x) = x² + 3x + 2, find f(–1)", options: ["0", "2", "–2", "4"], correct: 0 },
        { q: "What is the derivative of sin(x)?", options: ["cos(x)", "–cos(x)", "–sin(x)", "sec(x)"], correct: 0 },
        { q: "If A = [[1, 2], [3, 4]], what is det(A)?", options: ["–2", "2", "–1", "1"], correct: 0 },
        { q: "What is the integral of 1/x dx?", options: ["ln|x| + C", "x ln x + C", "1/(x²) + C", "e^x + C"], correct: 0 },
        { q: "If tan A = 1, what is angle A in degrees?", options: ["30°", "45°", "60°", "90°"], correct: 1 },
        { q: "Solve: log₃ 81", options: ["2", "3", "4", "5"], correct: 2 },
        { q: "What is the distance between points (1,2) and (4,6)?", options: ["5", "4", "6", "7"], correct: 0 },
        { q: "What is the equation of a line with slope 2 and y-intercept 3?", options: ["y = 2x + 3", "y = 3x + 2", "y = x + 3", "y = 2x – 3"], correct: 0 },
        { q: "If A and B are independent, P(A) = 0.5, P(B) = 0.4. Find P(A ∩ B)", options: ["0.1", "0.2", "0.4", "0.5"], correct: 1 },
        { q: "What is the value of cos²θ + sin²θ?", options: ["0", "1", "2", "θ"], correct: 1 },
        { q: "If a > 0 and b > 0, then AM ≥ GM is:", options: ["(a+b)/2 ≥ √ab", "a² + b² ≥ ab", "ab ≥ a+b", "a – b ≥ ab"], correct: 0 },
        { q: "What is the limit of (x² – 1)/(x – 1) as x → 1?", options: ["1", "2", "0", "undefined"], correct: 1 },
        { q: "If a matrix is 3x2, how many rows does it have?", options: ["2", "3", "5", "6"], correct: 1 },
        
       { q: "If events A and B are independent and P(A) = 0.5, P(B) = 0.3, what is P(A ∩ B)?",  options: ["0.8", "0.15", "0.2", "0.5"], correct: 1 },

        { q: "Solve the equation: x² – 4x + 3 = 0", options: ["1 and 3", "–1 and –3", "2 and 4", "3 and 4"], correct: 0 },
        { q: "Find dy/dx if y = x³ + 2x", options: ["3x² + 2", "3x² – 2", "x³ – 2x", "None"], correct: 0 },
        { q: "What is the domain of f(x) = √(x – 2)?", options: ["x ≥ 2", "x > 0", "x ≤ 2", "x ≠ 2"], correct: 0 },
        { q: "How many permutations of the word 'MATH'?", options: ["12", "16", "24", "36"], correct: 2 },
        { q: "If f(x) = e^x, then f ''(x) is?", options: ["e^x", "x", "1", "0"], correct: 0 },
        { q: "Find the angle between the vectors a = i + j and b = i – j", options: ["0°", "45°", "60°", "90°"], correct: 3 },
        { q: "Find the modulus of the complex number 3 + 4i", options: ["5", "7", "1", "√13"], correct: 0 },
        { q: "What is sin(30°)?", options: ["1", "1/2", "√3/2", "0"], correct: 1 },
        { q: "The solution of the inequality x² – 4 < 0 is:", options: ["(–2, 2)", "(–∞, –2)", "(2, ∞)", "(–∞, ∞)"], correct: 0 },
        { q: "The sum of infinite GP 2 + 1 + 0.5 + ... is:", options: ["3", "4", "2", "5"], correct: 1 },
        { q: "What is the eccentricity of a circle?", options: ["0", "1", ">1", "<1"], correct: 0 },
        { q: "Find the slope of a line perpendicular to y = 2x + 3", options: ["2", "–1/2", "–2", "1/2"], correct: 1 },
        { q: "Find the inverse of sin(x) = 1/2", options: ["x = 30°", "x = 90°", "x = 60°", "x = 180°"], correct: 0 },
        { q: "Find ∫ cos²x dx", options: ["(x/2) + (sin2x/4) + C", "cos x + C", "sin x + C", "None"], correct: 0 },
        { q: "If A and B are events and P(A ∪ B) = 0.7, P(A) = 0.5, P(B) = 0.4. Find P(A ∩ B)", options: ["0.1", "0.2", "0.3", "0.4"], correct: 1 },
        { q: "If y = ln(x²), then dy/dx is:", options: ["2/x", "1/x²", "x", "2x"], correct: 0 }
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
            alert("Test Submitted!");
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
