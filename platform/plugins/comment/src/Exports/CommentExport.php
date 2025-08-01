<?php

namespace Botble\Comment\Exports;

use Botble\Comment\Enums\CommentStatusEnum;
use Botble\Table\Supports\TableExportHandler;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class CommentExport extends TableExportHandler
{
    /**
     * {@inheritDoc}
     */
    protected function afterSheet(AfterSheet $event)
    {
        parent::afterSheet($event);

        $totalRows = $this->collection->count() + 1;

        $event->sheet
            ->getDelegate()
            ->getStyle('B1:B' . $totalRows)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT);

        $event->sheet
            ->getDelegate()
            ->getStyle('C1:C' . $totalRows)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT);

        for ($index = 2; $index <= $totalRows; $index++) {
            $status = $event->sheet->getDelegate()
                ->getStyle('F' . $index)
                ->getFont()
                ->getColor();

            $value = $event->sheet->getDelegate()
                ->getCell('F' . $index)
                ->getValue();

            if ($value == CommentStatusEnum::READ) {
                $status->setARGB('1d9977');
            } else {
                $status->setARGB('dc3545');
            }

            $event->sheet
                ->getDelegate()
                ->getCell('F' . $index)
                ->setValue(CommentStatusEnum::getLabel($value));
        }
    }
}
