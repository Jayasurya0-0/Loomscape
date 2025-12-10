<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "madhu_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) { die("DB Connection Failed: " . $conn->connect_error); }

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname  = $_POST["fullname"];
    $email     = $_POST["email"];
    $password  = $_POST["password"];
    $confirm   = $_POST["confirm-password"];
    $phone     = $_POST["phone"];

    if ($password !== $confirm) {
        $error = "Passwords do not match!";
    } else {
    // REMOVED: $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO login (fullname, email, password, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $email, $password, $phone); // <-- NOW USING $password

        if ($stmt->execute()) {
            $success = "Account created successfully!";
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Loomscape</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#D2691E',
                        secondary: '#8B4513'
                    },
                    borderRadius: {
                        'none': '0px',
                        'sm': '4px',
                        DEFAULT: '8px',
                        'md': '12px',
                        'lg': '16px',
                        'xl': '20px',
                        '2xl': '24px',
                        '3xl': '32px',
                        'full': '9999px',
                        'button': '8px'
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Pacifico&family=Crimson+Text:ital,wght@0,400;0,600;1,400&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
        :where([class^="ri-"])::before {
            content: "\f3c2";
        }

        .weaving-pattern {
            background-image:
                radial-gradient(circle at 20% 80%, rgba(210, 105, 30, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(139, 69, 19, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(210, 105, 30, 0.03) 0%, transparent 50%);
        }

        input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(210, 105, 30, 0.1);
        }

        .password-toggle {
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .password-toggle:hover {
            color: #D2691E;
        }

        .custom-checkbox {
            appearance: none;
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid #d1d5db;
            border-radius: 4px;
            background-color: white;
            cursor: pointer;
            position: relative;
            transition: all 0.2s ease;
        }

        .custom-checkbox:checked {
            background-color: #D2691E;
            border-color: #D2691E;
        }

        .custom-checkbox:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 0.75rem;
            font-weight: bold;
        }

        .country-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }
    </style>
</head>

<body class="font-['Crimson_Text'] bg-stone-50 weaving-pattern min-h-screen">
    <?php if ($success): ?>
<div class="bg-green-100 text-green-700 p-4 text-center font-medium">
    <?= $success ?>
</div>
<?php endif; ?>

<?php if ($error): ?>
<div class="bg-red-100 text-red-700 p-4 text-center font-medium">
    <?= $error ?>
</div>
<?php endif; ?>
    <header class="bg-stone-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center">
					 <img src="Images/Madus_logo-removebg-preview.png"
                            alt="Logo" class="h-8 mr-3">
                    <h1 class="font-[''] text-3xl text-primary">Loomscape</h1>
                    
                </div>
                <nav class="hidden md:flex space-x-8">
                    <a href="index.html"
                        class="text-stone-700 hover:text-primary transition-colors duration-300 font-medium">Home</a>
                        <a href="Booking.html"
                        class="text-stone-700 hover:text-primary transition-colors duration-300 font-medium">Booking</a>
                    <a href="About.html"
                        class="text-stone-700 hover:text-primary transition-colors duration-300 font-medium">About</a>
                    <a href="Contact.html"
                        class="text-stone-700 hover:text-primary transition-colors duration-300 font-medium">Contact</a>
                          <a href="signin.html"
                        class="text-stone-700 hover:text-primary transition-colors duration-300 font-medium">Signin</a>
                </nav>
                <button class="md:hidden w-8 h-8 flex items-center justify-center">
                    <i class="ri-menu-line text-xl text-stone-700"></i>
                </button>
            </div>
        </div>
    </header>

    <main class="flex-1 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-lg w-full space-y-8">
            <div class="text-center">
                <div class="mx-auto w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mb-6">
                    <i class="ri-user-add-line text-primary text-3xl"></i>
                </div>
                <h2 class="font-['Playfair_Display'] text-3xl font-bold text-stone-800 mb-2">Create Your Account</h2>
                <p class="text-stone-600">Join Loomscape to unlock exclusive cultural experiences</p>
            </div>

            <form method="POST" class="mt-8 space-y-6">
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <div class="space-y-6">
                        <div>
                            <label for="fullname" class="block text-sm font-medium text-stone-700 mb-2">Full
                                Name</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="ri-user-line text-stone-400 text-lg"></i>
                                </div>
                                <input id="fullname" name="fullname" type="text" required
                                    class="w-full pl-10 pr-4 py-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm"
                                    placeholder="Enter your full name">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-stone-700 mb-2">Email
                                Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="ri-mail-line text-stone-400 text-lg"></i>
                                </div>
                                <input id="email" name="email" type="email" required
                                    class="w-full pl-10 pr-4 py-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm"
                                    placeholder="your.email@example.com">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-stone-700 mb-2">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="ri-lock-line text-stone-400 text-lg"></i>
                                </div>
                                <input id="password" name="password" type="password" required
                                    class="w-full pl-10 pr-12 py-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm"
                                    placeholder="Create a strong password">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i class="ri-eye-line password-toggle text-stone-400 text-lg"
                                        onclick="togglePassword('password')"></i>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="confirm-password" class="block text-sm font-medium text-stone-700 mb-2">Confirm
                                Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="ri-lock-line text-stone-400 text-lg"></i>
                                </div>
                                <input id="confirm-password" name="confirm-password" type="password" required
                                    class="w-full pl-10 pr-12 py-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm"
                                    placeholder="Confirm your password">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i class="ri-eye-line password-toggle text-stone-400 text-lg"
                                        onclick="togglePassword('confirm-password')"></i>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-stone-700 mb-2">Phone
                                Number</label>
                            <div class="flex">
                                <select
                                    class="country-select px-3 py-3 border border-stone-300 rounded-l-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm bg-white pr-8">
                                    <option value="+91">+91</option>
                                    <option value="+1">+1</option>
                                    <option value="+44">+44</option>
                                    <option value="+61">+61</option>
                                    <option value="+86">+86</option>
                                    <option value="+33">+33</option>
                                    <option value="+49">+49</option>
                                </select>
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="ri-phone-line text-stone-400 text-lg"></i>
                                    </div>
                                    <input id="phone" name="phone" type="tel" required
                                        class="w-full pl-10 pr-4 py-3 border border-l-0 border-stone-300 rounded-r-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm"
                                        placeholder="9876543210">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-3">Interests & Preferences</label>
                            <div class="space-y-3">
                                <label class="flex items-center">
                                    <input type="checkbox" class="custom-checkbox mr-3" name="interests"
                                        value="weaving-workshops">
                                    <span class="text-sm text-stone-700">Traditional Weaving Workshops</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="custom-checkbox mr-3" name="interests"
                                        value="temple-tours">
                                    <span class="text-sm text-stone-700">Temple & Cultural Tours</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="custom-checkbox mr-3" name="interests"
                                        value="cultural-events">
                                    <span class="text-sm text-stone-700">Cultural Events & Festivals</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="custom-checkbox mr-3" name="interests"
                                        value="artisan-meetings">
                                    <span class="text-sm text-stone-700">Meet Local Artisans</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="custom-checkbox mr-3" name="interests"
                                        value="textile-history">
                                    <span class="text-sm text-stone-700">Textile History & Heritage</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <input id="terms" name="terms" type="checkbox" required class="custom-checkbox mt-1 mr-3">
                            <label for="terms" class="text-sm text-stone-700">
                                I agree to the <a href="#"
                                    class="text-primary hover:text-secondary transition-colors duration-300">Terms of
                                    Service</a> and <a href="#"
                                    class="text-primary hover:text-secondary transition-colors duration-300">Privacy
                                    Policy</a>
                            </label>
                        </div>

                        <div>
                            <button type="submit"
                            href="index.html"
                                class="w-full bg-primary hover:bg-secondary text-white py-3 px-4 !rounded-button font-medium transition-all duration-300 whitespace-nowrap">
                                Create Account
                            </button>
                        </div>

                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-stone-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-stone-500">Or sign up with</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <button type="button"
                                class="w-full inline-flex justify-center py-3 px-4 border border-stone-300 !rounded-button bg-white text-sm font-medium text-stone-500 hover:bg-stone-50 transition-colors duration-300">
                                <i class="ri-google-fill text-lg mr-2"></i>
                                Google
                            </button>
                            <button type="button"
                                class="w-full inline-flex justify-center py-3 px-4 border border-stone-300 !rounded-button bg-white text-sm font-medium text-stone-500 hover:bg-stone-50 transition-colors duration-300">
                                <i class="ri-facebook-fill text-lg mr-2"></i>
                                Facebook
                            </button>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <p class="text-stone-600">
                        Already have an account?
                        <a href="Login.php"
                            data-readdy="true"
                            class="text-primary hover:text-secondary font-medium transition-colors duration-300">Sign in
                            here</a>
                    </p>
                </div>
            </form>
        </div>
    </main>

    

    <script id="password-toggle">
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const toggle = field.nextElementSibling.querySelector('.password-toggle');
            if (field.type === 'password') {
                field.type = 'text';
                toggle.classList.remove('ri-eye-line');
                toggle.classList.add('ri-eye-off-line');
            } else {
                field.type = 'password';
                toggle.classList.remove('ri-eye-off-line');
                toggle.classList.add('ri-eye-line');
            }
        }
    </script>

    

    <script id="social-registration">
        document.addEventListener('DOMContentLoaded', function () {
            const googleButton = document.querySelector('button:has(.ri-google-fill)');
            const facebookButton = document.querySelector('button:has(.ri-facebook-fill)');

            googleButton.addEventListener('click', function () {
                alert('Google registration will be implemented. Redirecting to Google OAuth...');
            });

            facebookButton.addEventListener('click', function () {
                alert('Facebook registration will be implemented. Redirecting to Facebook OAuth...');
            });
        });
    </script>

  	<!-- body code goes here -->


	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="js/jquery-3.4.1.min.js"></script>

	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/popper.min.js"></script> 
	<script src="js/bootstrap-4.4.1.js"></script>
  </body>
</html>