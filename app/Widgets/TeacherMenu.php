<?php

namespace App\Widgets;

use App\Models\DigitalBook;
use Arrilot\Widgets\AbstractWidget;

class TeacherMenu extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $grade = auth('teacher')->user()->grade;
        
        return view('widgets.teacher_menu', [
            'books' => $grade ? $grade->books : null,
        ]);
    }
}
