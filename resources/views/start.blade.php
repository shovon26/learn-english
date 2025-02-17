<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SpeakEra AI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        /* Container to ensure full image visibility */
        .image-container {
            width: 100%;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        /* Full-height Image */
        .home-image {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Floating Button */
        .btn-float {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #e91e63;
            color: white;
            padding: 12px 30px;
            font-size: 18px;
            border-radius: 30px;
            text-decoration: none;
            transition: 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-float:hover {
            background-color: #d81b60;
            transform: translateX(-50%) scale(1.05);
        }
    </style>
</head>
<body>

<!-- Full Image with Scroll -->
<div class="image-container">
    <img src="{{ \App\Helpers\asset('/img/start.png') }}" class="home-image" alt="SpeakEra AI Homepage">
</div>

<!-- Floating Button -->
<a href="/speak-ai-agent" id="startConversationBtn" class="btn btn-float d-none"></a>
@include('includes.footer')
</body>
</html>

<script>
    document.addEventListener('keydown', function(event) {
        if (event.key === "Enter") {
            // Optionally, you could check if a specific element is in focus or some condition is met.
            // For now, we'll just redirect when Enter is pressed.
            var startButton = document.getElementById('startConversationBtn');
            if (startButton) {
                window.location.href = startButton.getAttribute('href');
            }
        }
    });
</script>
