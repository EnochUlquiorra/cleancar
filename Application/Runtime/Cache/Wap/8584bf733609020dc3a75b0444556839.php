<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>消息通知</title>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Cache-Control" content="no-transform" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="renderer" content="webkit">
        <!--uc浏览器判断到页面上文字居多时，会自动放大字体优化移动用户体验。添加以下头部可以禁用掉该优化-->
        <meta name="wap-font-scale" content="no">
        <meta content="telephone=no" name="format-detection"/>
        <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
        <link rel="stylesheet" href="/cleancar/Public/wap/css/html5.css" />
        <link rel="stylesheet" href="/cleancar/Public/wap/css/index.css" />
        <script type="text/javascript" src="/cleancar/Public/wap/js/jquery-1.10.2.min.js" ></script>
        <script type="text/javascript" src="/cleancar/Public/wap/js/screenSize.js" ></script>
    </head>  
    <body style="display: none;background-color: #fff;">
    	<!--遮罩层-->
        <div id="cover" style="position: fixed;width: 100%;height: 100%;background: rgba(0,0,0,0.1);z-index: 9999;display: none"></div> 
        <div class="box">
            <header>
                <i onclick="tiao()"></i>
                <p>消息通知</p>
            </header>
            <?php if($messageList != null): ?><div class="xiaoxitongzhi c">
                    <ul  id="container">
                        <?php if(is_array($messageList)): $i = 0; $__LIST__ = $messageList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$message): $mod = ($i % 2 );++$i;?><li>
                            	<a href="<?php echo U('system/messageinfo',array('msg_id'=>$message['msg_id']));?>">
                                <h4 class="c">
                                    <i class="fl"><?php echo ($message["msg_title"]); ?></i>
                                    <?php if($message['is_read']==0): ?>
                                    <span></span>
                                    <?php endif;?>
                                    <em class="fr"><?php echo date('Y-m-d H:i:s',$message['msg_addtime']);?></em>
                                </h4>
                                <p><?php echo ($message["msg_content"]); ?></p>
                                </a>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <p id='getmore' style="font-size:1.2rem; color:#c0c0c0; text-align: center;">查看更多</p>
                </div>
                <?php else: ?>
                <div style="display: block" class="meiyouxiaoxi">
                    <h4>
                        <img src="/cleancar/Public/wap/images/meiyouxiaoxi_03.png" />
                    </h4>
                    <p>你还没有任何消息</p>
                </div><?php endif; ?>

            <!--没有消息-->

        </div>
        <input type='hidden' id='page' value=1>
    </body>
    <script>
        function getLocalTime(nS) {
            //2017/7/19 上午10:05:08
            var s = new Date(parseInt(nS) * 1000).toLocaleString().replace(/上午/g, "").replace(/\//g, "-");
            s = s.substring(0, s.length - 3);
            return s;
        }
        //加载更多
        $("#getmore").on("click", function () {
            var p = parseInt($("#page").val())
            var next = p + 1;
            $("#page").val(next);
            $.ajax({
                url: "<?php echo U('system/message');?>&p=" + next,
                type: "get",
                timeout: 7000,
                success: function (data) { 
                    if (data.length == 0) {
                        $("#getmore").html("没有更多数据").attr("disabled", true);
                    } else {
                        var html = '';
                        for (var i = 0; i < data.length; i++) {
                            html += ' <li>';
                            html += '<a href="<?php echo U('system/messageinfo');?>&msg_id='+data[i].msg_id+'">';  
                            html += '<h4 class="c">';
                            html += '<i class="fl">' + data[i].msg_title + '</i>';
                            if(data[i]['is_read']==0){
                            	html += '<span></span>'; 
                        	}
                            html += ' <em class="fr">' + getLocalTime(data[i].msg_addtime) + '</em>';
                            html += '</h4>';
                            html += '<p>' + data[i].msg_content + '</p>';
                            html += '</a>';
                            html += ' </li>';
                        } 
                        $("#container").append(html);
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    //通常情况下textStatus和errorThrown只有其中一个包含信息
                    alert(errorThrown);
                },
                beforeSend: function () { 
                    $("#cover").show()
                },
                complete: function () {
                    $("#cover").hide()
                }
            });
        })
        $("body").show();
        //页面回跳
        function tiao(){
        	window.location.href="<?php echo U('index/index');?>";
        }
    </script>
</html>