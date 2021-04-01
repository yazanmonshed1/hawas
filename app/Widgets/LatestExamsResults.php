<?php

namespace App\Widgets;

use App\Models\Platform\StudentExam;
use Arrilot\Widgets\AbstractWidget;

class LatestExamsResults extends AbstractWidget
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
        $examResults = StudentExam::where('user_id', auth()->user()->id)->orderBy('updated_at', 'DESC')->limit(3)->get();

        return view('widgets.latest_exams_results', [
            'config' => $this->config,
            'examResults' => $examResults
        ]);
    }
}
