<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function homepage(){

        $ourName = "John Doe";
        $animals = [
            'cat',
            'dog',
            'bird',
            'fish'
        ];

        return view('homepage', [
            'name' => $ourName,
            'catname' => 'Fluffy',
            'allanimal' => $animals
        ]);

      

    }

    public function aboutPage(){
        return view('single-post');
    }

    public function contactPage(){
        return '<h1> Contact Page </h1> <a href="/">Back to Home </a>';
    }
}
