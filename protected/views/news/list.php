    <style>
    .arcList{ width:1000px; min-height: 500px; margin:0 auto;}
    .taskTitle{ width:100%; height:38px; border-bottom:3px solid #1a78c1; margin-top:30px; font-size:18px; font-weight:bold;}
    .taskTitle a{ color:#57A0FF;}
    .taskRecord{ height:30px; line-height:30px;}
    a{ color:#666;}
    </style>
    <div class="arcList">
        <!--taskArea start-->
        <?php
            $catInfo=Articlecatlog::model()->findByPk($_GET['catlogid']);
        ?>
        <div class="taskTitle"><!--taskTitle start-->
            <ul>
                <li><a><?php echo $catInfo->name;?></a></li>
            </ul>
        </div><!--taskTitle end-->
        <div class="taskField"><!--taskField start-->
            <table style=" width:100%; color:#666; font-size:14px;">
                <tbody>
                    <?php
                        foreach($proInfo as $item){
                    ?>
                    <tr class="taskRecord" style="height: 35px; line-height: 35px; border-bottom: 1px solid rgb(204, 204, 204); color: rgb(102, 102, 102);">
                        <td>
                            <a href="<?php echo $this->createUrl('news/deatailInfo',array('id'=>$item->goods_id,'catlogid'=>$item->cat_id));?>" style="padding-left: 5px;">&gt; <?php echo $item->goods_name;?></a><span style=" float:right; padding-right:5px;"><?php echo date('Y-m-d',$item->add_time);?></span>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            <div class="breakpage" style="text-align: center; margin-top:15px;"><!--breakpage start-->
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
            </div><!--breakpage end-->
        </div><!--taskField end-->
    </div>
    <script>
        $(function(){
            $(".taskRecord:odd").css("background","#f3f9fc");
        })
    </script>