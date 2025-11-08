<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Dummy data untuk sementara
        $news = [
            [
                'title' => 'Penerimaan Peserta Didik Baru 2024',
                'excerpt' => 'Pendaftaran PPDB tahun ajaran 2024/2025 telah dibuka. Segera daftarkan putra-putri Anda.',
                'date' => '2024-01-15',
                'image' => 'https://via.placeholder.com/400x250/3B82F6/FFFFFF?text=Berita+1'
            ],
            [
                'title' => 'Siswa Berprestasi Olimpiade Sains Nasional',
                'excerpt' => 'Siswa kami meraih medali emas dalam Olimpiade Sains Nasional tingkat provinsi.',
                'date' => '2024-01-10',
                'image' => 'https://via.placeholder.com/400x250/10B981/FFFFFF?text=Berita+2'
            ],
            [
                'title' => 'Kegiatan Bakti Sosial Siswa',
                'excerpt' => 'Siswa-siswi melakukan bakti sosial di lingkungan sekitar sekolah.',
                'date' => '2024-01-05',
                'image' => 'https://via.placeholder.com/400x250/F59E0B/FFFFFF?text=Berita+3'
            ]
        ];

        $gallery = [
            [
                'image' => 'https://via.placeholder.com/300x200/3B82F6/FFFFFF?text=Galeri+1',
                'title' => 'Kegiatan Belajar'
            ],
            [
                'image' => 'https://via.placeholder.com/300x200/10B981/FFFFFF?text=Galeri+2',
                'title' => 'Olahraga'
            ],
            [
                'image' => 'https://via.placeholder.com/300x200/F59E0B/FFFFFF?text=Galeri+3',
                'title' => 'Seni Budaya'
            ],
            [
                'image' => 'https://via.placeholder.com/300x200/EF4444/FFFFFF?text=Galeri+4',
                'title' => 'Laboratorium'
            ]
        ];

        return view('frontend.home', compact('news', 'gallery'));
    }
}