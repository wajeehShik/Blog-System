<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    //
    public function index(){
        $faqs=Faq::whereStatus('1')->paginate(10);
        return view("front.faqs",compact('faqs'));
    }
}
