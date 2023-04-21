<?php
/**
 * User: Mkang
 * Date: 2019-01-15
 * Time: 19:14
 */

namespace Mkang\BaiduAIP;

use GuzzleHttp\RequestOptions;
use Hanson\Foundation\AbstractAPI;
use Mkang\BaiduAIP\Exceptions\UndefinedApplicationConfigurationException;
use Mkang\BaiduAIP\Kernel\AipSampleSigner;

/**
 * Class Api
 *
 * @author  Mkang <96Mkang@gmail.com>
 *
 * @package Mkang\BaiduAIP
 */
class Api extends AbstractAPI
{
    /**
     * @var BaiduAIP 百度 aip 实例
     */
    protected $app;

    /**
     * @var string 所需权限
     */
    protected $scope = 'brain_all_scope';

    /**
     * @var string sdk 版本
     */
    protected $version = '2_2_5';

    const ReportUrl = 'https://aip.baidubce.com/rpc/2.0/feedback/v1/report';

    /**
     * @var bool
     */
    protected $isCloudUser;

    /**
     * @param BaiduAIP $app
     */
    public function __construct(BaiduAIP $app)
    {
        $this->app = $app;
    }


    /**
     * 不是云的老用户则不用在header中签名认证
     *
     * @return bool
     */
    protected function isCloudUser(): bool
    {
        if (is_null($this->isCloudUser)) {
            $scope             = $this->app->access_token->getScope();
            $this->isCloudUser = $scope && in_array($this->scope, explode(' ', $scope));
        }

        return $this->isCloudUser;
    }

    /**
     * @param  string $method HTTP method
     * @param  string $url
     * @param  array  $param  参数
     *
     * @return array
     * @throws UndefinedApplicationConfigurationException
     */
    private function getAuthHeaders($method, $url, $params = [], $headers = []): array
    {
        if ($this->isCloudUser()) {
            $obj = parse_url($url);
            if (!empty($obj['query'])) {
                $query = explode('&', $obj['query']);
                foreach ($query as $kv) {
                    if (!empty($kv)) {
                        list($k, $v) = explode('=', $kv, 2);
                        $params[$k] = $v;
                    }
                }
            }

            //UTC 时间戳
            $timestamp             = gmdate('Y-m-d\TH:i:s\Z');
            $headers['Host']       = isset($obj['port']) ? sprintf('%s:%s', $obj['host'], $obj['port']) : $obj['host'];
            $headers['x-bce-date'] = $timestamp;

            //签名
            $headers['authorization'] = AipSampleSigner::sign([
                'ak' => $this->app->getAppId(),
                'sk' => $this->app->getSecretKey(),
            ], $method, $obj['path'], $headers, $params, [
                'timestamp'     => $timestamp,
                'headersToSign' => array_keys($headers),
            ]);

            return $headers;
        }

        return $headers;
    }

    protected function specialHandling($url, $options)
    {
        $params = [
            'aipSdk'        => 'php',
            'aipSdkVersion' => $this->version,
        ];

        $options['query'] = array_merge($options['query'], $params);

        return $options;
    }

    /**
     * @param string $url
     * @param array  $options
     *
     * @return array
     */
    public function request(string $url, array $options)
    {
        $params           = ['access_token' => $this->app->access_token->getToken()];
        $options['query'] = $params;

        $options = $this->specialHandling($url, $options);

        $options['headers'] = $this->getAuthHeaders('POST', $url, $params, $options['headers']);

        $response = json_decode($this->getHttp()->request('POST', $url, $options)->getBody()->__toString(), true);

        return $response;
    }

    /**
     * @param string $url
     * @param array  $data
     * @param array  $headers
     *
     * @return array
     */
    public function post(string $url, array $data, array $headers = [])
    {
        return $this->request($url, [RequestOptions::FORM_PARAMS => $data, RequestOptions::HEADERS => $headers]);
    }

    /**
     * @param string $url
     * @param array  $data
     * @param array  $headers
     *
     * @return array
     */
    public function json(string $url, array $data, array $headers = [])
    {
        return $this->request($url, [RequestOptions::JSON => $data, RequestOptions::HEADERS => $headers]);
    }


    /**
     * 反馈
     *
     * @param array $feedback
     *
     * @return array
     */
    public function report(array $feedback)
    {
        return $this->post(Api::ReportUrl, compact('feedback'));
    }

}