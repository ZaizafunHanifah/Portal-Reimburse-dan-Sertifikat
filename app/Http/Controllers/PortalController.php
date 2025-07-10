<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reimburse;

class PortalController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function reimburse(Request $request)
    {
        $data = null;

        if ($request->has('no_sertifikat')) {
            $data = Reimburse::where('no_sertifikat', $request->no_sertifikat)->first();
        }

        return view('reimburse.index', compact('data'));
    }

    public function sertifikat()
    {
        return view('sertifikat.index');
    }
}
