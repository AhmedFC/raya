<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Auction;
use App\Models\Bid;
use App\Models\Document;
use App\Models\Offer;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }
}
