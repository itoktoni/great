<?php

namespace App\Http\Controllers;

use Alkhachatryan\LaravelWebConsole\LaravelWebConsole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Plugins\Query;
use Plugins\Template;
use App\Charts\dashboard;
use App\Dao\Enums\TicketStatus;
use App\Dao\Models\TicketSystem;

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
        if(auth()->check() && auth()->user()->active == false){
            return redirect()->to('/');
        }

        return view('pages.home.home');
    }

    public function console()
    {
        return LaravelWebConsole::show();
    }

    public function doc(){
        return view('doc');
    }
}
