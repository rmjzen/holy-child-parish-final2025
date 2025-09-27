<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaptismalCertificate;

class BaptismalCertificateController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'child_name'  => 'required|string|max:255',
            'birthdate'   => 'required|date',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
        ]);

        BaptismalCertificate::create($validated);

        return back()->with('success', 'Baptismal Certificate Request Submitted!');
    }
}
