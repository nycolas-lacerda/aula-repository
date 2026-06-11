<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\ActivityFile;
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ActivityController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $activities = Activity::with(['subject', 'grade', 'creator'])
            ->when(
                $user?->hasRole('teacher') && ! $user?->hasRole('admin'),
                fn ($query) => $query->where('created_by', $user->id)
            )
            ->latest()
            ->paginate(10);

        return view('activities.index', compact('activities'));
    }

    public function create(): View
    {
        return view('activities.create', [
            'subjects' => Subject::orderBy('name')->get(),
            'grades' => Grade::orderBy('name')->get(),
        ]);
    }

    public function store(StoreActivityRequest $request): RedirectResponse
    {
        $activity = Activity::create([
            ...$request->validated(),
            'created_by' => $request->user()->id,
        ]);

        $this->storeFiles($activity, $request->file('files', []));

        return redirect()
            ->route('activities.index')
            ->with('success', 'Atividade cadastrada com sucesso.');
    }

    public function show(Activity $activity): View
    {
        $this->ensureOwnerOrAdmin($activity);

        $activity->load(['subject', 'grade', 'creator', 'files', 'lessons.teacher']);

        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity): View
    {
        $this->ensureOwnerOrAdmin($activity);

        $activity->load('files');

        return view('activities.edit', [
            'activity' => $activity,
            'subjects' => Subject::orderBy('name')->get(),
            'grades' => Grade::orderBy('name')->get(),
        ]);
    }

    public function update(UpdateActivityRequest $request, Activity $activity): RedirectResponse
    {
        $this->ensureOwnerOrAdmin($activity);

        $activity->update($request->validated());

        $this->storeFiles($activity, $request->file('files', []));

        return redirect()
            ->route('activities.index')
            ->with('success', 'Atividade atualizada com sucesso.');
    }

    public function destroy(Activity $activity): RedirectResponse
    {
        $this->ensureOwnerOrAdmin($activity);

        $activity->load('files');

        foreach ($activity->files as $file) {
            Storage::disk('public')->delete($file->file_path);
        }

        $activity->delete();

        return redirect()
            ->route('activities.index')
            ->with('success', 'Atividade removida com sucesso.');
    }

    public function showFile(ActivityFile $activityFile)
    {
        $activity = $activityFile->activity()->first();

        abort_unless($activity, 404);
        $this->ensureOwnerOrAdmin($activity);
        abort_unless(Storage::disk('public')->exists($activityFile->file_path), 404);

        return response()->file(
            Storage::disk('public')->path($activityFile->file_path),
            [
                'Content-Disposition' => 'inline; filename="'.$activityFile->file_name.'"',
            ]
        );
    }

    private function storeFiles(Activity $activity, array $files): void
    {
        foreach ($files as $file) {
            $path = $file->store('activity-files', 'public');

            ActivityFile::create([
                'activity_id' => $activity->id,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => $file->getMimeType(),
            ]);
        }
    }

    private function ensureOwnerOrAdmin(Activity $activity): void
    {
        $user = auth()->user();

        if ($user?->hasRole('admin')) {
            return;
        }

        abort_unless($activity->created_by === $user?->id, 403);
    }
}
