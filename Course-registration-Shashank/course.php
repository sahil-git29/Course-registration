<?php
  session_start();

  $cum=mysqli_connect('localhost','root','');

  mysqli_select_db($cum, 'studentdatabase');

  $roll=$_SESSION['ROLL'];

  $se="select *from studentpaymentdetails where RollNumber='$roll'";

  $result = mysqli_query($cum, $se);

  $r=mysqli_fetch_assoc($result);
//second database
  $join=mysqli_connect('localhost','root','');

  mysqli_select_db($join, 'courses');

  $selectdatabase="semester".$r['Semester'].$r['Department'];

  $s="select *from $selectdatabase";

  $secondresult = mysqli_query($join, $s);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Registration Form</title>
    <meta name="author" content="IIIT Manipur">
    <meta name="description" content="">
    <link rel="stylesheet" href="./css/styles.dashboard.css">
    <!-- Tailwind -->
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <!-- <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #3d68ff; }
        .cta-btn { color: #3d68ff; }
        .upgrade-btn { background: #1947ee; }
        .upgrade-btn:hover { background: #0038fd; }
        .active-nav-link { background: #1947ee; }
        .nav-item:hover { background: #1947ee; }
        .account-link:hover { background: #3d68ff; }
    </style> -->
</head>
<body class="bg-gray-100 flex">

    <aside class="relative bg-blue-800 lg:w-1/5 md:-1/3 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="index.html" class="text-blue-100 sm:text-2xl text-xl font-medium hover:text-gray-300 tracking-wide" style="font-family: 'Lato',sans-serif;">Pranav Pathak</a>
            <p class="leading-relaxed text-gray-500 font-normal">Student</p>
            <!-- <button class="bg-white inline-flex cta-btn sm:text-sm lg:text-base text-base font-semibold py-2 px-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 focus:outline-none flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i>New Registration
            </button> -->
        </div>
        <nav class=" text-white bg-blue-800 text-base font-semibold pt-4">
            <a href="Student_dashboard.html" class="flex items-center opacity-75 hover:opacity-100 hover:bg-blue-900 text-white py-5 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="payment.html" class="flex items-center text-white opacity-75 bg-blue-800 hover:opacity-100 hover:bg-blue-900 py-5 pl-6 nav-item">
                <i class="fas fa-credit-card mr-3"></i>
                Payment Form
            </a>
            <a href="course.php" class="flex items-center text-white opacity-100 bg-blue-900 py-5 pl-6 nav-item">
                <i class="fas fa-book mr-3"></i>
                Course Registration
            </a>
        </nav>
        <a href="#" class="absolute w-full bottom-0 flex fixed items-center justify-center text-white bg-blue-900 py-3 nav-item">
            <i class="fas fa-info-circle mr-3" aria-hidden="true"></i>
            Need help
        </a>
    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full flex items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-2 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                    viewBox="0 0 172 172"
                    style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#2a4365"><path d="M86,14.33333c-39.5815,0 -71.66667,32.08517 -71.66667,71.66667c0,39.5815 32.08517,71.66667 71.66667,71.66667c39.5815,0 71.66667,-32.08517 71.66667,-71.66667c0,-39.5815 -32.08517,-71.66667 -71.66667,-71.66667zM86,34.04167c12.86417,0 23.29167,10.4275 23.29167,23.29167c0,12.86417 -10.4275,23.29167 -23.29167,23.29167c-12.86417,0 -23.29167,-10.4275 -23.29167,-23.29167c0,-12.86417 10.4275,-23.29167 23.29167,-23.29167zM86,143.33333c-17.47233,0 -33.11717,-7.81883 -43.63067,-20.15267c-2.7305,-3.2035 -2.12133,-8.01233 1.23983,-10.54217c10.87183,-8.17717 30.6805,-12.30517 42.39083,-12.30517c11.71033,0 31.519,4.128 42.398,12.30517c3.36117,2.52983 3.97033,7.34583 1.23983,10.54217c-10.52067,12.33383 -26.1655,20.15267 -43.63783,20.15267z"></path></g></g></svg></button>
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <a href="#" class="block px-4 py-2 account-link hover:text-white hover:bg-blue-700">Account</a>
                    <a href="#" class="block px-4 py-2 account-link hover:text-white hover:bg-blue-700">Support</a>
                    <a href="index.html" class="block px-4 py-2 account-link hover:text-white hover:bg-blue-700">Sign Out</a>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-blue-800 py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="index.html" class="text-blue-100 sm:text-2xl text-xl font-medium hover:text-gray-300 tracking-wide" style="font-family: 'Lato', sans-serif';">Pranav Pathak
                <p class="leading-relaxed text-sm text-gray-500 font-normal">Student</p>
                </a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>

            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="Student_dashboard.html" class="flex items-center active-nav-link opacity-75 hover:opacity-100 text-white py-2 pl-4 nav-item">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="Payment.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-credit-card mr-3"></i>
                    Payment details
                </a>
                <a href="course.php" class="flex items-center text-white py-2 pl-4 nav-item">
                    <i class="fas fa-book mr-3"></i>
                    Course Registration
                </a>
                <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-cogs mr-3"></i>
                    Support
                </a>
                <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-user mr-3"></i>
                    My Account
                </a>
                <a href="index.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Sign Out
                </a>
                <button class="w-full bg-white cta-btn font-semibold text-base py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                    <i class="fas fa-plus mr-3"></i>New Registration
                </button>
                <button class="w-full bg-white cta-btn font-semibold py-2 mt-3 rounded-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                    <i class="fas fa-info-circle mr-3"></i>Need help
                </button>

            </nav>

        </header>

        <div class="w-full overflow-x-hidden border-t pb-8 flex flex-col">
            <main class="w-full flex-grow p-6 mb-8">
                <h1 class="sm:text-3xl text-2xl text-blue-900 font-semibold mb-3">Course Registration Form</h1>
                <div class="leading-relaxed text-gray-600">Select the courses to opt for the upcoming semester from the <a href="http://www.iiitmanipur.ac.in/snippets/ECE-CSESyllabus.pdf" target="blank"><span class="text-blue-500 hover:underline">list of courses.</span></a></div>

            </main>
            <div class="lg:w-9/12 md:w-11/12 bg-white shadow-2xl contact-container p-8 flex flex-col md:mx-auto w-full mt-10 md:mt-0">
                <div class="mb-2">
                    <h2 class="text-center text-blue-900 font-medium text-xl">Form: Acd/02</h2>
                </div>
                <div class="mb-4">
                    <h4 class="text-right text-blue-900 font-normal text-lg">S.I. No. <span class="text-right text-red-700 font-normal text-lg">190545</span>
                    </h4>
                </div>
                <div class="bg-gray-200 h-px mb-6">
                </div>
                <form>
                    <div class="rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
                      <div class="-mx-3 md:flex md:mb-8 mb-0">
                        <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                          <label class="tracking-wide text-blue-900 text-base font-bold mb-2">
                            First name
                          </label>
                          <input class="w-full bg-white text-black border border-gray-300 rounded py-3 px-4 mt-2 mb-3 focus:outline-none focus:border-blue-800" type="text" value="<?php echo $r['Firstname']; ?>" required disabled>
                        </div>
                        <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                          <label class="tracking-wide text-blue-900 text-base font-bold mb-2">
                            Middle name
                          </label>
                          <input class="w-full bg-white text-black border border-gray-300 rounded py-3 px-4 mt-2 mb-3 focus:outline-none focus:border-blue-800" type="text" value="<?php echo $r['Middlename']; ?>" required disabled>
                        </div>
                        <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                          <label class="tracking-wide text-blue-900 text-base font-bold mb-2">
                            Last name
                          </label>
                          <input class="w-full bg-white text-black border border-gray-300 rounded py-3 px-4 mt-2 mb-3 focus:outline-none focus:border-blue-800" type="text" value="<?php echo $r['Lastname']; ?>" required disabled>
                        </div>

                      </div>

                      <!-- <div class="-mx-3 md:flex md:mb-8 mb-6">
                        <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                          <label class="tracking-wide text-blue-900 text-sm font-bold mb-2">
                            Department
                          </label>
                          <input class="w-full bg-white text-black border border-gray-300 rounded py-3 px-4 mt-2 mb-3 focus:outline-none focus:border-blue-800" type="text" placeholder="Full name" required>
                        </div>
                        <div class="md:w-1/3 px-3">
                          <label class="tracking-wide text-blue-900 text-sm font-bold mb-2">
                            Category
                          </label>
                          <input class="w-full bg-white text-black border border-gray-300 rounded py-3 px-4 mb-3 mt-2 focus:outline-none focus:border-blue-800" id="title" type="text" placeholder="Enrollment number" required>
                        </div>
                        <div class="md:w-1/3 px-3">
                            <label class="tracking-wide text-blue-900 text-sm font-bold mb-2">
                              Person with disability
                            </label>
                            <input class="w-full bg-white text-black border border-gray-300 rounded py-3 px-4 mb-3 mt-2 focus:outline-none focus:border-blue-800" id="title" type="text" placeholder="Enrollment number" required>
                          </div>
                      </div> -->

                      <div class="-mx-3 md:flex md:mb-8 mb-0">
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                          <label class="tracking-wide text-blue-900 text-base font-bold mb-2">
                            Roll no.
                          </label>
                          <input class="w-full bg-white text-black border border-gray-300 rounded py-3 px-4 mb-3 mt-2 focus:outline-none focus:border-blue-800" id="title" type="text" value="<?php echo $r['RollNumber']; ?>" required disabled>
                        </div>
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                          <label class="tracking-wide text-blue-900 text-base font-bold" for="location">
                            Programme
                          </label>
                          <select class="w-full bg-white border border-gray-300 text-black text-base py-3 px-4 pr-8 mb-3 rounded mt-2 focus:outline-none focus:border-blue-800" id="department" required disabled>
                            <option><?php echo $r['Programme'];?></option>

                          </select>
                        </div>
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                          <label class="tracking-wide text-blue-900 text-base font-bold" for="location">
                            Department
                          </label>
                          <div>
                            <div>
                              <select class="w-full bg-white border border-gray-300 text-black text-base py-3 px-4 pr-8 mb-3 rounded mt-2 focus:outline-none focus:border-blue-800" id="department" required disabled>
                                <option><?php echo $r['Department'];?></option>

                              </select>
                            </div>

                          </div>
                        </div>
                      </div>

                    <div class="-mx-3 md:flex md:mb-8 mb-4">
                      <div class="md:w-1/2 md:mr-4 px-3 mb-6 md:mb-0">
                        <label class=" tracking-wide text-blue-900 text-base font-bold" for="job-type">
                          Contact number
                        </label>
                        <input class="w-full bg-white text-black border border-gray-300 rounded py-3 px-4 mb-3 mt-2 focus:outline-none focus:border-blue-800" id="title" type="text" placeholder="10 digit mobile no." required>
                      </div>

                      <div class="md:w-1/2 md:mr-4 px-3 mb-6 md:mb-0">
                        <label class=" tracking-wide text-blue-900 text-base font-bold" for="job-type">
                          Father's name
                        </label>
                        <input class="w-full bg-white text-black border border-gray-300 rounded py-3 px-4 mb-3 mt-2 focus:outline-none focus:border-blue-800" id="title" type="text" placeholder="Father's full name" required>
                      </div>
                    </div>

                    <div class="-mx-3 md:flex md:mb-8 mb-4">
                      <div class="md:w-1/2 md:mr-4 px-3 mb-6 md:mb-0">
                        <label class=" tracking-wide text-blue-900 text-base font-bold" for="job-type">
                          Registration for semester
                        </label>
                        <select class="w-full bg-white border border-gray-300 text-black text-base py-3 px-4 pr-8 mb-3 rounded mt-2 focus:outline-none focus:border-blue-800" id="department" required disabled>
                          <option><?php echo $r['Semester'];?></option>

                        </select>
                      </div>
                      <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class=" tracking-wide text-blue-900 text-base font-bold" for="department">
                          Backlogs
                        </label>
                        <div class="flex py-2 px-8 items-center mt-2">
                          <input type="radio" class="form-checkbox h-5 w-5 text-yellow-600" name="radio"><span class="ml-2 text-gray-700">Yes</span>
                          <input type="radio" class="form-checkbox h-5 w-5 text-yellow-600 ml-6" checked name="radio"><span class="ml-2 text-gray-700">No</span>
                        </div>
                      </div>

                    </div>

                    <div class="-mx-3 md:flex md:mb-8 mb-4 justify-center">
                      <div class="px-3 mb-6 md:mb-0 ">
                        <table class="table-auto">
                          <thead>
                            <tr>
                              <th class="px-4">Semester</th>
                              <th class="px-4">Code</th>
                              <th class="px-4">Course name</th>
                              <th class="px-4">L</th>
                              <th class="px-4">T</th>
                              <th class="px-4">P</th>
                              <th class="px-4">C</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              while($re=mysqli_fetch_assoc($secondresult))
                                {
                                  ?>
                            <tr>

                              <td class="border px-4 py-2 text-center"><?php echo $re['Semester']; ?></td>
                              <td class="border px-4 py-2"><?php echo $re['Code']; ?></td>
                              <td class="border px-4 py-2"><?php echo $re['Coursename']; ?></td>
                              <td class="border px-4 py-2"><?php echo $re['L']; ?></td>
                              <td class="border px-4 py-2"><?php echo $re['T']; ?></td>
                              <td class="border px-4 py-2"><?php echo $re['P']; ?></td>
                              <td class="border px-4 py-2"><?php echo $re['C']; ?></td>
                            </tr>

                          </tbody>
                          <?php
                            }
                          ?>
                        </table>
                      </div>
                    </div>



                      <div class="-mx-3 flex">
                        <div class=" px-3">
                          <button class="bg-white border-2 border-gray-300 text-gray-700 font-medium py-2 px-4 rounded">
                            Save
                          </button>
                        </div>
                        <div class="ml-auto px-3">
                            <button class="bg-blue-700 text-white font-bold py-2 px-4 rounded">
                              Submit for verification
                            </button>
                          </div>
                      </div>
                    </div>
                  </form>
              </div>
        </div>

    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>



</body>
</html>
