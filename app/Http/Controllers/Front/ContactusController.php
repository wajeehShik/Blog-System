<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ContactusRequest;
use App\Models\Contactus;
use Illuminate\Http\Request;
use Stevebauman\Purify\Facades\Purify;

class ContactusController extends Controller
{
    //
public function index(){
    return view("front.contactus");
}
public function store(ContactusRequest $request){
    Contactus::create([
        'name'=>$request->post('name'),
        'email'=>$request->post('email'),
        'subject'=>$request->post('subject'),
        'message'=>Purify::clean($request->post('message'))
    ]);
    alert()->success("طلب تواصل",'سوف يتم تواصل مع قريبا');
    return redirect()->route("home");
    
}
}
