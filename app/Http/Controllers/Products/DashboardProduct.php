<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
class DashboardProduct extends Controller
{
    public static function index()
    {
        $query = Products::all()->toArray();

        return !empty($query) ? $query : [];
    }

}
