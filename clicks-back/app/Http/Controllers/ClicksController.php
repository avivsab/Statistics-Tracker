<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClicksController extends Controller
{
    public function index() {
    $trackedLinks = [
        ['Dashboard', 'home'],
        ['Orders', 'file'],
        ['Products', 'shopping-cart'],
        ['Customers', 'users'],
        ['Reports','bar-chart-2'],
        ['Integrations', 'layers']
    ];
    $trackedItems = ['Current month', 'Last quarter', 'Social engagement', 'Year-end sale' ] ; 
    
        return view('master', [
            'trackedLinks' => $trackedLinks,
            'trackedItems' => $trackedItems
        ]);
    }
}
