<?php

namespace App\Http\Controllers;

use Faker\Core\Color;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    public function __construct()
    {
        
    }
    //hien thu danh sach chuyen muc (GET)
    public function index(){
        return view('home');
    }
//     //Lay ra 1 chuyen muc theo id(GET)
//     public function getCategory($id){

//     }
//     //Sua 1 chuyen muc(POST)
//     public function updateCategory($id){

//     }
//     //show form them du lieu (pjuong thuc GET)
//     public function showCategory(){

//     }
//     //them du lieu vao chuyen muc (phuong thuc POST)
//     public function addCategory(){

//     }
//     //xoa du lieu (DELETE)
//     public function deleteCategory(){

//     }
 }
