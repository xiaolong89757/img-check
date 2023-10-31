<?php
class type3
{
    protected $status = true;
    protected $msg = '图片格式错乱';

    public function run($file)
    {
        // $imageInfo = @getimagesize($file)['mime'];
        $imageInfo = $this->getImgtype($file);
        $str = explode('.', $file);
        $type = explode('/', $imageInfo);
        // if($file == '/home/wwwroot/img-check/testimg/F/0/0/f008197594eaab45af66e28d858afcc9.jpg'){
        //     print_r($str);
        //     print_r($type);die;
        // }
        if ($type[1] != $str[1]) {
            if (strtolower($type[1]) == 'jpg' || strtolower($type[1]) == 'jpeg') {
                if (strtolower($str[1]) == 'jpg' || strtolower($str[1]) == 'jpeg') {
                    $this->status = true;
                } else {
                    $this->status = false;
                }
            }else{
                $this->status = false;
            }
        }
        return ['status' => $this->status, 'msg' => $this->msg];
    }

    public function getImgtype($imgPath, $MimeOrExifOrExtension = null)
    {
        $exifImgtype = array(
            'IMAGETYPE_GIF' => 1,
            'IMAGETYPE_JPEG' => 2,
            'IMAGETYPE_PNG' => 3,
            'IMAGETYPE_SWF' => 4,
            'IMAGETYPE_PSD' => 5,
            'IMAGETYPE_BMP' => 6,
            'IMAGETYPE_TIFF_II' => 7, //（Intel 字节顺序） 
            'IMAGETYPE_TIFF_MM' => 8, //（Motorola 字节顺序） 
            'IMAGETYPE_JPC' => 9,
            'IMAGETYPE_JP2' => 10,
            'IMAGETYPE_JPX' => 11,
            'IMAGETYPE_JB2' => 12,
            'IMAGETYPE_SWC' => 13,
            'IMAGETYPE_IFF' => 14,
            'IMAGETYPE_WBMP' => 15,
            'IMAGETYPE_XBM' => 16
        );
        $exifType = array_search(exif_imagetype($imgPath), $exifImgtype);
        $mimeType = image_type_to_mime_type(exif_imagetype($imgPath));
        $extension = substr(image_type_to_extension(exif_imagetype($imgPath)), 1);
        if ($MimeOrExifOrExtension) {
            if ($MimeOrExifOrExtension === 'Mime') {
                return $mimeType;
            } elseif ($MimeOrExifOrExtension === 'Exif') {
                return $exifType;
            } elseif ($MimeOrExifOrExtension === 'Extension') {
                return $extension;
            } else {
                return $mimeType;
            }
        } else {
            return $mimeType;
        }
    }
}
