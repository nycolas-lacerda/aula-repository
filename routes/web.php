<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LessonExportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SubjectController;
use App\Models\Activity;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\Review;
use App\Models\Subject;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return view('dashboard.admin', [
                'stats' => [
                    'disciplinas' => Subject::count(),
                    'series' => Grade::count(),
                    'atividades' => Activity::count(),
                    'aulas' => Lesson::count(),
                    'revisoes' => Review::count(),
                ],
            ]);
        }

        if ($user->hasRole('coordinator')) {
            return view('dashboard.coordinator', [
                'submittedLessons' => Lesson::with('teacher', 'grade')
                    ->where('status', 'submitted')
                    ->latest('submitted_at')
                    ->get(),
                'reviews' => Review::with('lesson.teacher')
                    ->latest()
                    ->limit(5)
                    ->get(),
            ]);
        }

        return view('dashboard.teacher', [
            'lessons' => Lesson::with('grade', 'activities')
                ->where('teacher_id', $user->id)
                ->latest()
                ->limit(5)
                ->get(),
            'activities' => Activity::with('subject', 'grade')
                ->where('created_by', $user->id)
                ->latest()
                ->limit(5)
                ->get(),
        ]);
    })->name('dashboard');

    Route::resource('subjects', SubjectController::class)->middleware(['role:admin']);
    Route::resource('grades', GradeController::class)->middleware(['role:admin']);
    Route::resource('activities', ActivityController::class)->middleware(['role:admin|teacher']);
    Route::get('activity-files/{activityFile}', [ActivityController::class, 'showFile'])
        ->name('activity-files.show')
        ->middleware(['auth']);
    Route::post('lessons/{lesson}/submit', [LessonController::class, 'submit'])->name('lessons.submit')->middleware(['role:admin|teacher']);
    Route::resource('lessons', LessonController::class)->middleware(['role:admin|teacher']);
    Route::get('/lessons/{lesson}/preview/pdf', [LessonExportController::class, 'previewPdf'])->name('lessons.preview.pdf');
    Route::get('/lessons/{lesson}/export/pdf', [LessonExportController::class, 'pdf'])->name('lessons.export.pdf');
    Route::get('/lessons/{lesson}/export/docx', [LessonExportController::class, 'docx'])->name('lessons.export.docx');
    Route::resource('reviews', ReviewController::class)->middleware(['role:admin|coordinator']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
