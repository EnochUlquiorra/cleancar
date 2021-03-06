<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>修改密码</title>
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
    <body style="display: none;">
        <div class="box">
            <header>
                <i onClick="javascript :history.back(-1);"></i>
                <p>修改密码</p>
            </header>

            <form  method="post" class="form-horizontal" action="<?php echo U('user/change_password');?>" onsubmit="return check()">
                <div class="xiugaidianhua c">
                    <div class="xiugaidianhua_ct c">
                        <label class="fl">原密码：</label>
                        <input   id="old_password" type="password" placeholder="请输入原密码" maxlength="18" class="fl"/>
                    </div>
                    <div class="xiugaidianhua_ct c">
                        <label class="fl">新密码：</label>
                        <input name="new_password" id="new_password" type="password" placeholder="请输入密码" maxlength="18" class="fl" style="width: 18rem;height: 2.963rem;"/>
                    </div>
                    <div class="xiugaidianhua_ct c">
                        <label class="fl" style="width: 7rem;height: 2.963rem;">确认新密码：</label>
                        <input id="re_new_password"  type="password" placeholder="请再次输入密码" maxlength="18" class="fl" style="width: 18rem;height: 2.963rem;"/>
                    </div>
                    <button>确    定</button>				
                </div>
            </form>
        </div>
        <input type="hidden" id="password_flag" value="">
    </body>
    <script>
        $("body").show();

        //提交表单时 进行验证
        function check() {
            if ($("#old_password").val().length == 0) {
                alert("请输入原始密码！")
                return false;
            }
            if ($("#password_flag").val() != 1) {
                alert("原始密码不正确！")
                return false;
            }
            if (!$("#new_password").val().match(/^\w{6,12}$/)) {
                alert("密码长度为6~12！")
                return false;
            }
            if ($("#re_new_password").val() != $("#new_password").val()) {
                alert("两次输入密码不一致！")
                return false;
            }
            return true;
        }

        //验证原始密码是否正确
        $("#old_password").on("input", function () {
            $.get("<?php echo U('ajax/check_if_password_is_verified');?>", {old_password: $(this).val()}, function (c) {
                $("#password_flag").val(c)
            })
        })
        //输入密码时清空re密码 
        $("#new_password").on('input', function () {
            $("#re_new_password").val(""); 
        })


    </script>
</html>