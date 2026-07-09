<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\Extracurricular;
use App\Models\Achievement;
use App\Models\SchoolProfile;
use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ChatbotController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500'
        ]);

        $userMessage = $request->message;
        $apiKey = env('GROQ_API_KEY');

        // Jika API key tersedia, gunakan Groq AI
        if ($apiKey) {
            return $this->sendToGroq($userMessage, $apiKey);
        }

        // Fallback: jawab berdasarkan keyword dari database
        return $this->fallbackReply($userMessage);
    }

    private function sendToGroq(string $userMessage, string $apiKey)
    {
        $context = $this->buildContext($userMessage);

        $systemPrompt = "Anda adalah asisten virtual SMKN 1 Katapang. Jawab pertanyaan pengunjung dengan bahasa Indonesia yang natural, ramah, dan langsung ke inti jawaban. Jangan gunakan format markdown seperti **bold**, bullet point dengan simbol, atau emoji. Tulis seperti orang berbicara biasa. Gunakan data dari KNOWLEDGE BASE berikut untuk menjawab. Jika informasi tidak tersedia, katakan dengan sopan dan sarankan menghubungi sekolah. Jangan mengarang informasi di luar konteks yang diberikan.\n\nKNOWLEDGE BASE:\n" . $context;

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . trim($apiKey),
                'Content-Type'  => 'application/json',
            ])->timeout(30)->post('https://api.groq.com/openai/v1/chat/completions', [
                'model'       => 'llama-3.3-70b-versatile',
                'messages'    => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user',   'content' => $userMessage],
                ],
                'temperature' => 0.7,
                'max_tokens'  => 1024,
            ]);

            if ($response->successful()) {
                $result = $response->json();
                if (isset($result['choices'][0]['message']['content'])) {
                    return response()->json([
                        'reply' => $result['choices'][0]['message']['content']
                    ]);
                }
            }

            Log::error('Groq API Error: ' . json_encode($response->json()));
            // Jika Groq gagal, gunakan fallback
            return $this->fallbackReply($userMessage);

        } catch (\Exception $e) {
            Log::error('Chatbot Error: ' . $e->getMessage());
            return $this->fallbackReply($userMessage);
        }
    }

    private function fallbackReply(string $userMessage)
    {
        $msg = Str::lower($userMessage);
        $reply = '';

        // Sapa
        if (Str::contains($msg, ['halo', 'hai', 'hello', 'hi', 'selamat'])) {
            $reply = "Halo! Selamat datang di SMKN 1 Katapang. Saya asisten virtual sekolah. Saya bisa membantu informasi tentang jurusan, ekstrakurikuler, prestasi, SPMB, dan profil sekolah. Silakan tanyakan!";
            return response()->json(['reply' => $reply]);
        }

        // Profil / visi misi
        if (Str::contains($msg, ['profil', 'visi', 'misi', 'sejarah', 'kepala sekolah', 'tentang'])) {
            $profile = SchoolProfile::first();
            if ($profile) {
                $reply  = "Profil SMKN 1 Katapang\n\n";
                $reply .= "Kepala Sekolah: {$profile->principal_name}\n\n";
                $reply .= "Visi: {$profile->vision}\n\n";
                if (is_array($profile->mission) && count($profile->mission)) {
                    $reply .= "Misi:\n";
                    foreach ($profile->mission as $i => $m) {
                        $reply .= ($i + 1) . ". {$m}\n";
                    }
                }
            } else {
                $reply = "Informasi profil sekolah belum tersedia. Silakan kunjungi halaman Tentang Kami atau hubungi sekolah langsung.";
            }
            return response()->json(['reply' => $reply]);
        }

        // Jurusan
        if (Str::contains($msg, ['jurusan', 'program keahlian', 'belajar apa', 'prodi', 'kompetensi'])) {
            $majors = Major::where('is_active', true)->get();
            if ($majors->isNotEmpty()) {
                $reply = "Program Keahlian SMKN 1 Katapang:\n\n";
                foreach ($majors as $major) {
                    $reply .= "{$major->name} ({$major->acronym})";
                    if ($major->description) {
                        $reply .= " - {$major->description}";
                    }
                    $reply .= "\n\n";
                }
            } else {
                $reply = "Informasi jurusan belum tersedia. Silakan cek menu Program Keahlian di website kami.";
            }
            return response()->json(['reply' => $reply]);
        }

        // Ekskul
        if (Str::contains($msg, ['ekskul', 'ekstrakurikuler', 'kegiatan', 'organisasi', 'osis'])) {
            $ekskuls = Extracurricular::where('is_active', true)->get();
            if ($ekskuls->isNotEmpty()) {
                $reply = "Ekstrakurikuler SMKN 1 Katapang:\n\n";
                foreach ($ekskuls as $ekskul) {
                    $reply .= "{$ekskul->name}";
                    if ($ekskul->mentor) $reply .= " - Pembina: {$ekskul->mentor}";
                    $reply .= "\n";
                }
            } else {
                $reply = "Informasi ekstrakurikuler belum tersedia. Silakan cek menu Ekstrakurikuler di website kami.";
            }
            return response()->json(['reply' => $reply]);
        }

        // Prestasi
        if (Str::contains($msg, ['prestasi', 'juara', 'lomba', 'penghargaan', 'kompetisi'])) {
            $achievements = Achievement::latest()->take(5)->get();
            if ($achievements->isNotEmpty()) {
                $reply = "Prestasi Terbaru SMKN 1 Katapang:\n\n";
                foreach ($achievements as $a) {
                    $reply .= "{$a->title} ({$a->year})\n";
                }
            } else {
                $reply = "Data prestasi belum tersedia. Silakan cek menu Prestasi di website kami.";
            }
            return response()->json(['reply' => $reply]);
        }

        // SPMB
        if (Str::contains($msg, ['ppdb', 'daftar', 'pendaftaran', 'masuk sekolah', 'penerimaan'])) {
            $reply = "Informasi SPMB SMKN 1 Katapang\n\n";
            $reply .= "Pendaftaran Peserta Didik Baru (SPMB) biasanya dibuka sekitar bulan Mei–Juni.\n\n";
            $reply .= "Untuk informasi lengkap dan link pendaftaran online, silakan kunjungi menu SPMB di website kami atau hubungi sekolah langsung.";
            return response()->json(['reply' => $reply]);
        }

        // Berita
        if (Str::contains($msg, ['berita', 'artikel', 'kegiatan terbaru', 'info terbaru', 'pengumuman'])) {
            $posts = Post::where('status', 'published')->latest()->take(3)->get();
            if ($posts->isNotEmpty()) {
                $reply = "Berita dan Artikel Terbaru:\n\n";
                foreach ($posts as $post) {
                    $reply .= "{$post->title}\n";
                }
                $reply .= "\nBaca selengkapnya di menu Berita & Artikel website kami.";
            } else {
                $reply = "Belum ada berita terbaru. Silakan cek menu Berita & Artikel di website kami.";
            }
            return response()->json(['reply' => $reply]);
        }

        // Kontak / lokasi
        if (Str::contains($msg, ['kontak', 'alamat', 'telepon', 'email', 'lokasi', 'dimana', 'dimana sekolah'])) {
            $reply = "SMKN 1 Katapang beralamat di Jl. Ceuri Jalan Terusan Kopo No.KM 13, RW.5, Katapang, Kec. Katapang, Kabupaten Bandung, Jawa Barat 40971, Indonesia. Untuk informasi kontak lengkap seperti nomor telepon dan email, silakan kunjungi halaman Kontak Kami di website kami.";
            return response()->json(['reply' => $reply]);
        }

        // Terima kasih
        if (Str::contains($msg, ['terima kasih', 'makasih', 'thanks', 'thank you'])) {
            $reply = "Sama-sama! Senang bisa membantu. Jika ada pertanyaan lain seputar SMKN 1 Katapang, jangan ragu untuk bertanya ya!";
            return response()->json(['reply' => $reply]);
        }

        // Default
        $reply = "Halo! Saya asisten virtual SMKN 1 Katapang.\n\nSaya bisa membantu informasi tentang:\n";
        $reply .= "- Jurusan dan Program Keahlian\n";
        $reply .= "- Ekstrakurikuler\n";
        $reply .= "- Prestasi Siswa\n";
        $reply .= "- Pendaftaran (SPMB)\n";
        $reply .= "- Profil Sekolah\n";
        $reply .= "- Berita dan Kegiatan\n\n";
        $reply .= "Silakan tanyakan salah satunya, atau hubungi sekolah langsung melalui halaman Kontak Kami.";

        return response()->json(['reply' => $reply]);
    }

    private function buildContext(string $message): string
    {
        $context = "";
        $messageLower = Str::lower($message);

        if (Str::contains($messageLower, ['profil', 'visi', 'misi', 'sejarah', 'kepala sekolah'])) {
            $profile = SchoolProfile::first();
            if ($profile) {
                $context .= "Info Sekolah:\n";
                $context .= "Nama Kepala Sekolah: {$profile->principal_name}\n";
                $context .= "Visi: {$profile->vision}\n";
                if (is_array($profile->mission)) {
                    $context .= "Misi: " . implode(", ", $profile->mission) . "\n";
                }
            }
        }

        if (Str::contains($messageLower, ['jurusan', 'program', 'keahlian', 'belajar apa'])) {
            $majors = Major::where('is_active', true)->get();
            $context .= "\nDaftar Jurusan:\n";
            foreach ($majors as $major) {
                $context .= "- {$major->name} ({$major->acronym}): {$major->description}\n";
            }
        }

        if (Str::contains($messageLower, ['ekskul', 'ekstrakurikuler', 'kegiatan'])) {
            $ekskuls = Extracurricular::where('is_active', true)->get();
            $context .= "\nDaftar Ekstrakurikuler:\n";
            foreach ($ekskuls as $ekskul) {
                $context .= "- {$ekskul->name}: Pembina {$ekskul->mentor}\n";
            }
        }

        if (Str::contains($messageLower, ['prestasi', 'juara', 'lomba'])) {
            $achievements = Achievement::latest()->take(5)->get();
            $context .= "\nPrestasi Terbaru:\n";
            foreach ($achievements as $achievement) {
                $context .= "- {$achievement->title} ({$achievement->year})\n";
            }
        }

        if (Str::contains($messageLower, ['berita', 'artikel', 'kegiatan terbaru'])) {
            $posts = Post::latest()->take(3)->get();
            $context .= "\nBerita Terbaru:\n";
            foreach ($posts as $post) {
                $context .= "- {$post->title}\n";
            }
        }

        if (Str::contains($messageLower, ['ppdb', 'daftar', 'masuk', 'pendaftaran'])) {
            $context .= "\nInformasi SPMB: Pendaftaran biasanya dibuka sekitar bulan Mei/Juni.\n";
        }

        if (Str::contains($messageLower, ['kontak', 'alamat', 'telepon', 'email', 'lokasi', 'dimana'])) {
            $context .= "\nKontak Sekolah:\n";
            $context .= "Alamat: Jl. Ceuri Jalan Terusan Kopo No.KM 13, RW.5, Katapang, Kec. Katapang, Kabupaten Bandung, Jawa Barat 40971, Indonesia\n";
            $context .= "Untuk nomor telepon dan email lengkap, kunjungi halaman Kontak di website.\n";
        }

        return $context ?: "Informasi umum tentang SMKN 1 Katapang.";
    }
}
