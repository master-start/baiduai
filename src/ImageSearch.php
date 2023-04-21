<?php
/**
 * @link http://ai.baidu.com/docs#/ImageSearch-PHP-SDK/top
 * User: Mkang
 * Date: 2019-01-16
 * Time: 19:42
 */

namespace Mkang\BaiduAIP;

/**
 * Class ImageSearch
 *
 * @author  Mkang <96Mkang@gmail.com>
 *
 * @package Mkang\BaiduAIP
 */
class ImageSearch extends Api
{
    /**
     * 相同图检索—入库 same_hq_add api url
     */
    const sameHqAddUrl = 'https://aip.baidubce.com/rest/2.0/realtime_search/same_hq/add';

    /**
     * 相同图检索—检索 same_hq_search api url
     */
    const sameHqSearchUrl = 'https://aip.baidubce.com/rest/2.0/realtime_search/same_hq/search';

    /**
     * 相同图检索—删除 same_hq_delete api url
     */
    const sameHqDeleteUrl = 'https://aip.baidubce.com/rest/2.0/realtime_search/same_hq/delete';

    /**
     * 相似图检索—入库 similar_add api url
     */
    const similarAddUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/realtime_search/similar/add';

    /**
     * 相似图检索—检索 similar_search api url
     */
    const similarSearchUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/realtime_search/similar/search';

    /**
     * 相似图检索—删除 similar_delete api url
     */
    const similarDeleteUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/realtime_search/similar/delete';

    /**
     * 商品检索—入库 product_add api url
     */
    const productAddUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/realtime_search/product/add';

    /**
     * 商品检索—检索 product_search api url
     */
    const productSearchUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/realtime_search/product/search';

    /**
     * 商品检索—删除 product_delete api url
     */
    const productDeleteUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/realtime_search/product/delete';


    /**
     * 相同图检索—入库接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   brief 检索时原样带回,最长256B。
     *   tags 1 - 65535范围内的整数，tag间以逗号分隔，最多2个tag。样例："100,11" ；检索时可圈定分类维度进行检索
     * @return array
     */
    public function sameHqAdd($image, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(ImageSearch::sameHqAddUrl, $data);
    }

    /**
     * 相同图检索—检索接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   tags 1 - 65535范围内的整数，tag间以逗号分隔，最多2个tag。样例："100,11" ；检索时可圈定分类维度进行检索
     *   tag_logic 检索时tag之间的逻辑， 0：逻辑and，1：逻辑or
     *   pn 分页功能，起始位置，例：0。未指定分页时，默认返回前300个结果；接口返回数量最大限制1000条，例如：起始位置为900，截取条数500条，接口也只返回第900 - 1000条的结果，共计100条
     *   rn 分页功能，截取条数，例：250
     * @return array
     */
    public function sameHqSearch($image, $options = [])
    {
        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(ImageSearch::sameHqSearchUrl, $data);
    }

    /**
     * 相同图检索—删除接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function sameHqDeleteByImage($image, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(ImageSearch::sameHqDeleteUrl, $data);
    }

    /**
     * 相同图检索—删除接口
     *
     * @param string $contSign - 图片签名（和image二选一，image优先级更高）
     * @param array  $options  - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function sameHqDeleteBySign($contSign, $options = [])
    {

        $data = [];

        $data['cont_sign'] = $contSign;

        $data = array_merge($data, $options);

        return $this->post(ImageSearch::sameHqDeleteUrl, $data);
    }

    /**
     * 相似图检索—入库接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   brief 检索时原样带回,最长256B。
     *   tags 1 - 65535范围内的整数，tag间以逗号分隔，最多2个tag。样例："100,11" ；检索时可圈定分类维度进行检索
     * @return array
     */
    public function similarAdd($image, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(ImageSearch::similarAddUrl, $data);
    }

    /**
     * 相似图检索—检索接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   tags 1 - 65535范围内的整数，tag间以逗号分隔，最多2个tag。样例："100,11" ；检索时可圈定分类维度进行检索
     *   tag_logic 检索时tag之间的逻辑， 0：逻辑and，1：逻辑or
     *   pn 分页功能，起始位置，例：0。未指定分页时，默认返回前300个结果；接口返回数量最大限制1000条，例如：起始位置为900，截取条数500条，接口也只返回第900 - 1000条的结果，共计100条
     *   rn 分页功能，截取条数，例：250
     * @return array
     */
    public function similarSearch($image, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(ImageSearch::similarSearchUrl, $data);
    }

    /**
     * 相似图检索—删除接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function similarDeleteByImage($image, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(ImageSearch::similarDeleteUrl, $data);
    }

    /**
     * 相似图检索—删除接口
     *
     * @param string $contSign - 图片签名（和image二选一，image优先级更高）
     * @param array  $options  - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function similarDeleteBySign($contSign, $options = [])
    {

        $data = [];

        $data['cont_sign'] = $contSign;

        $data = array_merge($data, $options);

        return $this->post(ImageSearch::similarDeleteUrl, $data);
    }

    /**
     * 商品检索—入库接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   brief 检索时原样带回,最长256B。**请注意，检索接口不返回原图，仅反馈当前填写的brief信息，所以调用该入库接口时，brief信息请尽量填写可关联至本地图库的图片id或者图片url、图片名称等信息**
     *   class_id1 商品分类维度1，支持1-60范围内的整数。检索时可圈定该分类维度进行检索
     *   class_id2 商品分类维度1，支持1-60范围内的整数。检索时可圈定该分类维度进行检索
     * @return array
     */
    public function productAdd($image, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(ImageSearch::productAddUrl, $data);
    }

    /**
     * 商品检索—检索接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   class_id1 商品分类维度1，支持1-60范围内的整数。检索时可圈定该分类维度进行检索
     *   class_id2 商品分类维度1，支持1-60范围内的整数。检索时可圈定该分类维度进行检索
     *   pn 分页功能，起始位置，例：0。未指定分页时，默认返回前300个结果；接口返回数量最大限制1000条，例如：起始位置为900，截取条数500条，接口也只返回第900 - 1000条的结果，共计100条
     *   rn 分页功能，截取条数，例：250
     * @return array
     */
    public function productSearch($image, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(ImageSearch::productSearchUrl, $data);
    }

    /**
     * 商品检索—删除接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function productDeleteByImage($image, $options = [])
    {

        $data = [];

        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->post(ImageSearch::productDeleteUrl, $data);
    }

    /**
     * 商品检索—删除接口
     *
     * @param string $contSign - 图片签名（和image二选一，image优先级更高）
     * @param array  $options  - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function productDeleteBySign($contSign, $options = [])
    {
        $data              = [];
        $data['cont_sign'] = $contSign;

        $data = array_merge($data, $options);

        return $this->post(ImageSearch::productDeleteUrl, $data);
    }
}