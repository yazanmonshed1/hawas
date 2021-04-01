<?php

namespace App\Widgets;

use App\Models\Platform\LastPageEntered as PlatformLastPageEntered;
use Arrilot\Widgets\AbstractWidget;

class LastPageEntered extends AbstractWidget
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
        $lastPageEntered = PlatformLastPageEntered::where('user_id', auth()->user()->id)->first();

        if ($lastPageEntered) {
            $pageData = [
                'title' => $lastPageEntered->book->title,
                'subtitle' => $lastPageEntered->bookContent->title,
                'page_number' => $lastPageEntered->bookContent->page_number,
                'image' => $lastPageEntered->book->cover_image
            ];
        }

        return view('widgets.last_page_entered', [
            'page' => isset($pageData) ? $pageData : null,
        ]);
    }
}
