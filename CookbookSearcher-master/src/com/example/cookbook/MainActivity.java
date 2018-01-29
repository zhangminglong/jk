package com.example.cookbook;

import java.util.ArrayList;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.util.Log;
import android.view.View;
import android.webkit.JavascriptInterface;
import android.webkit.WebSettings.LayoutAlgorithm;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Toast;

import com.example.cookbook.GetCookbookData.Cookbook;

@SuppressLint("SetJavaScriptEnabled")
public class MainActivity extends Activity {

	private WebView webview;
	private final String url = "file:///android_asset/index.html";

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		
		webview = (WebView) findViewById(R.id.webView);
		
		//����webview�Ĳ����ͼ��ر���ҳ��
		webview.setScrollBarStyle(View.SCROLLBARS_INSIDE_OVERLAY);	//��ʹ��������ռλ
		webview.getSettings().setBuiltInZoomControls(false);	//�������½����Ű�ť
		webview.getSettings().setSupportZoom(false);	//������html����
		webview.getSettings().setJavaScriptEnabled(true);	//���룡ʹwebview�е�html֧��javascript���ܹ��밲׿���н���
		webview.getSettings().setUseWideViewPort(true);	//ʹ����Ӧ�ֱ���
		webview.getSettings().setLoadWithOverviewMode(true);	//ʹ����Ӧ�ֱ���
		webview.setWebViewClient(new webViewClient()); ////ΪWebView����WebViewClient����ĳЩ����	
		webview.getSettings().setLayoutAlgorithm(LayoutAlgorithm.SINGLE_COLUMN);// ��ֹ�������ݹ������º���������
		webview.addJavascriptInterface(this, "android");	//ע�⣡ʹ��������䣬���ڱ����onCreate�������ע��@SuppressLint("JavascriptInterface")���͵���android.annotation.SuppressLint������Ȼ�ᱨ������Ҫ��@JavascriptInterfaceע��Ĺ��з���������webview�б�����
		webview.loadUrl(url);	//���ص�ǰ��Ŀ��assetsĿ¼�µ�welcome.html�ļ���webview

	}
	
	/**
	 * ��javaScript���õķ�������Ҫ�������ؼ��ʴ�����һ��Activity
	 * @param some
	 */
	@JavascriptInterface
	public void callDetailActivity(String keyword) {
		//�ж��Ƿ�����������
		ConnectivityManager con = (ConnectivityManager) MainActivity.this.getSystemService(Context.CONNECTIVITY_SERVICE);  
		NetworkInfo networkinfo = con.getActiveNetworkInfo();
		if (networkinfo == null || !networkinfo.isAvailable()) {
			// ��ǰ���粻����
			Toast.makeText(getApplicationContext(), "����ֻ�����������", Toast.LENGTH_SHORT).show();
		} else if(keyword.equals("")) {
			Toast.makeText(getApplicationContext(), "��δ����ؼ���", Toast.LENGTH_SHORT).show();
		} else {
			keyword = keyword.trim();//ȥ���ַ�����β�Ŀո�  
			Intent intent = new Intent(MainActivity.this, DetailActivity.class);
			intent.putExtra("keyword", keyword);
			startActivity(intent);
		}
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
	 }

}
