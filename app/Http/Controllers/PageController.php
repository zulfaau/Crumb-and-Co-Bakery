<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|max:120',
            'phone' => 'nullable|string|max:30',
            'subject' => 'required|string|min:3|max:150',
            'message' => 'required|string|min:10|max:2000',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'subject.required' => 'Subjek pesan wajib diisi.',
            'message.required' => 'Pesan wajib diisi (minimal 10 karakter).',
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'Terima kasih telah menghubungi kami! Tim Crumb & Co. akan segera membalas pesan Anda.');
    }
}
