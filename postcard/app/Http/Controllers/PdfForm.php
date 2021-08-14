<?php

namespace App\Http\Controllers;

class PdfForm {
    protected $rule = [
        'ja' => [
            'message_to'     => 'max:11',
            'message_content'=> 'max:56',
            'message_from'   => 'max:11',
        ],
        'en' => [
            'message_to'     => 'max:11',
            'message_content'=> 'max:56',
            'message_from'   => 'max:11',
        ],
    ];

    public function getRule($lang){
        return $this->rule[$lang] ?? [];
    }
}