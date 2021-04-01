<?php

namespace App\Models\Secretary;

use App\NadConsole\Traits\NadsoftModelBase;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use NadsoftModelBase;

    protected $table = 'digital_books';

    protected $slug = 'digital_books';

    public function newQuery()
    {
        $secretary = auth('admin')->user();
        return $secretary->school->books();
    }
}
