<link href="<?php echo VERSION2;?>taskcss/main.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo VERSION2;?>taskcss/twitter.css">
<link rel="stylesheet" type="text/css" href="<?php echo VERSION2;?>taskcss/button.css">
<link rel="stylesheet" type="text/css" href="<?php echo VERSION2;?>taskcss/css.css">
<link rel="stylesheet" type="text/css" href="<?php echo VERSION2;?>taskcss/mm.css">
<link rel="stylesheet" type="text/css" href="<?php echo VERSION2;?>taskcss/drop-down.css">
<link rel="stylesheet" type="text/css" href="<?php echo VERSION2;?>taskcss/introjs.css">
<?php
    echo $this->renderPartial('/user/taobaoTaskNav');//载入淘宝大厅导航
?>
<div id="content">
  <div class="cle"></div>
  <div class="cle"></div>
  <div class="cle"></div>
  <div class="cle"></div>
  <div class="cle"></div>
  <form id="all-data" method="post" onsubmit="return false;">
    <div id="body_main" class="">
      <div class="left_xf fixed" style="top: 200px;">
        <div class="left_xf_nav">
          <ul>
            <li><a href="javascript:void(0)" id="guide">新手帮助</a></li>
            <li><a href="javascript:void(0)" class="on">商品信息</a></li>
            <li><a href="javascript:void(0)" class="">增值服务</a></li>
            <li><a href="javascript:void(0)" class="">筛选接手</a></li>
            <li><a href="javascript:void(0)" class="">快递空包</a></li>
          </ul>
        </div>
        <div class="xf_fban">
          <div class="xf_plfb">批量发
            <input type="text" id="txtFCount2" onkeyup="document.getElementById(&#39;txtFCount&#39;).value=this.value;" value="1" class="plrw_input" maxlength="5">
            个</div>
          <div class="sudiv2" data-step="6" data-intro="立即发布任务">
            <input type="submit" class="button abtn7" value="立即发布" style="padding:8px 15px;font-size: 18px;">
          </div>
        </div>
      </div>
      <div id="product" class="div">
        <?php
            $this->renderPartial('/user/taskPublishNav');//加载发布任务公共导航
        ?>
        <div id="product_main" class="product_con" data-step="2" data-intro="在这里，输入您的商品基本信息">
          <ul class="pmm">
            <li style="display:block;" class="lili">
              <div class="drw">
                <div class="pt"> <span class="h40"> <img class="h41" src="<?php echo VERSION2;?>taskcss/blue.png" alt="">商品信息： </span> <span class="h40" style="margin-left: 25px;"><a href="http://www.milioo.com/article/sell/122Q02015.html" target="_blank" style="color: red;font-size: 15px;">查看豆豆计算规则</a></span> </div>
                <div class="product_content2">
                  <input type="hidden" name="task_type" value="3">
                  <ul class="pc1">
                    <li class="s35" title="使用您保存的模板快速读取相关数据"> 套餐类型：</li>
                    <li class="s36 " id="mealLailu">
                      <select id="ddlMealType" name="ddlMealType" class="ui-select" style="display: none;">
                        <option value="1" selected="selected">普通套餐任务</option>
                        <option value="2">来路套餐任务</option>
                      </select>
                      <div class="select-main">
                        <div class="select-arrow"></div>
                        <div class="select-set">普通套餐任务</div>
                        <div class="select-block" style="display: none;">
                          <ul class="select-list">
                            <li class="select-items active">普通套餐任务</li>
                            <li class="select-items">来路套餐任务</li>
                          </ul>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="product_content1 comeway" style="display:none;">
                  <ul class="dowebok">
                    <li class="s35" title="要求威客使用什么方式搜索进店">搜索进店方式：</li>
                    <li class="s39 searchway" title="要求威客搜索商品进店">
                      <input type="radio" name="visitWay" checked="checked" value="2">
                      搜商品 </li>
                    <li class="s40 searchway" title="要求威客搜索店铺名进店">
                      <input type="radio" name="visitWay" value="1">
                      搜店铺 </li>
                    <li class="s40 searchway" title="要求威客搜索直通车广告进店">
                      <input type="radio" name="visitWay" value="3">
                      直通车</li>
                    <li class="s40 s41 searchway" title="要求威客通过信用评价地址进店">
                      <input type="radio" name="visitWay" value="4">
                      信用评价</li>
                    <li class="h32"><span>支付 <font class="pdfo">1.0</font> 个豆豆</span></li>
                  </ul>
                </div>
                <div class="product_content2 comeway" style="display:none;">
                  <ul class="pc1">
                    <li class="s35" id="divkey" title="搜索此关键词进店">搜店铺关键字：</li>
                    <li class="s34">
                      <input type="text" name="txtDes" id="txtDes" class="pc11 inputp s36_ts">
                    </li>
                    <li class="s38" id="divdes" title="输入关键词后，这里填写搜索提示，如：搜索结果在第一页第一个">店铺搜索提示：</li>
                    <li class="s36">
                      <input type="text" name="txtSearchDes" id="txtSearchDes" class="pc11 inputp s36_ts">
                    </li>
                  </ul>
                </div>
                <div class="product_content2">
                  <ul class="pc1">
                    <li class="s35" title="选择您的淘宝掌柜名"><img src="<?php echo VERSION2;?>taskcss/c12.jpg" alt="">淘宝掌柜名：</li>
                    <li class="s34">
                      <select class="ui-select" id="ddlZGAccount" name="ddlZGAccount" style="display: none;">
                        <option value="任e行完美极致专卖店">任e行完美极致专卖店</option>
                      </select>
                      <div class="select-main">
                        <div class="select-arrow"></div>
                        <div class="select-set">任e行完美极致专卖店</div>
                        <div class="select-block" style="display: none;">
                          <ul class="select-list">
                            <li class="select-items active">任e行完美极致专卖店</li>
                          </ul>
                        </div>
                      </div>
                    </li>
                    <li class="s38" title="使用您保存的模板快速读取相关数据">使用任务模板：</li>
                    <li class="s36">
                      <select id="ddlTemplate" name="ddlTemplate" class="ui-select" style="display: none;">
                        <option value="0">请选择模板</option>
                      </select>
                      <div class="select-main">
                        <div class="select-arrow"></div>
                        <div class="select-set">请选择模板</div>
                        <div class="select-block" style="display: none;">
                          <ul class="select-list">
                            <li class="select-items active">请选择模板</li>
                          </ul>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="product_content2">
                  <ul class="pc1" id="ppuul">
                    <div class="c35"><a href="http://help.milioo.com/posts/view/79965" target="_blank"><img src="<?php echo VERSION2;?>taskcss/c3_08.png" alt="收货时间新规" title="收货时间新规"></a></div>
                    <li class="s35" title="选择确认收货时长。ps：如您发布实物任务，需要走快递，那么一般可选72小时后收货"><img src="<?php echo VERSION2;?>taskcss/c12.jpg" alt="">要求确认时间：</li>
                    <li class="s34">
                      <select name="ddlOKDay" id="ddlOKDay" class="ui-select" style="display: none;">
                        <option value="0" selected="selected">马上好评（虚拟任务）</option>
                        <option value="1">24小时(基本豆豆×1.5+0)</option>
                        <option value="2">48小时(基本豆豆×1.5+1)</option>
                        <option value="3">72小时(基本豆豆×1.5+2)</option>
                        <option value="4">96小时(基本豆豆×1.5+3)</option>
                        <option value="5">120小时(基本豆豆×1.5+4)</option>
                        <option value="6">144小时(基本豆豆×1.5+5)</option>
                        <option value="7">168小时(基本豆豆×1.5+6)</option>
                      </select>
                      <div class="select-main">
                        <div class="select-arrow"></div>
                        <div class="select-set">马上好评（虚拟任务）</div>
                        <div class="select-block" style="display: none;">
                          <ul class="select-list" style="height: 250px; overflow: auto;">
                            <li class="select-items active">马上好评（虚拟任务）</li>
                            <li class="select-items">24小时(基本豆豆×1.5+0)</li>
                            <li class="select-items">48小时(基本豆豆×1.5+1)</li>
                            <li class="select-items">72小时(基本豆豆×1.5+2)</li>
                            <li class="select-items">96小时(基本豆豆×1.5+3)</li>
                            <li class="select-items">120小时(基本豆豆×1.5+4)</li>
                            <li class="select-items">144小时(基本豆豆×1.5+5)</li>
                            <li class="select-items">168小时(基本豆豆×1.5+6)</li>
                          </ul>
                        </div>
                      </div>
                    </li>
                    <li class="s38 comeway" title="将搜索结果截图，方便威客找到您的商品" style="display:none;">商品位置截图：</li>
                    <input id="url-upfile-1" class="comeway" type="text" readonly="" style="width:150px;margin-left: 26px;border: #99C1F5 1px dashed;display:none;">
                    <span class="uploadImg comeway" style="display:none">
                    <input size="24" type="file" name="file" class="file" id="upfile-1" style="width: 270px;height:40px">
                    <input type="button" class="button comeway" value="上传截图" style="margin-left: 5px;display:none">
                    <span id="info-upfile-1" class="upload-info green" style="font-size:14px"></span> </span>
                  </ul>
                </div>
                <div class="product_content2">
                  <ul class="pc1">
                    <li class="s35" title="输入您想提升销量的商品链接"><img src="<?php echo VERSION2;?>taskcss/c12.jpg" alt="">商品链接地址：</li>
                    <li class="s36">
                      <input type="text" class="pc11 inputp s36_ts" name="txtGoodsUrl" id="txtGoodsUrl" placeholder="http://">
                    </li>
                    <li class="h37" title="请输入打折后的价格，保持平台价格与淘宝价格一致">商品价格：(包含邮费)
                      <input type="text" id="txtPrice" name="txtPrice" class="inputp">
                    </li>
                    <li class="h38" title="商品价格不等于任务商品担保价格时，请勾选！改价不要超过商品价格的50%，支付宝使用率低于50%既被淘宝视为信用炒作处理。">改价：
                      <input type="checkbox" name="cbxIsGJ" class="h39">
                    </li>
                    <li class="h38" title="取消商品价格限制" style="display:none">打折：
                      <input type="checkbox" name="chssp" class="h39">
                    </li>
                    <li class="s37" title="与商品价格、收货时长相关">基本豆豆：
                      <input type="text" id="txtMinMPrice" readonly="" style="background:#F0F0F0;" name="txtMinMPrice" class="inputp">
                    </li>
                  </ul>
                </div>
              </div>
            </li>
          </ul>
          <div style="clear:both;"></div>
        </div>
      </div>
      <div id="server" class="span6" data-step="3" data-intro="选择您想要的增值服务，这样能增加安全性">
        <div class="pt"> <span class="h40"> <img class="h41" src="<?php echo VERSION2;?>taskcss/blue.png" alt="">增值服务： </span> </div>
        <div class="pd">
          <ul class="pdul" style="margin-top:15px;">
            <li>
              <div id="a1" class="nulldiv" title="在拍下商品前使用旺旺或旺信与商家聊天"></div>
              <input type="checkbox" name="cbxIsWW" id="aa1">
            </li>
            <li class="pdli"><span>支付<font class="pdfo">1.0</font>个豆豆</span></li>
            <li>
              <div id="a2" class="nulldiv" title="收藏商家发布的商品"></div>
              <input type="checkbox" name="shopcoller" id="aa2">
            </li>
            <li class="pdli"><span>支付<font class="pdfo">0.5</font>个豆豆</span></li>
            <li>
              <div id="a3" class="nulldiv" title="要求接手使用手机付款"></div>
              <input type="checkbox" name="isMobile" id="aa3">
            </li>
            <li class="pdli"><span>支付<font class="pdfo">2.0</font>个豆豆</span></li>
          </ul>
          <ul class="pdul">
            <li>
              <div id="a4" class="nulldiv" title="接手确认收货前在旺旺与您聊天确认。如：已收到货，下次还会再来"></div>
              <input type="checkbox" name="cbxIsLHS" id="aa4">
            </li>
            <li class="pdli"><span>支付<font class="pdfo">0.5</font>个豆豆</span></li>
            <li>
              <div id="a5" class="nulldiv" title="从头到尾浏览宝贝，并提供底图截图"></div>
              <input type="checkbox" name="isViewEnd" id="aa5">
            </li>
            <li class="pdli"><span>支付<font class="pdfo">0.5</font>个豆豆</span></li>
          </ul>
          <ul class="pdul">
            <li>
              <div id="a9" class="nulldiv" title="接手确认收货好评时需要上传的好评图片"></div>
              <input type="checkbox" name="pinimage" id="aa9">
            </li>
            <li class="pdli"><span>每张支付<font class="pdfo">0.5</font>个豆豆</span></li>
            <li class="pdli">
              <div class="haoPingWrap" style="float:left;margin-left:-68px;"> <span class="uploadImg" style="float:left;height:39px;margin-left:0px;width:131px;">
                <input type="file" name="file" class="file" id="upfile-haoping" size="25">
                <input type="button" class="button" style="width:120px;padding:8px 0px;border-radius:2px;font-size: 16px;background: #f60;border:#f60" value="上传图片">
                </span> <span id="info-upfile-haoping" class="upload-info green"></span> </div>
            </li>
            <li class="pdli">
              <div class="value long">
                <input id="haoping-upfile-1" hidden="" type="text" title="没有图片请保留空" readonly="" style="width:206px;height:20px" maxlength="150" name="photoUrls">
              </div>
            </li>
          </ul>
          <ul class="pdul">
            <li>
              <div id="a10" class="nulldiv" title="在商品页面停留相应时间，卖家可使用量子查看接手是否达标"></div>
              <input type="checkbox" name="stopDsTime" id="aa10">
            </li>
            <li class="pdli11">
              <input type="radio" name="stopTime" value="1">
              停1分钟<span class="f12"> （<font class="pdfo">0.1</font>个豆豆）</span></li>
            <li class="pdli11">
              <input type="radio" name="stopTime" value="2">
              停2分钟<span class="f12"> （<font class="pdfo">0.3</font>个豆豆）</span></li>
            <li class="pdli11">
              <input type="radio" name="stopTime" value="3">
              停3分钟<span class="f12"> （<font class="pdfo">0.5</font>个豆豆）</span></li>
          </ul>
          <ul class="pdul">
            <li>
              <div id="a11" class="nulldiv" title="规定好评内容。如：衣服质量很好，穿着舒适"></div>
              <input type="checkbox" name="cbxIsMsg" id="aa11">
            </li>
            <li class="pdlli12">
              <input id="hpnr" type="text" class="inputp" name="txtMessage" placeholder="如果需要接手方带字好评请勾选，并填写规定好评内容。不勾选则默认不带字好评">
              支付<font class="pdfo">0.5</font>个豆豆</li>
          </ul>
          <ul class="pdul">
            <li>
              <div id="a12" class="nulldiv" title="留言提醒接手需要注意的地方，或写暗语。但切勿以此增加要求并要挟接手，否则将予以惩罚"></div>
              <input type="checkbox" name="cbxIsTip" id="aa12">
            </li>
            <li class="pdlli13">
              <input type="text" id="lytx" class="inputp" name="txtRemind" placeholder="在此给接手留言提醒注意事项。也可写暗语让您不用登陆平台都知道是刷手">
            </li>
          </ul>
        </div>
      </div>
      <div id="screen" data-step="4" data-intro="筛选出您想要的接手（接手人）">
        <div class="pt"> <span class="h40"> <img class="h41" src="<?php echo VERSION2;?>taskcss/blue.png" alt="">筛选接手： </span> </div>
        <div class="scmain">
          <ul class="pdul">
            <li>
              <div id="a14" class="nulldiv" title="您手动审核接手，通过后才可接手任务"></div>
              <input type="checkbox" name="cbxIsAudit" id="aa14">
            </li>
            <li class="pdli"><span>支付<font class="pdfo">0.5</font>个豆豆</span></li>
            <li>
              <div id="a15" class="nulldiv" title="要求接手使用实名认证的买号"></div>
              <input type="checkbox" name="isReal" id="aa15">
            </li>
            <li class="pdli"><span>支付<font class="pdfo">0.5</font>个豆豆</span></li>
            <li>
              <div id="a16" class="nulldiv" title="要求接手方必须是已加入平台商保的接手"></div>
              <input type="checkbox" name="cbxIsSB" id="aa16">
            </li>
            <li class="h32"><span>支付<font class="pdfo">2.0</font>个豆豆</span></li>
          </ul>
          <ul class="pdul">
            <li>
              <div id="a17" class="nulldiv" title="限制接手一定时限内接手任务数"></div>
              <input type="checkbox" name="cbxIsFMaxMCount" id="aa17">
            </li>
            <li class="pdli11">
              <input type="radio" name="fmaxmc" value="1">
              1天接1个<span class="f12"> （<font class="pdfo">0.5</font>个豆豆）</span></li>
            <li class="pdli11">
              <input type="radio" name="fmaxmc" value="2">
              1天接2个<span class="f12"> （<font class="pdfo">0.2</font>个豆豆）</span></li>
            <li class="pdli11">
              <input type="radio" name="fmaxmc" value="3">
              1周接1个<span class="f12"> （<font class="pdfo">1.0</font>个豆豆）</span></li>
          </ul>
          <ul class="pdul">
            <li>
              <div id="a18" class="nulldiv" title="指定地区的接手方可接手任务"></div>
              <input type="checkbox" name="isLimitCity" id="aa18">
            </li>
            <li class="h34">
              <select id="Province" name="Province[]" class="ui-select" placeholder="请选择模板" style="display: none;">
                <option value="北京市">北京市</option>
                <option value="上海市">上海市</option>
                <option value="天津市">天津市</option>
                <option value="重庆市">重庆市</option>
                <option value="河北省">河北省</option>
                <option value="山西省">山西省</option>
                <option value="辽宁省">辽宁省</option>
                <option value="吉林省">吉林省</option>
                <option value="黑龙江">黑龙江</option>
                <option value="江苏省">江苏省</option>
                <option value="浙江省">浙江省</option>
                <option value="安徽省">安徽省</option>
                <option value="福建省">福建省</option>
                <option value="江西省">江西省</option>
                <option value="山东省">山东省</option>
                <option value="河南省">河南省</option>
                <option value="湖北省">湖北省</option>
                <option value="湖南省">湖南省</option>
                <option value="广东省">广东省</option>
                <option value="甘肃省">甘肃省</option>
                <option value="陕西省">陕西省</option>
                <option value="湖南省">湖南省</option>
                <option value="内蒙古">内蒙古</option>
                <option value="广西">广西</option>
                <option value="四川省">四川省</option>
                <option value="贵州省">贵州省</option>
                <option value="云南省">云南省</option>
                <option value="西藏">西藏</option>
                <option value="新疆">新疆</option>
                <option value="香港">香港</option>
                <option value="奥门">奥门</option>
                <option value="台湾">台湾</option>
              </select>
              <div class="select-main">
                <div class="select-arrow"></div>
                <div class="select-set">北京市</div>
                <div class="select-block" style="display: none;">
                  <ul class="select-list" style="height: 250px; overflow: auto;">
                    <li class="select-items active">北京市</li>
                    <li class="select-items">上海市</li>
                    <li class="select-items">天津市</li>
                    <li class="select-items">重庆市</li>
                    <li class="select-items">河北省</li>
                    <li class="select-items">山西省</li>
                    <li class="select-items">辽宁省</li>
                    <li class="select-items">吉林省</li>
                    <li class="select-items">黑龙江</li>
                    <li class="select-items">江苏省</li>
                    <li class="select-items">浙江省</li>
                    <li class="select-items">安徽省</li>
                    <li class="select-items">福建省</li>
                    <li class="select-items">江西省</li>
                    <li class="select-items">山东省</li>
                    <li class="select-items">河南省</li>
                    <li class="select-items">湖北省</li>
                    <li class="select-items">湖南省</li>
                    <li class="select-items">广东省</li>
                    <li class="select-items">甘肃省</li>
                    <li class="select-items">陕西省</li>
                    <li class="select-items">湖南省</li>
                    <li class="select-items">内蒙古</li>
                    <li class="select-items">广西</li>
                    <li class="select-items">四川省</li>
                    <li class="select-items">贵州省</li>
                    <li class="select-items">云南省</li>
                    <li class="select-items">西藏</li>
                    <li class="select-items">新疆</li>
                    <li class="select-items">香港</li>
                    <li class="select-items">奥门</li>
                    <li class="select-items">台湾</li>
                  </ul>
                </div>
              </div>
            </li>
            <li class="scli1" title="按住Shifl键加单击选项，可多选！">
              <input type="checkbox" id="isMultiple" class="h45">
              多选省份<span class="f12">(支付<font class="pdfo">2.0</font>个豆豆)</span></li>
          </ul>
          <ul class="pdul">
            <li>
              <div id="a19" class="nulldiv" title="指定接手买号的等级"></div>
              <input type="checkbox" name="isBuyerFen" id="aa19">
            </li>
            <li class="h34">
              <select name="BuyerJifen" id="BuyerJifen" class="ui-select" placeholder="请选择模板" style="display: none;">
                <option value="1">一心及以上  （支付 0.5 豆豆）</option>
                <option value="2">二心及以上  （支付 1.0 豆豆）</option>
                <option value="3">三心及以上  （支付 2.0 豆豆）</option>
                <option value="4">四心及以上  （支付 3.0 豆豆）</option>
                <option value="5">五心及以上  （支付 4.0 豆豆）</option>
                <option value="6">一钻及以上  （支付 5.0 豆豆）</option>
                <option value="7">二钻及以上  （支付 6.0 豆豆）</option>
                <option value="8">三钻及以上  （支付 7.0 豆豆）</option>
                <option value="9">四钻及以上  （支付 8.0 豆豆）</option>
                <option value="10">五钻及以上  （支付 9.0 豆豆）</option>
              </select>
              <div class="select-main">
                <div class="select-arrow"></div>
                <div class="select-set">一心及以上  （支付 0.5 豆豆）</div>
                <div class="select-block" style="display: none;">
                  <ul class="select-list" style="height: 250px; overflow: auto;">
                    <li class="select-items active">一心及以上  （支付 0.5 豆豆）</li>
                    <li class="select-items">二心及以上  （支付 1.0 豆豆）</li>
                    <li class="select-items">三心及以上  （支付 2.0 豆豆）</li>
                    <li class="select-items">四心及以上  （支付 3.0 豆豆）</li>
                    <li class="select-items">五心及以上  （支付 4.0 豆豆）</li>
                    <li class="select-items">一钻及以上  （支付 5.0 豆豆）</li>
                    <li class="select-items">二钻及以上  （支付 6.0 豆豆）</li>
                    <li class="select-items">三钻及以上  （支付 7.0 豆豆）</li>
                    <li class="select-items">四钻及以上  （支付 8.0 豆豆）</li>
                    <li class="select-items">五钻及以上  （支付 9.0 豆豆）</li>
                  </ul>
                </div>
              </div>
            </li>
            <li class="scli2">此等级以上可接任务<span>（支付<font class="pdfo">0.5 - 9.0</font>个豆豆）</span></li>
          </ul>
          <ul class="pduzz">
            <li>
              <div id="a20" class="nulldiv" title="过滤不符合要求的接手"></div>
              <input type="checkbox" id="aa20">
            </li>
          </ul>
          <div class="nyd">
            <ul class="pdul_1">
              <li class="h100">接手积分不低于 :
                <input type="hidden" value="0" id="cbxIsFMinGrade" name="cbxIsFMinGrade">
              </li>
              <li class="h99">
                <input type="radio" name="fmingrade" value="10">
                10 </li>
              <li class="h99">
                <input type="radio" name="fmingrade" value="30">
                30 </li>
              <li class="h99">
                <input type="radio" name="fmingrade" value="50">
                50</li>
              <li class="h99">
                <input type="radio" name="fmingrade" value="100">
                100</li>
              <li class="s32"><span>支付<font class="pdfo">0.5</font>个豆豆</span></li>
            </ul>
            <ul class="pdul_1">
              <li class="h100">接手好评率不低于 :
                <input type="hidden" value="0" id="cbxIsFMaxABC" name="cbxIsFMaxABC">
              </li>
              <li class="h99">
                <input type="radio" name="fmaxabc" value="98">
                98% </li>
              <li class="h99">
                <input type="radio" name="fmaxabc" value="95">
                95%</li>
              <li class="h99">
                <input type="radio" name="fmaxabc" value="90">
                90%</li>
            </ul>
            <ul class="pdul_1">
              <li class="h100">接手被拉黑次数不大于 :
                <input type="hidden" value="0" id="cbxIsFMaxBBC" name="cbxIsFMaxBBC">
              </li>
              <li class="h99">
                <input type="radio" name="fmaxbbc" value="5">
                5</li>
              <li class="h99">
                <input type="radio" name="fmaxbbc" value="10">
                10 </li>
              <li class="h99">
                <input type="radio" name="fmaxbbc" value="15">
                15</li>
            </ul>
            <ul class="pdul_1">
              <li class="h100">接手被有效投诉次数不大于 :
                <input type="hidden" value="0" id="cbxIsFMaxBTSCount" name="cbxIsFMaxBTSCount">
              </li>
              <li class="h99">
                <input type="radio" name="fmaxbtsc" value="2">
                2 </li>
              <li class="h99">
                <input type="radio" name="fmaxbtsc" value="3">
                3 </li>
              <li class="h99">
                <input type="radio" name="fmaxbtsc" value="4">
                4</li>
            </ul>
          </div>
        </div>
      </div>
      <div id="express" class="div" data-step="5" data-intro="根据您手头的单号资源进行选择，可搜索“空包网”自行购买。">
        <div class="pt"> <span class="h40"> <img class="h41" src="<?php echo VERSION2;?>taskcss/blue.png" alt="">快递空包： </span> <span class="c35"><a href="http://help.milioo.com/posts/view/79452" target="_blank"><img src="<?php echo VERSION2;?>taskcss/c3_08.png" alt="如何解决快递空包" title="如何解决快递空包"></a></span> </div>
        <div class="exmain">
          <ul class="pdul">
            <li>
              <div id="a21" class="nulldiv" title="要求接手使用真实地址签收快递"></div>
              <input type="checkbox" name="isSign" id="aa21">
            </li>
            <li class="pdli"><span>支付<font class="pdfo">2.0</font>个豆豆</span></li>
          </ul>
          <ul class="pdul" style="display:none">
            <li>
              <div id="a22" class="nulldiv" title="购买真实空包快递单号"></div>
              <input type="checkbox" name="isxtzs" id="aa22">
            </li>
            <li class="pdli11">
              <input type="radio" name="zd_one">
              顺丰（<font class="pdfo">3</font>元）</li>
          </ul>
          <ul class="pc1">
            <li>
              <div id="a23" class="nulldiv" title="规定接手拍下商品时使用的地址"></div>
              <input type="checkbox" name="cbxIsAddress" id="aa23">
            </li>
            <li class="h97">姓名：
              <input type="text" name="cbxName" class="shdz pc11 inputp">
            </li>
            <li class="h97">手机：
              <input type="text" name="cbxMobile" class="pc11 inputp shdz" onkeyup="this.value=this.value.replace(/[^0-9-]+/,&#39;&#39;);" maxlength="11">
            </li>
            <li class="h97">邮编：
              <input type="text" name="cbxcode " class="pc11 inputp shdz">
            </li>
            <li class="s33"><span>支付<font class="pdfo">0.5</font>个豆豆</span></li>
          </ul>
          <div class="address1">
            <div class="add1"> 地址： </div>
            <textarea name="cbxAddress" cols="45" id="cbxAddress" rows="6" class="texta shdz" placeholder="此处填写您要求接收人的修改的收货地址，包含具体省、市、区及详细地址，请不要填写“请带字好评”等引导的文字。"></textarea>
          </div>
          <ul class="pdul moban_t">
            <li>
              <div id="a24" class="nulldiv" title="保存以上信息为模板，方便再次发布"></div>
              <input type="checkbox" name="isTpl" id="aa24">
            </li>
            <li class="h97"><font class="muban">名称：</font>
              <input type="text" id="pz11" name="tplTo" class="inputp">
            </li>
          </ul>
        </div>
      </div>
      <div class="sudiv" data-step="5" data-intro="确认提交！" data-position="top">
        <input type="submit" id="btnCilentAdd" class="button sss abtn7" value="立即发布">
      </div>
    </div>
  </form>
  <div id="subform">
    <div class="center">
      <p class="anone"></p>
      <p class="txtone"> 批量发布数量:
        <input name="txtFCount" type="text" id="txtFCount" onkeyup="document.getElementById(&#39;txtFCount2&#39;).value=this.value;" value="1" class="txt" maxlength="5">
        个</p>
    </div>
  </div>
</div>