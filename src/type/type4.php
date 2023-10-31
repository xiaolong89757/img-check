<?php
class type4
{
    protected $status = true;
    protected $hearder = ['ffd8ff', '89504e', '474946'];
    protected $footer = ['ffd9', '6082', '003b'];
    protected $msg = '图片源文件头部错误';

    public function run($file)
    {
        // 读取文件内容
        $fileContent = file_get_contents($file);
        if ($fileContent !== false) {
            // 将文件内容转换为十六进制字符串
            $hexString = bin2hex($fileContent);

            $head = strtolower(substr($hexString, 0, 6));
            if (!in_array($head, $this->hearder)) {
                $this->status = false;
            }

            $length = strlen($hexString);
            $foot = substr($hexString, $length - 4);
            if (!in_array($foot, $this->footer)) {
                $this->status = false;
                $this->msg = '图片源文件结束符号错误';
            }
        } else {
            // 文件读取失败
            echo 'Failed to read the file.';
        }
        return ['status' => $this->status, 'msg' => $this->msg];
    }
}
