<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryBuilderController extends Controller
{
    // Retrieving All Rows
    function RetrievingAllRows(){
        $query = DB::table('products')->select('*')->get();
        return $query;
    }
    // Retrieving Single Row
    function RetrievingSingleRow(){
        // select first row
        // $query = DB::table('products')->first();
        // select single row form any id
        $query = DB::table('products')->find(6);
        // select all spesifik column
        // $query = DB::table('products')->pluck('price','id');
        return $query;
    }
    // Aggregates function
    function Aggregates(){
        $count = DB::table('products')->count();

        $max = DB::table('products')->max('price');
        $avg = DB::table('products')->avg('price');
        $min = DB::table('products')->min('price');
        $sum = DB::table('products')->sum('price');

        return ['count'=>$count,'max'=>$max,'avg'=>$avg,'min'=>$min,'sum'=>$sum];
    }
    // Select Clause, distinct unique value return kore
    function SelectClause(){
        // $query = DB::table('products')->select('id','title','price')->get();
        $query = DB::table('products')->select('title')->distinct()->get();
        return $query;
    }
    // Inner Join
    function InnerJoin(){
        $query = DB::table('products')
                ->join('categories','products.category_id','=','categories.id')
                ->join('brands','products.brand_id','=','brands.id')
                ->get();
        return $query;
    }
    // Left Join Right Join
    function LeftRightJoin(){
        $products = DB::table('products')
                ->leftJoin('categories','products.category_id','=','categories.id')
                ->leftJoin('brands','products.brand_id','=','brands.id')
                ->get();
        // $products = DB::table('products')
        //         ->rightJoin('categories','products.category_id','=','categories.id')
        //         ->rightJoin('brands','products.brand_id','=','brands.id')
        //         ->get();
        return $products;
    }
    // Cross Join
    function CrossJoin(){
        $products = DB::table('products')
                ->crossJoin('brands')
                ->get();
        return $products;
    }
    // Advanced Join Clauses
    function AdvancedJoinClauses(){
        $query = DB::table('products')
            ->join('categories',function(JoinClause $joinClause){
                $joinClause->on('products.category_id','=','categories.id')
                ->where('products.price','>','2000');
            })
        ->join('brands',function(JoinClause $joinClause){
            $joinClause->on('products.brand_id','=','brands.id')
                ->where('brands.brandName','=','Easy');
        })
        ->get();
        return $query;
    }
    // Unions
    function Unions(){
        $query1 = DB::table('products')->where('products.price','>','2000');
        $query2 = DB::table('products')->where('products.discount','=',1);
        $resutl = $query1->union($query2)->get();
        return $resutl;
    }
    // Basic Where Clauses
    function BasicWhereClauses(){
        // $query = DB::table('products')->where('products.price','=','2000')->get();
        // $query = DB::table('products')->where('products.price','!=','2000')->get();
        // $query = DB::table('products')->where('products.price','<','2000')->get();
        // $query = DB::table('products')->where('products.price','<=','2000')->get();
        // $query = DB::table('products')->where('products.price','>','2000')->get();
        // $query = DB::table('products')->where('products.price','>=','2000')->get();
        // $query = DB::table('products')->where('products.title','LIKE','%Ca%')->get();
        // $query = DB::table('products')->where('products.title','NOT LIKE','%Ca%')->get();
        // $query = DB::table('products')->whereIn('products.price',[1500,4500])->get();
        $query = DB::table('products')->whereNotIn('products.price',[1500,4500])->get();
        return $query;
    }
    // Advance Where Clauses 1
    function AdvanceWhereClauses1(){
        $orWhere = DB::table('products')
            ->where('products.price','>','2000')
            ->orWhere('products.price','=',1500)
            ->get();

        $whereNot = DB::table('products')
            ->where('products.price','>','2000')
            ->whereNot('products.price','=',1500)
            ->get();

        $whereBetween = DB::table('products')
            ->whereBetween('products.price',[1,2000])
            ->get();

        $whereNotBetween = DB::table('products')
            ->whereNotBetween('products.price',[1,2000])
            ->get();
        return $whereNotBetween;
    }
    // Advance Where Clauses(whereNull, whereNotNull, whereIn, whereNotIn)
    function AdvanceWhereClauses2(){
        $whereNull = DB::table('products')
            ->whereNull('price')
            ->get();
        $whereNotNull = DB::table('products')
            ->whereNotNull('price')
            ->get();
        $whereIn = DB::table('products')
            ->whereIn('price',[1500,4500])
            ->get();
        $whereNotIn = DB::table('products')
            ->whereNotIn('price',[2000])
            ->get();
        return $whereNotIn;
    }
    // Advance Where Clauses(whereDate, whereMonth, whereDay, whereYear, whereTime)
    function AdvanceWhereClauses3(){
        $whereDate = DB::table('brands')
            ->whereDate('create_at','2023-07-08')
            ->get();
        $whereMonth = DB::table('brands')
            ->whereMonth('create_at','07')
            ->get();
        $whereDay = DB::table('brands')
            ->whereDay('create_at','07')
            ->get();
        $whereYear = DB::table('brands')
            ->whereYear('create_at','2023')
            ->get();
        $whereTime = DB::table('brands')
            ->whereTime('create_at','01:04:09')
            ->get();
        return $whereTime;
    }
    // Advance Where Clauses(whereColumn)
    function AdvanceWhereClauses4(){
        $whereColumn = DB::table('brands')
            ->whereColumn('create_at','<','update_at')
            ->get();
        $whereColumn = DB::table('products')
            ->whereColumn('price','>','discount_price')
            ->get();
        return $whereColumn;
    }
    // order By Asc Desc and random
    function OrderByAscDesc(){
        $orderBy = DB::table('brands')
            ->orderBy('brandName','asc')
            ->get();
        $orderBy = DB::table('brands')
            ->orderBy('brandName','desc')
            ->get();
        $inRandomOrder = DB::table('brands')
            ->inRandomOrder()
            ->get();
        return $inRandomOrder;
    }
    // Latest and Oldest and Skip-Take method
    function LatestOldest(){
        $query = DB::table('products')
            ->latest()
            ->first();
        $query = DB::table('products')
            ->oldest()
            ->first();
        $query = DB::table('products')
            ->skip(2)
            ->take(3)
            ->get();
        return $query;
    }
    // groupBy and having
    function groupByandhaving(){
        $query = DB::table('products')
            ->groupBy('price')
            ->get();
        $query = DB::table('products')
            ->groupBy('price')
            ->having('price','>',2000)
            ->get();
        return $query;
    }
    // Insert Statements
    function Insert(){
        $query = DB::table('brands')
            ->insert([
                'brandName' => 'Toyota',
                'brandImg'  => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.cardekho.com%2Ftoyota%2Fgallery&psig=AOvVaw2bG4SnmFJdAzjDLrVZHRuN&ust=1687195941953000&source=images&cd=vfe&ved=0CBEQjRxqFwoTCKj8r-iszf8CFQAAAAAdAAAAABAE'
            ]);
        return $query;
    }

}
