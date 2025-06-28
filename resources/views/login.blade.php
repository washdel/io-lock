<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/css/login.css'])
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Outfit:wght@100..900&display=swap" rel="stylesheet">

</head>
<body class="home-background">

<!-- Login Form -->

  <div>
    <div class="container px-4 animated-load">
      <div class="row justify-content-center">
        <div class ="row justify-content-center">
          <div class="register-container">
            <div class="register-title mb-0">IO-Lock</div>
            <div class="text-center">
              <p style="font-weight: 550; color: rgba(6, 31, 46, 0.82); font-size: x-small">Login to your account</p>
            </div>
            <form onsubmit="return loginWithFirebase(event)">
              <div class="row mb-3">
                <div class="mb-3">
                  <input type="text" id="username" class="form-control register-form" placeholder="Username" required>
                </div>
                <div class="mb-3">
                  <input type="password" id="password" class="form-control register-form" placeholder="Password" required>
                </div>
                <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn-register">Login</button>
                </div>
              </div>
            </form>
            <div class="justify-content-center text-center">
              <a style="font-size: small; color:rgba(6, 31, 46, 0.82);" href="{{ route('register') }}">Don't have an account? Register</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-3 mx-4">
      <a class="btn btn-sm btn-outline-custom log-home-button animated-load" href="{{ route('home') }}">Back to homepage</a>
    </div>
  </div>

<!-- Firebase JS -->
  <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-database-compat.js"></script>

    <script>
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

      async function loginWithFirebase(event) {
        event.preventDefault();
        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();
        if (!username || !password) {
          alert("Please fill in all fields.");
          return false;
        }
        try {
          const snapshot = await database.ref('nfc_cards').once('value');
          const users = snapshot.val();
          let found = false;
          let aksesLevel = '';
          let userObj = null;
          for (const uid in users) {
            if (
              users[uid].username === username &&
              users[uid].password === password
            ) {
              found = true;
              aksesLevel = users[uid].akses_level || '';
              userObj = users[uid];
              break;
            }
          }
          if (found) {
            // Store username and akses_level in both localStorage and sessionStorage
            localStorage.setItem('akses_level', aksesLevel);
            localStorage.setItem('username', userObj.username || username);
            sessionStorage.setItem('akses_level', aksesLevel);
            sessionStorage.setItem('username', userObj.username || username);
            sessionStorage.setItem('last_login_username', userObj.username || username);
            localStorage.setItem('last_login_username', userObj.username || username);
            sessionStorage.setItem('last_login_password', password);
            localStorage.setItem('last_login_password', password);
            alert("Login successful!");
            window.location.href = "{{ route('dashboard') }}";
          } else {
            alert("Username or password is incorrect.");
          }
        } catch (error) {
          console.error("Error during login:", error);
          alert("Login failed. Please try again.");
        }
        return false;
      }
    </script>
    <!-- Transition Login-Reg page-->

</body>
</html>
