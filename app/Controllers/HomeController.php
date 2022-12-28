<?php

namespace App\Controllers;

use App\Controllers\Controller;
use Lynx\System\Database\SQL\DATASET;
use Lynx\System\Localization\Lang;
use Lynx\System\Request\Request;
use Lynx\System\Session\Session;
use Lynx\System\Http\HttpAgent;
use Lynx\System\Debug\Debugger;
use Lynx\System\View\View;
use Lynx\System\File\File;
use Lynx\System\Set\Set;
use App\Models\User;

class HomeController extends Controller{

    protected $moduleName;

    public function __construct()
    {
        $this->moduleName = "Lynx Test Module";        
    }

    public function index()
    {
        $moduleName = $this->moduleName . " - Home";
        $date = date('Y-m-d H:i:s');

        return View::render('home', compact('moduleName', 'date'));
    }

    public function create()
    {
        $moduleName = $this->moduleName . " - Insert";
        $date = date('Y-m-d H:i:s');

        return View::render('create', compact('moduleName', 'date'));
    }
 
    public function changeLanguage(Request $request)
    {   
        Lang::setAppLocale($request->post('language'));
        return redirect('');
    }
    
    public function store(Request $request)
    {

    }

    public function model(Request $request)
    {

        Debugger::dd(User::find('1')->first());

    }
}
