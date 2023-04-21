<?php
/**
 * @link http://ai.baidu.com/docs#/NLP-PHP-SDK/top
 * User: Mkang
 * Date: 2019-01-16
 * Time: 20:17
 */

namespace Mkang\BaiduAIP;

/**
 * Class Nlp
 *
 * @author  Mkang <96Mkang@gmail.com>
 *
 * @package Mkang\BaiduAIP
 */
class Nlp extends Api
{
    /**
     * 词法分析 lexer api url
     */
    const lexerUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v1/lexer';

    /**
     * 词法分析（定制版） lexer_custom api url
     */
    const lexerCustomUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v1/lexer_custom';

    /**
     * 依存句法分析 dep_parser api url
     */
    const depParserUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v1/depparser';

    /**
     * 词向量表示 word_embedding api url
     */
    const wordEmbeddingUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v2/word_emb_vec';

    /**
     * DNN语言模型 dnnlm_cn api url
     */
    const dnnlmCnUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v2/dnnlm_cn';

    /**
     * 词义相似度 word_sim_embedding api url
     */
    const wordSimEmbeddingUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v2/word_emb_sim';

    /**
     * 短文本相似度 simnet api url
     */
    const simnetUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v2/simnet';

    /**
     * 评论观点抽取 comment_tag api url
     */
    const commentTagUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v2/comment_tag';

    /**
     * 情感倾向分析 sentiment_classify api url
     */
    const sentimentClassifyUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v1/sentiment_classify';

    /**
     * 文章标签 keyword api url
     */
    const keywordUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v1/keyword';

    /**
     * 文章分类 topic api url
     */
    const topicUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v1/topic';

    /**
     * 文本纠错 ecnet api url
     */
    const ecnetUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v1/ecnet';

    /**
     * 对话情绪识别接口 emotion api url
     */
    const emotionUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v1/emotion';

    /**
     * 地址识别接口 address api url
     */
    const addressUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v1/address';

    /**
     * 格式化结果
     *
     * @param $content string
     *
     * @return mixed
     */
    protected function proccessResult($content)
    {
        return json_decode(mb_convert_encoding($content, 'UTF8', 'GBK'), true, 512, JSON_BIGINT_AS_STRING);
    }

    /**
     * 词法分析接口
     *
     * @param string $text    - 待分析文本（目前仅支持GBK编码），长度不超过65536字节
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function lexer($text, $options = [])
    {
        $data         = [];
        $data['text'] = $text;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');
        $data = json_decode($data, true);

        return $this->post(Nlp::lexerUrl, $data);
    }

    /**
     * 词法分析（定制版）接口
     *
     * @param string $text    - 待分析文本（目前仅支持GBK编码），长度不超过65536字节
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function lexerCustom($text, $options = [])
    {
        $data         = [];
        $data['text'] = $text;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');
        $data = json_decode($data, true);

        return $this->post(Nlp::lexerCustomUrl, $data);
    }

    /**
     * 依存句法分析接口
     *
     * @param string $text    - 待分析文本（目前仅支持GBK编码），长度不超过256字节
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   mode 模型选择。默认值为0，可选值mode=0（对应web模型）；mode=1（对应query模型）
     * @return array
     */
    public function depParser($text, $options = [])
    {
        $data         = [];
        $data['text'] = $text;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');
        $data = json_decode($data, true);

        return $this->post(Nlp::depParserUrl, $data);
    }

    /**
     * 词向量表示接口
     *
     * @param string $word    - 文本内容（GBK编码），最大64字节
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function wordEmbedding($word, $options = [])
    {
        $data         = [];
        $data['word'] = $word;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');
        $data = json_decode($data, true);

        return $this->post(Nlp::wordEmbeddingUrl, $data);
    }

    /**
     * DNN语言模型接口
     *
     * @param string $text    - 文本内容（GBK编码），最大512字节，不需要切词
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function dnnlm($text, $options = [])
    {
        $data         = [];
        $data['text'] = $text;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');
        $data = json_decode($data, true);

        return $this->post(Nlp::dnnlmCnUrl, $data);
    }

    /**
     * 词义相似度接口
     *
     * @param string $word1   - 词1（GBK编码），最大64字节
     * @param string $word2   - 词1（GBK编码），最大64字节
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   mode 预留字段，可选择不同的词义相似度模型。默认值为0，目前仅支持mode=0
     * @return array
     */
    public function wordSimEmbedding($word1, $word2, $options = [])
    {
        $data           = [];
        $data['word_1'] = $word1;
        $data['word_2'] = $word2;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');
        $data = json_decode($data, true);

        return $this->post(Nlp::wordSimEmbeddingUrl, $data);
    }

    /**
     * 短文本相似度接口
     *
     * @param string $text1   - 待比较文本1（GBK编码），最大512字节
     * @param string $text2   - 待比较文本2（GBK编码），最大512字节
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   model 默认为"BOW"，可选"BOW"、"CNN"与"GRNN"
     * @return array
     */
    public function simnet($text1, $text2, $options = [])
    {
        $data           = [];
        $data['text_1'] = $text1;
        $data['text_2'] = $text2;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');
        $data = json_decode($data, true);

        return $this->post(Nlp::simnetUrl, $data);
    }

    /**
     * 评论观点抽取接口
     *
     * @param string $text    - 评论内容（GBK编码），最大10240字节
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   type 评论行业类型，默认为4（餐饮美食）
     * @return array
     */
    public function commentTag($text, $options = [])
    {
        $data         = [];
        $data['text'] = $text;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');
        $data = json_decode($data, true);

        return $this->post(Nlp::commentTagUrl, $data);
    }

    /**
     * 情感倾向分析接口
     *
     * @param string $text    - 文本内容（GBK编码），最大102400字节
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function sentimentClassify($text, $options = [])
    {
        $data         = [];
        $data['text'] = $text;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');
        $data = json_decode($data, true);

        return $this->json(Nlp::sentimentClassifyUrl, $data);
    }

    /**
     * 文章标签接口
     *
     * @param string $title   - 篇章的标题，最大80字节
     * @param string $content - 篇章的正文，最大65535字节
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function keyword($title, $content, $options = [])
    {
        $data            = [];
        $data['title']   = $title;
        $data['content'] = $content;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');
        $data = json_decode($data, true);

        return $this->post(Nlp::keywordUrl, $data);
    }

    /**
     * 文章分类接口
     *
     * @param string $title   - 篇章的标题，最大80字节
     * @param string $content - 篇章的正文，最大65535字节
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function topic($title, $content, $options = [])
    {
        $data            = [];
        $data['title']   = $title;
        $data['content'] = $content;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');
        $data = json_decode($data, true);

        return $this->post(Nlp::topicUrl, $data);
    }

    /**
     * 文本纠错接口
     *
     * @param string $text    - 待纠错文本，输入限制511字节
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function ecnet($text, $options = [])
    {
        $data         = [];
        $data['text'] = $text;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');
        $data = json_decode($data, true);

        return $this->post(Nlp::ecnetUrl, $data);
    }

    /**
     * 对话情绪识别接口接口
     *
     * @param string $text    - 待识别情感文本，输入限制512字节
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   scene default（默认项-不区分场景），talk（闲聊对话-如度秘聊天等），task（任务型对话-如导航对话等），customer_service（客服对话-如电信/银行客服等）
     * @return array
     */
    public function emotion($text, $options = [])
    {
        $data         = [];
        $data['text'] = $text;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');
        $data = json_decode($data, true);

        return $this->json(Nlp::emotionUrl, $data);
    }

    /**
     * 地址识别接口
     * @param $text
     * @param array $options
     * @return array
     */
    public function address($text, $options = [])
    {
        $data         = [];
        $data['text'] = $text;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');
        $data = json_decode($data, true);

        return $this->json(Nlp::addressUrl, $data);
    }
}