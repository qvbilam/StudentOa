<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Controller;

use Think\Controller;

class ZcxKnowledgeController extends Controller
{
    //知识列表
    function Zcxindex()
    {
        $p = M(knowledge);
        $post = $p->join('oa_user u on oa_knowledge.k_author=u.user_id')->select();
        $this->assign('post',$post);
        $this->display();
    }

    function Zcxadd()
    {
        if (IS_POST) {
            //1. 实例化Knowledge模型
            $knowledge = D('Knowledge');
            //2. 调用create方法接收表单数据
            $form_data = $knowledge->create();
            //补全数据
            $form_data['k_author'] = session('id');
            $form_data['k_ctime'] = date('Y-m-d H:i:s');
            //dump($form_data);
            //3. 写入knowledge表
            if ($knowledge->add($form_data)) {
                $this->success('添加知识成功', U('index'), 3);
            } else {
                $this->error('添加知识失败');
            }

        } else {
            $this->display();
        }
    }

    function ZcxupImage()
    {
        //dump($_FILES);die;
        //判断是否有上传文件
        if ($_FILES['Filedata']['size'] > 0) {
            //自定义上传配置项
            $config = C('UPLOAD_FILE');
            $config['exts'] = array('jpg', 'png', 'gif');
            //实例化文件上传类
            $uploader = new \Think\Upload($config);
            //调用upload方法执行文件上传
            $result = $uploader->upload();
            //dump($result);
            //判断上传结果
            if (!$result) {
                echo $uploader->getError();
            } else {
                //dump($result);
                $big_pic = $config['rootPath'] . $result['Filedata']['savepath']
                    . $result['Filedata']['savename'];
                //图片上传成功,制作缩略图
                //实例化图片处理类
                $img = new \Think\Image();
                //打开要处理的图片
                $img->open($big_pic);
                //制作缩略图
                $img->thumb(146, 120, 2);
                //保存缩略图
                $small_pic = $config['rootPath'] . $result['Filedata']['savepath']
                    . 'thumb_' . $result['Filedata']['savename'];
                $img->save($small_pic);

                $arr = array(
                    'big' => $big_pic,
                    'small' => $small_pic
                );
                echo json_encode($arr);
            }
        }
    }
}