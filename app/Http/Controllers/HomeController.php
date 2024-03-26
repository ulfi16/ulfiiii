<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\galeriImage;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $query=galeriImage::where('user_id',auth()->id());

        $data['images']=$query->paginate(2);
        return view('home',$data);
    }
}
