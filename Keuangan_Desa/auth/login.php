<!DOCTYPE html>
<html>
<head>
    <title>Login Admin - Keuangan Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: 
                linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                url('../assets/BalaiDesa.jpeg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            width: 360px;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }
    </style>
</head>

<body>

<div class="login-box">
    <h4 class="text-center mb-3">Login Admin</h4>
    <form method="post" action="proses_login.php">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-success w-100">Login</button>
    </form>
</div>

</body>
</html>
