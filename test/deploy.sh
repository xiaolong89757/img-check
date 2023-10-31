#!/bin/bash
read -p "请填写要检查的绝对路径:" msg
msg="/home/wwwroot/img-check/testimg"

if [[ ! $msg ]]; then
    echo "终止，因为路径为空。"
else
    echo "开始执行..."
    php start.php --path=$msg
    if [ $? -eq 0 ]; then
        echo "完成。"
    else
        echo "出错了,请解决错误"
    fi
fi
