<?php       
  return [
      'title' => 'Title with subtext',
      'category' => 'Text',
      'icon' => 'fa fa-font',
      "settings" => [
        "title_text" => [
            "type" => "text",
            "label" => "Title text",
            "value" => "Title text goes here"
        ],
        "subtitle_text" => [
            "type" => "text",
            "label" => "Subtitle text",
            "value" => "You can also add subtitle text here to support your title text "
        ],
        "text_color" => [
            "type" => "select",
            "label" => "Text color",
            "options" => [
                ["value" => "white", "label" => "white"],
                ["value" => 'black', "label" => "black"],
                ["value" => "gray", "label" => "gray"],
                ["value" => "red", "label" => "red"],
                ["value" => "orange", "label" => "orange"],
                ["value" => "blue", "label" => "blue"],
                ["value" => "indigo", "label" => "indigo"],
            ],
            "value" => "black"
        ],
        "text_transparency" => [
            "type" => "select",
            "label" => "Text transparency",
            "options" => [
                ["value" => "", "label" => "standard"],
                ["value" => '-50', "label" => "50"],
                ["value" => "-100", "label" => "100"],
                ["value" => "-200", "label" => "200"],
                ["value" => "-300", "label" => "300"],
                ["value" => "-400", "label" => "400"],
                ["value" => "-500", "label" => "500"],
                ["value" => "-600", "label" => "600"],
                ["value" => "-700", "label" => "700"],
                ["value" => "-800", "label" => "800"],
                ["value" => "-900", "label" => "900"],
            ],
            "value" => "-500"
        ],
        "subtitle_text_color" => [
            "type" => "select",
            "label" => "Subtitle text color",
            "options" => [
                ["value" => "white", "label" => "white"],
                ["value" => 'black', "label" => "black"],
                ["value" => "gray", "label" => "gray"],
                ["value" => "red", "label" => "red"],
                ["value" => "orange", "label" => "orange"],
                ["value" => "blue", "label" => "blue"],
                ["value" => "indigo", "label" => "indigo"],
            ],
            "value" => "gray"
        ],      
        "subtitle_text_transparency" => [
            "type" => "select",
            "label" => "Subtitle text transparency",
            "options" => [
                ["value" => "", "label" => "standard"],
                ["value" => '-50', "label" => "50"],
                ["value" => "-100", "label" => "100"],
                ["value" => "-200", "label" => "200"],
                ["value" => "-300", "label" => "300"],
                ["value" => "-400", "label" => "400"],
                ["value" => "-500", "label" => "500"],
                ["value" => "-600", "label" => "600"],
                ["value" => "-700", "label" => "700"],
                ["value" => "-800", "label" => "800"],
                ["value" => "-900", "label" => "900"],
            ],
            "value" => "-600"
        ],
        "margin_y" => [
            "type" => "number",
            "label" => "Margin Y",
            "value" => 5
        ],
        "padding_y" => [
            "type" => "number",
            "label" => "Padding Y",
            "value" => 0
        ],
        "padding_x" => [
            "type" => "number",
            "label" => "Padding X",
            "value" => 0
        ],
    ],
  ];