<?php
class type2
{
    protected $status = true;
    protected $msg = '图片色值出现问题';

    public function run($file)
    {
        $img = $this->judge($file);
        if ($img == 1) {
            $this->status = false;
        }
        return ['status' => $this->status, 'msg' => $this->msg];
    }

    public function judge($image)
    {
        $image_info = @getimagesize($image);
        $img_source = '';
        switch ($image_info['mime']) {
            case 'image/png':
                // 处理 PNG 文件
                $img_source = imagecreatefrompng($image);
                break;
            case 'image/jpeg':
                // 处理 JPEG 文件
                $img_source = imagecreatefromjpeg($image);
                break;
            case 'image/gif':
                // 处理 GIF 文件
                $img_source = imagecreatefromgif($image);
                break;
            default:
                $this->msg = '文件不是图片类型';
                return 1;
        }
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
