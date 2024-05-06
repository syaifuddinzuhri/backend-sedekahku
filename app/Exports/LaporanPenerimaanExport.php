<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Contracts\View\View;

class LaporanPenerimaanExport implements FromView
{
    protected $data;
    protected $payload;

    public function __construct($data,  $payload)
    {
        $this->data = $data;
        $this->payload = $payload;
    }

    public function view(): View
    {
        return view('report.laporan', [
            'data' => $this->data,
            'payload' => $this->payload,
        ]);
    }


    // public function getData($data)
    // {
    //     $arr = [];
    //     $no = 1;
    //     foreach ($data as $key => $val) {
    //         $arr[$key]['no'] = $no++;
    //         $arr[$key]['program'] = $val['name'];
    //         $arr[$key]['total'] = $val['total'];
    //     }
    //     return $arr;
    // }

    // /**
    //  * Membuat header pada konten excel
    //  *
    //  * @return array
    //  */
    // public function headings(): array
    // {
    //     return [
    //         'No.',
    //         'Program',
    //         'Total Sedekah',
    //     ];
    // }

    // /**
    //  * Taruh array user pada konten excel
    //  *
    //  * @return array
    //  */
    // public function array(): array
    // {
    //     return $this->data;
    // }

    // /**
    //  * Beri nama pada sheet
    //  *
    //  * @return string
    //  */
    // public function title(): string
    // {
    //     return 'Laporan Penerimaan';
    // }
}
