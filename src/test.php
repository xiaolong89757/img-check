<?php
class check
{

    function list_file($folder_name)
    {
        $folder_list = scandir($folder_name);
        foreach ($folder_list as $v1) {
            if ($v1 == '.' || $v1 == '..') {
                continue;
            }
            $tmp1 = $folder_name . '/' . $v1;
            if (is_dir($tmp1)) {

                $tmp1_list = scandir($tmp1);
                foreach ($tmp1_list as $v2) {
                    if ($v2 == '.' || $v2 == '..') {
                        continue;
                    }
                    $tmp2 = $tmp1 . '/' . $v2;
                    if (is_dir($tmp2)) {
                        $tmp2_list = scandir($tmp2);
                        foreach ($tmp2_list as $v3) {
                            if ($v3 == '.' || $v3 == '..') {
                                continue;
                            }
                            $tmp3 = $tmp2 . '/' . $v3;
                            if (is_dir($tmp3)) {
                                $tmp3_list = scandir($tmp3);
                                foreach ($tmp3_list as $v4) {
                                    if ($v4 == '.' || $v4 == '..') {
                                        continue;
                                    }
                                    $tmp4 = $tmp3 . '/' . $v4;
                                    if (is_dir($tmp4)) {

                                        file_put_contents("img_error.txt", $tmp4 . "\n", FILE_APPEND);
                                    } else {
                                        $img = put_content($tmp4);
                                    }
                                }
                            } else {
                                $img = put_content($tmp3);
                            }
                        }
                    } else {
                        $img = put_content($tmp2);
                    }
                }
            } else {
                $img = put_content($tmp1);
            }
        }
    }
    public function run($file)
    {
        $img = $this->judge($file);
        if ($img == 1) {
            return false;
        }
        return true;
        if (@imagecreatefromjpeg($data) == false) {
            file_put_contents("img_error.txt", $data . "\n", FILE_APPEND);
        }
        // print_r($img);die;
        // if(strpos($data,'2.') !== false){
        //     print_r($img);die;
        // }
        // if (!isset($img['COMMENT'])) {
        //     file_put_contents("img_error.txt", $data . "\n",FILE_APPEND);
        // }
        // try {
        //     ob_start("output_handler");
        //     imagejpeg($img);
        //     ob_end_flush();
        // } catch (\Exception $e) {
        //     echo 111;die;
        //     file_put_contents("img_error.txt", $data . "\n", FILE_APPEND);
        // }
    }
    function output_handler($img)
    {
        header('Content-type: image/png');
        header('Content-Length:' . strlen($img));
        return $img;
    }
    public function judge($image)
    {
        //获取图片资源
        $img_source = imagecreatefromjpeg($image);
        //获取图片的长和宽,便于获取图片某点的颜色值
        $img_size = getimagesize($image);
        $img_width = 2;
        $img_height = $img_size[1] - 2;
        //取得这点像素的颜色索引值，
        $color_index = imagecolorat($img_source, $img_width, $img_height);
        if ($color_index == 8421504) {
            return 1;
        } else {
            return 0;
        }
    }
}
