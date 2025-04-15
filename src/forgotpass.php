<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="output.css">
    <link rel="icon" href="Logo.png" type="image/png">
</head>
<body class="bg-gray-200 flex justify-center">
    <div class="  mt-[2cm] border-1 bg-white border-white shadow-lg shadow-gray-300 rounded-xl h-[15cm] w-[12cm]   ">
       <h1 class="text-xl font-bold pl-8 pt-8 pb-8">
        Change Password
       </h1>
<form action = "passchanged.php" method="POST">


       <label for="email" class="pl-8 ">Your Email</label>
       <br>
        <input class="pl-4 border-gray-200 border-1 h-[1.2cm] rounded-xl w-[10cm] ml-9 mb-4 " type="email" id="email" name="email" required placeholder="Enter your email">

       <label for="pwd" class="pl-8 ">New Password</label>
       <br>
        <input class="pl-4 border-gray-200 border-1 h-[1.2cm] rounded-xl mb-4 w-[10cm] ml-9 " type="password" id="pwd" name="pwd" required placeholder="Enter your password"   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}$" oninvalid="this.setCustomValidity('Password must contain at least 8 characters, including uppercase, lowercase, and a special character.')"
        oninput="this.setCustomValidity('')" >

        <label for="pwd" class="pl-8 ">Confirm Password</label>
        <br>
        <input class="pl-4 border-gray-200 border-1 h-[1.2cm] rounded-xl w-[10cm] ml-9  mb-7" type="password" id="pwd" name="pwd" required placeholder="Confirm your password"   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}$" oninvalid="this.setCustomValidity('Password must contain at least 8 characters, including uppercase, lowercase, and a special character.')"
        oninput="this.setCustomValidity('')">

      <div class="pl-9 pt-10">
        
          <input  type="checkbox" id="T and C" name="T and C" value="T and C" required>
   <label for="T and C"> I acept the <a class="text-blue-800" href = "">Terms and Conditions</a> </label>
      </div>

      <label for = "Change Password">
          <button class="bg-blue-800  text-white rounded-xl h-[1.2cm] w-[10cm] ml-9 mt-4 hover:cursor-pointer hover:shadow-2xl" value = "Change Password">
         
          Change Password
          
        </button>
      </label>
    </form>
    </div>
    
</body>
</html>