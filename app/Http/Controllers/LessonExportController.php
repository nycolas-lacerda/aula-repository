<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class LessonExportController extends Controller
{
    public function previewPdf(Lesson $lesson)
    {
        $lesson->load([
            'teacher',
            'grade',
            'activities.files'
        ]);

        $pdf = Pdf::loadView(
            'exports.lesson-pdf',
            compact('lesson')
        );

        return $pdf->stream(
            'preview.pdf'
        );
    }
    
    public function pdf(Lesson $lesson)
    {
        $lesson->load([
            'teacher',
            'grade',
            'activities.subject',
            'activities.files',
        ]);

        $pdf = Pdf::loadView(
            'exports.lesson-pdf',
            compact('lesson')
        );

        return $pdf->download(
            'plano-aula-' . $lesson->id . '.pdf'
        );
    }

    public function docx(Lesson $lesson)
    {
        $lesson->load('activities');

        $phpWord = new PhpWord();

        $section = $phpWord->addSection();

        $section->addTitle(
            $lesson->title,
            1
        );

        $section->addText(
            'Objetivo: ' . $lesson->objective
        );

        foreach ($lesson->activities as $activity) {

            $section->addTitle(
                $activity->title,
                2
            );

            $section->addText(
                $activity->description
            );

            $section->addText(
                strip_tags($activity->content)
            );
            foreach ($activity->files as $file) {
                $imagePath = storage_path(
                    'app/public/' . $file->file_path
                );

                if (file_exists($imagePath)) {
                    $section->addImage(
                        $imagePath,
                        [
                            'width' => 400,
                            'keepRatio' => true,
                        ]
                    );
                }
            }
        }

        $fileName =
            storage_path(
                'app/temp/plano-' . $lesson->id . '.docx'
            );

        if (! file_exists(dirname($fileName))) {
            mkdir(dirname($fileName), 0755, true);
        }

        IOFactory::createWriter(
            $phpWord,
            'Word2007'
        )->save($fileName);

        return response()->download(
            $fileName
        )->deleteFileAfterSend();
    }
}
