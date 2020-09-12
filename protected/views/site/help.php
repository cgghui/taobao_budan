    <div class="help"><!--新手帮助-->

        <div class="helpt clearfix">

            <a href="#" class="helpt_lf">如何发布任务（视频教程）</a>

            <a href="#" class="helpt_ri">如何接手任务（视频教程）</a>

        </div>

        <div class="helpSo" style="display: none;">

            <form action="" method="">

                <input type="text" class="helpSo_inp" placeholder="请输入您的问题按回车键确认">

            </form>

        </div>

        <div class="helpCen clearfix">

            <div class="helpInf_lf"><!--左侧列表-->

                <h1 class="helpCen_t">新手入门</h1>

                <div class="help_lis pb20 clearfix">

                    <div class="help_lisLf">

                        <h1 class="help_lis_t">商家帮助区</h1>

                        <ul class="help_lists">

                            <?php

                                $articleInfo=Article::model()->findAll(array(

                                    'condition'=>'cat_id=38 and is_delete=0',

                                    'select'=>'goods_id,goods_name,cat_id',

									'order'=>'add_time desc',

                                    'limit'=>'12'

                                ));

                                foreach($articleInfo as $item){

                            ?>

                            <li><span data-title="置顶的内容">★</span><a title="" href="<?php echo $this->createUrl('news/deatailInfo',array('id'=>$item->goods_id,'catlogid'=>$item->cat_id));?>"><?php

                                echo $item->goods_name;

                            ?></a></li>

                            <?php

                                }

                            ?>

                            <li><a href="<?php echo $this->createUrl('news/list',array('catlogid'=>38));?>" style="color: #57A0FF ;">查看全部>></a></li>

                        </ul>

                    </div>

                    <div class="help_lisR">

                        <h1 class="help_lis_t">威客帮助区</h1>

                        <ul class="help_lists">

                            <?php

                                $articleInfo=Article::model()->findAll(array(

                                    'condition'=>'cat_id=39 and is_delete=0',

                                    'select'=>'goods_id,goods_name,cat_id',

									'order'=>'add_time desc',

                                    'limit'=>'12'

                                ));

                                foreach($articleInfo as $item){

                            ?>

                            <li><span data-title="置顶的内容">★</span><a title="" href="<?php echo $this->createUrl('news/deatailInfo',array('id'=>$item->goods_id,'catlogid'=>$item->cat_id));?>"><?php

                                echo $item->goods_name;

                            ?></a></li>

                            <?php

                                }

                            ?>

                            <li><a href="<?php echo $this->createUrl('news/list',array('catlogid'=>39));?>" style="color: #57A0FF ;">查看全部>></a></li>

                        </ul>

                    </div>

                </div>

                <h1 class="helpCen_t">官方动态</h1>

                <div class="help_lis clearfix pb150">

                    <div class="help_lisLf">

                        <h1 class="help_lis_t">最新资讯</h1>

                        <ul class="help_lists">

                            <?php

                                $articleInfo=Article::model()->findAll(array(

                                    'condition'=>'cat_id=40 and is_delete=0',

                                    'select'=>'goods_id,goods_name,cat_id',

									'order'=>'add_time desc',

                                    'limit'=>'5'

                                ));

                                foreach($articleInfo as $item){

                            ?>

                            <li><span data-title="置顶的内容">★</span><a title="" href="<?php echo $this->createUrl('news/deatailInfo',array('id'=>$item->goods_id,'catlogid'=>$item->cat_id));?>"><?php

                                echo $item->goods_name;

                            ?></a></li>

                            <?php

                                }

                            ?>

                            <li><a href="<?php echo $this->createUrl('news/list',array('catlogid'=>40));?>" style="color: #57A0FF ;">查看全部>></a></li>

                        </ul>

                    </div>

                    <div class="help_lisR">

                        <h1 class="help_lis_t">官方公告</h1>

                        <ul class="help_lists">

                            <?php

                                $articleInfo=Article::model()->findAll(array(

                                    'condition'=>'cat_id=41 and is_delete=0',

                                    'select'=>'goods_id,goods_name,cat_id',

									'order'=>'add_time desc',

                                    'limit'=>'5'

                                ));

                                foreach($articleInfo as $item){

                            ?>

                            <li><span data-title="置顶的内容">★</span><a title="" href="<?php echo $this->createUrl('news/deatailInfo',array('id'=>$item->goods_id,'catlogid'=>$item->cat_id));?>"><?php

                                echo $item->goods_name;

                            ?></a></li>

                            <?php

                                }

                            ?>

                            <li><a href="<?php echo $this->createUrl('news/list',array('catlogid'=>41));?>" style="color: #57A0FF ;">查看全部>></a></li>

                        </ul>

                    </div>

                </div>

            </div><!--左侧列表 end-->

            <div class="helpInf_r"><!--右侧列表-->

                <h1 class="helpCen_t">重要通知</h1>

                <ul class="zdll">

                    <?php

                        $articleInfo=Article::model()->findAll(array(

                            'condition'=>'cat_id=33 and is_delete=0',

                            'select'=>'goods_id,goods_name,cat_id',

							'order'=>'add_time desc',

                            'limit'=>'12'

                        ));

                        foreach($articleInfo as $item){

                    ?>

                    <li><a title="" href="<?php echo $this->createUrl('news/deatailInfo',array('id'=>$item->goods_id,'catlogid'=>$item->cat_id));?>"><?php

                        echo $item->goods_name;

                    ?></a></li>

                    <?php

                        }

                    ?>

                    <li><a href="<?php echo $this->createUrl('news/list',array('catlogid'=>33));?>" style="color: #57A0FF ;">查看全部>></a></li>

                </ul>

            </div><!--右侧列表 end-->

        </div>

    </div><!--新手帮助 end-->