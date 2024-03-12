<?php
class MyDB extends SQLite3 {
    function __construct() {
       $this->open('db/omakase.db');
    }
 }

 // 2. Open Database 
 $db = new MyDB();

session_start();

if (isset($_GET["mail"]) && isset($_GET["pass"])) {
    $email = $_GET["mail"];
    $password = $_GET["pass"];

    //ผู้จัดการ
    if ($email == "gangnam@gmail.com" && $password == "gangnammanager") {
        header("Location: manage/home-manager.php");
        exit;
    }
    //chef
    if($email == "chef@gmail.com" && $password == "chef123") {
        header("Location: chefroom.php");
        exit;
    }
    //reciep
    if($email == "reciep@gmail.com" && $password == "reciep123") {
        header("Location: reciep/booking.php");
        exit;
    }
    
    $sql = "SELECT * FROM customers WHERE email = '$email'";
    $result = $db->query($sql);
    $row = $result->fetchArray(SQLITE3_ASSOC);
    
    if (!$row) {
        $message = "กรุณาลงทะเบียน";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        if ($row['password'] == $password) {
            $_SESSION['cus_id'] = $row['cus_id'];
            header('Location: home.php');
            exit;
        } else {
            $mesg = "อีเมลล์หรือรหัสผ่านไม่ถูกต้อง";
            echo "<script type='text/javascript'>alert('$mesg');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Loginstyle.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap');

        * {
            font-family: "Noto Sans Thai", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url(https://images.unsplash.com/photo-1504416285472-eccf03dd31eb?q=80&w=2944&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D) no-repeat;
            background-size: cover;
            background-position: center;
        }

        .wrapper {
            position: relative;
            width: 400px;
            height: 440px;
            border: 2px solid rgba(255, 255, 255, .5);
            border-radius: 20px;
            color: black;
            box-shadow: 0 0 30px rgba(0, 0, 0, .5);
            display: flex;
            position: relative;
            justify-content: center;
            align-items: center;
            /* background-color: red; */
            background-color: rgba(255, 255, 255, .85);
            overflow: hidden;
            /* transform: scale(0); */
            transition: height .2s ease;

        }

        .wrapper.active {
            height: 900px;
            margin: 100px;
        }

        .wrapper .form-box {
            width: 100%;
            padding: 40px;
        }

        .wrapper .form-box.login {
            transition: transform .18s ease;
            transform: translateX(0);
        }

        .wrapper.active .form-box.login {
            transition: none;
            transform: translateX(-400px);
        }

        .wrapper .form-box.register {
            position: absolute;
            transition: none;
            transform: translateX(400px);
        }

        .wrapper.active .form-box.register {
            transition: transform .18s ease;
            transform: translateX(0);
        }

        .wrapper .icon-close {
            position: absolute;
            top: 0;
            right: 0;
            width: 45px;
            height: 45px;
            font-size: 1.8em;
            display: flex;
            justify-content: center;
            align-items: center;
        }

            .form-box h2 {
            font-size: 2em;
            text-align: center;
        }

        .input-box {
            position: relative;
            width: 100%;
            height: 50px;
            border-bottom: 1px solid;
            margin: 30px 0;
        }

        .input-box label {
            position: absolute;
            top: 50%;
            left: 3px;
            transform: translateY(-50%);
            font-size: 1em;
            font-weight: 500;
            pointer-events: none;
            transition: .5s;
        }

        .input-box input:focus~label,
        .input-box input:valid~label {
            top: -1px;
        }

        .input-box input {
            width: 100%;
            height: 120%;
            background: transparent;
            border: none;
            outline: none;
            font-size: 1em;
            font-weight: 100;
            padding: 0 35px 0 5px;
        }

        .genderchoice {
            font-size: 1em;
            font-weight: 500;
            display: flex;
            flex-direction: column;
            gap: 15px;
            position: relative;
        }

        .gender {
            position: absolute;
            left: 10px;
        }

        .genderradio {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            margin-top: 50px;
        }

        .input-box .icon {
            position: absolute;
            right: 8px;
            font-size: 1.2em;
            line-height: 57px;
        }

        .remember-forgot {
            font-size: .9em;
            font-weight: 500;
            margin: -15px 0 15px;
            display: flex;
            justify-content: space-between;

        }

        .remember-forgot label input {
            accent-color: #000000;
            margin-right: 5px;
        }

        .btn {
            width: 100%;
            height: 45px;
            background: #FFC700;
            border: none;
            outline: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1em;
            color: #fff;
            font-weight: 500;
        }

        .login-register {
            font-size: .9em;
            text-align: center;
            font-weight: 500;
            margin: 25px 0 10px;
        }
    </style>
</head>

<body>
    <!-- กรอบ Login และ Register -->
    <div class="wrapper">
        <!-- หน้า Login -->
        <div class="form-box login">

            <h2>เข้าสู่ระบบ</h2>
            <form>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail-outline"></ion-icon>
                    </span>
                    <input type="email" name="mail" required>
                    <label>อีเมล</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <input type="password" name="pass" required>
                    <label>รหัสผ่าน</label>
                </div>
                <a href="reservation.php">
                    <button type="submit" class="btn" id="btnlogin" name="login" value="Login">เข้าสู่ระบบ</button>
                </a>
                <div class="login-register">
                    <p>ไม่มีบัญชี?
                        <a href="#" class="register-link">ลงทะเบียน</a>
                    </p>
                </div>
            </form>
        </div>
        <!-- หน้า Register -->
        <div class="form-box register">
            <h2>ลงทะเบียน</h2>
            <form action="register_db.php" method="POST">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <input type="firstname" name="first_name" required>
                    <label>ชื่อจริง</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <input type="lastname" name="last_name" required>
                    <label>นามสกุล</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="call-outline"></ion-icon>
                    </span>
                    <input type="number" name="phone" required>
                    <label>เบอร์โทรศัพท์</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail-outline"></ion-icon>
                    </span>
                    <input type="email" name="mail" required>
                    <label>อีเมล</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="id-card-outline"></ion-icon>
                    </span>
                    <input type="text" name="username" required>
                    <label>ชื่อผู้ใช้</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <input type="password" name="password" required>
                    <label>รหัสผ่าน</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <input type="password" name="confirmed_pass" required>
                    <label>ยืนยันรหัสผ่าน</label>
                </div>
                <button type="submit" class="btn" name="btnregis">สมัครสมาชิก</button>
                <div class="login-register">
                    <p>มีบัญชีอยู่แล้ว?
                        <a href="#" class="login-link">เข้าสู่ระบบ</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script src="Loginscript.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        const wrapper = document.querySelector('.wrapper')
        const loginlink = document.querySelector('.login-link')
        const registerlink = document.querySelector('.register-link')
        const btnpopup = document.querySelector('.btnLogin-popup')

        registerlink.addEventListener('click', () => {
            wrapper.classList.add('active');
        });

        loginlink.addEventListener('click', () => {
            wrapper.classList.remove('active');
        });

        btnpopup.addEventListener('click', () => {
            wrapper.classList.add('active-popup');
        });
    </script>
</body>
</html>