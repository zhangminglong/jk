<?php
/********************
	��ά������
********************/
namespace app\index\controller;

class QRcode
{
    
    /**
     * ����ָ����ַ�Ķ�ά��
     * @param string $url ��ά�������������ַ
     * @param string $label ��ǩ����
     */
    public function create_qrcode($url,$label)
    {
        $qrCode = new \Endroid\QrCode\QrCode();//�������ɶ�ά�����
        $qrCode->setText($url)
        ->setSize(150)
        ->setPadding(10)
        ->setErrorCorrection('high')
        ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
        ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
        ->setLabel($label)      //��ǩ
        ->setLabelFontSize(10)  //��ǩ������Ĵ�С
        ->setImageType(\Endroid\QrCode\QrCode::IMAGE_TYPE_PNG);
        header("Content-type: image/png");
        $qrCode->render();
    }
    //ʹ�÷���
	//��ģ���ļ���ʹ��<img src="{:url('index/qrcode/create_qrcode')}">
}
    