<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;

class TestController extends Controller
{
    public function test(Request $request)
    {

        $value = $request->value??0;

       
       $startTime = microtime(true);
        
        // Your actual query goes here
        
        if($value == 0) {
            $users = DB::table('users')->get();
        }
        else if($value == 1) {
            $users = User::get();
        }
        else {
            $users = QueryBuilder::for(User::class)
                ->allowedSorts(['email','name'])
                ->allowedFilters('name')
                ->get();
        }

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        dd("Query took " . $executionTime . " seconds to execute.");
    }
}
