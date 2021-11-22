<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;

class TranslateController extends Controller
{
    public function translate($id)
    {
        $data = ["Svečių laukia aštuoni rąstiniai namai su modernia interjero įranga ir visais patogumais!",
  1 => "Norintiems atsipalaiduoti ir turiningai praleisti laiką - siūlome išsinuomoti erdvią kaimišką sodybą su etnografiniais elementais. Ji yra pačiame Vištyčio mieste ant gražaus 1660 ha ežero kranto (10 m nuo ežeras) "
];
$post = \request('p');
        $resource = Resource::find($id);
        if($post) {
            $resource->update([
                'name' => $data[0],
                'short_title' => $data[0],
                'seo_title' => $data[0],
                'seo_tag' => $data[0],
                'description' => $data[1]
            ]);
        } else {
            $title = $resource->name;
            $description = $resource->description;
            dd([
                $title, $description
            ]);
        }

    }
}