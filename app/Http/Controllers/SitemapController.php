<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;

class SitemapController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $projects = Project::all();
        $services = Service::all();

        return response()->view('sitemap', [
            'products' => $products,
            'projects' => $projects,
            'services' => $services,
        ])->header('Content-Type', 'text/xml');
    }
}
