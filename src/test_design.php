<?php
session_start();
include "connection.php";

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
} else {
    mysqli_set_charset($conn, "utf8mb4");
}

$user = null;

if (!empty($_SESSION['enrollment_id']) || !empty($_SESSION['email'])) {
    if (!empty($_SESSION['enrollment_id'])) {
        $query = "SELECT fname, email FROM users WHERE enrollment_id = ?";
        $param = $_SESSION['enrollment_id'];
    } else {
        $query = "SELECT fname, email FROM users WHERE email = ?";
        $param = $_SESSION['email'];
    }

    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die("Query preparation failed: " . $conn->error);
    }

    $stmt->bind_param("s", $param);

    if (!$stmt->execute()) {
        die("Query execution failed: " . $stmt->error);
    }

    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "<script>alert('No user found for given session data.');</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('User session not set.');</script>";
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Test Creation</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="Logo.png" type="image/png">
</head>
<body class="bg-gray-100 text-gray-800">
        <!-- Navbar -->
        <nav
        class="flex justify-between h-18 bg-white p-4 text-black shadow-lg text-center text-lg font-semibold fixed w-full">
        <div class="flex items-center">
            <img class="rounded-full size-10" src="Logo.png" alt="Logo">
            <h1 class="pl-2">XamXpress</h1>
        </div>
        <ul class="flex justify-center items-center space-x-10">
            <li><a href="Tdashboard.php">Home</a></li>
            <li><a href="test_design.php">Test Design</a></li>
           
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <div class="relative flex items-center text-center">
            <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
                data-dropdown-placement="bottom-start" class="w-10 h-10 rounded-full cursor-pointer mr-2" src="user-avtar-modified.png"
                alt="User dropdown">
            <p id="userName" name="name"><?php echo isset($user) ? htmlspecialchars($user['fname'], ENT_QUOTES, 'UTF-8') : 'Guest'; ?></p>
            <div id="userDropdown"
                class="z-10 hidden absolute mr-10 right-0 bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600" style="margin-top: 220px;">
                <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                    <div id="userEmail" class="font-medium truncate" name="email">
                        <?php echo isset($user) ? htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') : 'Not logged in'; ?>
                    </div>
                </div>
                <div class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                    <a href="profile.php"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                </div>
                <div class="py-1 flex justify-center items-center">
                    <a href="login.php"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Logout</a>
                    <img src="logout.png" alt="logout" class="w-6 h-6 ml-2">
                </div>
            </div>
        </div>

        <script>
            document.getElementById('avatarButton').addEventListener('click', function (event) {
            event.stopPropagation();
            var dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function (event) {
            var dropdown = document.getElementById('userDropdown');
            if (!dropdown.classList.contains('hidden')) {
            dropdown.classList.add('hidden');
            }
        });
            home = () => {
            window.location.href = "index.html";
            }
            contact = () => {
            window.location.href = "contact.html";
            }
        </script>
        </nav>
        <div class="h-20"></div> <!-- Added gap between navbar and other content -->


  <div class="max-w-7xl mx-auto p-6 space-y-12">
    <!-- Section 1: Test Details -->
    <section class="bg-white p-6 rounded-lg shadow space-y-4 ">
      <h2 class="text-2xl font-bold">1. Test Details</h2>
      <input id="testTitle" type="text" placeholder="Test Title" class="w-full p-2 border rounded">
      <textarea id="testDescription" placeholder="Description" class="w-full p-2 border rounded"></textarea>
      <div class="grid grid-cols-2 gap-4">
        <input id="totalMarks" type="number" placeholder="Total Marks" class="w-full p-2 border rounded">
        <input id="testDuration" type="number" placeholder="Duration (in minutes)" class="w-full p-2 border rounded">
      </div>
      <input id="testDateTime" type="datetime-local" class="w-full p-2 border rounded">
    <div class="flex gap-6 pt-2">
        <label class="flex items-center gap-2">
            <span class="text-gray-700">Enable Negative Marking</span>
            <div class="relative inline-block w-10 h-5">
                <input type="checkbox" id="negativeMarkingToggle" class="sr-only peer">
                <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-blue-600 transition-colors duration-300"></div>
                <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full transform peer-checked:translate-x-5 transition-transform duration-300"></div>
            </div>
        </label>
        <label class="flex items-center gap-2">
            <span>Randomize Questions</span>
            <div class="relative">
                <input type="checkbox" id="randomizeToggle" class="sr-only peer">
                <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-blue-600 transition-colors duration-300"></div>
                <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full transform peer-checked:translate-x-5 transition-transform duration-300"></div>
            </div>
        </label>
    </div>
    </section>

    <!-- Section 2: Add Questions -->
    <section class="bg-white p-6 rounded-lg shadow space-y-4">
      <h2 class="text-2xl font-bold">2. Add Questions</h2>
      <select id="questionType" class="w-full p-2 border rounded">
        <option value="single">MCQ (Single Correct)</option>
        <option value="multiple">MCQ (Multiple Correct)</option>
        <option value="truefalse">True/False</option>
        <option value="short">Short Answer</option>
      </select>
      <textarea id="questionText" placeholder="Enter Question Text" class="w-full p-2 border rounded"></textarea>
      
      <div id="mcqOptions" class="space-y-2 hidden">
        <input type="text" placeholder="Option 1" class="w-full p-2 border rounded">
        <input type="text" placeholder="Option 2" class="w-full p-2 border rounded">
        <button onclick="addOption()" class="bg-blue-600 text-white px-4 py-1 rounded">+ Add Option</button>
      </div>

      <input id="correctAnswer" type="text" placeholder="Correct Answer(s)" class="w-full p-2 border rounded">
      <input id="marks" type="number" placeholder="Marks for Correct Answer" class="w-full p-2 border rounded">
      <input id="negativeMarks" type="number" placeholder="Negative Marks (if any)" class="w-full p-2 border rounded">
      <input id="fileUpload" type="file" class="w-full">
    <button class="bg-green-600 text-white px-4 py-2 rounded" onclick="addQuestion()">Add Question</button>

    <div class="pt-4">
        <label class="block font-medium mb-1">Import Questions(Image)</label>
        <input type="file" id="importQuestions" accept=".csv,.xlsx" class="w-full p-2 border rounded">
    </div>
</section>


    <!-- Section 3: Assign to Students -->
    <section class="bg-white p-6 rounded-lg shadow space-y-4">
      <h2 class="text-2xl font-bold">3. Assign to Students</h2>
      <select id="classBatchSelect" class="w-full p-2 border rounded" onchange="updateStudentDropdown()">
        <option value="">Select Class or Batch</option>
        <option value="class11">Class 11th batch</option>
        <option value="class12">Class 12th batch</option>
        <option value="drop1">Drop(1) batch</option>
        <option value="drop2">Drop(2) batch</option>
      </select>
      <select id="studentSelect" class="w-full p-2 border rounded mt-4">
        <option value="">Select Student</option>
      </select>
      <div class="mt-4">
        <label class="block font-medium mb-2">Save Test For:</label>
        <div class="flex items-center gap-4">
          <label class="flex items-center">
        <input type="checkbox" id="saveForBatch" class="mr-2">
        <span>Entire Class/Batch</span>
          </label>
          <label class="flex items-center">
        <input type="checkbox" id="saveForStudents" class="mr-2">
        <span>Selected Students</span>
          </label>
        </div>
        <p id="checkboxError" class="text-red-500 text-sm hidden">Please select at least one option.</p>
        <script>
          function validateBeforeAction(action) {
            if (!validateSaveOptions()) {
              alert("Please select at least one option before proceeding.");
              return;
            }
            action();
          }

          document.querySelector("button[onclick='previewTest()']").setAttribute("onclick", "validateBeforeAction(previewTest)");
          document.querySelector("button[onclick='publishTest()']").setAttribute("onclick", "validateBeforeAction(publishTest)");
          document.querySelector("button[onclick='saveAsDraft()']").setAttribute("onclick", "validateBeforeAction(saveAsDraft)");
        </script>
      </div>
      <script>
        function validateSaveOptions() {
          const saveForBatch = document.getElementById("saveForBatch").checked;
          const saveForStudents = document.getElementById("saveForStudents").checked;
          const errorElement = document.getElementById("checkboxError");

          if (!saveForBatch && !saveForStudents) {
        errorElement.classList.remove("hidden");
        return false;
          } else {
        errorElement.classList.add("hidden");
        return true;
          }
        }

      
      </script>

      <script>
        const studentsByBatch = {
          class11: ["Student A", "Student B", "Student C"],
          class12: ["Student D", "Student E", "Student F"],
          drop1: ["Student G", "Student H"],
          drop2: ["Student I", "Student J"],
        };

        function updateStudentDropdown() {
          const classBatch = document.getElementById("classBatchSelect").value;
          const studentSelect = document.getElementById("studentSelect");

          studentSelect.innerHTML = '<option value="">Select Student</option>';

          if (classBatch && studentsByBatch[classBatch]) {
        studentsByBatch[classBatch].forEach((student) => {
          const option = document.createElement("option");
          option.value = student;
          option.textContent = student;
          studentSelect.appendChild(option);
        });
          }
        }
      </script>

      
      <input type="password" placeholder="Set Test Access Password (Optional)" class="w-full p-2 border rounded">
      <div class="grid grid-cols-2 gap-4">
        <input type="datetime-local" class="w-full p-2 border rounded" placeholder="Start Time">
        <input type="datetime-local" class="w-full p-2 border rounded" placeholder="End Time">
      </div>
      <select class="w-full p-2 border rounded">
        <option value="1">Single Attempt</option>
        <option value="multiple">Multiple Attempts</option>
        
      </select>

      
    </section>

    <!-- Section 4: Preview & Publish -->
    <section class="bg-white p-6 rounded-lg shadow space-y-4">
      <h2 class="text-2xl font-bold">4. Preview & Publish</h2>
      <div class="flex gap-4">
        <button class="bg-blue-600 text-white px-4 py-2 rounded" onclick="previewTest()">Preview Test</button>
        <button class="bg-green-600 text-white px-4 py-2 rounded" onclick="publishTest()">Publish Now</button>
        <button class="bg-gray-500 text-white px-4 py-2 rounded" onclick="saveAsDraft()">Save as Draft</button>
      </div>
    <label class="flex items-center gap-2">
      <span>Edit Later</span>
      <div class="relative inline-block w-10 h-5">
        <input type="checkbox" id="editLaterCheckbox" class="sr-only peer">
        <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-blue-600 transition-colors duration-300"></div>
        <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full transform peer-checked:translate-x-5 transition-transform duration-300"></div>
      </div>
    </label>
    </section>

    

    <!-- Section 5: Test Management Panel -->
    <section class="bg-white p-6 rounded-lg shadow space-y-4">
        <h2 class="text-2xl font-bold">5. Test Management Panel</h2>
        <table class="w-full border text-left">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2">Title</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Assigned</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody id="testList">
                <!-- Dynamic rows will be added here -->
            </tbody>
        </table>
    </section>

    <script>
        const tests = [
            {
                title: "Sample Test",
                status: "Published",
                assigned: "30 Students",
                link: "https://example.com/test/sample",
                accessCode: generateAccessCode(),
            },
        ];

        function generateAccessCode() {
            const editLater = document.getElementById("editLaterCheckbox").checked;
            return editLater ? "EDITLATER123" : "PUBLISHNOW456";
        }

        function renderTests() {
            const testList = document.getElementById("testList");
            testList.innerHTML = "";

            tests.forEach((test, index) => {
                const row = document.createElement("tr");
                row.className = "border-t";

                row.innerHTML = `
                    <td class="p-2">${test.title}</td>
                    <td class="p-2">${test.status}</td>
                    <td class="p-2">${test.assigned}</td>
                    <td class="p-2 space-x-2">
                        <button class="text-blue-600 underline" onclick="editTest(${index})">Edit</button>
                        <button class="text-red-600 underline" onclick="deleteTest(${index})">Delete</button>
                        <button class="text-green-600 underline" onclick="copyLink('${test.link}')">Copy Link</button>
                        <button class="text-purple-600 underline" onclick="copyAccessCode('${test.accessCode}')">Copy Access Code</button>
                    </td>
                `;

                testList.appendChild(row);
            });
        }

        function editTest(index) {
            const test = tests[index];
            alert(`Editing test: ${test.title}`);
            // Add logic to edit the test
        }

        function deleteTest(index) {
            if (confirm("Are you sure you want to delete this test?")) {
                tests.splice(index, 1);
                renderTests();
                alert("Test deleted successfully!");
            }
        }

        function copyLink(link) {
            navigator.clipboard.writeText(link).then(() => {
                alert("Test link copied to clipboard!");
            });
        }

        function copyAccessCode(accessCode) {
            navigator.clipboard.writeText(accessCode).then(() => {
                alert("Access code copied to clipboard!");
            });
        }

        renderTests();
    </script>
  </div>

 
  <script>
    function addOption() {
      const container = document.getElementById("mcqOptions");
      const input = document.createElement("input");
      input.type = "text";
      input.placeholder = "New Option";
      input.className = "w-full p-2 border rounded";
      container.insertBefore(input, container.lastElementChild);
    }

    document.getElementById("questionType").addEventListener("change", function () {
      const optionsDiv = document.getElementById("mcqOptions");
      const type = this.value;
      if (type === "single" || type === "multiple") {
        optionsDiv.classList.remove("hidden");
      } else {
        optionsDiv.classList.add("hidden");
      }
    });


    const questions = [];

function addQuestion() {
  const questionType = document.getElementById("questionType").value;
  const questionText = document.getElementById("questionText").value;
  const correctAnswer = document.getElementById("correctAnswer").value;
  const marks = document.getElementById("marks").value;
  const negativeMarks = document.getElementById("negativeMarks").value;

  if (!questionText || !correctAnswer || !marks) {
    alert("Please fill in all required fields.");
    return;
  }

  const question = {
    type: questionType,
    text: questionText,
    correctAnswer: correctAnswer,
    marks: parseFloat(marks),
    negativeMarks: parseFloat(negativeMarks) || 0,
  };

  if (questionType === "single" || questionType === "multiple") {
    const options = Array.from(
      document.querySelectorAll("#mcqOptions input[type='text']")
    ).map((input) => input.value);
    question.options = options;
  }

  questions.push(question);
  alert("Question added successfully!");
  clearQuestionForm();
}

function clearQuestionForm() {
    document.getElementById("questionText").value = "";
    document.getElementById("correctAnswer").value = "";
    document.getElementById("marks").value = "";
    document.getElementById("negativeMarks").value = "";
    const optionsDiv = document.getElementById("mcqOptions");
    optionsDiv.innerHTML = `
        <input type="text" placeholder="Option 1" class="w-full p-2 border rounded">
        <input type="text" placeholder="Option 2" class="w-full p-2 border rounded">
        <button onclick="addOption()" class="bg-blue-600 text-white px-4 py-1 rounded">+ Add Option</button>
    `;
    optionsDiv.classList.add("hidden");
}
const importSection = document.querySelector("#importQuestions").parentElement;
const fileUpload = document.getElementById("fileUpload");
fileUpload.accept = "image/*";
importSection.appendChild(fileUpload);
document.getElementById("importQuestions").remove();


function previewTest() {
        if (questions.length === 0) {
          alert("No questions added to preview.");
          return;
        }
        console.log("Previewing Test:", questions);
        alert("Test preview is displayed in the console.");
      }

      function publishTest() {
        if (questions.length === 0) {
          alert("No questions to publish.");
          return;
        }
        const editLater = document.getElementById("editLaterCheckbox").checked;
        console.log("Publishing Test:", { questions, editLater });
        alert("Test published successfully!");
      }

      function saveAsDraft() {
        if (questions.length === 0) {
          alert("No questions to save as draft.");
          return;
        }
        console.log("Saving Test as Draft:", questions);
        alert("Test saved as draft successfully!");
      }
  </script>
</body>
</html>
