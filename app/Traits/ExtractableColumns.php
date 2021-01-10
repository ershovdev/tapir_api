<?php

namespace App\Traits;

trait ExtractableColumns
{
    public function getColumns()
    {
        return array_column($this->toArray());
    }
}
