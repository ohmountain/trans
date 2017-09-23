<?php

## 
## 1. 产生数据
## 2. POST
## 3. 存证
## 4. 存入数据库
## 

$ownership = [
    "comm_name" => "清镇市卫城镇凤山村",
    "comm_pp_name" => "上寨组",
    "owner_id" => "52015110221806020J",
    "owner_name" => "张以华",
    "owner_gender" => "男",
    "owner_contact" => "",
    "owner_sid" => "52250219761016261X",
    "family_name" => "李萍",
    "family_gender" => "女",
    "family_sid" => "522502197903135228",
    "relationship" => "夫妻",
    "block" => [
        [ 
            "block_name" => "麻窝田",
            "block_area" => "1.70",
            "block_type" => "田",
            "block_no"   => "0109",
            "block_coordinate" => " ",
            "block_shape" => "不规则",
            "usage_status" => "2",
            "contract_id_hash" => ""
        ],
        [ 
            "block_name" => "沙包田",
            "block_area" => "1.65",
            "block_type" => "田",
            "block_no"   => "0110",
            "block_coordinate" => " ",
            "block_shape" => "不规则",
            "usage_status" => "2",
            "contract_id_hash" => ""
        ],
        [ 
            "block_name" => "下麻窝田",
            "block_area" => "0.61",
            "block_type" => "田",
            "block_no"   => "0111",
            "block_coordinate" => " ",
            "block_shape" => "不规则",
            "usage_status" => "2",
            "contract_id_hash" => ""
        ],
        [ 
            "block_name" => "马家侧边烂田",
            "block_area" => "0.26",
            "block_type" => "田",
            "block_no"   => "0112",
            "block_coordinate" => " ",
            "block_shape" => "不规则",
            "usage_status" => "2",
            "contract_id_hash" => ""
        ],
        [ 
            "block_name" => "马家侧边烂田",
            "block_area" => "0.77",
            "block_type" => "田",
            "block_no"   => "0113",
            "block_coordinate" => " ",
            "block_shape" => "不规则",
            "usage_status" => "2",
            "contract_id_hash" => ""
        ],
        [ 
            "block_name" => "岩脚",
            "block_area" => "1.64",
            "block_type" => "田",
            "block_no"   => "0114",
            "block_coordinate" => " ",
            "block_shape" => "不规则",
            "usage_status" => "2",
            "contract_id_hash" => ""
        ],
        [ 
            "block_name" => "孙家门口",
            "block_area" => "1.68",
            "block_type" => "田",
            "block_no"   => "0115",
            "block_coordinate" => " ",
            "block_shape" => "不规则",
            "usage_status" => "2",
            "contract_id_hash" => ""
        ],
        [ 
            "block_name" => "围墙大土",
            "block_area" => "4.55",
            "block_type" => "田",
            "block_no"   => "0116",
            "block_coordinate" => " ",
            "block_shape" => "不规则",
            "usage_status" => "2",
            "contract_id_hash" => ""
        ]
    ]
];


echo json_encode($ownership) . "\n";
