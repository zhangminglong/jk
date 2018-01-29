package com.example.cookbook;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.util.ArrayList;
import java.util.List;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.protocol.HTTP;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.util.Log;

public class GetCookbookData {
	
	/*���뵽�� �ۺ�����api ��key*/
	private final String appKey = "dbab58a7a5fb096079bf765370257eef";
	private final String url = "http://apis.juhe.cn/cook/query";
	
	/*������Ϣ�ṹ��*/
	public class Cookbook {
		public int id;	//id
		public String title;	//����
		public String tags;	//��ǩ
		public String imtro;	//����
		public String ingredients;	//����
		public String burden;	//ԭ��
		public String albums;	//ͼƬ
		public ArrayList<String> step = new ArrayList<String>();	//����
	}
	
	/**
	 * ���api���ص�json�ַ���
	 * @param menu
	 * @return
	 */
	private String getJsonFromServer(String menu) throws Exception {
		
		BufferedReader in = null;
		String result = null;
		
		try { 
			HttpClient client = new DefaultHttpClient();
			HttpPost request = new HttpPost(url);
			
	        // ������/ֵ���б�  
	        List<NameValuePair> parameters = new ArrayList<NameValuePair>();
	        parameters.add(new BasicNameValuePair("key", appKey));
	        parameters.add(new BasicNameValuePair("menu", menu));
	        parameters.add(new BasicNameValuePair("albums", "1"));
	        
	        // ����UrlEncodedFormEntity����  
	        UrlEncodedFormEntity formEntiry = new UrlEncodedFormEntity(parameters, HTTP.UTF_8);//���ñ��룬��ֹ�������� 
	        request.setEntity(formEntiry);
	        
	        // ִ������  
	        HttpResponse response = client.execute(request);
	        
	        // ���ղ�����������
	        in = new BufferedReader(new InputStreamReader(response.getEntity().getContent())); 
	        StringBuffer sb = new StringBuffer("");
	        String line = "";
	        String NL = System.getProperty("line.separator");
	        while ((line = in.readLine()) != null) {  
	            sb.append(line + NL);
	        } 
	        in.close(); 
	        result = sb.toString();
	        
	        //�����ã�logcat��ӡ���ص�json�ַ���
	        Log.i("myTag", "���������صĽ����" + result);
        
		} catch(Exception e) {
			Log.e("myTag", "getJsonFromServer���� ");
			e.printStackTrace();
		} finally {
			if (in != null) {
                try {
                    in.close();  
                } catch (Exception e) {  
                	Log.e("myTag", e.getMessage());
                }  
            }
		}
		
		return result;
	}
	
	/**
	 * ��json�ַ���ת����cookbook���͵�ArrayList����
	 * @param json
	 * @throws JSONException 
	 */
	private ArrayList<Cookbook> jsonToCookbook(String json) throws JSONException {
		
		//��ʼ��ArrayList<Cookbook>
		ArrayList<Cookbook> listCookbook =  new ArrayList<Cookbook>();
		
		//��÷��ص�״̬��
		JSONObject jsonObject = new JSONObject(json);
		int resultCode = jsonObject.getInt("resultcode");
		
		//״̬��Ϊ200�ٽ���
		if(resultCode == 200) {
			JSONObject jsonObjectResult = new JSONObject(jsonObject.getString("result"));
			JSONArray jsonArrayData = new JSONArray(jsonObjectResult.getString("data"));		
			for(int i = 0; i < jsonArrayData.length(); i++) {
				Cookbook cookbook = new Cookbook();
				JSONObject jsonObjectCookbook = (JSONObject) jsonArrayData.get(i);
				JSONArray jsonArraySteps = new JSONArray(jsonObjectCookbook.getString("steps"));
				
				cookbook.id = jsonObjectCookbook.getInt("id");
				cookbook.title = jsonObjectCookbook.getString("title");
				cookbook.tags = jsonObjectCookbook.getString("tags");
				cookbook.imtro = jsonObjectCookbook.getString("imtro");
				
				//ȥ����ַ�е�ת�����\
				cookbook.imtro = cookbook.imtro.replace("\\" , "");	
				
				cookbook.ingredients = jsonObjectCookbook.getString("ingredients");
				cookbook.burden = jsonObjectCookbook.getString("burden");
				cookbook.albums = jsonObjectCookbook.getString("albums");
				
				for(int j = 0; j < jsonArraySteps.length(); j++) {
					String img;
					JSONObject JSONObjectStep = (JSONObject) jsonArraySteps.get(j);
					//ȥ����ַ�е�ת�����\
//					img = JSONObjectStep.getString("img").replace("\\" , "");
//					cookbook.step.add(img);		
					cookbook.step.add(JSONObjectStep.getString("step"));
				}
				listCookbook.add(cookbook);
			}
			return listCookbook;
		} else {
			String reason = jsonObject.getString("reason");
			int errorCode = jsonObject.getInt("error_code");
			Log.e("mytag", "resultcode: " + resultCode + "\nreason: " + reason + "\nerror_code: " + errorCode);
			return null;
		}

	}
	
	public ArrayList<Cookbook> run(String menu) {
		String result = null;
		ArrayList<Cookbook> listCookbook =  new ArrayList<Cookbook>();
		
		try {
			result = getJsonFromServer(menu);
			if(result != null) {
				listCookbook = jsonToCookbook(result);
			}
		} catch (Exception e) {
			Log.d("myTag", "�޷��ӷ���˻������: ");
			e.printStackTrace();
		}
		
		return listCookbook; 	
	}
}
