<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Project;
use App\Models\Service;
use App\Models\GalleryCategory;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\DB;

class WebsiteController extends Controller
{
    public function home()
    {
        // Fetch categories with their active products (for the new 3D layout)
        $categories = Category::where('is_active', true)
            ->with(['products' => function ($query) {
                $query->where('is_active', true)->with('brand');
            }])
            ->get();

        // Calculate stock for products within categories
        foreach ($categories as $category) {
            foreach ($category->products as $product) {
                $totalStock = DB::table('stocks')
                    ->where('product_id', $product->id)
                    ->sum('quantity');
                $product->stock_quantity = $totalStock;
            }
        }
        $brands = Brand::where('is_active', true)->get();

        $projects = Project::with('customer')
            ->whereIn('status', ['completed', 'commissioning', 'testing'])
            ->latest()
            ->take(6)
            ->get();

        $stats = [
            'projects' => Project::count(),
            'customers' => DB::table('customers')->count(),
            'products' => Product::where('is_active', true)->count(),
        ];

        $services = Service::where('is_active', true)->take(6)->get();

        return view('website.home', compact('categories', 'brands', 'projects', 'stats', 'services'));
    }

    public function about()
    {
        $brands = Brand::where('is_active', true)->get();
        $stats = [
            'projects' => Project::count(),
            'customers' => DB::table('customers')->count(),
            'products' => Product::where('is_active', true)->count(),
        ];
        return view('website.about', compact('brands', 'stats'));
    }

    public function services()
    {
        $services = Service::where('is_active', true)->get();
        return view('website.services', compact('services'));
    }

    public function serviceDetail($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $services = Service::where('is_active', true)->get();
        return view('website.service-detail', compact('service', 'services'));
    }

    public function products(Request $request)
    {
        $query = Product::with(['category', 'brand', 'images'])->where('is_active', true);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        $products = $query->latest()->paginate(12);

        $products->getCollection()->transform(function ($product) {
            $product->stock_quantity = DB::table('stocks')
                ->where('product_id', $product->id)
                ->sum('quantity');
            return $product;
        });

        $categories = Category::where('is_active', true)->get();
        $brands = Brand::where('is_active', true)->get();

        return view('website.products', compact('products', 'categories', 'brands'));
    }

    public function productDetail($id)
    {
        $product = Product::with(['category', 'brand', 'images', 'specifications'])->findOrFail($id);
        $product->stock_quantity = DB::table('stocks')
            ->where('product_id', $product->id)
            ->sum('quantity');

        $relatedProducts = Product::with('images')->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('website.product-detail', compact('product', 'relatedProducts'));
    }

    public function projects(Request $request)
    {
        $query = Project::with(['customer', 'solarSystems']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $projects = $query->latest()->paginate(9);
        return view('website.projects', compact('projects'));
    }

    public function projectDetail($id)
    {
        $project = Project::with(['customer', 'solarSystems', 'tasks', 'installations'])->findOrFail($id);
        return view('website.project-detail', compact('project'));
    }

    public function gallery()
    {
        $categories = GalleryCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('website.gallery', compact('categories'));
    }

    public function calculator()
    {
        return view('website.calculator');
    }

    public function contact()
    {
        return view('website.contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', __('site.common.contact_success'));
    }

    public function setLocale($locale)
    {
        if (in_array($locale, ['ar', 'en'])) {
            session(['locale' => $locale]);
        }
        return redirect()->back();
    }
}

