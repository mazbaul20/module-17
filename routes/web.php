<?php

use App\Http\Controllers\QueryBuilderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/retrievingallrows',[QueryBuilderController::class,'RetrievingAllRows']);
// Retrieving Single Row
Route::get('/retrievingsinglerows',[QueryBuilderController::class,'RetrievingSingleRow']);
// Aggregates Function
Route::get('/aggregatesfunc',[QueryBuilderController::class,'Aggregates']);
// Select Clause
Route::get('/selectclause',[QueryBuilderController::class,'SelectClause']);
// Inner Join
Route::get('/innerjoin',[QueryBuilderController::class,'InnerJoin']);
// Left Join Right Join
Route::get('/leftrightjoin',[QueryBuilderController::class,'LeftRightJoin']);
// Cross Join
Route::get('/crossjoin',[QueryBuilderController::class,'CrossJoin']);
// Advanced Join Clauses
Route::get('/advancedjoinclauses',[QueryBuilderController::class,'AdvancedJoinClauses']);
// Unions
Route::get('/unions',[QueryBuilderController::class,'Unions']);
// Basic Where Clauses
Route::get('/basicwhereclauses',[QueryBuilderController::class,'BasicWhereClauses']);
// Advance Where Clauses 1
Route::get('/AdvanceWhereClauses1',[QueryBuilderController::class,'AdvanceWhereClauses1']);
// Advance Where Clauses 2
Route::get('/AdvanceWhereClauses2',[QueryBuilderController::class,'AdvanceWhereClauses2']);
// Advance Where Clauses 3
Route::get('/AdvanceWhereClauses3',[QueryBuilderController::class,'AdvanceWhereClauses3']);
// Advance Where Clauses 4
Route::get('/AdvanceWhereClauses4',[QueryBuilderController::class,'AdvanceWhereClauses4']);
// order By Asc Desc and random
Route::get('/orderByAscDesc',[QueryBuilderController::class,'OrderByAscDesc']);
