<?php            
namespace app/index/controller:

class WebPush{

            public function push{

	    	//��̨����ǰ̨��������
	    	$postUrl = 'http://goeasy.io/goeasy/publish'; //������ַ
             
                $appkey = 'your appkey';       //����app key
                $channel = 'your channel';     //����Ŀ��channel
                $content = json_encode($data); //���͵���Ϣ����,��Ϣһ���������ַ����������Ҫ���͵�$data����Ϊ����Ļ���һ��Ҫת����JSON�ַ�����Ȼ����ǰ��JSON����һ��
											   //��Ȼ���$data�����Ϊ�ַ�����,����ֱ��$content = $data;
                                                         
                //׼����POST����
	    	$curlPost = array('appkey' => $appkey,'channel' => $channel,'content'=> $content);
         
                //��ʼ����
	    	$ch = curl_init();//��ʼ��curl         
	    	curl_setopt($ch, CURLOPT_URL,$postUrl);//ץȡָ����ҳ         
	    	curl_setopt($ch, CURLOPT_HEADER, 0);//����header         
	    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//Ҫ����Ϊ�ַ������������Ļ��        
	    	curl_setopt($ch, CURLOPT_POST, 1);//post�ύ��ʽ         
	    	curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);         
	    	$data = curl_exec($ch);//����curl         
	    	curl_close($ch);
            }
}