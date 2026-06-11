<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Models\Activity;
use App\Models\Grade;
use App\Models\Lesson;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LessonController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $lessons = Lesson::with(['teacher', 'grade', 'activities'])
            ->when(
                $user?->hasRole('teacher') && ! $user?->hasRole('admin'),
                fn ($query) => $query->where('teacher_id', $user->id)
            )
            ->latest()
            ->paginate(10);

        return view('lessons.index', compact('lessons'));
    }

    public function create(): View
    {
        return view('lessons.create', [
            'grades' => Grade::orderBy('name')->get(),
            'activities' => $this->availableActivities(),
        ]);
    }

    public function store(StoreLessonRequest $request): RedirectResponse
    {
        $lesson = Lesson::create([
            'title' => $request->validated('title'),
            'objective' => $request->validated('objective'),
            'grade_id' => $request->validated('grade_id'),
            'teacher_id' => $request->user()->id,
            'status' => 'draft',
        ]);

        $this->syncActivities($lesson, $request->validated('activities', []));

        return redirect()
            ->route('lessons.edit', $lesson)
            ->with('success', 'Aula criada como rascunho.');
    }

    public function show(Lesson $lesson): View
    {
        $this->ensureOwnerOrAdmin($lesson);

        $lesson->load(['teacher', 'grade', 'activities.subject', 'reviews.reviewer']);

        return view('lessons.show', compact('lesson'));
    }

    public function edit(Lesson $lesson): View
    {
        $this->ensureOwnerOrAdmin($lesson);

        $lesson->load('activities');

        return view('lessons.edit', [
            'lesson' => $lesson,
            'grades' => Grade::orderBy('name')->get(),
            'activities' => $this->availableActivities(),
        ]);
    }

    public function update(UpdateLessonRequest $request, Lesson $lesson): RedirectResponse
    {
        $this->ensureOwnerOrAdmin($lesson);

        $lesson->update([
            'title' => $request->validated('title'),
            'objective' => $request->validated('objective'),
            'grade_id' => $request->validated('grade_id'),
            'status' => 'draft',
            'submitted_at' => null,
            'approved_at' => null,
        ]);

        $this->syncActivities($lesson, $request->validated('activities', []));

        return redirect()
            ->route('lessons.index')
            ->with('success', 'Aula atualizada e retornada para rascunho.');
    }

    public function submit(Lesson $lesson): RedirectResponse
    {
        $this->ensureOwnerOrAdmin($lesson);

        if ($lesson->activities()->count() === 0) {
            return back()->withErrors([
                'activities' => 'Associe ao menos uma atividade antes de submeter.',
            ]);
        }

        $lesson->update([
            'status' => 'submitted',
            'submitted_at' => now(),
            'approved_at' => null,
        ]);

        return redirect()
            ->route('lessons.show', $lesson)
            ->with('success', 'Aula enviada para revisão.');
    }

    public function destroy(Lesson $lesson): RedirectResponse
    {
        $this->ensureOwnerOrAdmin($lesson);

        $lesson->reviews()->delete();
        $lesson->activities()->detach();
        $lesson->delete();

        return redirect()
            ->route('lessons.index')
            ->with('success', 'Aula removida com sucesso.');
    }

    private function availableActivities()
    {
        $user = auth()->user();

        return Activity::with('subject', 'grade')
            ->when(
                $user?->hasRole('teacher') && ! $user?->hasRole('admin'),
                fn ($query) => $query->where(function ($query) use ($user) {
                    $query->where('status', 'published')
                        ->orWhere('created_by', $user->id);
                })
            )
            ->orderBy('title')
            ->get();
    }

    private function syncActivities(Lesson $lesson, array $activityIds): void
    {
        $lesson->activities()->sync(
            collect($activityIds)
                ->values()
                ->mapWithKeys(fn ($activityId, $position) => [
                    $activityId => ['position' => $position + 1],
                ])
                ->all()
        );
    }

    private function ensureOwnerOrAdmin(Lesson $lesson): void
    {
        $user = auth()->user();

        if ($user?->hasRole('admin')) {
            return;
        }

        abort_unless($lesson->teacher_id === $user?->id, 403);
    }
}
