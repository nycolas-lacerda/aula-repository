<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Lesson;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(): View
    {
        $reviews = Review::with(['lesson.teacher', 'reviewer'])
            ->latest()
            ->paginate(10);

        return view('reviews.index', compact('reviews'));
    }

    public function create(): View
    {
        return view('reviews.create', [
            'lessons' => Lesson::with('teacher')
                ->where('status', 'submitted')
                ->orderByDesc('submitted_at')
                ->get(),
        ]);
    }

    public function store(StoreReviewRequest $request): RedirectResponse
    {
        $lesson = Lesson::findOrFail($request->validated('lesson_id'));
        $this->ensureSubmitted($lesson);

        Review::create([
            'lesson_id' => $lesson->id,
            'reviewer_id' => $request->user()->id,
            'status' => $request->validated('status'),
            'comments' => $request->validated('comments'),
        ]);

        $lesson->update([
            'status' => $request->validated('status') === 'approved' ? 'approved' : 'rejected',
            'approved_at' => $request->validated('status') === 'approved' ? now() : null,
        ]);

        return redirect()
            ->route('reviews.index')
            ->with('success', 'Revisão registrada com sucesso.');
    }

    public function show(Review $review): View
    {
        $review->load(['lesson.teacher', 'reviewer']);

        return view('reviews.show', compact('review'));
    }

    public function edit(Review $review): View
    {
        $review->load(['lesson.teacher', 'reviewer']);

        $lessons = Lesson::with('teacher')
            ->where('status', 'submitted')
            ->orderByDesc('submitted_at')
            ->get();

        if (! $lessons->contains('id', $review->lesson_id)) {
            $lessons->prepend($review->lesson);
        }

        return view('reviews.edit', [
            'review' => $review,
            'lessons' => $lessons,
        ]);
    }

    public function update(UpdateReviewRequest $request, Review $review): RedirectResponse
    {
        $lesson = Lesson::findOrFail($request->validated('lesson_id'));
        $this->ensureSubmitted($lesson);

        $review->update([
            'lesson_id' => $lesson->id,
            'status' => $request->validated('status'),
            'comments' => $request->validated('comments'),
        ]);

        $lesson->update([
            'status' => $request->validated('status') === 'approved' ? 'approved' : 'rejected',
            'approved_at' => $request->validated('status') === 'approved' ? now() : null,
        ]);

        return redirect()
            ->route('reviews.index')
            ->with('success', 'Revisão atualizada com sucesso.');
    }

    public function destroy(Review $review): RedirectResponse
    {
        $lesson = $review->lesson;
        $review->delete();

        if ($lesson) {
            $lesson->update([
                'status' => 'submitted',
                'approved_at' => null,
            ]);
        }

        return redirect()
            ->route('reviews.index')
            ->with('success', 'Revisão removida com sucesso.');
    }

    private function ensureSubmitted(Lesson $lesson): void
    {
        if ($lesson->status !== 'submitted') {
            throw ValidationException::withMessages([
                'lesson_id' => 'A aula precisa estar submetida para revisão.',
            ]);
        }
    }
}
