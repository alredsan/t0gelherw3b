<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\Type;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * *Mostrar la pagina inicial
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        try{
            $tipos = Type::all();
            $organisation = Organisation::all();

        }catch(QueryException $ex){
            abort(500);
        }

        return view('inicio',compact('tipos','organisation'));
    }
}
