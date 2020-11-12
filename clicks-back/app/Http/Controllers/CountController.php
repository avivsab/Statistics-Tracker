<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountController extends Controller
{
    public function create(Request $request)
    {
        if (isset($_POST['data'])) {
            $key = $_POST['data'];
            $array = json_encode($key);
            $array1 = explode(',', $array);
            $array2 = [];

            for ($i = 0; $i < count($array1); $i++) {
                $array1[$i] = preg_replace('/[^A-Za-z0-9\-:]/', '', $array1[$i]);
                $array3 = explode(':', $array1[$i]);
                $element = $array3[0];
                if (empty($array3[1])) {
                    $element = 'No Clicks';
                    $counts = 0;
                } else {
                    $counts = (int) $array3[1];
                }
                $ldate = date('Y-m-d H:i:s');
                DB::insert('insert into statistics (elementId, clicks, created_at) values (?, ?, ?)', [$element, $counts, $ldate]);
            }
            return redirect()->intended('/');
        }
    }
}
