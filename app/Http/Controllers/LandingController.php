<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FAQ;
use App\Models\Template;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(){
        $faqs = FAQ::all();
        $templates = Template::with('category')->get(); // relasi category harus sudah didefinisikan di model Template
        $categories = Category::with(['templates'])
        ->withCount('templates')
        ->get();

        $categoryTypes = Category::distinct()->pluck('type');
        $testimonials = [
            [
                'name' => 'Rafi & Yuni',
                'role' => 'Pasangan Pengantin',
                'message' => "Undangan digital ini benar-benar mempermudah kami! Desainnya elegan dan mudah disesuaikan dengan tema acara kami. Tamu undangan juga bisa dengan mudah mengaksesnya melalui ponsel, bahkan bisa langsung mengonfirmasi kehadiran mereka. Kami merasa sangat terbantu dan puas dengan layanan ini!",
                'image' => 'testimonials-1.jpg',
            ],
            [
                'name' => 'Hendra & Tia',
                'role' => 'Pasangan Pengantin',
                'message' => "Undangan digital membuat acara kami semakin modern dan ramah lingkungan. Tamu juga bisa dengan mudah berbagi undangan ke teman-teman mereka, tanpa khawatir kehilangan informasi penting.",
                'image' => 'testimonials-5.jpg',
            ],
            [
                'name' => 'Arif & Nanda',
                'role' => 'Pasangan Pengantin',
                'message' => "Undangan pernikahan digital ini sangat praktis dan modern! Saya bisa berbagi undangan dengan mudah kepada teman-teman dan keluarga melalui WhatsApp atau email. Desainnya juga sangat elegan dan personal.",
                'image' => 'testimonials-1.jpg',
            ],
            [
                'name' => 'Budi & Ani',
                'role' => 'Pasangan Pengantin',
                'message' => "Saya sangat puas dengan undangan digital yang kami gunakan untuk pernikahan. Proses pengirimannya cepat, dan penerima bisa langsung melihat detail acara tanpa harus khawatir kehilangan undangan fisik.",
                'image' => 'testimonials-5.jpg',
            ],
        ];

        return view('welcome',[
            'faqs' => $faqs,
            'templates' => $templates,
            'testimonials' => $testimonials,
            'categories' => $categories,
            'categoryTypes' => $categoryTypes,
        ]);
    }
}
