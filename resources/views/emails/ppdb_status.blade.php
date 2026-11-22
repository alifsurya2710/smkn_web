<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran SPMB RA AL-IKHWAN</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f1f5f9; margin: 0; padding: 24px; color: #334155;">
    <div style="max-w: 600px; max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        
        <!-- Header -->
        <div style="background: linear-gradient(135deg, #0D2461 0%, #15803d 100%); padding: 32px 24px; text-align: center; color: #ffffff;">
            <h1 style="margin: 0; font-size: 22px; font-weight: 800; letter-spacing: -0.5px; text-transform: uppercase;">RA AL-IKHWAN</h1>
            <p style="margin: 6px 0 0 0; font-size: 13px; opacity: 0.9;">Seleksi Penerimaan Murid Baru (SPMB)</p>
        </div>

        <!-- Body -->
        <div style="padding: 32px 24px;">
            <p style="font-size: 15px; line-height: 1.6; margin-top: 0;">
                Yth. Bapak/Ibu <strong>{{ $application->parent_name ?? $application->user->name ?? 'Orang Tua / Wali' }}</strong>,
            </p>
            <p style="font-size: 14px; line-height: 1.6; color: #475569;">
                Terima kasih telah mendaftarkan ananda <strong>{{ $application->full_name }}</strong> di RA AL-IKHWAN. Berikut adalah informasi hasil verifikasi pendaftaran:
            </p>

            <!-- Card Status -->
            <div style="margin: 24px 0; padding: 20px; border-radius: 12px; {{ $application->status === 'approved' ? 'background-color: #f0fdf4; border: 1px solid #bbf7d0;' : 'background-color: #fef2f2; border: 1px solid #fecaca;' }}">
                <div style="text-align: center;">
                    <span style="display: inline-block; padding: 6px 16px; border-radius: 9999px; font-size: 12px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; {{ $application->status === 'approved' ? 'background-color: #16a34a; color: #ffffff;' : 'background-color: #dc2626; color: #ffffff;' }}">
                        {{ $application->status === 'approved' ? 'DITERIMA (APPROVED)' : 'BELUM DITERIMA / DITOLAK (REJECTED)' }}
                    </span>
                    <h2 style="font-size: 20px; font-weight: 700; margin: 12px 0 4px 0; {{ $application->status === 'approved' ? 'color: #166534;' : 'color: #991b1b;' }}">
                        {{ $application->status === 'approved' ? 'Selamat! Pendaftaran Diterima' : 'Mohon Maaf, Berkas Belum Sesuai' }}
                    </h2>
                    <p style="margin: 0; font-size: 13px; color: #64748b;">
                        Nomor Pendaftaran: <strong>{{ $application->registration_number }}</strong>
                    </p>
                </div>

                @if($application->status === 'rejected' && $application->catatan)
                <div style="margin-top: 18px; padding-top: 16px; border-top: 1px dashed #fca5a5;">
                    <p style="margin: 0 0 6px 0; font-size: 12px; font-weight: 700; color: #991b1b; text-transform: uppercase;">
                        Penjelasan / Alasan Penolakan:
                    </p>
                    <div style="font-size: 13px; line-height: 1.5; color: #7f1d1d; background: #ffffff; padding: 12px; border-radius: 8px; border: 1px solid #fee2e2;">
                        {{ $application->catatan }}
                    </div>
                    <p style="margin: 8px 0 0 0; font-size: 11px; color: #991b1b;">
                        * Silakan login ke website SPMB untuk melengkapi atau memperbaiki dokumen sesuai catatan di atas.
                    </p>
                </div>
                @endif

                @if($application->status === 'approved')
                <div style="margin-top: 18px; padding-top: 16px; border-top: 1px dashed #86efac; font-size: 13px; color: #166534; line-height: 1.5;">
                    @if($application->catatan)
                        <p style="margin: 0 0 4px 0;"><strong>Catatan Panitia:</strong> {{ $application->catatan }}</p>
                    @endif
                    <p style="margin: 4px 0 0 0;">
                        Seluruh berkas persyaratan dan administrasi telah diverifikasi dan dinyatakan lengkap. Panitia SPMB akan segera menghubungi nomor WhatsApp Anda untuk informasi orientasi murid baru selanjutnya.
                    </p>
                </div>
                @endif
            </div>

            <!-- Detail Pendaftaran Table -->
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 13px;">
                <tr>
                    <td style="padding: 8px 0; color: #64748b; width: 40%; border-bottom: 1px solid #f1f5f9;">Nama Calon Murid</td>
                    <td style="padding: 8px 0; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">{{ $application->full_name }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: #64748b; border-bottom: 1px solid #f1f5f9;">Jalur & Biaya Pendaftaran</td>
                    <td style="padding: 8px 0; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">
                        {{ match($application->jalur_pendaftaran) {
                            'yatim' => 'Anak Yatim / Piatu (Gratis Rp 0)',
                            'kurang_mampu' => 'Kurang Mampu (Rp 50.000)',
                            'prestasi' => 'Berprestasi (Rp 100.000)',
                            default => 'Reguler (Rp 150.000)'
                        } }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: #64748b; border-bottom: 1px solid #f1f5f9;">Nama Orang Tua / Wali</td>
                    <td style="padding: 8px 0; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">{{ $application->parent_name }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: #64748b; border-bottom: 1px solid #f1f5f9;">Nomor HP / WhatsApp</td>
                    <td style="padding: 8px 0; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">{{ $application->phone }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: #64748b; border-bottom: 1px solid #f1f5f9;">Riwayat PAUD</td>
                    <td style="padding: 8px 0; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9;">{{ $application->pernah_paud ? 'Pernah PAUD/KB' : 'Belum Pernah' }}</td>
                </tr>
            </table>

            <p style="font-size: 13px; line-height: 1.6; color: #64748b; margin-top: 28px;">
                Jika memiliki pertanyaan lebih lanjut, Anda dapat membalas email ini atau menghubungi layanan administrasi RA AL-IKHWAN melalui nomor WhatsApp resmi panitia SPMB.
            </p>
        </div>

        <!-- Footer -->
        <div style="background-color: #f8fafc; padding: 18px 24px; text-align: center; border-top: 1px solid #e2e8f0; font-size: 11px; color: #94a3b8;">
            &copy; {{ date('Y') }} RA AL-IKHWAN Cingcin - Soreang. Seluruh hak cipta dilindungi.
        </div>
    </div>
</body>
</html>
