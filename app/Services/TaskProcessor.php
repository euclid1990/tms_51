<?php

namespace App\Services;

use App\Models\Task;

class TaskProcessor
{
    public function tasks($name, $description)
    {
        $count = count($name);
        $items = [];
        for ($i = 0; $i < $count; $i ++) {
            $item = new Task();
            $item->name = $name[$i];
            $item->description = $description[$i];
            $items[] = $item;
        }
        return $items;
    }
}
