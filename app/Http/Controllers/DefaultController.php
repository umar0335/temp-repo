<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function findDuplicate(Request $req){
        // print_r ($req->arr);
        $duplicateArr = array();

        foreach($req->arr as $key => $value){
            for($i = ($key+1); $i < count($req->arr); $i++){
                if($value == $req->arr[$i]){
                    $temp = ['value' => $value, 'index1' => $key, 'index2' => $i];
                    $duplicateArr[] = $temp;
                }
            }
        }

        print_r($duplicateArr);
    }
}
