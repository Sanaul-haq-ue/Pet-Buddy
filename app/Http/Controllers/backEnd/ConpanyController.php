<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class ConpanyController extends Controller
{
    public function company()
    {
        return view('backEnd.pages.companyService.company', [
            'companies' => Company::paginate(7)
        ]);

    }
}
