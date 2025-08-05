<?php
$cookie1 = 'email';
$cookie2 = 'registered_at';

if (isset($_COOKIE[$cookie1]) && isset($_COOKIE[$cookie2])) {
    $html = <<<HTML
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="11;url=index.php">
    <title>哟西~</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-color: #f5f5f5;
        }
        .countdown {
            font-size: 24px;
            color: #333;
            margin: 20px 0;
        }
    </style>
</head>
<body>
  <img src="https://p4.a.yximgs.com/ufile/atlas/NTI1NjU0NTI0NzU2MTU0NDk4NV8xNjMwMTg4NTI2MzM3_1.jpg" style="width:320px; height:320px;">
    <h1>哟西~ 尝试非法登录？<br>孩子，你可以考研了！</h1>
    <p>页面将在 <span id="countdown">10</span> 秒后自动跳转...</p>
    <script>
        // 动态倒计时
        var seconds = 10;
        var countdown = setInterval(function() {
            seconds--;
            document.getElementById('countdown').textContent = seconds;
            if (seconds <= 0) {
                clearInterval(countdown);
                window.location.href = 'index.php';
            }
        }, 1000);
    </script>
</body>
</html>
HTML;
    echo $html;
    exit;
}
?>
<?php
$serviceName = '';
$apiData = '';
$keyData = '';

if (file_exists('config')) {
    $lines = file('config', FILE_IGNORE_NEW_LINES);
    $serviceName = $lines[0] ?? '';
    $apiData = $lines[1] ?? '';
    $keyData = $lines[2] ?? '';
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>登录"<?php echo htmlspecialchars($serviceName); ?>" - kjcx1 Pro</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background-color: #f5f5f5;
        color: #333;
        margin: 0;
        padding: 20px;
        line-height: 1.6;
        min-height: 100vh;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        animation: pageLoad 1s ease;
    }

    .container {
        width: 800px;
        margin: 20px auto;
        background: white;
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        position: relative;
        top: 20px;
    }

    .login-title {
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

    .status-icon {
        color: #28a745;
        font-size: 24px;
        margin-right: 10px;
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

    :root {
        --primary: #6366f1;
        --success: #10b981;
        --error: #ef4444;
        --shadow: 0 10px 15px -3px rgba(0,0,0,0.1),0 4px 6px -4px rgba(0,0,0,0.1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Ziti', 'Segoe UI', system-ui, sans-serif;
    }

    @keyframes pageLoad {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideIn {
        from { transform: translateY(-50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .header i {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 1rem;
        animation: iconFloat 3s ease-in-out infinite;
    }

    @keyframes iconFloat {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }

    .input-group {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .input-group i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        transition: color 0.3s ease;
    }

    input {
        width: 100%;
        padding: 0.875rem 1rem 0.875rem 2.75rem;
        border: 2px solid #e2e8f0;
        border-radius: 0.75rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
    }

    input:focus + i {
        color: var(--primary);
    }

    .code-wrapper {
        display: flex;
        gap: 1rem;
    }

    #code {
        flex: 1;
        width: 50%;
        padding-right: 0.5rem;
    }

    .send-btn {
        width: 50%;
        background: var(--primary);
        color: white;
        border: none;
        padding: 0.875rem 0.5rem;
        border-radius: 0.75rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
    }

    .send-btn:disabled {
        background: #cbd5e1;
        cursor: not-allowed;
    }

    .login-btn {
        width: 100%;
        background: var(--success);
        color: white;
        padding: 1rem;
        border: none;
        border-radius: 0.75rem;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .login-btn:hover {
        opacity: 0.9;
    }

    .loader {
        width: 1.25rem;
        height: 1.25rem;
        border: 2px solid white;
        border-top-color: transparent;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        display: none;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .message {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0,0,0,0.9);
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        z-index: 1000;
        display: flex;
        align-items: center;
        gap: 8px;
        opacity: 0;
        visibility: hidden;
        min-width: 230px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .message.show {
        opacity: 1;
        visibility: visible;
        animation: messageSlide 0.6s cubic-bezier(0.68, -0.55, 0.27, 1.55);
    }

    @keyframes messageSlide {
        0% { transform: translate(-50%, -80px); }
        100% { transform: translate(-50%, 0); }
    }

    @media (max-width: 480px) {
        .login-container {
            padding: 1.5rem;
            border-radius: 1rem;
        }

        .send-btn {
            width: 100px;
            padding: 0.75rem;
            font-size: 0.875rem;
        }
    }

    .footer {
        text-align: center;
        margin-top: auto;
        padding: 10px 0;
        font-size: 12px;
        color: #666;
    }
    </style>
 
</head>
<body>
    <div class="container">
        <div style="text-align: right;">
            <img src="Videof5642538.jpg" style="width:250px; height:120px;">
            <h1 class="login-title">kjcx1 Pro网页登录端</h1>
            <div class="status">
                <div class="login-container">
                    <div class="header">
                        <svg t="1743629355565" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1261" width="50" height="50"><path d="M967.84384 392.23296L839.68 245.76H184.32l-128.16384 146.47296A61.44 61.44 0 0 0 40.96 432.68096V512h942.08v-79.31904a61.44 61.44 0 0 0-15.19616-40.448z" fill="#CED4EB" p-id="1262"></path><path d="M860.16 286.72h-163.84a20.50048 20.50048 0 0 1-20.48-20.48V61.44a20.48 20.48 0 0 0-20.48-20.48H204.8a61.50144 61.50144 0 0 0-61.44 61.44v512a20.48 20.48 0 0 0 20.48 20.48h696.32a20.48 20.48 0 0 0 20.48-20.48V307.2a20.48 20.48 0 0 0-20.48-20.48z" fill="#ECEFF8" p-id="1263"></path><path d="M983.04 447.0784V778.24a21.15584 21.15584 0 0 1-5.9392 14.5408l-184.32 184.32A21.15584 21.15584 0 0 1 778.24 983.04H102.4a61.62432 61.62432 0 0 1-61.44-61.44V447.0784a60.19072 60.19072 0 0 1 4.7104-23.3472 20.2752 20.2752 0 0 1 11.264-11.264 20.56192 20.56192 0 0 1 15.9744 0.4096l390.144 177.3568L512 612.352l3.4816-1.6384 435.6096-197.8368a20.56192 20.56192 0 0 1 15.9744-0.4096 20.2752 20.2752 0 0 1 11.264 11.264 60.19072 60.19072 0 0 1 4.7104 23.3472z" fill="#6EA5FF" p-id="1264"></path><path d="M956.86656 878.12096c94.8224-169.51296-80.56832-364.3392-259.09248-288.1536h-0.02048A205.06624 205.06624 0 0 0 573.44 778.24c-1.3312 179.36384 220.48768 272.09728 346.7264 147.31264a205.824 205.824 0 0 0 36.70016-47.43168z" fill="#ECEFF8" p-id="1265"></path><path d="M737.28 901.12a20.48 20.48 0 0 1-20.48-20.48v-134.88128l-6.00064 6.00064a20.48 20.48 0 0 1-28.95872-28.95872l40.96-40.96A20.48 20.48 0 0 1 757.76 696.32v184.32a20.48 20.48 0 0 1-20.48 20.48zM819.2 901.12a20.48 20.48 0 0 1-20.48-20.48v-184.32a20.48 20.48 0 0 1 40.96 0v134.88128l6.00064-6.00064a20.48 20.48 0 0 1 28.95872 28.95872l-40.96 40.96A20.45952 20.45952 0 0 1 819.2 901.12z" fill="#6EA5FF" p-id="1266"></path><path d="M512 612.352l-165.4784 78.2336a20.52096 20.52096 0 0 1-17.6128-37.0688l134.144-63.2832z" fill="#ECEFF8" p-id="1267"></path><path d="M866.79552 262.49216L703.8976 63.34464A61.99296 61.99296 0 0 0 655.36 40.96a20.48 20.48 0 0 0-20.48 20.48v204.8a61.50144 61.50144 0 0 0 61.44 61.44h163.84a20.48 20.48 0 0 0 20.48-20.48v-5.9392a60.86656 60.86656 0 0 0-13.84448-38.76864z" fill="#CED4EB" p-id="1268"></path><path d="M573.44 184.32H245.76a20.48 20.48 0 0 1 0-40.96h327.68a20.48 20.48 0 0 1 0 40.96zM573.44 307.2H245.76a20.48 20.48 0 0 1 0-40.96h327.68a20.48 20.48 0 0 1 0 40.96zM696.32 430.08H327.68a20.48 20.48 0 0 1 0-40.96h368.64a20.48 20.48 0 0 1 0 40.96z" fill="#6EA5FF" p-id="1269"></path><path d="M153.6 870.4m-30.72 0a30.72 30.72 0 1 0 61.44 0 30.72 30.72 0 1 0-61.44 0Z" fill="#ECEFF8" p-id="1270"></path><path d="M276.48 870.4m-30.72 0a30.72 30.72 0 1 0 61.44 0 30.72 30.72 0 1 0-61.44 0Z" fill="#ECEFF8" p-id="1271"></path><path d="M399.36 870.4m-30.72 0a30.72 30.72 0 1 0 61.44 0 30.72 30.72 0 1 0-61.44 0Z" fill="#ECEFF8" p-id="1272"></path></svg>
                        <h2>登录"<?php echo htmlspecialchars($serviceName); ?>"</h2>
                        <span style="color:#FF0000;">请确保已注册kjcx1 Pro，否则无法登录</span>
                    </div>
                    
                    <div class="input-group">
                        <input type="email" id="email" placeholder="请输入邮箱地址">
                        <i class="fas fa-envelope"></i>
                    </div>
                    
                    <div class="input-group">
                        <div class="code-wrapper">
                            <input type="text" id="code" placeholder="验证码">
                            <i class="fas fa-shield-alt"></i>
                            <button class="send-btn" id="sendBtn">
                                <span>获取邮件</span>
                                <div class="loader"></div>
                            </button>
                        </div>
                    </div>

                    <button class="login-btn" id="loginBtn">
                        <i class="fas fa-sign-in-alt"></i> 立即登录
                    </button>
                    <br>
                    <br>
                    <a href="http://app.kjcx2.top" style="text-decoration: none;">kjcx1 Pro|官方网站</a>
                    <br>
                    <a href="http://login.server.api.kjcx2.top/web/" style="text-decoration: none;">没账号？ 去注册</a>

                    <br><br>
                    <div style="text-align: center;">
                        <h5>登录(注册)为你已同意我们的服务<br>请遵守<a href="http://email.kjcx1.top/Privacy_Policy.php" style="color: #4B0082;">隐私政策</a>与<a href="http://email.kjcx1.top/Terms_of_Service.php" style="color: #4B0082;">用户协议</a></h5>
                    </div>
                </div>

                <div class="message" id="message">
                    <i class="fas fa-check-circle"></i>
                    <span>提示信息</span>
                </div>

      <script>
        let currentCode = '';
        let sendLock = false; // 防止重复点击的锁
        let verifiedEmail = ''; // 存储已验证的邮箱
        let emailLocked = false; // 邮箱锁定状态

        // 显示消息
        function showMessage(text, type = 'success') {
            const msg = document.getElementById('message');
            msg.querySelector('i').className = `fas ${type === 'success' ? 'fa-check-circle' : 'fa-times-circle'}`;
            msg.querySelector('span').textContent = text;
            msg.className = `message ${type} show`;
            setTimeout(() => msg.classList.remove('show'), 2000);
        }

        // 设置Cookie
        function setCookie(name, value, minutes) {
            const d = new Date();
            d.setTime(d.getTime() + (minutes * 60 * 1000));
            const expires = "expires=" + d.toUTCString();
            document.cookie = `${name}=${value};${expires};path=/`;
        }

        // 获取Cookie
        function getCookie(name) {
            const nameEQ = name + "=";
            const ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i].trim();
                if (c.startsWith(nameEQ)) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        // 锁定邮箱输入框
        function lockEmailInput() {
            const emailInput = document.getElementById('email');
            emailInput.readOnly = true;
            emailInput.style.backgroundColor = '#f1f5f9';
            emailInput.style.cursor = 'not-allowed';
            emailLocked = true;
        }

        // 发送验证码
        async function sendCode() {
            const email = document.getElementById('email').value;
            const btn = document.getElementById('sendBtn');

            if (!/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                showMessage('请输入有效的邮箱地址', 'error');
                return;
            }

            // 检查是否在60秒冷却期内
            const lastSendTime = getCookie('last_send_time');
            if (lastSendTime) {
                const currentTime = Math.floor(Date.now() / 1000);
                const timeDiff = currentTime - lastSendTime;
                if (timeDiff < 60) {
                    const remainingTime = 60 - timeDiff;
                    showMessage(`请${remainingTime}秒后再试`, 'error');
                    return;
                }
            }

            if (sendLock) return; // 如果已经处于冷却状态，直接返回
            sendLock = true; // 锁定发送按钮

            btn.disabled = true;
            btn.querySelector('.loader').style.display = 'block';
            btn.querySelector('span').style.display = 'none';

            currentCode = Math.random().toString().slice(-6);
            verifiedEmail = email; // 存储已验证的邮箱
            lockEmailInput(); // 锁定邮箱输入框

            try {
                // >>>>>>>>>>>>>>> 仅在此处添加编码处理 <<<<<<<<<<<<<<<
                const encodedCode = btoa(currentCode);
                // >>>>>>>>>>>>>>> 仅修改API链接中的code参数 <<<<<<<<<<<<<<<
                const xhr = new XMLHttpRequest();
                xhr.open('GET', `http://email.kjcx1.top/SMTP/email.php?to_email=${encodeURIComponent(email)}&code=${encodeURIComponent(encodedCode)}&platform=kjcx1 Pro第三方登录 - <?php echo htmlspecialchars($serviceName); ?>`, true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        const data = JSON.parse(xhr.responseText);
                        if (data.status === 'success') {
                            showMessage('邮件已发送至你的邮箱！');
                            
                            // 设置Cookie记录发送时间
                            const currentTime = Math.floor(Date.now() / 1000);
                            setCookie('last_send_time', currentTime, 1);
                            setCookie('verified_email', email, 5); // 5分钟有效期

                            let time = 60;
                            const timer = setInterval(() => {
                                btn.innerHTML = `<span>冷却${time}秒</span>`;
                                if (time-- <= 0) {
                                    clearInterval(timer);
                                    btn.innerHTML = '<span>获取邮件</span>';
                                    btn.disabled = false;
                                    sendLock = false; // 解锁发送按钮
                                }
                            }, 1000);
                        } else {
                            showMessage('发送失败，请重试', 'error');
                        }
                    } else {
                        showMessage('邮件发送失败，请检查网络连接', 'error');
                    }
                };
                xhr.onerror = function () {
                    showMessage('邮件已发送至你的邮箱！');
                };
                xhr.send();
            } catch (error) {
                showMessage('邮件发送失败，请检查网络连接', 'error');
                console.error("Error:", error);
            } finally {
                btn.querySelector('.loader').style.display = 'none';
                btn.querySelector('span').style.display = 'block';
            }
        }

        // 登录逻辑
        async function login() {
            const email = document.getElementById('email').value;
            const code = document.getElementById('code').value.trim();
            const loginBtn = document.getElementById('loginBtn');

            if (!code) {
                showMessage('请检查邮箱和验证码是否输入完整', 'error');
                return;
            }

            // 验证邮箱是否与发送验证码时一致
            if (email !== verifiedEmail && email !== getCookie('verified_email')) {
                showMessage('邮箱已被修改，请重新获取验证码', 'error');
                return;
            }

            // 验证验证码是否正确
            if (code !== currentCode && code !== getCookie('verification_code')) {
                showMessage('验证码错误', 'error');
                return;
            }

            loginBtn.disabled = true;
            loginBtn.classList.add('loading');

            try {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'http://login.server.api.kjcx2.top/login-hgi.php?internet=<?php echo $_SERVER['HTTP_HOST']; ?>', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        const result = JSON.parse(xhr.responseText);
                        if (result.success) {
document.cookie = `api=API_kjcx1.top/28282929292929HJjjKKKKKKKKKKKjwuiwjsjajakakajsnubxribdxibdxbidxibeubevogedvgedwdvwdvwdgvwidvigvvgivigvigivgigvivgigvigvigdvwgivdvwigog wdogvwogdvogvogvwdogwdgovdwogcwdog,wvogdwdv,wodvwdvwdogvwogdvwiissijsjsj_111111111; path=/`;
document.cookie = `api_1=API_kjcx1.top/28282929292929HJjjKKKKKKKKKKKjwuiwjsjajakakajsnubxribdxibdxbidxibeubevogedvgedwdvwdvwdgvwidvigvvgivigvigivgigvivgigvigvigdvwgivdvwigog wdogvwogdvogvogvwdogwdgovdwogcwdog,wvogdwdv,wodvwdvwdogvwogdvwiissijsjsj_111111111; path=/`;
document.cookie = `api_2=API_kjcx1.top/28282929292929HJjjKKKKKKKKKKKjwuiwjsjajakakajsnubxribdxibdxbidxibeubevogedvgedwdvwdvwdgvwidvigvvgivigvigivgigvivgigvigvigdvwgivdvwigog wdogvwogdvogvogvwdogwdgovdwogcwdog,wvogdwdv,wodvwdvwdogvwogdvwiissijsjsj_111111111; path=/`;
document.cookie = `api_3=API_kjcx1.top/28282929292929HJjjKKKKKKKKKKKjwuiwjsjajakakajsnubxribdxibdxbidxibeubevogedvgedwdvwdvwdgvwidvigvvgivigvigivgigvivgigvigvigdvwgivdvwigog wdogvwogdvogvogvwdogwdgovdwogcwdog,wvogdwdv,wodvwdvwdogvwogdvwiissijsjsj_111111111; path=/`;
                            document.cookie = `email=${encodeURIComponent(result.email)}; path=/`;
                            document.cookie = `registered_at=${encodeURIComponent(result.registered_at)}; path=/`;
document.cookie = `email_api=${encodeURIComponent(result.email)}; path=/`;
                            document.cookie = `registered_at_api=${encodeURIComponent(result.registered_at)}; path=/`;
                            showMessage(result.message, 'success');
                            setTimeout(() => {
                                document.querySelector('body').innerHTML = '';
                                window.location.replace('index.php'); // 登录后的目标页面
                            }, 2000);
                        } else {
                            showMessage(result.message, 'error');
                        }
                    } else {
                        showMessage('登录失败，请稍后再试', 'error');
                    }
                };
                xhr.onerror = function () {
                    showMessage('登录失败，请稍后再试', 'error');
                };
                xhr.send(`email=${encodeURIComponent(email)}&code=${encodeURIComponent(code)}`);
            } catch (error) {
                console.error("Login Error:", error);
                showMessage('登录失败，请稍后再试', 'error');
            } finally {
                loginBtn.disabled = false;
                loginBtn.classList.remove('loading');
            }
        }

        // 防止用户修改邮箱
        document.getElementById('email').addEventListener('input', function() {
            if (emailLocked) {
                this.value = verifiedEmail;
                showMessage('邮箱已锁定，无法修改', 'error');
            }
        });

        document.getElementById('sendBtn').addEventListener('click', sendCode);
        document.getElementById('loginBtn').addEventListener('click', login);
        document.getElementById('code').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') login();
        });
    </script>
            </div>
        </div>
    </div>
    <div class="footer">
 <?php
// 显示版权信息（动态更新）
$currentYear = date('Y');
echo "<h4>Copyright © 2023-" . $currentYear . " 科技创想网络工作室</h4>";
?>
    </div>
</body>
</html>