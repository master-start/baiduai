<?php
/**
 * @link http://ai.baidu.com/docs#/BodyAnalysis-PHP-SDK/top
 * User: Mkang
 * Date: 2019-01-16
 * Time: 19:48
 */

namespace Mkang\BaiduAIP;

/**
 * Class BodyAnalysis
 *
 * @author  Mkang <96Mkang@gmail.com>
 *
 * @package Mkang\BaiduAIP
 */
class BodyAnalysis extends Api
{
    /**
     * 人体关键点识别 body_analysis api url
     */
    const bodyAnalysisUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/body_analysis';

    /**
     * 人体属性识别 body_attr api url
     */
    const bodyAttrUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/body_attr';

    /**
     * 人流量统计 body_num api url
     */
    const bodyNumUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/body_num';


    /**
     * 人体关键点识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function bodyAnalysis($image, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(BodyAnalysis::bodyAnalysisUrl, $data);
    }

    /**
     * 人体属性识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   type gender,<br>age,<br>lower_wear,<br>upper_wear,<br>headwear,<br>glasses,<br>upper_color,<br>lower_color,<br>cellphone,<br>upper_wear_fg,<br>upper_wear_texture,<br>lower_wear_texture,<br>orientation,<br>umbrella or 1）可选值说明：<br>gender-性别，age-年龄阶段，lower_wear-下身服饰，upper_wear-上身服饰，headwear-是否戴帽子，glasses-是否戴眼镜，upper_color-上身服饰颜色，lower_color-下身服饰颜色，cellphone-是否使用手机，upper_wear_fg-上身服饰细分类，upper_wear_texture-上身服饰纹理，lower_wear_texture-下身服饰纹理，orientation-身体朝向，umbrella-是否撑伞；<br>2）type 参数值可以是可选值的组合，用逗号分隔；**如果无此参数默认输出全部14个属性**
     * @return array
     */
    public function bodyAttr($image, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(BodyAnalysis::bodyAttrUrl, $data);
    }

    /**
     * 人流量统计接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   area 特定框选区域坐标，逗号分隔，如‘x1,y1,x2,y2,x3,y3...xn,yn'，默认尾点和首点相连做闭合，**此参数为空或无此参数默认识别整个图片的人数**
     *   show 是否输出渲染的图片，默认不返回，**选true时返回渲染后的图片(base64)**，其它无效值或为空则默认false
     * @return array
     */
    public function bodyNum($image, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(BodyAnalysis::bodyNumUrl, $data);
    }
}