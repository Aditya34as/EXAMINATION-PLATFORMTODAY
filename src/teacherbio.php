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
        { q: "What is the basic unit of life?", options: ["Tissue", "Organ", "Cell", "Organism"], correct: 2 },
        { q: "What is the powerhouse of the cell?", options: ["Nucleus", "Ribosome", "Mitochondria", "Chloroplast"], correct: 2 },
        { q: "Which organ pumps blood throughout the body?", options: ["Lungs", "Liver", "Heart", "Kidneys"], correct: 2 },
        { q: "Which gas is absorbed by plants during photosynthesis?", options: ["Oxygen", "Nitrogen", "Carbon Dioxide", "Hydrogen"], correct: 2 },
        { q: "Which vitamin is produced when skin is exposed to sunlight?", options: ["Vitamin A", "Vitamin B", "Vitamin D", "Vitamin K"], correct: 2 },
        { q: "Which part of the plant conducts photosynthesis?", options: ["Root", "Stem", "Leaf", "Flower"], correct: 2 },
        { q: "Which blood cells help in clotting?", options: ["Red blood cells", "White blood cells", "Platelets", "Plasma"], correct: 2 },
        { q: "What is the function of the lungs?", options: ["Pump blood", "Digest food", "Exchange gases", "Filter waste"], correct: 2 },
        { q: "Which organ is responsible for filtering blood?", options: ["Heart", "Lungs", "Kidney", "Liver"], correct: 2 },
        { q: "Which of the following is a hereditary material?", options: ["DNA", "RNA", "Protein", "Chlorophyll"], correct: 0 },
        { q: "How many chambers does a human heart have?", options: ["2", "3", "4", "5"], correct: 2 },
        { q: "What type of blood cells fight infections?", options: ["RBCs", "WBCs", "Platelets", "Plasma"], correct: 1 },
        { q: "Which organ secretes insulin?", options: ["Liver", "Pancreas", "Kidney", "Spleen"], correct: 1 },
        { q: "What is the largest organ in the human body?", options: ["Liver", "Brain", "Skin", "Heart"], correct: 2 },
        { q: "What is the green pigment in plants called?", options: ["Chlorophyll", "Carotene", "Melanin", "Xanthophyll"], correct: 0 },
        { q: "Which part of the brain controls balance?", options: ["Cerebrum", "Cerebellum", "Medulla", "Thalamus"], correct: 1 },
        { q: "What is the normal human body temperature?", options: ["96.8°F", "98.6°F", "99.9°F", "97.0°F"], correct: 1 },
        { q: "Which system controls body activities using hormones?", options: ["Nervous system", "Endocrine system", "Digestive system", "Respiratory system"], correct: 1 },
        { q: "How many bones are in the adult human body?", options: ["206", "210", "208", "200"], correct: 0 },
        { q: "Which part of the plant absorbs water?", options: ["Leaves", "Stem", "Roots", "Flowers"], correct: 2 },
        { q: "What is the function of red blood cells?", options: ["Fight infection", "Clot blood", "Carry oxygen", "Digest fats"], correct: 2 },
        { q: "Which part of the eye controls the amount of light entering?", options: ["Cornea", "Lens", "Iris", "Retina"], correct: 2 },
        { q: "Which organism causes malaria?", options: ["Virus", "Bacteria", "Fungus", "Protozoa"], correct: 3 },
        { q: "Which vitamin helps in blood clotting?", options: ["Vitamin A", "Vitamin B", "Vitamin C", "Vitamin K"], correct: 3 },
        { q: "Which blood group is universal donor?", options: ["A", "B", "AB", "O"], correct: 3 },
        { q: "What causes rusting of iron in biology terms?", options: ["Photosynthesis", "Oxidation", "Fermentation", "Hydrolysis"], correct: 1 },
        { q: "Which organ helps in detoxification?", options: ["Kidney", "Liver", "Heart", "Pancreas"], correct: 1 },
        { q: "Which animal is cold-blooded?", options: ["Tiger", "Frog", "Elephant", "Dog"], correct: 1 },
        { q: "What is the study of fungi called?", options: ["Virology", "Mycology", "Bacteriology", "Zoology"], correct: 1 },
        { q: "Which structure connects muscles to bones?", options: ["Ligaments", "Tendons", "Cartilage", "Nerves"], correct: 1 }
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