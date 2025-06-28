<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <!-- Bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/css/register.css'])
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Outfit:wght@100..900&display=swap" rel="stylesheet">

</head>
<body class="home-background">

<!-- Register Form -->
  <div>
    <div class="container px-4 animated-load">
      <div class="row justify-content-center">
        <div class="row justify-content-center">
          <div class="register-container">
            <div class="register-title mb-0">IO-Lock</div>
            <div class="text-center">
              <p style="font-weight: 550; color: rgba(6, 31, 46, 0.82); font-size: x-small">Let's make our job easier.</p>
            </div>
            <form onsubmit="return submitToFirebase(event)">
              <div class="row mb-3">
                <div class="col mb-3">
                  <input type="text" id="first_name" class="form-control register-form" placeholder="First Name">
                </div>
                <div class="col mb-3">
                  <input type="text" id="last_name" class="form-control register-form" placeholder="Last Name">
                </div>
                <div class="row mx-auto px-0">
                  <div class="mb-3">
                    <input type="text" id="username" class="form-control register-form" placeholder="Username">
                  </div>
                </div>
                <div class="col mb-3">
                  <input type="password" id="password" class="form-control register-form" placeholder="Password">
                </div>
                <div class="col mb-3">
                  <input type="password" id="password_confirmation" class="form-control register-form" placeholder="Confirm Password">
                </div>
                <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn-register">Create Account</button>
                </div>
              </div>
            </form>
            <div class="justify-content-center text-center">
              <a style="font-size: small; color:rgba(6, 31, 46, 0.82);" href="{{ route('login') }}">I already have an account</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-3 mx-4">
      <a class="btn btn-sm btn-outline-custom log-home-button animated-load" href="{{ route('home') }}">Back to homepage</a>
    </div>
  </div>

<!-- Javascript Firebase -->
<script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-database-compat.js"></script>
<script>
  // Konfigurasi Firebase
   const firebaseConfig = {
        apiKey: "AIzaSyAp46YtRQMKG7dFlu4dzNi-e90ajD2_3X4",
        authDomain: "io-lock.firebaseapp.com",
        databaseURL: "https://io-lock-default-rtdb.asia-southeast1.firebasedatabase.app",
        projectId: "io-lock",
        storageBucket: "io-lock.firebasestorage.app",
        messagingSenderId: "1066049821247",
        appId: "1:1066049821247:web:35102b5413c8066db6f68a",
        measurementId: "G-CDST6DL4D2"
      };
      // Initialize Firebase
      const app = firebase.initializeApp(firebaseConfig);
      const database = firebase.database();

  // Fungsi untuk handle register
  async function submitToFirebase(event) {
    event.preventDefault();
    const firstName = document.getElementById("first_name").value.trim();
    const lastName = document.getElementById("last_name").value.trim();
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();
    const passwordConfirmation = document.getElementById("password_confirmation").value.trim();
    if (!firstName || !lastName || !username || !password || !passwordConfirmation) {
      alert("Please fill in all fields.");
      return false;
    }
    if (password !== passwordConfirmation) {
      alert("Password and confirmation do not match.");
      return false;
    }
    // ID unik (misal: timestamp)
    const userId = "unassign" + Date.now();
    // Data user baru
    const newUser = {
      nama: firstName + " " + lastName,
      username: username,
      password: password,
      akses_level: "user"
    };
    try {
      await database.ref('nfc_cards/' + userId).set(newUser);
      alert("Registration successful! Please login.");
      window.location.href = "{{ route('login') }}";
    } catch (error) {
      console.error("Error during registration:", error);
      alert("Registration failed. Please try again.");
    }
    return false;
  }
</script>
</body>
</html>
