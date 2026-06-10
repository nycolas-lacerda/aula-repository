<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::latest()->paginate(10);

        return view(
            'subjects.index',
            compact('subjects')
        );
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(
        StoreSubjectRequest $request
    ) {

        Subject::create(
            $request->validated()
        );

        return redirect()
            ->route('subjects.index')
            ->with(
                'success',
                'Disciplina cadastrada.'
            );
    }

    public function edit(
        Subject $subject
    ) {
        return view(
            'subjects.edit',
            compact('subject')
        );
    }

    public function update(
        UpdateSubjectRequest $request,
        Subject $subject
    ) {

        $subject->update(
            $request->validated()
        );

        return redirect()
            ->route('subjects.index')
            ->with(
                'success',
                'Disciplina atualizada.'
            );
    }

    public function destroy(
        Subject $subject
    ) {

        $subject->delete();

        return redirect()
            ->route('subjects.index')
            ->with(
                'success',
                'Disciplina removida.'
            );
    }
}