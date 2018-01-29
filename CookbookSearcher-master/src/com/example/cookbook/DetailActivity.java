package com.example.cookbook;

import java.util.ArrayList;

import com.example.cookbook.GetCookbookData.Cookbook;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.util.Log;
import android.view.View;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.webkit.WebSettings.LayoutAlgorithm;

public class DetailActivity extends Activity {
	
	private WebView webview;
	private String keyword;
	private final String url = "file:///android_asset/detail.html"; 
	ArrayList<Cookbook> listCookbook =  new ArrayList<Cookbook>();
	//����Handler����
	Handler handler = new Handler() {
	    @Override
	    public void handleMessage(Message msg) {
	        super.handleMessage(msg);
	        Bundle data = msg.getData();
	        String status = data.getString("status");
	        if(status.equals("OK")) {
	        	webview.loadUrl(url);	//����html�ļ���webview
	        }
	    }
	};
	//�½�һ���̶߳���
	Runnable runnable = new Runnable() {
	    @Override
	    public void run() {
	    	//��������
	    	GetCookbookData getCookbookData = new GetCookbookData();
	    	listCookbook = getCookbookData.run(keyword);
	        Message msg = new Message();
	        Bundle data = new Bundle();
	        data.putString("status", "OK");
	        msg.setData(data);
	        handler.sendMessage(msg);
	    }
	};
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		
		webview = (WebView) findViewById(R.id.webView);
		
		//ȡ�������ؼ���
		Intent intent = getIntent();
		keyword = intent.getStringExtra("keyword");
		
		//��Runnable����HTTP�����Է�����UI�߳���NetworkOnMainThreadException
		new Thread(runnable).start();
		
		//����webview�Ĳ����ͼ��ر���ҳ��
		webview.setScrollBarStyle(View.SCROLLBARS_INSIDE_OVERLAY);	//��ʹ��������ռλ
		webview.getSettings().setBuiltInZoomControls(false);	//�������½����Ű�ť
		webview.getSettings().setSupportZoom(false);	//������html����
		webview.getSettings().setJavaScriptEnabled(true);	//���룡ʹwebview�е�html֧��javascript���ܹ��밲׿���н���
		webview.getSettings().setUseWideViewPort(true);	//ʹ����Ӧ�ֱ���
		webview.getSettings().setLoadWithOverviewMode(true);	//ʹ����Ӧ�ֱ���
		webview.setWebViewClient(new webViewClient()); ////ΪWebView����WebViewClient����ĳЩ����	
		webview.getSettings().setLayoutAlgorithm(LayoutAlgorithm.SINGLE_COLUMN);// ��ֹ�������ݹ������º���������
//		webview.addJavascriptInterface(this, "android");	//ע�⣡ʹ��������䣬���ڱ����onCreate�������ע��@SuppressLint("JavascriptInterface")���͵���android.annotation.SuppressLint������Ȼ�ᱨ������Ҫ��@JavascriptInterfaceע��Ĺ��з���������webview�б�����
		
	}
	
	/**
	 * �ؼ�����ΪWebView����WebViewClient��Ȼ����дshouldOverrideUrlLoading�������ɡ�����WebViewClientΪWebView��һ�������࣬��Ҫ�������֪ͨ�������¼���
	 * @author Dr.Chan
	 *
	 */
	 class webViewClient extends WebViewClient{ 
		 	/**
		 	 * ��дshouldOverrideUrlLoading������ʹ������Ӻ�ʹ��������������򿪡� 
		 	 */
		 	@Override 
		    public boolean shouldOverrideUrlLoading(WebView view, String url) { 
		        view.loadUrl(url); 
		        //�������Ҫ�����Ե�������¼��Ĵ�����true�����򷵻�false 
		        return true; 
		    }
		 	
		 	/**
		 	 * ҳ��������ɺ����
		 	 */
		 	@Override
		 	public void onPageFinished(WebView view, String url) {
		 		super.onPageFinished(view, url);
		 		
		 		int count = 0;
		 		//����arrylist����js�ķ���������append��html��
		 		for(int i = 0; i < listCookbook.size(); i++, count++) {
		 			StringBuffer sb = new StringBuffer("<br/>");
		 			Cookbook cookbook = (Cookbook) listCookbook.get(i);
		 			for(int j = 0; j < cookbook.step.size(); j++) {
		 				sb.append(((String) (cookbook.step.get(j))) + "<br/>");
		 			}
		 			webview.loadUrl("javascript:appendDetail('" + cookbook.title + "','" + cookbook.albums + "','" + cookbook.tags + "','" + cookbook.imtro + "','" + cookbook.ingredients + "','" + cookbook.burden + "','" + sb.toString() + "')");
		 		}
		 		webview.loadUrl("javascript:resultCount('" + count + "')");
		 		
		 		//��̬����js
		 		String js = "var newscript = document.createElement(\"script\");";
		 		js += "newscript.src=\"file:///android_asset/js/amazeui.min.js\";";
		 		js += "document.body.appendChild(newscript);";
		 		webview.loadUrl("javascript:" + js);
		 	}
	 }
}


