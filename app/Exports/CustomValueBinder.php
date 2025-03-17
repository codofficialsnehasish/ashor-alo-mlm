<?php
namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class CustomValueBinder extends DefaultValueBinder implements WithCustomValueBinder
{
    public function bindValue(Cell $cell, $value)
    {
        // Force text format for account numbers
        if (is_numeric($value) && strlen((string) $value) > 10) {
            $cell->setValueExplicit((string) $value, DataType::TYPE_STRING);
            return true;
        }

        // Default behavior for other values
        return parent::bindValue($cell, $value);
    }
}
