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
            Physics: generatePhysicsQuestions()
        };

        let currentSubject = "Physics";
        let questions = subjects[currentSubject];
        let currentQuestion = 0;
        let selectedAnswers = Array(questions.length).fill(null);
        let skippedQuestions = new Set();

        function generatePhysicsQuestions() {
            return [
                { q: "What is the SI unit of force?", options: ["Newton", "Joule", "Watt", "Pascal"], correct: 0 },
                { q: "What is the acceleration due to gravity on Earth?", options: ["9.8 m/s^2", "10 m/s^2", "8.9 m/s^2", "9.2 m/s^2"], correct: 0 },
                { q: "Who discovered the law of universal gravitation?", options: ["Einstein", "Newton", "Galileo", "Tesla"], correct: 1 },
                { q: "Which of the following is a vector quantity?", options: ["Speed", "Mass", "Velocity", "Energy"], correct: 2 },
                { q: "What is the speed of light in vacuum?", options: ["3x10^8 m/s", "3x10^6 m/s", "3x10^5 m/s", "3x10^7 m/s"], correct: 0 },
                { q: "What type of lens is used to correct myopia?", options: ["Convex", "Concave", "Plano", "Bifocal"], correct: 1 },
                { q: "What is Ohm’s Law?", options: ["V=IR", "P=IV", "E=mc^2", "F=ma"], correct: 0 },
                { q: "What does a voltmeter measure?", options: ["Resistance", "Current", "Voltage", "Power"], correct: 2 },
                { q: "What is the unit of electric current?", options: ["Ampere", "Volt", "Ohm", "Watt"], correct: 0 },
                { q: "Which particle has a negative charge?", options: ["Proton", "Neutron", "Electron", "Photon"], correct: 2 },
                { q: "Which wave does not require a medium to travel?", options: ["Sound", "Water", "Light", "Seismic"], correct: 2 },
                { q: "What is kinetic energy?", options: ["Energy stored", "Energy in motion", "Heat energy", "Energy of bonds"], correct: 1 },
                { q: "The unit of frequency is?", options: ["Hertz", "Joule", "Newton", "Tesla"], correct: 0 },
                { q: "What is the power of a lens with a focal length of 0.5 m?", options: ["+2 D", "-2 D", "+0.5 D", "-0.5 D"], correct: 0 },
                { q: "Which law states that current is directly proportional to voltage?", options: ["Ohm’s Law", "Faraday’s Law", "Kirchhoff’s Law", "Newton’s Law"], correct: 0 },
                { q: "Which color of light has the shortest wavelength?", options: ["Red", "Green", "Violet", "Blue"], correct: 2 },
                { q: "Which phenomenon explains the blue color of the sky?", options: ["Reflection", "Diffraction", "Scattering", "Refraction"], correct: 2 },
                { q: "What is the resistance of a conductor if V=10V and I=2A?", options: ["5 Ohm", "20 Ohm", "10 Ohm", "2 Ohm"], correct: 0 },
                { q: "What is the unit of work?", options: ["Watt", "Joule", "Newton", "Pascal"], correct: 1 },
                { q: "Which of the following is a renewable energy source?", options: ["Coal", "Petrol", "Solar", "Diesel"], correct: 2 },
                { q: "What is latent heat?", options: ["Heat during motion", "Heat during phase change", "Heat of expansion", "None"], correct: 1 },
                { q: "Which law relates pressure and volume of gas?", options: ["Boyle’s Law", "Ohm’s Law", "Hooke’s Law", "Newton’s Law"], correct: 0 },
                { q: "Sound waves are: ", options: ["Transverse", "Longitudinal", "Electromagnetic", "None"], correct: 1 },
                { q: "What is measured in Tesla?", options: ["Electric Field", "Resistance", "Magnetic Field", "Current"], correct: 2 },
                { q: "Which device converts sound to electric signals?", options: ["Speaker", "Transistor", "Microphone", "Amplifier"], correct: 2 },
                { q: "What is the center of mass?", options: ["Topmost point", "Geometric center", "Balancing point", "None"], correct: 2 },
                { q: "What is the energy stored in a spring called?", options: ["Elastic", "Thermal", "Kinetic", "Potential"], correct: 0 },
                { q: "What is the boiling point of water?", options: ["100°C", "90°C", "80°C", "120°C"], correct: 0 },
                { q: "Which unit is used for measuring heat?", options: ["Joule", "Kelvin", "Ampere", "Pascal"], correct: 0 },
                { q: "Which property of light causes a rainbow?", options: ["Reflection", "Refraction", "Dispersion", "Absorption"], correct: 2 }
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