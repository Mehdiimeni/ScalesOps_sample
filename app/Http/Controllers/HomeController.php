<?php 

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory as ViewFactory;

class HomeController extends Controller
{
    protected $viewFactory;

    public function __construct(ViewFactory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
    }

    public function index()
    {
        return $this->viewFactory->make('home');
    }
}
