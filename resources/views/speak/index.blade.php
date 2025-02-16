@extends('layouts.app')
@section('title', 'SpeakEra AI')
@section('styles')
    <style>
        .speech-container {
            text-align: center;
            padding: 40px;
        }
        .voice-btn {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 15px 20px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 8px;
            width: 20%;
        }
        .voice-btn:hover {
            background-color: #0056b3;
        }
        #transcription {
            font-size: 18px;
            margin-top: 20px;
            font-weight: bold;
            color: #333;
        }
        #ai-response {
            font-size: 18px;
            margin-top: 20px;
            font-weight: bold;
            color: green;
        }
        .response-section{
            background-color: #b3aeae;
            height: 600px;
            overflow-y: auto;
            padding: 10px;
        }
    </style>
@stop

@section('content')
    <div class="container speech-container" style="height: 1000px">
        <div class="card" style="height: 1000px">
            <div class="d-flex justify-content-center align-items-center flex-column" style="height: 350px; margin-bottom: 20px">
                <h1 class="text-muted">Speak with SpeakEra AI</h1>
                <p class="text-muted">Click the button and start speaking. AI will respond in voice.</p>
                <button class="voice-btn" id="startSpeech">🎤 Speak Now</button>
            </div>
            <div class="response-section">
                <p id="transcription"></p>
                <p id="ai-response"></p>
            </div>

            <audio id="aiAudio" controls style="display:none;"></audio>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
            recognition.lang = 'en-US';
            recognition.interimResults = false;
            recognition.continuous = false;

            let isProcessing = false; // Prevent multiple triggers
            const maxDuration = 7000; // Max time for voice input (in milliseconds)
            const cooldownTime = 3000; // Gap time before next call (in milliseconds)

            $('#startSpeech').click(function() {
                if (isProcessing) {
                    console.log("Please wait before starting again...");
                    return;
                }

                isProcessing = true; // Block new calls
                recognition.start();
                console.log("Speech recognition started.");

                // Stop recognition after `maxDuration`
                setTimeout(() => {
                    recognition.stop();
                    console.log("Max duration reached, stopping recognition.");
                }, maxDuration);
            });

            recognition.onresult = function(event) {
                let userSpeech = event.results[0][0].transcript;
                $('#transcription').text("You said: " + userSpeech);
                console.log({ userSpeech });

                // Send text to Laravel backend for AI processing
                $.ajax({
                    url: '/api/process-voice',
                    type: 'POST',
                    data: JSON.stringify({ text: userSpeech }),
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#ai-response').text("AI: " + response.reply);
                        speakAIResponse(response.reply);
                    }
                });

                // Apply cooldown before next input
                setTimeout(() => {
                    isProcessing = false; // Allow next recognition after cooldown
                    console.log("Cooldown finished, ready for next input.");
                }, cooldownTime);
            };

            recognition.onend = function() {
                console.log("Speech recognition ended.");
                isProcessing = false; // Reset flag if recognition ends naturally
            };

            recognition.onerror = function(event) {
                console.error("Speech recognition error:", event.error);
                isProcessing = false; // Reset flag on error
            };

            function speakAIResponse(text) {
                let speech = new SpeechSynthesisUtterance(text);
                speech.lang = 'en-US';
                speech.rate = 1;

                speech.onstart = () => console.log("Speech started");
                speech.onend = () => console.log("Speech ended");
                speech.onerror = (event) => console.error("Speech error:", event);

                window.speechSynthesis.cancel(); // Stop any ongoing speech
                setTimeout(() => {
                    window.speechSynthesis.speak(speech);
                }, 100); // Slight delay for Chrome issues

                console.log("Speaking:", text);
            }

        });
    </script>
@stop

