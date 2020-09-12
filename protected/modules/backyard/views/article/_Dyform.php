<style>
.errorSummary{ border:1px solid #ccc; background:#f7dada;}
.errorSummary p{ width:98%; margin:0 auto;}
.errorSummary ul{ width:98%; margin:0 auto;}
.errorMessage{ display:inline; color:red;}
.required{ color:red;}
</style>
<!--商品描述文本编辑器-->
<?php $this->widget('ext.kindeditor.KindEditorWidget',array(
    'id'=>'Article_goods_desc',   //Textarea id
    // Additional Parameters (Check http://www.kindsoft.net/docs/option.html)
    'items' => array(
        'width'=>'800',
        'height'=>'400px',
        'themeType'=>'default',
        'allowImageUpload'=>true,
        'allowFileManager'=>true,
    ),
));
 ?> 

<?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'article-form',
        'enableClientValidation'=>true,
    	'clientOptions'=>array(
    		'validateOnSubmit'=>true,
    	),
)); ?>

	<?php echo $form->errorSummary($model); ?><!--报错信息-->
    <table id="articleoth" style="width:100%; line-height:35px; font-size:12px;" cellpadding="0" cellspacing="0" border="0">
    <tr>
		<td><?php echo $form->labelEx($model,'goods_name'); ?></td>
		<td><?php echo $form->textField($model,'goods_name',array('maxlength'=>120)); ?> <?php echo $form->error($model,'goods_name'); ?></td>
		<td>
            <?php
                if($model->goods_id!="")//判断为修改时，添加一个隐藏的域来存放商品的id和栏目id
                {
                     echo $form->hiddenField($model,'goods_id',array("value",$model->goods_id));
                     echo $form->hiddenField($model,'cat_id',array("value",$model->cat_id));
                }
            ?>
        </td>
	</tr>
    
    <tr>
		<td><?php echo $form->labelEx($model,'cat_id'); ?></td>
		<td>
            <?php
                echo '<select name="Article[cat_id]" id="Shopgoods_cat_id">';
                if(isset($optionStr))
                {
                    echo $optionStr;
                }
                $this->Arc_CatlogTree_arr(0,0,$class_arr);
                echo '</select>';
            ?>
        </td>
		<td><?php echo $form->error($model,'cat_id'); ?></td>
	</tr>
 
    <!--商品缩略图-->
    <tr>
		<td><?php echo $form->labelEx($model,'goods_img'); ?></td>
		<td><?php echo $form->textField($model,'goods_img',array('maxlength'=>255,'id'=>'url1')); ?>
		<?php echo $form->error($model,'goods_img'); ?><input type="button" id="image1" value="选择图片" /></td>
        <td></td>
	</tr>   
    
    <!--商品多图-->
    <tr>
		<td><?php echo $form->labelEx($model,'goods_thumb'); ?></td>
		<td><?php echo $form->hiddenField($model,'goods_thumb',array('maxlength'=>255,'size'=>100)); ?>
		<?php echo $form->error($model,'goods_thumb'); ?><input type="button" id="J_selectImage" value="批量上传" /></td>
        <td></td>
	</tr>
    <tr>
        <td></td>
        <td colspan="2">
            <div id="J_imageView">
                <ul>
                    <?php
                        if($model->goods_thumb!="")//不为空，表示该表单用于修改状态
                        {
                            $imgListArr=explode("|",$model->goods_thumb);
                            unset($imgListArr[count($imgListArr)-1]);
                            foreach($imgListArr as $k=>$v)
                            {
                    ?>
                    <li>
                        <div class="close"><img src="<?php echo ASSET_URL;?>default/images/close.png" width="20" height="20" /></div>
                        <div class="imgBox"><img src="<?php echo $v;?>" width="120" height="120"></div>
                    </li>     
                    <?php        
                            }
                        }
                    ?>
                </ul>
            </div>
        </td>
      </tr>

	<tr>
		<td><?php echo $form->labelEx($model,'keywords'); ?></td>
		<td><?php echo $form->textField($model,'keywords',array('size'=>80,'maxlength'=>255)); ?></td>
		<td><?php echo $form->error($model,'keywords'); ?></td>
	</tr>
    
	<tr>
		<td><?php echo $form->labelEx($model,'goods_desc'); ?></td>
		<td><?php echo $form->textArea($model,'goods_desc',array('rows'=>6, 'cols'=>50)); ?></td>
		<td><?php echo $form->error($model,'goods_desc'); ?></td>
	</tr>

	<tr>
		<td><?php echo $form->labelEx($model,'sort_order'); ?></td>
		<td><?php echo $form->textField($model,'sort_order'); ?></td>
		<td><?php echo $form->error($model,'sort_order'); ?></td>
	</tr>

	<tr>
        <td></td>
        <td><?php echo CHtml::submitButton($model->isNewRecord ? '确认添加' : '确认修改'); ?></td>
        <td></td>
	</tr>
    </table>
<?php $this->endWidget(); ?>

</div><!-- form -->
<style>
    /*控制多图上传样式*/
    #J_imageView ul li{ width:auto; height:auto; float:left; display:inline; margin-right: 10px; border:4px solid #ccc; position:relative}
    .imgbox img{ width:120px; height:100px;}
    .close{ position: absolute; top: 0; right: 2px; cursor: pointer;opacity:10;}
    input{  border: 1px solid #d4d4d4;
        height:30px; line-height:30px;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        color: #484848;
        -webkit-box-shadow: inset 0 2px 1px -1px rgba(0, 0, 0, 0.1);
        -moz-box-shadow: inset 0 2px 1px -1px rgba(0, 0, 0, 0.1);
        box-shadow: inset 0 2px 1px -1px rgba(0, 0, 0, 0.1);
    }
    select{ height:30px; line-height: 25px; padding: 0 5px;}
    label{ font-weight:normal;}
</style>
<div class="form">
<script>
    KindEditor.ready(function(K) {
        
    	var editor = K.editor({
    		allowFileManager : true
    	});
        
        /*
            缩略图上传
        */
        K('#image1').click(function() {
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					imageUrl : K('#url1').val(),
					clickFn : function(url, title, width, height, border, align) {
						K('#url1').val(url);
						editor.hideDialog();
					}
				});
			});
		});
        
        /*
            批量上传图片
        */
    	K('#J_selectImage').click(function() {
    		editor.loadPlugin('multiimage', function() {
    			editor.plugin.multiImageDialog({
    				clickFn : function(urlList) {
    					var div = K('#J_imageView ul');
                        var imgUrl="";
    					K.each(urlList, function(i, data) {
    						div.append('<li><div class="close"><img src="<?php echo ASSET_URL;?>default/images/close.png" width="20" height="20" /></div><div class="imgBox"><img src="' + data.url+'" width="120" height="100"></div></li>');
                            imgUrl=data.url+"|"+imgUrl;
    					});
                        /*var imgUrl='';
                        K('.imgBox img').each(function(){
                            imgUrl=K(this).attr("src")+"|"+imgUrl;
                        });*/
                        getBeforeUrl=K("#Article_goods_thumb").val();
                        K("#Article_goods_thumb").val(getBeforeUrl+imgUrl);//将图片集地址发送到id为Shopgoods_goods_thumb的表单隐藏域中
    					editor.hideDialog();
    				}
    			});
    		});
    	});
    });
</script>

<script>
    //批量图删除操作开始
    $(function(){
       $(".close").live("click",function(){
            var closeUrl=$(this).parent("li").find(".imgBox img").attr("src")+"|";//获取当前要删除的图片的路径
            var imgListStr=$("#Article_goods_thumb").val();
            imgListStr=imgListStr.replace(closeUrl," ");
            $("#Article_goods_thumb").val(imgListStr);
            $(this).parent("li").remove();//去掉当前的li*/
       })
    })
    //批量图删除操作结束
</script>
<script type="text/javascript">
/*<![CDATA[*/
jQuery(function($) {
KindEditor.ready(function(K){var editor=K.create("textarea[id=Article_goods_desc]", {'width':'800','height':'400px','themeType':'default','allowImageUpload':'1','allowFileManager':'1',})});
jQuery('#article-form').yiiactiveform({'validateOnSubmit':true,'attributes':[{'id':'Article_goods_name','inputID':'Article_goods_name','errorID':'Article_goods_name_em_','model':'Article','name':'goods_name','enableAjaxValidation':false,'clientValidation':function(value, messages, attribute) {

if(jQuery.trim(value)=='') {
	messages.push("\u6807\u9898\u5fc5\u586b");
}

}},{'id':'Article_cat_id','inputID':'Article_cat_id','errorID':'Article_cat_id_em_','model':'Article','name':'cat_id','enableAjaxValidation':false,'clientValidation':function(value, messages, attribute) {

if(jQuery.trim(value)=='') {
	messages.push("\u680f\u76ee\u5fc5\u9009\uff0c\u5982\u679c\u6ca1\u6709\u8bf7\u5148\u6dfb\u52a0\u680f\u76ee");
}

}},{'id':'Article_goods_img','inputID':'Article_goods_img','errorID':'Article_goods_img_em_','model':'Article','name':'goods_img','enableAjaxValidation':false},{'id':'Article_goods_thumb','inputID':'Article_goods_thumb','errorID':'Article_goods_thumb_em_','model':'Article','name':'goods_thumb','enableAjaxValidation':false},{'id':'Article_keywords','inputID':'Article_keywords','errorID':'Article_keywords_em_','model':'Article','name':'keywords','enableAjaxValidation':false},{'id':'Article_goods_desc','inputID':'Article_goods_desc','errorID':'Article_goods_desc_em_','model':'Article','name':'goods_desc','enableAjaxValidation':false},{'id':'Article_add_time','inputID':'Article_add_time','errorID':'Article_add_time_em_','model':'Article','name':'add_time','enableAjaxValidation':false},{'id':'Article_sort_order','inputID':'Article_sort_order','errorID':'Article_sort_order_em_','model':'Article','name':'sort_order','enableAjaxValidation':false},{'id':'Article_is_delete','inputID':'Article_is_delete','errorID':'Article_is_delete_em_','model':'Article','name':'is_delete','enableAjaxValidation':false}],'summaryID':'article-form_es_'});
});
/*]]>*/
</script>