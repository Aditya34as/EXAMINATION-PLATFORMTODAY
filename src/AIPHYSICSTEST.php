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
            <h2 class="text-lg md:text-xl justify-center mx-auto font-semibold">JEE_MAINS_2025</h2>
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
            Physics: generatePhysicsQuestions()
        };

        let currentSubject = "Physics";
        let questions = subjects[currentSubject];
        let currentQuestion = 0;
        let selectedAnswers = Array(questions.length).fill(null);
        let skippedQuestions = new Set();

        function generatePhysicsQuestions() {
    return [
        { q: "What is the dimensional formula of force?", options: ["[MLT^-2]", "[ML^2T^-2]", "[MLT^-1]", "[ML^-1T^-2]"], correct: 0 },
        { q: "Which of the following is a non-conservative force?", options: ["Gravitational force", "Electrostatic force", "Friction", "Spring force"], correct: 2 },
        { q: "Which law governs the motion of planets around the Sun?", options: ["Newton's First Law", "Kepler's Laws", "Coulomb's Law", "Gauss's Law"], correct: 1 },
        { q: "Work done in a closed path in a conservative field is:", options: ["Maximum", "Zero", "Minimum", "Constant"], correct: 1 },
        { q: "The moment of inertia of a solid sphere about its diameter is:", options: ["(2/5)MR²", "(1/2)MR²", "(3/5)MR²", "(2/3)MR²"], correct: 0 },
        { q: "What is the escape velocity from Earth's surface?", options: ["11.2 km/s", "9.8 km/s", "7.9 km/s", "5.6 km/s"], correct: 0 },
        { q: "Which law gives the relationship between pressure and volume at constant temperature?", options: ["Boyle's Law", "Charles's Law", "Avogadro's Law", "Dalton's Law"], correct: 0 },
        { q: "In SHM, when is the kinetic energy maximum?", options: ["At mean position", "At extreme position", "Always constant", "Zero at mean"], correct: 0 },
        { q: "What is the principle of superposition?", options: ["Force addition", "Field overlap", "Wave addition", "Motion composition"], correct: 2 },
        { q: "Which of the following quantities is conserved in an elastic collision?", options: ["Momentum only", "Kinetic energy only", "Both momentum and kinetic energy", "Force"], correct: 2 },
        { q: "What is the relation between pressure and temperature in an ideal gas at constant volume?", options: ["P ∝ T", "P ∝ 1/T", "P ∝ T²", "P = constant"], correct: 0 },
        { q: "What is the unit of coefficient of viscosity?", options: ["N·s/m²", "kg/m³", "Pa·s", "Both A and C"], correct: 3 },
        { q: "What is the ratio of specific heats (γ) for a monoatomic gas?", options: ["1.33", "1.67", "1.5", "1.0"], correct: 1 },
        { q: "What is the direction of heat flow?", options: ["Cold to hot", "Hot to cold", "Depends on material", "No direction"], correct: 1 },
        { q: "Which law is used to derive the speed of sound in gases?", options: ["Newton's Law", "Boyle’s Law", "Laplace’s Law", "Bernoulli’s Law"], correct: 2 },
        { q: "In optics, which phenomenon explains the formation of mirages?", options: ["Reflection", "Refraction", "Total internal reflection", "Diffraction"], correct: 2 },
        { q: "What is the focal length of a mirror with radius of curvature 40 cm?", options: ["40 cm", "80 cm", "20 cm", "10 cm"], correct: 2 },
        { q: "Lens formula is:", options: ["1/f = 1/v + 1/u", "1/f = v + u", "f = v – u", "f = vu"], correct: 0 },
        { q: "In Young's double slit experiment, what causes bright fringes?", options: ["Destructive interference", "Refraction", "Constructive interference", "Diffraction"], correct: 2 },
        { q: "The drift velocity of electrons in a conductor is:", options: ["Very high", "Equal to speed of light", "Very low", "Zero"], correct: 2 },
        { q: "What is the SI unit of resistivity?", options: ["Ohm-meter", "Ohm", "Ohm/cm", "Siemens"], correct: 0 },
        { q: "The total resistance in parallel combination is:", options: ["More than largest", "Equal to average", "Less than smallest", "Equal to sum"], correct: 2 },
        { q: "Kirchhoff’s Second Law is based on:", options: ["Conservation of charge", "Conservation of energy", "Conservation of mass", "Newton's Law"], correct: 1 },
        { q: "Which device stores energy in a magnetic field?", options: ["Capacitor", "Resistor", "Inductor", "Transformer"], correct: 2 },
        { q: "A transformer works on which principle?", options: ["Electrostatics", "Mutual induction", "Self induction", "Lorentz force"], correct: 1 },
        { q: "The magnetic field inside a long straight solenoid is:", options: ["Non-uniform", "Zero", "Uniform", "Depends on air"], correct: 2 },
        { q: "Which rule gives the direction of induced current?", options: ["Right-hand rule", "Left-hand rule", "Lenz’s Law", "Kirchhoff's Law"], correct: 2 },
        { q: "Photoelectric effect proves:", options: ["Wave nature of light", "Particle nature of light", "Heat property of light", "Mass of light"], correct: 1 },
        { q: "What is the rest mass of a photon?", options: ["0", "1", "9.1 x 10^-31 kg", "Infinite"], correct: 0 },
        { q: "Which particle is responsible for nuclear force?", options: ["Proton", "Neutron", "Electron", "Meson"], correct: 3 }
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