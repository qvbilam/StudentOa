<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Controller;

use \Think\Controller;

class ZcxDocController extends Controller
{
    function ZcxeditDoc()
    {
        $doc_model = D('Doc');
        if (IS_POST) {
            //1. 判断是否有新附件上传
            if ($_FILES['file']['size'] > 0) {
                //自定义文件上传配置项
                $config = C('UPLOAD_FILE');
                //实例化文件上传类
                $uploader = new Upload($config);
                //调用upload方法进行文件上传
                $result = $uploader->upload();
                //判断上传结果，如果该结果为false，则报错；反之，则拼装文件上传路径
                if (!$result) {
                    echo $uploader->getError();
                } else {
                    //拼接新上传文件的路径
                    $path = $config['rootPath'] . $result['file']['savepath'] .
                        $result['file']['savename'];
                }
            }
            //2. 收集表单数据
            $form_data = $doc_model->create('', 2);
            if (isset($path)) {
                //上传成功时，将旧的附件路径取出
                $old_path = $doc_model->field('doc_file')->find($form_data['doc_id']);
                //将新文件的路径补充到form_data中，方便修改
                $form_data['doc_file'] = $path;

            }
            //dump($form_data);die;
            //3. 修改数据表
            if ($doc_model->save($form_data)) {
                //修改成功后，删除旧的附件
                if (is_file($old_path['doc_file'])) {
                    unlink($old_path['doc_file']);
                }
                $this->success('修改公文成功', U('index'), 3);
            } else {
                $this->error('修改公文失败', U('editDoc', 'id=' . $form_data['doc_id']), 3);
            }

        } else {
            //1. 接收doc_id
            $doc_id = I('get.id');
            $doc_info = $doc_model->find($doc_id);
            $this->assign('doc_info', $doc_info);

            $this->display();
        }
    }

    function ZcxdelDoc()
    {
        //1. 接收doc_id
        $doc_id = I('get.id');
        //2. 实例化Doc模型，删除doc_id对应的数据
        $doc_model = D('Doc');
        //3. 将附件路径取出
        $docinfo = $doc_model->field('doc_file')->find($doc_id);

        if ($doc_model->delete($doc_id)) {
            //当删除数据表数据成功时，删除附件   is_file  file_exist
            if ($docinfo['doc_file'] != 'null') {
                unlink($docinfo['doc_file']);
            }
            $this->success('删除公文成功', U('index'), 3);
        } else {
            $this->error('删除公文失败', U('index'), 3);
        }
    }

    function ZcxgetContent()
    {
        //1. 接收传递的doc_id
        $doc_id = I('post.id');
        //2. 实例化Doc模型，调用find方法查询数据
        $docinfo = D('Doc')->field('doc_id,doc_title,doc_content')->find($doc_id);
        $docinfo['doc_content'] = htmlspecialchars_decode($docinfo['doc_content']);
        //将数组转为json对象，直接输出，返回给前台
        echo json_encode($docinfo);
    }

    function index()
    {
        //实例化Doc模型
        $doc_model = D('Doc');
        //联合User表查询数据
        $doc_list = $doc_model
            ->alias('d')
            ->field('d.*,u.user_nickname')
            ->join('left join oa_user u on d.doc_author=u.user_id')
            ->select();
        $this->assign('doc_list', $doc_list);

        $this->display();
    }

    function Zcxdownload()
    {
        //1. 接收doc_id
        $doc_id = I('get.id');
        //2. 实例化Doc模型，读取数据表中的对应数据
        $docinfo = D('Doc')->field('doc_file')->find($doc_id);
        $file = $docinfo['doc_file'];

        header("Content-type: application/octet-stream");
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header("Content-Length: " . filesize($file));
        readfile($file);
    }

    function Zcxadd()
    {
        $this->display();
    }

    function Zcxaddok()
    {
        //定义上传成功的路径
        $upload_path = 'null';
        //判断上传文件的大小大于0，说明有文件上传
        if ($_FILES['file']['size'] > 0) {
            //1. 自定义文件上传配置项
            $config = C('UPLOAD_FILE');
            //dump($config);die;
            //2. 实例化文件上传类
            $uploader = new \Think\Upload($config);
            //3. 调用upload方法执行文件上传
            $result = $uploader->upload();
            //4. 判断上传结果
            if (!$result) {
                echo $uploader->getError();
            } else {
                //文件上传后的全路径
                $upload_path = $config['rootPath'] . $result['file']['savepath'] .
                    $result['file']['savename'];
            }
        }
        //实例化Doc模型，调用create方法接收表单数据
        $doc_model = D('Doc');
        $form_data = $doc_model->create('', 1);
        if (!$form_data) {
            echo $doc_model->getError();
        } else {
            $form_data['doc_file'] = $upload_path;
            //将数据写入doc表
            $result_add = $doc_model->add($form_data);
            if ($result_add) {
                $this->success('添加公文成功', U('index'), 3);
            } else {
                $this->error('添加公文失败');
            }
        }
    }
}
