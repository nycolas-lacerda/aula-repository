<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::latest()->paginate(10);

        return view('grades.index', compact('grades'));
    }

    public function create()
    {
        return view('grades.create');
    }

    public function store(StoreGradeRequest $request)
    {
        Grade::create(
            $request->validated()
        );

        return redirect()
            ->route('grades.index')
            ->with(
                'success',
                'Série cadastrada com sucesso.'
            );
    }

    public function edit(Grade $grade)
    {
        return view(
            'grades.edit',
            compact('grade')
        );
    }

    public function show(Grade $grade)
    {
        return redirect()
            ->route('grades.edit', $grade);
    }

    public function update(
        UpdateGradeRequest $request,
        Grade $grade
    ) {
        $grade->update(
            $request->validated()
        );

        return redirect()
            ->route('grades.index')
            ->with(
                'success',
                'Série atualizada com sucesso.'
            );
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();

        return redirect()
            ->route('grades.index')
            ->with(
                'success',
                'Série removida com sucesso.'
            );
    }
}