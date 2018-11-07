<?php

namespace App\Exports;

use App\Models\Package;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
class PackageExport implements FromQuery, WithHeadings, WithMapping, WithTitle, ShouldAutoSize,WithEvents
{
    use Exportable;
    private $where;

    public function __construct($where)
    {
        $this->where = $where;
    }

    public function headings(): array
    {
        return ['物流单号', '物流公司', '包裹类型', '包裹数量', '签收数量', '创建时间', '签收时间', '签收人', '状态', '确认状态','备注'];
    }

    public function query()
    {
        return Package::query()->with([
            'logisticsCompany',
            'receiveUser'
        ])->filter($this->where);
    }

    public function map($item): array
    {
        return [
            ','.$item->logistics_tracking_number,
            $item->logisticsCompany->logistics_company_name,
            Package::$typeMap[$item->type],
            $item->package_quantity,
            $item->receive_quantity,
            $item->created_at,
            $item->received_at,
            $item->receive_user_id? $item->receiveUser->name :'',
            Package::$statusMap[$item->status],
            Package::$markSureMap[$item->mark_sure],
            $item->remark,
        ];
    }

    public function title(): string
    {
        return '包裹列表';
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $columns = ['A'];
                for ($i = 1; $i <= $event->sheet->getHighestRow(); $i++) {
                    foreach ($columns as $column) {
                        $event->sheet->setCellValueExplicit($column . $i,
                            ltrim($event->sheet->getCell($column . $i), ','),
                            DataType::TYPE_STRING);
                    }
                }
            },
        ];
    }
}
