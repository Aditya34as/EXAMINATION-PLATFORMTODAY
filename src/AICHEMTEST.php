<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Exam Portal - Chemistry Test</title>
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
            Chemistry: generateChemistryQuestions()
        };

        let currentSubject = "Chemistry";
        let questions = subjects[currentSubject];
        let currentQuestion = 0;
        let selectedAnswers = Array(questions.length).fill(null);
        let skippedQuestions = new Set();

        function generateChemistryQuestions() {
            return [
                { q: "What is the chemical symbol for water?", options: ["HO", "H2O", "OH2", "WO"], correct: 1 },
                { q: "Which gas is known as laughing gas?", options: ["CO2", "O2", "N2O", "NO2"], correct: 2 },
                { q: "What is the pH of pure water?", options: ["5", "6", "7", "8"], correct: 2 },
                { q: "Which element is found in all organic compounds?", options: ["Oxygen", "Hydrogen", "Carbon", "Nitrogen"], correct: 2 },
                { q: "What is the atomic number of oxygen?", options: ["6", "8", "10", "12"], correct: 1 },
                { q: "Which acid is found in vinegar?", options: ["Citric acid", "Sulfuric acid", "Acetic acid", "Hydrochloric acid"], correct: 2 },
                { q: "NaCl is the formula for which compound?", options: ["Baking soda", "Common salt", "Bleaching powder", "Lime water"], correct: 1 },
                { q: "Which metal is liquid at room temperature?", options: ["Mercury", "Iron", "Copper", "Zinc"], correct: 0 },
                { q: "What is the lightest element?", options: ["Oxygen", "Hydrogen", "Helium", "Nitrogen"], correct: 1 },
                { q: "Which gas is produced by plants during photosynthesis?", options: ["Carbon Dioxide", "Oxygen", "Nitrogen", "Hydrogen"], correct: 1 },
                { q: "What is the chemical symbol for Gold?", options: ["Gd", "Ag", "Go", "Au"], correct: 3 },
                { q: "Which of the following is a noble gas?", options: ["Oxygen", "Helium", "Hydrogen", "Nitrogen"], correct: 1 },
                { q: "What is the chemical formula for ammonia?", options: ["NH3", "NO2", "N2H4", "N2O"], correct: 0 },
                { q: "Which acid is used in car batteries?", options: ["Hydrochloric acid", "Acetic acid", "Sulfuric acid", "Nitric acid"], correct: 2 },
                { q: "What is the molar mass of water?", options: ["16 g/mol", "18 g/mol", "20 g/mol", "10 g/mol"], correct: 1 },
                { q: "Which of the following is an alkali metal?", options: ["Iron", "Potassium", "Calcium", "Zinc"], correct: 1 },
                { q: "Which element is represented by the symbol 'Fe'?", options: ["Fluorine", "Lead", "Iron", "Francium"], correct: 2 },
                { q: "What is formed when acid reacts with a base?", options: ["Salt and water", "Acid and metal", "Salt and gas", "Metal oxide"], correct: 0 },
                { q: "Which indicator turns red in acid?", options: ["Phenolphthalein", "Litmus", "Methyl orange", "Turmeric"], correct: 1 },
                { q: "Which compound is used in baking powder?", options: ["Sodium chloride", "Sodium bicarbonate", "Calcium carbonate", "Potassium nitrate"], correct: 1 },
                { q: "Which of the following is an allotrope of carbon?", options: ["Quartz", "Graphite", "Sodium", "Iron"], correct: 1 },
                { q: "What is the common name of calcium carbonate?", options: ["Bleach", "Lime", "Limestone", "Baking soda"], correct: 2 },
                { q: "What is the main component of natural gas?", options: ["Methane", "Butane", "Propane", "Ethane"], correct: 0 },
                { q: "Which metal is most reactive?", options: ["Gold", "Silver", "Sodium", "Copper"], correct: 2 },
                { q: "Which element has the highest electronegativity?", options: ["Oxygen", "Fluorine", "Chlorine", "Nitrogen"], correct: 1 },
                { q: "Which of the following is not a greenhouse gas?", options: ["Carbon dioxide", "Methane", "Nitrogen", "Water vapor"], correct: 2 },
                { q: "Which part of an atom has no charge?", options: ["Electron", "Neutron", "Proton", "Nucleus"], correct: 1 },
                { q: "Which acid is found in lemon?", options: ["Oxalic acid", "Acetic acid", "Citric acid", "Tartaric acid"], correct: 2 },
                { q: "Which process converts liquid to gas?", options: ["Condensation", "Freezing", "Evaporation", "Melting"], correct: 2 },
                { q: "What is the state of matter of plasma?", options: ["Solid", "Liquid", "Gas", "Ionized gas"], correct: 3 }
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

        // function loadSubject(subject) {
        //     currentSubject = subject;
        //     questions = subjects[subject];
        //     selectedAnswers = Array(questions.length).fill(null);
        //     currentQuestion = 0;
        //     loadQuestion();
        //     updatePalette();
        // }

        // loadSubject(currentSubject);
        startTimer(600);
    </script>
</body>

</html>
