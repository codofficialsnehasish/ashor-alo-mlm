<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Ashor Alo</title>
    <!-- External CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css/animate.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 2;
        }
        header span {
            font-size: 2rem;
        }
        header button {
            font-size: 1rem;
            background-color: transparent;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .logout-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #c62828;
        }

        .container {
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
        }
        h1 {
            color: #333;
            font-size: 3rem;
        }
        p {
            color: #666;
            font-size: 1.5rem;
        }
        .confetti {
            position: absolute;
            top: 70px; /* Adjust according to the header height */
            left: 0;
            width: 100%;
            height: calc(100% - 70px); /* Adjust according to the header height */
            pointer-events: none;
            z-index: 0;
        }
        .confetti__particle {
            position: absolute;
            background-color: #f6c026;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            opacity: 0.7;
            transform: rotate(45deg);
            animation: confetti 3s ease-in-out infinite;
        }
        @keyframes confetti {
            0% { transform: translateY(-50px) rotate(45deg); }
            100% { transform: translateY(100vh) rotate(45deg); }
        }
    </style>
</head>
<body>
    <header>
        @auth
        <span>{{ Auth::user()->name }}</span>
        <a href="{{ url('/site-logout') }}" class="logout-button" style="margin-right: 50px;">Logout</a>
        @endauth
    </header>
    <div class="container">
        <h1>Welcome to Ashor Alo</h1>
        <p>Your source for enlightening news</p>
    </div>

    <!-- Confetti -->
    <div class="confetti">
        <!-- Generate confetti particles using JavaScript -->
    </div>

    <!-- External JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // Generate confetti particles
        for (let i = 0; i < 100; i++) {
            let particle = document.createElement('div');
            particle.className = 'confetti__particle';
            particle.style.left = Math.random() * window.innerWidth + 'px';
            particle.style.animationDelay = Math.random() * 3 + 's';
            document.querySelector('.confetti').appendChild(particle);
        }

        function logout() {
            // Your logout logic goes here
            alert('Logged out');
        }
    </script>
</body>
</html>
