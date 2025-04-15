<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Exam Portal - Physics Test</title>
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
            Aptitude:  generateAptitudeQuestions()
        };

        let currentSubject = "Aptitude";
        let questions = subjects[currentSubject];
        let currentQuestion = 0;
        let selectedAnswers = Array(questions.length).fill(null);
        let skippedQuestions = new Set();


            function generateAptitudeQuestions() {
        return [
            { q: "What is 25% of 200?", options: ["25", "50", "75", "100"], correct: 1 },
            { q: "If 5x = 20, then x = ?", options: ["2", "4", "5", "6"], correct: 1 },
            { q: "What is the square root of 144?", options: ["10", "11", "12", "13"], correct: 2 },
            { q: "Simplify: (2 + 3) × 4", options: ["20", "14", "24", "10"], correct: 0 },
            { q: "What comes next in the series: 2, 4, 8, 16, ?", options: ["18", "24", "32", "30"], correct: 2 },
            { q: "A train travels 100 km in 2 hours. Its speed is?", options: ["25 km/h", "40 km/h", "50 km/h", "60 km/h"], correct: 2 },
            { q: "Which number is an even prime?", options: ["1", "2", "3", "5"], correct: 1 },
            { q: "Find the missing number: 3, 6, 9, ?, 15", options: ["10", "11", "12", "13"], correct: 2 },
            { q: "If x + 3 = 7, then x = ?", options: ["2", "3", "4", "5"], correct: 2 },
            { q: "What is the average of 10, 20, 30?", options: ["15", "20", "25", "30"], correct: 1 },
            { q: "15% of 300 is?", options: ["30", "45", "60", "75"], correct: 1 },
            { q: "Solve: 5² + 3²", options: ["34", "25", "16", "28"], correct: 0 },
            { q: "What is 1/4 of 100?", options: ["20", "25", "30", "40"], correct: 1 },
            { q: "How many minutes in 2 hours?", options: ["100", "120", "150", "180"], correct: 1 },
            { q: "What is the next prime number after 7?", options: ["9", "10", "11", "13"], correct: 2 },
            { q: "What is the perimeter of a square with side 5 cm?", options: ["10", "15", "20", "25"], correct: 2 },
            { q: "A triangle has angles 50° and 60°. The third angle is?", options: ["60°", "70°", "80°", "90°"], correct: 1 },
            { q: "If 3 pencils cost ₹15, what is the cost of 5 pencils?", options: ["₹20", "₹25", "₹30", "₹35"], correct: 1 },
            { q: "What is 5% of 200?", options: ["5", "10", "15", "20"], correct: 1 },
            { q: "The next number in the pattern 2, 5, 10, 17 is?", options: ["26", "24", "23", "22"], correct: 2 },
            { q: "If A = 1, B = 2, ..., Z = 26, what is the value of C + D?", options: ["6", "7", "8", "9"], correct: 3 },
            { q: "How many seconds in 3 minutes?", options: ["180", "200", "300", "360"], correct: 0 },
            { q: "Which shape has 4 equal sides and 4 right angles?", options: ["Rectangle", "Rhombus", "Square", "Trapezium"], correct: 2 },
            { q: "What is the LCM of 4 and 5?", options: ["10", "15", "20", "25"], correct: 2 },
            { q: "If 8x = 64, then x = ?", options: ["6", "7", "8", "9"], correct: 2 },
            { q: "Half of 180 is?", options: ["80", "85", "90", "100"], correct: 2 },
            { q: "Which is the smallest two-digit prime number?", options: ["10", "11", "12", "13"], correct: 1 },
            { q: "Area of a rectangle is 20 sq units. If length is 5, breadth is?", options: ["2", "3", "4", "5"], correct: 0 },
            { q: "If x = 2, then x² + 2x = ?", options: ["6", "8", "10", "12"], correct: 1 },
            { q: "Convert 0.75 into percentage.", options: ["25%", "50%", "75%", "100%"], correct: 2 }
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