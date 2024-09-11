<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


return [
    'inputContainer' => '<div class="input {{type}} {{required}} {{divClass}}">
        {{beforeContent}}{{content}}{{afterContent}}
        </div>',
    
    'inputContainerError' => '<div class="input {{type}} {{required}} {{divClass}}">
        {{beforeContent}}{{content}}{{afterContent}}{{error}}
        </div>',
    
    'input' => '{{beforeInput}}<input {{attrs}} name="{{name}}" type="{{type}}" />{{afterInput}}',
    'error' => '<div class="error inputError alert-danger">{{content}}</div>',
];
