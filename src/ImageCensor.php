<?php
/**
 * @link http://ai.baidu.com/docs#/ImageCensoring-PHP-SDK/top
 * User: Mkang
 * Date: 2019/1/16
 * Time: 上午11:40
 */

namespace Mkang\BaiduAIP;

/**
 * Class ImageCensor
 *
 * @author  Mkang <96Mkang@gmail.com>
 *
 * @package Mkang\BaiduAIP
 */
class ImageCensor extends Api
{
    const ImageCensorUserDefinedUrl = 'https://aip.baidubce.com/rest/2.0/solution/v1/img_censor/user_defined';

    const AntiSpamUrl = 'https://aip.baidubce.com/rest/2.0/antispam/v2/spam';

    const AntiPornUrl = 'https://aip.baidubce.com/rest/2.0/antiporn/v1/detect';

    const ImageCensorCombUrl = 'https://aip.baidubce.com/api/v1/solution/direct/img_censor';

    const AntiPornGifUrl = 'https://aip.baidubce.com/rest/2.0/antiporn/v1/detect_gif';

    const AntiTerrorUrl = 'https://aip.baidubce.com/rest/2.0/antiterror/v1/detect';

    const FaceAuditUrl = 'https://aip.baidubce.com/rest/2.0/solution/v1/face_audit';

    /**
     * 图片审核
     *
     * @param  string $image 图像
     *
     * @return array
     */
    public function imageCensorUserDefined($image)
    {
        $data = [];

        $isUrl = substr(trim($image), 0, 4) === 'http';
        if (!$isUrl) {
            $data['image'] = base64_encode($image);
        } else {
            $data['imgUrl'] = $image;
        }

        return $this->post(ImageCensor::ImageCensorUserDefinedUrl, $data);
    }


    /**
     * 文本审核
     *
     * @param  string $content 文本内容
     *
     * @return array
     */
    public function antiSpam($content, $options = array())
    {
        $data = array_merge(compact('content'), $options);

        return $this->post(ImageCensor::AntiSpamUrl, $data);
    }


    /**
     * 色情图片识别
     *
     * @param  string $image 图像读取
     *
     * @return array
     */
    public function antiPorn($image)
    {
        $data = [
            'image' => base64_encode($image),
        ];

        return $this->post(ImageCensor::AntiPornUrl, $data);
    }

    /**
     * 组合审核
     *
     * @param        $image
     * @param string $scenes
     * @param array  $options
     *
     * @return array
     */
    public function imageCensorComb($image, $scenes = 'antiporn', $options = array())
    {
        $scenes = !is_array($scenes) ? explode(',', $scenes) : $scenes;

        $data = compact('scenes');

        $isUrl = substr(trim($image), 0, 4) === 'http';
        if (!$isUrl) {
            $data['image'] = base64_encode($image);
        } else {
            $data['imgUrl'] = $image;
        }

        $data = array_merge($data, $options);

        return $this->json(ImageCensor::ImageCensorCombUrl, $data);
    }


    /**
     * gif 色情识别
     *
     * @param  string $image 图像读取
     *
     * @return array
     */
    public function antiPornGif($image)
    {

        $data = ['image' => base64_encode($image)];

        return $this->post(ImageCensor::AntiPornGifUrl, $data);
    }

    /**
     * 反暴恐识别
     *
     * @param  string $image 图像读取
     *
     * @return array
     */
    public function antiTerror($image)
    {
        $data = ['image' => base64_encode($image)];

        return $this->post(ImageCensor::AntiTerrorUrl, $data);
    }

    /**
     * 头像审核
     *
     * @param        $images
     * @param string $configId
     *
     * @return array
     */
    public function faceAudit($images, $configId = '')
    {
        // 非数组则处理为数组
        if (!is_array($images)) {
            $images = [$images];
        }

        $data = ['configId' => $configId];

        $isUrl = substr(trim($images[0]), 0, 4) === 'http';
        if (!$isUrl) {
            $arr = [];

            foreach ($images as $image) {
                $arr[] = base64_encode($image);
            }
            $data['images'] = implode(',', $arr);
        } else {
            $urls = [];

            foreach ($images as $url) {
                $urls[] = urlencode($url);
            }

            $data['imgUrls'] = implode(',', $urls);
        }

        return $this->post(ImageCensor::FaceAuditUrl, $data);
    }

}