<?php
/**
 * @link http://ai.baidu.com/docs#/ImageClassify-PHP-SDK/top
 * User: Mkang
 * Date: 2019-01-16
 * Time: 19:34
 */

namespace Mkang\BaiduAIP;

/**
 * Class ImageClassify
 *
 * @author  Mkang <96Mkang@gmail.com>
 *
 * @package Mkang\BaiduAIP
 */
class ImageClassify extends Api
{

    /**
     * 通用物体识别 advanced_general api url
     */
    const advancedGeneralUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v2/advanced_general';

    /**
     * 菜品识别 dish_detect api url
     */
    const dishDetectUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v2/dish';

    /**
     * 车辆识别 car_detect api url
     */
    const carDetectUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/car';

    /**
     * logo商标识别 logo_search api url
     */
    const logoSearchUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v2/logo';

    /**
     * logo商标识别—添加 logo_add api url
     */
    const logoAddUrl = 'https://aip.baidubce.com/rest/2.0/realtime_search/v1/logo/add';

    /**
     * logo商标识别—删除 logo_delete api url
     */
    const logoDeleteUrl = 'https://aip.baidubce.com/rest/2.0/realtime_search/v1/logo/delete';

    /**
     * 动物识别 animal_detect api url
     */
    const animalDetectUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/animal';

    /**
     * 植物识别 plant_detect api url
     */
    const plantDetectUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/plant';

    /**
     * 图像主体检测 object_detect api url
     */
    const objectDetectUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/object_detect';

    /**
     * 图像主体检测 landmark api url
     */
    const landmarkUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/landmark';
    /**
     * 通用物体识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function advancedGeneral($image, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(ImageClassify::advancedGeneralUrl, $data);
    }

    /**
     * 菜品识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   top_num 返回预测得分top结果数，默认为5
     * @return array
     */
    public function dishDetect($image, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(ImageClassify::dishDetectUrl, $data);
    }

    /**
     * 车辆识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   top_num 返回预测得分top结果数，默认为5
     * @return array
     */
    public function carDetect($image, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(ImageClassify::carDetectUrl, $data);
    }

    /**
     * logo商标识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   custom_lib 是否只使用自定义logo库的结果，默认false：返回自定义库+默认库的识别结果
     * @return array
     */
    public function logoSearch($image, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(ImageClassify::logoSearchUrl, $data);
    }

    /**
     * logo商标识别—添加接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param string $brief   - brief，检索时带回。此处要传对应的name与code字段，name长度小于100B，code长度小于150B
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function logoAdd($image, $brief, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);
        $data['brief'] = $brief;

        $data = array_merge($data, $options);

        return $this->post(ImageClassify::logoAddUrl, $data);
    }

    /**
     * logo商标识别—删除接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function logoDeleteByImage($image, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(ImageClassify::logoDeleteUrl, $data);
    }

    /**
     * logo商标识别—删除接口
     *
     * @param string $contSign - 图片签名（和image二选一，image优先级更高）
     * @param array  $options  - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function logoDeleteBySign($contSign, $options = [])
    {

        $data = [];

        $data['cont_sign'] = $contSign;

        $data = array_merge($data, $options);

        return $this->post(ImageClassify::logoDeleteUrl, $data);
    }

    /**
     * 动物识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   top_num 返回预测得分top结果数，默认为6
     * @return array
     */
    public function animalDetect($image, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(ImageClassify::animalDetectUrl, $data);
    }

    /**
     * 植物识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function plantDetect($image, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(ImageClassify::plantDetectUrl, $data);
    }

    /**
     * 图像主体检测接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   with_face 如果检测主体是人，主体区域是否带上人脸部分，0-不带人脸区域，其他-带人脸区域，裁剪类需求推荐带人脸，检索/识别类需求推荐不带人脸。默认取1，带人脸。
     * @return array
     */
    public function objectDetect($image, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(ImageClassify::objectDetectUrl, $data);
    }

    /**
     * 识别地标
     * @param $image
     * @param array $options
     * @return array
     */
    public function landmark($image, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(ImageClassify::landmarkUrl, $data);
    }
}