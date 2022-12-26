<?php

namespace App\Controllers;

use Lynx\System\Database\SQL\DATASET;
use Lynx\System\Request\Request;
use App\Controllers\Controller;
use Lynx\System\Http\HttpAgent;
use Lynx\System\View\View;
use Lynx\System\Session\Session;
use Lynx\System\Set\Set;
use Lynx\System\Localization\Lang;

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

    public function store(Request $request)
    {

    }

    public function changeLanguage(Request $request)
    {   
        Lang::setAppLocale($request->post('language'));
        return redirect('');
    }

}
