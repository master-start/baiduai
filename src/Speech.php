<?php
/**
 * @link http://ai.baidu.com/docs#/TTS-Online-PHP-SDK/top
 * User: Mkang
 * Date: 2019-01-16
 * Time: 19:10
 */

namespace Mkang\BaiduAIP;

use GuzzleHttp\RequestOptions;

/**
 * Class Speech
 *
 * @author  Mkang <96Mkang@gmail.com>
 *
 * @package Mkang\BaiduAIP
 */
class Speech extends Api
{
    const AsrUrl = 'http://vop.baidu.com/server_api';

    const TtsUrl = 'http://tsn.baidu.com/text2audio';

    protected function specialHandling($url, $options)
    {
        $token                   = $options['query']['access_token'];
        $options['json']['cuid'] = md5($token);

        if ($url === Speech::AsrUrl) {
            $options['json']['token'] = $token;
        } else {
            $options['json']['tok'] = $token;
        }

        unset($options['query']['access_token']);

        return $options;
    }

    /**
     * 语音识别
     *
     * @param  string $speech
     * @param  string $format
     * @param  int    $rate
     * @param  array  $options
     *
     * @return array
     */
    public function asr($speech, $format, $rate = 16000, $options = [])
    {
        $data = [
            'format'  => $format,
            'rate'    => $rate,
            'channel' => 1,
        ];

        if (!empty($speech)) {
            $data['speech'] = base64_encode($speech);
            $data['len']    = strlen($speech);
        }

        $data = array_merge($data, $options);

        return $this->json(Speech::AsrUrl, $data);
    }


    /**
     * 语音合成
     *
     * @param  string $text
     * @param  string $lang
     * @param  int    $ctp
     * @param  array  $options
     *
     * @return array
     */
    public function synthesis(string $text, $lang = 'zh', $ctp = 1, array $options = [])
    {
        $data = [
            'tex' => $text,
            'lan' => $lang,
            'ctp' => $ctp,
        ];

        $data = array_merge($data, $options);

        return $this->post(Speech::TtsUrl, $data);
    }

}