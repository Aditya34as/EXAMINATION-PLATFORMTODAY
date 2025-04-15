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
            Biology:  generateBiologyQuestions()
        };

        let currentSubject = "Biology";
        let questions = subjects[currentSubject];
        let currentQuestion = 0;
        let selectedAnswers = Array(questions.length).fill(null);
        let skippedQuestions = new Set();
        function generateBiologyQuestions() {
    return [
        { q: "What is the function of the Golgi apparatus?", options: ["Protein synthesis", "Detoxification", "Packaging and transport of proteins", "ATP production"], correct: 2 },
        { q: "Which hormone regulates the circadian rhythm in humans?", options: ["Insulin", "Melatonin", "Adrenaline", "Thyroxine"], correct: 1 },
        { q: "What is the end product of glycolysis?", options: ["Lactic acid", "Pyruvate", "Acetyl-CoA", "Glucose"], correct: 1 },
        { q: "Which stage of mitosis involves alignment of chromosomes at the equator?", options: ["Prophase", "Metaphase", "Anaphase", "Telophase"], correct: 1 },
        { q: "Which process is responsible for the formation of gametes?", options: ["Mitosis", "Meiosis", "Binary fission", "Budding"], correct: 1 },
        { q: "Which plant hormone is responsible for cell elongation?", options: ["Auxin", "Cytokinin", "Gibberellin", "Ethylene"], correct: 0 },
        { q: "What is the primary role of xylem in plants?", options: ["Transport of food", "Transport of water and minerals", "Photosynthesis", "Reproduction"], correct: 1 },
        { q: "Which enzyme unwinds DNA during replication?", options: ["Ligase", "Helicase", "Polymerase", "Topoisomerase"], correct: 1 },
        { q: "Which part of the nephron is responsible for filtration?", options: ["Loop of Henle", "Collecting duct", "Bowman’s capsule", "Proximal tubule"], correct: 2 },
        { q: "Which cells in the pancreas produce insulin?", options: ["Alpha cells", "Beta cells", "Delta cells", "Acinar cells"], correct: 1 },
        { q: "What is the chromosome number in human gametes?", options: ["23", "46", "22", "44"], correct: 0 },
        { q: "Which gland is known as the master gland?", options: ["Adrenal", "Thyroid", "Pituitary", "Pineal"], correct: 2 },
        { q: "Which process converts nitrogen gas into ammonia?", options: ["Denitrification", "Ammonification", "Nitrogen fixation", "Nitrification"], correct: 2 },
        { q: "Which blood vessels carry blood away from the heart?", options: ["Veins", "Arteries", "Capillaries", "Venules"], correct: 1 },
        { q: "Which type of immunity is provided by vaccines?", options: ["Passive natural", "Active artificial", "Passive artificial", "Active natural"], correct: 1 },
        { q: "What is the genetic makeup of an individual called?", options: ["Phenotype", "Genotype", "Karyotype", "Allele"], correct: 1 },
        { q: "Which vitamin deficiency causes night blindness?", options: ["Vitamin A", "Vitamin C", "Vitamin D", "Vitamin K"], correct: 0 },
        { q: "Which blood component transports oxygen?", options: ["Plasma", "White blood cells", "Platelets", "Red blood cells"], correct: 3 },
        { q: "Which structure in the eye focuses light onto the retina?", options: ["Cornea", "Lens", "Iris", "Pupil"], correct: 1 },
        { q: "Which macromolecule is made up of amino acids?", options: ["Carbohydrates", "Lipids", "Proteins", "Nucleic acids"], correct: 2 },
        { q: "Which kingdom does a multicellular autotrophic organism with cell walls belong to?", options: ["Fungi", "Plantae", "Protista", "Monera"], correct: 1 },
        { q: "What is transpiration?", options: ["Water intake", "Water transport", "Water loss from leaves", "Water storage"], correct: 2 },
        { q: "Which organelle is involved in protein synthesis?", options: ["Nucleus", "Ribosome", "Lysosome", "Mitochondria"], correct: 1 },
        { q: "What causes Down syndrome?", options: ["Deletion mutation", "Trisomy 21", "Monosomy X", "Triploidy"], correct: 1 },
        { q: "What is the function of stomata?", options: ["Absorption of nutrients", "Transport of water", "Gas exchange", "Photosynthesis"], correct: 2 },
        { q: "Which gas is the major component of biogas?", options: ["Carbon dioxide", "Methane", "Hydrogen", "Oxygen"], correct: 1 },
        { q: "Which part of the brain regulates heartbeat and breathing?", options: ["Cerebrum", "Medulla oblongata", "Cerebellum", "Pons"], correct: 1 },
        { q: "Which part of the flower develops into fruit?", options: ["Petal", "Ovary", "Ovule", "Anther"], correct: 1 },
        { q: "Which disease is caused by the HIV virus?", options: ["Hepatitis", "Tuberculosis", "AIDS", "Polio"], correct: 2 },
        { q: "Which mineral is essential for the formation of hemoglobin?", options: ["Calcium", "Potassium", "Iron", "Zinc"], correct: 2 }
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