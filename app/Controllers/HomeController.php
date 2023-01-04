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
        $object = new \stdClass;
        $object->username = "jainil";
        $object->languages  =  ["English" => [4,2,3,1,5], "Hindi" => [1,1,1,1,1], "Gujarati" => [1,1,1,1,1]];
        $object->programming = ["PHP" => ["array" => ["Laravel", "Lynx", "Codeigniter"], "object" => $object] ];
        $array = ['test'=> 'value','jainil'=> ['1',2,'2','3'],'type' => ['index' => [7867,0,1,2,234,-1,234234], 'associative' => ['one' => 1, 'tow' => 2, 'three' => 3]],9234,12,345,56,0,0,-1,-2,22234,$object];
    
        // $array = collect($array);
        // Debugger::dd($array);

        // dd(collect($array));
        dd(User::select('*')->whereBetween('id',[34,38])->orderBy('id','ASC')->limit(5)->get());
    }
}
