@extends('layouts.app')
@section('title', 'SpeakEra AI')
@section('styles')
    <style>
        /*.speech-container {*/
        /*    text-align: center;*/
        /*    padding: 40px;*/
        /*}*/
        /*.voice-btn {*/
        /*    background-color: #007bff;*/
        /*    border: none;*/
        /*    color: white;*/
        /*    padding: 15px 20px;*/
        /*    font-size: 18px;*/
        /*    cursor: pointer;*/
        /*    border-radius: 8px;*/
        /*    width: 20%;*/
        /*}*/
        /*.voice-btn:hover {*/
        /*    background-color: #0056b3;*/
        /*}*/
        /*#transcription {*/
        /*    font-size: 18px;*/
        /*    margin-top: 20px;*/
        /*    font-weight: bold;*/
        /*    color: #333;*/
        /*}*/
        /*#ai-response {*/
        /*    font-size: 18px;*/
        /*    margin-top: 20px;*/
        /*    font-weight: bold;*/
        /*    color: green;*/
        /*}*/
        /*.response-section{*/
        /*    background-color: #b3aeae;*/
        /*    height: 600px;*/
        /*    overflow-y: auto;*/
        /*    padding: 10px;*/
        /*}*/
        .speech-container {
            text-align: center;
            padding: 40px;
        }
        .voice-btn {
            background-color: #e9d365;
            border: none;
            color: #f70066;
            padding: 15px 20px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 8px;
            width: 20%;
            transition: background-color 0.3s ease;
        }
        .voice-btn:hover {
            /*background-color: #d81b60;*/
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
        .response-section {
            background-color: #b3aeae;
            height: auto;
            overflow-y: auto;
            padding: 10px;
        }
        /* Timer styling */
        #timer {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
            margin-bottom: 10px;
        }
        .ai-message{
            color: black;
            font-size: 20px;
            font-weight: 600;
        }
        .user-message{
            color: #f70066;
            font-size: 20px;
        }
    </style>
@stop

@section('content')
<div class="container speech-container" style="height: 1000px">
    <div class="card" style="height: 960px">
        <div class="d-flex flex-column justify-content-center align-items-center" style="height: 350px; margin-bottom: 20px; background-color: #f70066;">
            <!-- Timer Display -->
            <div id="timer">10:00</div>
            <h1 class="" style="color: white">Speak with SpeakEra AI</h1>
            <p class="" style="color: white">Click the button and start speaking. AI will respond in voice.</p>
            <!-- Speak Now Button -->
            <button class="voice-btn" id="startSpeech">🎤 Speak Now</button>
        </div>
        <div class="response-section" id="response-section" style="display: none">
{{--            <p id="transcription"></p>--}}
{{--            <p id="ai-response"></p>--}}
        </div>
        <audio id="aiAudio" controls style="display:none;"></audio>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let conversation = [];

            // --- Timer Countdown (10 minutes) ---
            let totalSeconds = 600; // 10 minutes = 600 seconds
            function updateTimer() {
                let minutes = Math.floor(totalSeconds / 60);
                let seconds = totalSeconds % 60;
                seconds = seconds < 10 ? '0' + seconds : seconds;
                $('#timer').text(minutes + ":" + seconds);
                if (totalSeconds > 0) {
                    totalSeconds--;
                }
            }
            // Update timer every second
            setInterval(updateTimer, 1000);

            // --- Function to Update Conversation Display ---
            function updateConversationDisplay() {
                let htmlContent = '';
                conversation.forEach(function(message) {
                    if (message.startsWith("You said:")) {
                        htmlContent += '<p class="user-message">' + message + '</p>';
                    } else if (message.startsWith("AI:")) {
                        htmlContent += '<p class="ai-message">' + message + '</p>';
                    }
                });
                $('.response-section').html(htmlContent);
                // Auto-scroll to the bottom of the conversation
                $('.response-section').scrollTop($('.response-section')[0].scrollHeight);
            }

            // --- Speech Recognition Setup ---
            let recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
            recognition.lang = 'en-US';
            recognition.interimResults = false;
            recognition.continuous = false;

            let isProcessing = false; // Prevent multiple triggers
            const maxDuration = 7000; // Maximum voice input duration (in milliseconds)
            const cooldownTime = 3000; // Cooldown time before next call (in milliseconds)

            // Store the original button HTML to revert later.
            const originalBtnHTML = $('#startSpeech').html();

            $('#startSpeech').click(function() {
                if (isProcessing) {
                    console.log("Please wait before starting again...");
                    return;
                }

                isProcessing = true;
                // Replace button content with dynamic icon (icon.png)
                $('#startSpeech').html('<img src="{{ \App\Helpers\asset("/img/icon.png") }}" alt="Recording" style="height:70px; background-color: #000000;">');

                recognition.start();
                console.log("Speech recognition started.");

                // Stop recognition automatically after maxDuration
                setTimeout(() => {
                    recognition.stop();
                    console.log("Max duration reached, stopping recognition.");
                }, maxDuration);
            });

            recognition.onresult = function(event) {
                let userSpeech = event.results[0][0].transcript;
                let userMsg = "You said: " + userSpeech;
                conversation.push(userMsg);
                if(conversation.length > 0){
                    console.log("ENtered in the display conversationss");
                    // document.getElementById("response-section").style.display = "block";
                    $("#response-section").show();
                }
                updateConversationDisplay();
                console.log({ userSpeech });

                // Send the recognized text to your Laravel backend for processing
                $.ajax({
                    url: '/api/process-voice',
                    type: 'POST',
                    data: JSON.stringify({ text: userSpeech }),
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        let aiMsg = "AI: " + response.reply;
                        conversation.push(aiMsg);
                        updateConversationDisplay();
                        speakAIResponse(response.reply);
                    }
                });

                // After cooldownTime, allow new speech input and revert the button
                setTimeout(() => {
                    isProcessing = false;
                    $('#startSpeech').html(originalBtnHTML);
                    console.log("Cooldown finished, ready for next input.");
                }, cooldownTime);
            };

            recognition.onend = function() {
                console.log("Speech recognition ended.");
                isProcessing = false;
                // Revert button if not already done by cooldown handler
                $('#startSpeech').html(originalBtnHTML);
            };

            recognition.onerror = function(event) {
                console.error("Speech recognition error:", event.error);
                isProcessing = false;
                $('#startSpeech').html(originalBtnHTML);
            };

            function speakAIResponse(text) {
                let speech = new SpeechSynthesisUtterance(text);
                speech.lang = 'en-US';
                speech.rate = 1;

                speech.onstart = () => console.log("Speech started");
                speech.onend = () => console.log("Speech ended");
                speech.onerror = (event) => console.error("Speech error:", event);

                window.speechSynthesis.cancel(); // Stop any ongoing speech synthesis
                setTimeout(() => {
                    window.speechSynthesis.speak(speech);
                }, 100); // Slight delay to handle Chrome issues

                console.log("Speaking:", text);
            }
        });
    </script>
@stop

