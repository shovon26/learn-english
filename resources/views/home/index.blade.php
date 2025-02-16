@extends('layouts.app')
@section('title', 'SpeakEra AI')

@section('styles')
    <style>
        .hero-section {
            background: linear-gradient(to right, #1e3c72, #2a5298);
            color: white;
            text-align: center;
            padding: 60px 20px;
            border-radius: 10px;
        }

        .feature-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .voice-input {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .voice-btn {
            background-color: #ff7f50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1.2rem;
            border-radius: 50px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .voice-btn:hover {
            background-color: #ff6347;
        }
    </style>
@stop

@section('content')
    <div class="container py-4" style="min-height: 1000px">
        <!-- Hero Section -->
        <div class="hero-section">
            <h1>Welcome to SpeakEra AI</h1>
            <p>Your AI-powered assistant for mastering spoken English</p>
            <button class="voice-btn" id="startSpeech" onclick="window.location.href='{{url('/speak-ai-agent')}}'">🎤 Speak Now</button>
            <p id="transcription" class="mt-3"></p>
        </div>

        <!-- Features Section -->
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card feature-card p-3">
                    <h4>🎤 Voice Communication & Feedback</h4>
                    <p>Get real-time feedback on pronunciation, fluency, and grammar.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card p-3">
                    <h4>🗣️ Real-Time Conversation</h4>
                    <p>Engage in AI-powered conversations to improve English speaking skills.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card p-3">
                    <h4>📅 Task Scheduling & Exams</h4>
                    <p>Practice with AI-scheduled tasks and take automated exams.</p>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card feature-card p-3">
                    <h4>📊 Progress Tracking</h4>
                    <p>Monitor your learning progress with detailed analytics.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card p-3">
                    <h4>🌎 AI-Powered Translation</h4>
                    <p>Translate content to your native language for better understanding.</p>
                </div>
            </div>
            <div class="col-md-4 cursor-pointer" onclick="window.location.href='{{url('/subscription-plan')}}'">
                <div class="card feature-card p-3">
                    <h4>💳 Purchase Plans</h4>
                    <p>Choose from different learning plans to suit your needs.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
            recognition.lang = 'en-US';
            recognition.interimResults = false;
            recognition.continuous = false;

            $('#startSpeech').on('click', function() {
                $('#transcription').text("Listening...");
                recognition.start();
            });

            recognition.onresult = function(event) {
                const speechResult = event.results[0][0].transcript;
                $('#transcription').text("You said: " + speechResult);
            };

            recognition.onerror = function(event) {
                $('#transcription').text("Error occurred: " + event.error);
            };
        });
    </script>
@stop
