<?php 

namespace App\Controllers; 

use Lynx\System\Request\Request;
use App\Controllers\Controller;
use Lynx\System\View\View;

 class BlogController extends Controller { 
 
    protected $moduleName = "Blog";

    protected $viewName = "admin.post.data";

    public function index(Request $request)
    {
        $moduleName = $this->moduleName;

        return View::collection($this->viewName, compact('moduleName'));
    }

 } 
