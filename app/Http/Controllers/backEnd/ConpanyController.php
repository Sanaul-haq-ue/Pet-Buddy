<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class ConpanyController extends Controller
{
    public function company()
    {
        return view('backEnd.company', [
            'companies' => Company::paginate(7)
        ]);

        // return view('backEnd.company');
    }
}
