<?php
/**
 * User: Mkang
 * Date: 2019-01-16
 * Time: 20:28
 */

namespace Mkang\BaiduAIP;

/**
 * Class Kg
 *
 * @author  Mkang <96Mkang@gmail.com>
 *
 * @package Mkang\BaiduAIP
 */
class Kg extends Api
{

    /**
     * 创建任务 create_task api url
     */
    const createTaskUrl = 'https://aip.baidubce.com/rest/2.0/kg/v1/pie/task_create';

    /**
     * 更新任务 update_task api url
     */
    const updateTaskUrl = 'https://aip.baidubce.com/rest/2.0/kg/v1/pie/task_update';

    /**
     * 获取任务详情 task_info api url
     */
    const taskInfoUrl = 'https://aip.baidubce.com/rest/2.0/kg/v1/pie/task_info';

    /**
     * 以分页的方式查询当前用户所有的任务信息 task_query api url
     */
    const taskQueryUrl = 'https://aip.baidubce.com/rest/2.0/kg/v1/pie/task_query';

    /**
     * 启动任务 task_start api url
     */
    const taskStartUrl = 'https://aip.baidubce.com/rest/2.0/kg/v1/pie/task_start';

    /**
     * 查询任务状态 task_status api url
     */
    const taskStatusUrl = 'https://aip.baidubce.com/rest/2.0/kg/v1/pie/task_status';


    /**
     * 创建任务接口
     *
     * @param string $name             - 任务名字
     * @param string $templateContent  - json string 解析模板内容
     * @param string $inputMappingFile - 抓取结果映射文件的路径
     * @param string $outputFile       - 输出文件名字
     * @param string $urlPattern       - url pattern
     * @param array  $options          - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   limit_count 限制解析数量limit_count为0时进行全量任务，limit_count&gt;0时只解析limit_count数量的页面
     * @return array
     */
    public function createTask($name, $templateContent, $inputMappingFile, $outputFile, $urlPattern, $options = [])
    {
        $data = [];

        $data['name']               = $name;
        $data['template_content']   = $templateContent;
        $data['input_mapping_file'] = $inputMappingFile;
        $data['output_file']        = $outputFile;
        $data['url_pattern']        = $urlPattern;

        $data = array_merge($data, $options);

        return $this->post(Kg::createTaskUrl, $data);
    }

    /**
     * 更新任务接口
     *
     * @param integer $id      - 任务ID
     * @param array   $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   name 任务名字
     *   template_content json string 解析模板内容
     *   input_mapping_file 抓取结果映射文件的路径
     *   url_pattern url pattern
     *   output_file 输出文件名字
     * @return array
     */
    public function updateTask($id, $options = [])
    {
        $data = [];

        $data['id'] = $id;

        $data = array_merge($data, $options);

        return $this->post(Kg::updateTaskUrl, $data);
    }

    /**
     * 获取任务详情接口
     *
     * @param integer $id      - 任务ID
     * @param array   $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function getTaskInfo($id, $options = [])
    {
        $data = [];

        $data['id'] = $id;

        $data = array_merge($data, $options);

        return $this->post(Kg::taskInfoUrl, $data);
    }

    /**
     * 以分页的方式查询当前用户所有的任务信息接口
     *
     * @param array $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   id 任务ID，精确匹配
     *   name 中缀模糊匹配,abc可以匹配abc,aaabc,abcde等
     *   status 要筛选的任务状态
     *   page 页码
     *   per_page 页码
     * @return array
     */
    public function getUserTasks($options = [])
    {
        $data = [];


        $data = array_merge($data, $options);

        return $this->post(Kg::taskQueryUrl, $data);
    }

    /**
     * 启动任务接口
     *
     * @param integer $id      - 任务ID
     * @param array   $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function startTask($id, $options = [])
    {
        $data = [];

        $data['id'] = $id;

        $data = array_merge($data, $options);

        return $this->post(Kg::taskStartUrl, $data);
    }

    /**
     * 查询任务状态接口
     *
     * @param integer $id      - 任务ID
     * @param array   $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function getTaskStatus($id, $options = [])
    {
        $data = [];

        $data['id'] = $id;

        $data = array_merge($data, $options);

        return $this->post(Kg::taskStatusUrl, $data);
    }
}