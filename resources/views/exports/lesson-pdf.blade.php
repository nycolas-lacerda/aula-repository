<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans;
        }

        h1 {
            text-align: center;
        }

        .section {
            margin-bottom: 20px;
        }

        .image-container {
            page-break-inside: avoid;
            text-align: center;
        }

        .image-container img {
            max-width: 170mm;
            max-height: 240mm;
        }
    </style>
</head>

<body>
    <h1>{{ $lesson->title }}</h1>
    <div class="section">
        <strong>Professor:</strong>
        {{ $lesson->teacher->name }}
    </div>
    <div class="section">
        <strong>Série:</strong>
        {{ $lesson->grade->name }}
    </div>
    <div class="section">
        <strong>Objetivo:</strong>
        {{ $lesson->objective }}
    </div>
    <h2>Atividades</h2>
    
    @foreach ($lesson->activities as $activity)
        <h3>{{ $activity->title }}</h3>
        <p>{{ $activity->description }}</p>
        <div>
            {!! nl2br(e($activity->content)) !!}
        </div>
        <div>
            @foreach ($activity->files as $file)
                <div class="image-container" style="margin-top:20px">
                    <img src="{{ storage_path('app/public/' . $file->file_path) }}"
                        style="display:block; margin:auto;">
                </div>
            @endforeach
        </div>
    @endforeach
</body>

</html>
