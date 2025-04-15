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
        { q: "If (x - 3)(x + 4) = 0, then x is?", options: ["3 and -4", "-3 and 4", "3 and 4", "-3 and -4"], correct: 0 },
        { q: "A train 150 m long crosses a pole in 15 seconds. Its speed is?", options: ["10 m/s", "15 m/s", "12 m/s", "18 m/s"], correct: 2 },
        { q: "The HCF of 60 and 72 is?", options: ["6", "12", "18", "24"], correct: 1 },
        { q: "If x² + 2x = 35, what is the value of x?", options: ["5 or -7", "5 or -5", "3 or -3", "7 or -5"], correct: 3 },
        { q: "What is the compound interest on ₹1000 at 10% per annum for 2 years?", options: ["₹210", "₹200", "₹220", "₹210.50"], correct: 3 },
        { q: "A can do a job in 12 days, B in 15 days. In how many days can they do it together?", options: ["6.6", "6.85", "6.67", "7"], correct: 2 },
        { q: "The average of 5, 8, 12, 15, and 20 is?", options: ["10", "12", "13", "14"], correct: 1 },
        { q: "What is the value of (a + b)² - (a - b)²?", options: ["4ab", "2ab", "a² + b²", "ab²"], correct: 0 },
        { q: "A person spends 80% of his income. If his income is ₹25000, what is his saving?", options: ["₹4000", "₹4500", "₹5000", "₹5500"], correct: 2 },
        { q: "A car travels 240 km in 4 hours. What is its speed?", options: ["50 km/h", "55 km/h", "60 km/h", "65 km/h"], correct: 2 },
        { q: "The simple interest on ₹5000 for 3 years at 5% is?", options: ["₹750", "₹700", "₹600", "₹800"], correct: 0 },
        { q: "Find the next number: 7, 14, 28, 56, ?", options: ["112", "98", "84", "126"], correct: 0 },
        { q: "If sinθ = 0.6, what is cosθ?", options: ["0.6", "0.8", "0.4", "1.0"], correct: 1 },
        { q: "A sum triples in 6 years at simple interest. What is the rate of interest?", options: ["25%", "33.33%", "30%", "35%"], correct: 1 },
        { q: "What is the least number which when divided by 6, 8, 9 gives a remainder 1?", options: ["145", "145", "145", "145"], correct: 0 },
        { q: "What is the value of 999 × 999?", options: ["998001", "999000", "999999", "998100"], correct: 0 },
        { q: "If a:b = 2:3 and b:c = 4:5, find a:c?", options: ["8:15", "2:5", "4:5", "6:5"], correct: 0 },
        { q: "Find the area of a triangle with base 10 cm and height 8 cm.", options: ["40 cm²", "50 cm²", "60 cm²", "70 cm²"], correct: 0 },
        { q: "If x + 1/x = 5, find x² + 1/x².", options: ["25", "23", "21", "27"], correct: 1 },
        { q: "Selling price of an article is ₹600 and profit is 20%. What is the cost price?", options: ["₹500", "₹480", "₹520", "₹550"], correct: 0 },
        { q: "The angle between the hands of a clock at 3:30 is?", options: ["60°", "75°", "90°", "105°"], correct: 1 },
        { q: "If A is 3 years older than B and their sum is 21, what is A’s age?", options: ["12", "10", "9", "11"], correct: 0 },
        { q: "A cylinder has radius 3 cm and height 7 cm. Find its volume.", options: ["198 cm³", "220 cm³", "200 cm³", "240 cm³"], correct: 0 }, // πr²h = 3.14×9×7 ≈ 198
        { q: "A man can row 12 km/h in still water. If the stream is 3 km/h, what is his speed downstream?", options: ["9 km/h", "12 km/h", "15 km/h", "18 km/h"], correct: 2 },
        { q: "In how many ways can the letters of the word 'MATH' be arranged?", options: ["12", "16", "24", "20"], correct: 2 },
        { q: "The value of (4x³y) × (3xy²) is?", options: ["12x⁴y³", "7x²y³", "12x²y²", "12x⁴y²"], correct: 0 },
        { q: "If a man walks 3 km in 30 minutes, what is his speed in km/h?", options: ["3", "4", "5", "6"], correct: 3 },
        { q: "What is the next term in the sequence: 1, 4, 9, 16, ?", options: ["20", "25", "30", "36"], correct: 1 },
        { q: "A shopkeeper marks a shirt at ₹800 and allows a discount of 20%. Selling price is?", options: ["₹640", "₹680", "₹700", "₹750"], correct: 0 },
        { q: "If 2x + 3 = 15, then x = ?", options: ["5", "6", "7", "8"], correct: 0 }
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