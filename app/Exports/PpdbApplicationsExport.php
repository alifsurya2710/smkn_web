<?php

namespace App\Exports;

use App\Models\PpdbApplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PpdbApplicationsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $status;
    protected $search;
    protected $jalur;

    public function __construct($status = null, $search = null, $jalur = null)
    {
        $this->status = $status;
        $this->search = $search;
        $this->jalur  = $jalur;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = PpdbApplication::with('user')->latest();

        if ($this->status && $this->status !== 'all') {
            $query->where('status', $this->status);
        }

        if ($this->jalur && $this->jalur !== 'all') {
            $query->where('jalur_pendaftaran', $this->jalur);
        }

        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('parent_name', 'like', "%{$search}%")
                  ->orWhere('registration_number', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        return $query->get();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'No. Pendaftaran',
            'Nama Calon Murid',
            'Jalur Pendaftaran',
            'Biaya Pendaftaran',
            'Nama Orang Tua / Wali',
            'Nomor HP / WhatsApp',
            'Alamat Email',
            'NISN',
            'Pernah PAUD',
            'Status Pendaftaran',
            'Catatan / Alasan Penolakan',
            'Tanggal Pendaftaran',
        ];
    }

    /**
    * @var PpdbApplication $app
    * @return array
    */
    public function map($app): array
    {
        $statusText = match($app->status) {
            'approved' => 'Diterima (Approved)',
            'rejected' => 'Ditolak (Rejected)',
            default    => 'Menunggu Verifikasi (Pending)',
        };

        $jalurText = match($app->jalur_pendaftaran) {
            'yatim'        => 'Anak Yatim / Piatu (Gratis)',
            'kurang_mampu' => 'Kurang Mampu (Rp 50.000)',
            'prestasi'     => 'Berprestasi (Rp 100.000)',
            default        => 'Reguler (Rp 150.000)',
        };

        return [
            $app->registration_number,
            $app->full_name,
            $jalurText,
            $app->nominal_biaya ? 'Rp ' . number_format($app->nominal_biaya, 0, ',', '.') : 'Rp 0',
            $app->parent_name ?? '-',
            $app->phone,
            $app->email,
            $app->nisn ?? '-',
            $app->pernah_paud ? 'Ya (Pernah PAUD)' : 'Tidak (Belum Pernah)',
            $statusText,
            $app->catatan ?? '-',
            $app->created_at ? $app->created_at->format('d/m/Y H:i') : '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']], 'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '0D2461']
            ]],
        ];
    }
}
