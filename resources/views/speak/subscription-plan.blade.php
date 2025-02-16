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
    </style>
@stop

@section('content')
    <div class="container speech-container" style="min-height: 1000px">
        <div class="card d-flex justify-content-center align-items-center" style="min-height: 800px">

        </div>
    </div>
@endsection

@section('scripts')
    <script>

    </script>
@stop

