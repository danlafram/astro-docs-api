<?php       
  return [
      'title' => 'Centered hero',
      'category' => 'General',
      'icon' => 'fa fa-align-center',
      "settings" => [
        "title_text" => [
            "type" => "text",
            "label" => "Title text",
            "value" => "The main title text for your hero component"
        ],
        "subtitle_text" => [
            "type" => "text",
            "label" => "Subtitle text",
            "value" => "Some sub-text content that will be underneath the main title text for your hero component."
        ],
        "text-color" => [
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
            "value" => "white"
        ],
        "text-transparency" => [
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
            "value" => ""
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