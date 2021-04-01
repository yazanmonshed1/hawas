<?php

namespace App\Widgets;

use App\Models\Play;
use App\Models\Program;
use Arrilot\Widgets\AbstractWidget;

class Navbar extends AbstractWidget
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
        $programs = Program::limit(3)->orderBy('id', 'DESC')->get();
        $plays = Play::where('type', 'play')->limit(3)->orderBy('id', 'DESC')->get();
        $films = Play::where('type', 'film')->limit(3)->orderBy('id', 'DESC')->get();

        return view('widgets.navbar', [
            'config' => $this->config,
            'programs' => $programs,
            'plays' => $plays,
            'films' => $films
        ]);
    }
}
