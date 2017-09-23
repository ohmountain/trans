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



http://localhost:8000/aabbcc?data={%22comm_name%22:%22\u6e05\u9547\u5e02\u536b\u57ce\u9547\u51e4\u5c71\u6751%22,%22comm_pp_name%22:%22\u9ad8\u5c71\u7ec4%22,%22owner_id%22:%2252018110221804003J%22,%22owner_name%22:%22\u6a0a\u7965\u534e%22,%22owner_gender%22:%22\u7537%22,%22owner_contact%22:%22%22,%22owner_sid%22:%22522502196501132652%22,%22family_name%22:%22\u6a0a\u9a84%22,%22family_gender%22:%22\u7537%22,%22family_sid%22:%22522502199203072634%22,%22relationship%22:%22\u7236\u5b50%22,%22block%22:[{%22block_name%22:%22\u571f\u4e95\u7530%22,%22block_area%22:%222.03%22,%22block_type%22:%22\u7530%22,%22block_no%22:%220013%22,%22block_cordinate%22:%22%20%22,%22block_shape%22:%22\u4e0d\u89c4\u5219%22,%22usage_status%22:%222%22,%22contract_id_hash%22:%22%22},{%22block_name%22:%22\u54e8\u6811\u811a\u571f%22,%22block_area%22:%220.81%22,%22block_type%22:%22\u571f%22,%22block_no%22:%220014%22,%22block_coordinate%22:%22%20%22,%22block_shape%22:%22\u4e0d\u89c4\u5219%22,%22usage_status%22:%222%22,%22contract_id_hash%22:%22%22}]}
echo json_encode($ownership) . "\n";
