<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/layout';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    
    /*
        成功提示开始
    */
    public function redirect_message($message='成功', $status='success',$time=3, $url=false )
    {
      
        $back_color ='#ff0000';
        $linkUrl=$url;
          
        if($status =='success')
        {
            $back_color= '#666';
        }
          
        if(is_array($url))
        {
            $route=isset($url[0]) ? $url[0] : '';
            $url=$this->createUrl($route,array_splice($url,1));
        }
        if ($url)
        {
            $url = "window.location.href='{$url}'"; 
        }
        else
        {
            $url = "history.back();"; 
        }
        echo <<<HTML
        <style>
        *{ margin:0; padding:0; font-size:12px;}
        a{ text-decoration: none;}
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <div style=" width:100%; height:100%; position:fixed; background:#fff; z-index:1000000;">
        <div style="background:#C9F1FF; margin:0 auto; height:100px; width:400px; text-align:center; line-height:28px; color:#555;">
                    <div style="margin-top:100px;">
                    <h5 style="color:{$back_color};font-size:14px; padding-top:20px;" >{$message}</h5>
                    页面正在跳转请等待<span id="sec" style="color:blue;">{$time}</span>秒，或点击<a href="{$linkUrl}" style="color:green; font-weight:bold;">链接</a>直接跳转
                    </div>
        </div>
        </div>
                    <script type="text/javascript">
                    function run(){
                        var s = document.getElementById("sec");
                        if(s.innerHTML == 0){
                        {$url}
                            return false;
                        }
                        s.innerHTML = s.innerHTML * 1 - 1;
                    }
                    window.setInterval("run();", 1000);
                    </script>
HTML;
    }
    /*
        成功提示结束
    */
	
}