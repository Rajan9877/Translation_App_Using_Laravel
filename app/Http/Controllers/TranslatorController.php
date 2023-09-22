<?php

namespace App\Http\Controllers;
use App\Models\Language;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Http\Request;

class TranslatorController extends Controller
{
    public function index(){
        $languages = Language::all();
        return view('welcome', compact('languages'));      
    }
    public function translate(Request $request){
        $from = $request->input('from');
        $to = $request->input('to');
        $translationtext = $request->input('translationtext');
        $tr = new GoogleTranslate();
        $translatedtext = $tr->setSource($from)->setTarget($to)->translate($translationtext);
        echo $translatedtext;
    }
}
