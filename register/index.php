<?php
if (isset($_POST['register'])) {
    $host = '127.0.0.1';
    $dbname = 'cloud';
    $user = 'root';
    $password = 'root';
    $port = 3306;

    try {
        // Создаем соединение с базой данных
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Получаем данные из формы
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password_input = $_POST['password'];
        
        // Проверяем, что все поля заполнены
        if (empty($username) || empty($email) || empty($password_input)) {
            die("Все поля обязательны для заполнения");
        }
        
        // Проверяем email на валидность
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Некорректный email адрес");
        }
        
        // Хешируем пароль
        $hashed_password = password_hash($password_input, PASSWORD_DEFAULT);
        
        // Функция для генерации случайного ownerid
        function generateRandomString($length) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        
        // Функция для проверки уникальности ownerid
        function isOwnerIdUnique($conn, $ownerid) {
            $stmt = $conn->prepare("SELECT COUNT(*) FROM accounts WHERE ownerid = :ownerid");
            $stmt->bindParam(':ownerid', $ownerid);
            $stmt->execute();
            return $stmt->fetchColumn() == 0;
        }
        
        // Генерируем уникальный ownerid
        $ownerid = '';
        do {
            $length = rand(10, 20);
            $ownerid = generateRandomString($length);
        } while (!isOwnerIdUnique($conn, $ownerid));
        
        // Устанавливаем остальные параметры
        $role = 'Trial';
        $owner = 'SiteCloudAuthKey.ru';
        $keylevels = '10';
        
        // Проверяем, существует ли уже пользователь с таким email или username
        $stmt = $conn->prepare("SELECT COUNT(*) FROM accounts WHERE email = :email OR username = :username");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        if ($stmt->fetchColumn() > 0) {
            die("Пользователь с таким email или username уже существует");
        }
        
        // Подготавливаем и выполняем запрос на вставку
        $stmt = $conn->prepare("INSERT INTO accounts (username, email, password, ownerid, role, owner, keylevels) 
                               VALUES (:username, :email, :password, :ownerid, :role, :owner, :keylevels)");
        
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':ownerid', $ownerid);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':owner', $owner);
        $stmt->bindParam(':keylevels', $keylevels);
        
        $stmt->execute();
        
        // Перенаправляем пользователя после успешной регистрации
        header("Location: https://CloudAuthKey.local/login");
        exit();
        
    } catch(PDOException $e) {
        // Логируем ошибку и показываем пользователю общее сообщение
        error_log("Database error: " . $e->getMessage());
        die("Произошла ошибка при регистрации. Пожалуйста, попробуйте позже.");
    }
}
?>

<!DOCTYPE html>
<html lang="ru" class="bg-[#09090d] text-white overflow-x-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CloudAuthKey - Register</title>
    <link rel="stylesheet" href="output.css">
    <link rel="shortcut icon" type="image/jpg" href="favicon.png">
</head>
<body>
    <header>
        <nav class="border-gray-200 px-4 lg:px-6 py-2.5 mb-14">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="/" class="flex items-center">
                    <img src="logo-1-dark.png" class="mr-3 h-12 mt-2" alt="CloudAuthKey Logo">
                </a>
                <div class="flex items-center lg:order-2">
                    <a href="https://CloudAuthKey.local/login" class="text-white font-medium rounded-lg text-sm px-4 py-2 lg:px-5 lg:py-2.5 mr-2 bg-purple-600 hover:opacity-80">Войти</a>
                </div>
            </div>
        </nav>
    </header>

    <section>
        <div class="relative flex flex-wrap md:-m-8 ml-8 md:ml-24">
            <div class="w-full md:w-1/2 md:p-8">
                <div class="md:max-w-lg md:mx-auto md:pt-36">
                    <h2 class="mb-7 md:mb-12 text-3xl md:text-6xl font-bold leading-tight text-center">
                        Добро пожаловать в CloudAuthKey</span>!
                    </h2>
                </div>
            </div>
            <div class="w-full md:w-1/2 md:p-8 -ml-4 md:-ml-0">
                <div class="p-2 md:p-4 py-16 flex flex-col justify-center h-full">
                    <form class="md:max-w-md md:ml-32 space-y-4 md:space-y-6" method="post">
                        <div class="relative mb-4">
<input type="text" id="username" name="username" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-white bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " required>
                            <label for="username" class="absolute text-sm text-purple-600 duration-300 transform -translate-y-4 scale-75 top-2 origin-[0] bg-[#09090d] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Логин</label>
                        </div>
                        <div class="relative mb-4">
<input type="email" id="email" name="email" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-white bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " required>
                            <label for="email" class="absolute text-sm text-purple-600 duration-300 transform -translate-y-4 scale-75 top-2 origin-[0] bg-[#09090d] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Почта</label>
                        </div>
                        <div class="relative mb-4">
<input type="password" id="password" name="password" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-white bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " required>
                            <label for="password" class="absolute text-sm text-purple-600 duration-300 transform -translate-y-4 scale-75 top-2 origin-[0] bg-[#09090d] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Пароль</label>
                        </div>
                        
                                                <div class="text-sm font-medium text-white">Ваш план использование будет: <span class="text-purple-600">Пробный</span> </div>
                        
                        
                        <button name="register" class="text-white border-2 hover:bg-white hover:text-black font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full mt-10">
                            <span class="inline-flex">Зарегистрироваться</span>
                        </button>
                        <div class="text-sm font-medium text-white">
                            Уже есть аккаунт? <a href="/./login" class="hover:underline text-purple-600">Войти</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>