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
        $context = $this->buildContext($userMessage);

        // Mengambil kunci rahasia Groq dari file .env
        $apiKey = env('GROQ_API_KEY');
        if (!$apiKey) {
            return response()->json([
                'reply' => 'Maaf, konfigurasi AI (GROQ_API_KEY) belum diatur di file .env.'
            ]);
        }

        $systemPrompt = "Anda adalah AI Asisten Virtual yang ramah, sopan, dan informatif untuk sebuah SMK (Sekolah Menengah Kejuruan). 
Tugas Anda adalah membalas pertanyaan pengunjung website sekolah dengan bahasa Indonesia yang baik dan baku.
Gunakan data KNOWLEDGE BASE di bawah ini untuk menjawab. Jika data/informasi tidak ada di KNOWLEDGE BASE atau tidak relevan, mohon maaf dan katakan dengan sopan bahwa informasi tersebut belum tersedia atau sarankan mereka untuk menghubungi pihak sekolah. Jangan mengarang informasi di luar konteks yang diberikan.

KNOWLEDGE BASE:
" . $context;

        try {
            $apiKey = trim($apiKey);
            
            // Endpoint API Groq
            $url = "https://api.groq.com/openai/v1/chat/completions";

            // Menggunakan model Llama 3 (sangat cepat dan pintar)
          $payload = [
                'model' => 'llama-3.3-70b-versatile', 
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => $systemPrompt
                    ],
                    [
                        'role' => 'user',
                        'content' => $userMessage
                    ]
                ],
                'temperature' => 0.7,
                'max_tokens' => 1024
            ];

            Log::info("Chatbot: Mengirim request ke Groq API...");
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post($url, $payload);

            if ($response->successful()) {
                $result = $response->json();
                if (isset($result['choices'][0]['message']['content'])) {
                    return response()->json([
                        'reply' => $result['choices'][0]['message']['content']
                    ]);
                }
            }

            // Menangkap error jika gagal
            $errorData = $response->json();
            $errorMessage = $errorData['error']['message'] ?? 'Kesalahan API Tidak Diketahui';
            Log::error("Groq API Error: " . json_encode($errorData));

            return response()->json([
                'reply' => "Gangguan teknis AI: " . $errorMessage
            ], 200);

        } catch (\Exception $e) {
            Log::error("Chatbot Critical Error: " . $e->getMessage());
            
            return response()->json([
                'reply' => 'Kesalahan Sistem: ' . $e->getMessage()
            ], 200);
        }
    }

    private function buildContext(string $message): string
    {
        $context = "";
        $messageLower = Str::lower($message);

        // 1. Profil Sekolah (Visi Misi)
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

        // 2. Jurusan
        if (Str::contains($messageLower, ['jurusan', 'program', 'keahlian', 'belajar apa'])) {
            $majors = Major::where('is_active', true)->get();
            $context .= "\nDaftar Jurusan:\n";
            foreach ($majors as $major) {
                $context .= "- {$major->name} ({$major->acronym}): {$major->description}\n";
            }
        }

        // 3. Ekstrakurikuler
        if (Str::contains($messageLower, ['ekskul', 'ekstrakurikuler', 'kegiatan'])) {
            $ekskuls = Extracurricular::where('is_active', true)->get();
            $context .= "\nDaftar Ekstrakurikuler:\n";
            foreach ($ekskuls as $ekskul) {
                $context .= "- {$ekskul->name}: Mentored by {$ekskul->mentor}\n";
            }
        }

        // 4. Prestasi
        if (Str::contains($messageLower, ['prestasi', 'juara', 'lomba'])) {
            $achievements = Achievement::latest()->take(5)->get();
            $context .= "\nPrestasi Terbaru:\n";
            foreach ($achievements as $achievement) {
                $context .= "- {$achievement->title} ({$achievement->year})\n";
            }
        }

        // 5. Berita/Artikel (Hanya judul)
        if (Str::contains($messageLower, ['berita', 'artikel', 'kegiatan terbaru'])) {
            $posts = Post::latest()->take(3)->get();
            $context .= "\nBerita Terbaru:\n";
            foreach ($posts as $post) {
                $context .= "- {$post->title}\n";
            }
        }

        // 6. PPDB (Statis/Logic simple)
        if (Str::contains($messageLower, ['ppdb', 'daftar', 'masuk', 'pendaftaran'])) {
            $context .= "\nInformasi PPDB: Pendaftaran biasanya dibuka sekitar bulan Mei/Juni. Silakan cek menu PPDB di website untuk info link pendaftaran online.\n";
        }

        return $context ?: "Informasi umum tentang SMK.";
    }
}