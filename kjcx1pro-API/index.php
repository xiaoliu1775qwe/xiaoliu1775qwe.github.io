<?php
$serviceName = '';
$lnternet = '';
$keyData = '';

if (file_exists('config')) {
    $lines = file('config', FILE_IGNORE_NEW_LINES);
    $serviceName = $lines[0] ?? '';
    $lnternet = $lines[1] ?? '';
    $keyData = $lines[2] ?? '';
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($serviceName); ?>—kjcx1 Pro专属用户中心</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
        }
        
        .container {
            width: 800px;
            margin: 20px auto 20px 20px;
            background: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        h1 {
            color: #0000FF;
            font-size: 24px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .status {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .action-buttons {
            margin-top: 30px;
        }
      
        .btn {
            display: inline-block;
            padding: 8px 16px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 10px;
            font-size: 14px;
        }
        
        .btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
    
            <img src="Videof5642538.jpg" style="width:250px; height:120px;">
        <h2><?php echo htmlspecialchars($serviceName); ?>—kjcx1 Pro专属用户中心</h2>
        
        <div class="status">
          <span class="">
        <div class="info-box">
        <div class="avatar"></div>
        <div class="user-info" id="user-info">
        </div>
        <div class="action-buttons">
        <h3>
       
             <br>------------------------------------------------------------------<br>
            <a href="/" class="btn">去首页</a>
            </h3>
         </div>
      </div>
   </div>
</div>   
    
 <?php
// 显示版权信息
$currentYear = date('Y');
echo "<h4>Copyright © 2023-" . $currentYear . " 科技创想网络工作室</h4>";
?>

    
     <script>
        function getCookie(name) {
            const cookieArray = document.cookie.split('; ');
            for (let i = 0; i < cookieArray.length; i++) {
                const cookiePair = cookieArray[i].split('=');
                if (cookiePair[0] === name) {
                    return decodeURIComponent(cookiePair[1]);
                }
            }
            return null;
        }

        function clearCookies() {
const cookiesToClear = ['email', 'registered_at', 'api', 'api_1', 'api_2', 'api_3', 'registered_at_api', 'email_api'];
            
            const domainParts = window.location.hostname.split('.');
            const domains = [
                '', 
                window.location.hostname, 
                ...(domainParts.length > 2 ? [`.${domainParts.slice(-2).join('.')}`] : []) 
            ].filter((value, index, self) => self.indexOf(value) === index); 
            
            const paths = ['', '/']; 
            
            cookiesToClear.forEach(name => {
                paths.forEach(path => {
                    domains.forEach(domain => {
                        let cookieString = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=${path}`;
                        if (domain) {
                            cookieString += `; domain=${domain}`;
                        }
                        document.cookie = cookieString;
                    });
                });
            });
            
         
            window.location.href = window.location.href.split('?')[0]; 
        }

        // 检测登录状态并显示信息
        const userInfoDiv = document.getElementById('user-info');
        const registeredAt = getCookie('registered_at');
        const email = getCookie('email');

        if (registeredAt && email) {
            // 如果用户已登录，显示用户信息
            userInfoDiv.innerHTML = `
                <p><strong>注册日期：</strong>${registeredAt}</p>
                <p><strong>邮箱：</strong>${email}</p>
                <button onclick="clearCookies()" class="btn">退出登录</button>
            `;
        } else {
            // 如果用户未登录，显示登录按钮
            userInfoDiv.innerHTML = `
                <p>您尚未登录</p>
               <button onclick="window.location.href='login.php'" class="btn">点击登录</button>
            `;
        }

  
        function triggerClick(button, url) {
     
            button.classList.add('btn-click');
            
    
            setTimeout(() => {
                button.classList.remove('btn-click');
            }, 400);
            
         
            if(url) {
                setTimeout(() => {
                    window.open(url);
                }, 200);
            }
        }
    </script>
</body>
</html>