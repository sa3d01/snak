<?php

namespace App\Observers;

use App\Child;

class ChildObserver
{
    public function deleting(Child $child)
    {
        $child->subscribes()->delete();
    }
}
