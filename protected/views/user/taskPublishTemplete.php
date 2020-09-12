<link href="<?php echo VERSION2;?>taskcss/main.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo VERSION2;?>taskcss/button.css">
<link rel="stylesheet" type="text/css" href="<?php echo VERSION2;?>taskcss/mm.css">
<?php
    echo $this->renderPartial('/user/taobaoTaskNav');//载入淘宝大厅导航
?>
<div id="content" style=" min-height: 300px;">
  <div class="h15"></div>
  <a id="mao1"></a>
  <div id="body_main" style="background-color:#fff;margin:30px auto;">
    <?php
        $this->renderPartial('/user/taskPublishNav');//加载发布任务公共导航
    ?>
    <div class="cle"></div>
    <div class="reListTitle">
      <table width="1000" border="0" cellspacing="0" cellpadding="4" id="tpl">
        <thead>
          <tr style="color:#57a0ff">
            <th class="id">模板名称</th>
            <th class="poster">掌柜/商品网址</th>
            <th class="price">任务价格</th>
            <th class="oktime">使用金币</th>
            <th class="poster">任务类型</th>
            <th class="do">操作</th>
          </tr>
          <?php
            foreach($proInfo as $item){
          ?>
          <tr style="font-size: 12px; color: #666;">
            <th class="id"><?php echo $item->tplTo;?></th>
            <th class="poster" style="padding-bottom: 5px;"><?php echo $item->ddlZGAccount;?><br /><input type="text" style="border: 2px dashed #57a0ff; height:25px; border-radius: 2px; line-height:25px; width:300px;" value="<?php echo $item->txtGoodsUrl;?>" /></th>
            <th class="price"><?php echo $item->txtPrice;?> 元</th>
            <th class="oktime"><?php echo $item->MinLi;?> 个</th>
            <th class="poster"><?php echo $item->taskCatalog==0?"普通任务":"来路搜索任务";?></th>
            <th class="do"><a href="<?php echo $item->taskCatalog==0?$this->createUrl('user/taskPublishPT',array('templete'=>$item->id)):$this->createUrl('user/taskPublishLU',array('templete'=>$item->id));?>" style=" color: orange;">立即使用</a>　<a onclick="if(confirm('您确定删除吗？删除后将无法恢复')) return true; else return false;" href="<?php echo $this->createUrl('user/deltemplete',array("temid"=>$item->id));?>">删除</a></th>
          </tr>
          <?php }?>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="breakpage" style="margin-bottom: 10px;"><!--分页开始-->
<?php
    $this->widget('CLinkPager', array(
        'selectedPageCssClass'=>'active',
        'pages' => $pages,
        'lastPageLabel' => '最后一页',
        'firstPageLabel' => '第一页',
        'header' => false,
        'nextPageLabel' => ">>",
        'prevPageLabel' => "<<",
    ));
?>
</div><!--分页结束-->