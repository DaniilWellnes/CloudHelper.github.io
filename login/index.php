<?php
session_start();

// Настройки подключения к базе данных
define('DB_HOST', 'localhost');
define('DB_PORT', 3306);
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'cloud');

// Устанавливаем соединение с базой данных
try {
    $conn = new PDO(
        "mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME.";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
        
    );
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Обработка формы входа
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    try {
        // Получаем пользователя из базы данных
        $stmt = $conn->prepare("SELECT username, password FROM accounts WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch();
            
            // Проверяем пароль с помощью password_verify()
            if (password_verify($password, $user['password'])) {
                // Сохраняем пользователя в сессии
                $_SESSION['user'] = $user['username'];
                
                // Логируем вход в систему
                $event = "Успешный вход в систему";
                
                $auditStmt = $conn->prepare(
                    "INSERT INTO auditlog (user, event) 
                     VALUES (:user, :event)"
                );
                $auditStmt->bindParam(':user', $user['username']);
                $auditStmt->bindParam(':event', $event);
                $auditStmt->execute();
                
                // Перенаправляем в личный кабинет
                header("Location: /panel/data-app");
                exit();
            } else {
                // Неверный пароль
                $error = "Неверный логин или пароль";
            }
        } else {
            // Пользователь не найден
            $error = "Неверный логин или пароль";
        }
        
        // Логируем неудачную попытку входа
        $event = "Неудачная попытка входа";
        $auditStmt = $conn->prepare(
            "INSERT INTO auditlog (user, event) 
             VALUES (:user, :event)"
        );
        $auditStmt->bindParam(':user', $username);
        $auditStmt->bindParam(':event', $event);
        $auditStmt->execute();
        
    } catch (PDOException $e) {
        error_log("Ошибка при работе с базой данных: " . $e->getMessage());
        $error = "Произошла ошибка при авторизации. Пожалуйста, попробуйте позже.";
    }
}
?>


<!DOCTYPE html>
<html lang="ru" class="bg-[#09090d] text-white overflow-x-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CloudAuthKey - Login</title>
    <link rel="stylesheet" href="output.css">
    <link rel="shortcut icon" type="image/jpg" href="favicon.png">
</head>
<body>
    <header>
        <nav class="border-gray-200 px-6 lg:px-6 py-2.5 mb-15">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="/" class="flex items-center">
                    <img src="logo-1-dark.png" class="mr-3 h-12 mt-2" alt="CloudAuthKey Logo">
                </a>
        <div class="flex items-center lg:order-2">
            <a href="https://CloudAuthKey.local/register" class="text-white font-medium rounded-lg text-sm px-4 py-2 lg:px-5 lg:py-2.5 mr-2 bg-purple-600 hover:opacity-80">Регистрация</a>
        </div>
    </div>
</nav>
    </header>

    <section>
        <div class="relative flex flex-wrap md:-m-8 ml-8 md:ml-24">
            <div class="w-full md:w-1/2 md:p-8">
                <div class="md:max-w-lg md:mx-auto md:pt-36">
                    <h2 class="mb-7 md:mb-12 text-3xl md:text-6xl font-bold leading-tight text-center">
                        Вновь ради видеть Вас в CloudAuthKey</span>!
                    </h2>
                </div>
                        
            </div>
            <div class="w-full md:w-1/2 md:p-8 -ml-4 md:-ml-0">
                <div class="p-2 md:p-4 py-16 flex flex-col justify-center h-full">
                    <form class="md:max-w-md md:ml-32 space-y-4 md:space-y-6" method="post">
                        <h2 class="mb-10 md:mb-12 text-3xl md:text-6xl font-bold leading-tight text-center"></h2>
                        
                        <div class="relative mb-4">
                            <input type="text" id="username" name="username" class="block px-2.5 pb-2.5 pt-4 w-full text-pu text-white bg-transparent rounded-lg border-1 border-purple-300 appearance-none focus:ring-0 peer" placeholder=" " required>
                            <label for="username" class="absolute text-sm text-purple-600 duration-300 transform -translate-y-4 scale-75 top-2 origin-[0] bg-[#09090d] px-2 peer-focus:px-2 peer-focus:text-purple-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Логин</label>
                        </div>
                        <div class="relative mb-4">
                            <input type="password" id="password" name="password" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-white bg-transparent rounded-lg border-1 border-purple-300 appearance-none focus:ring-0 peer" placeholder=" " required>
                            <label for="password" class="absolute text-sm text-purple-600 duration-300 transform -translate-y-4 scale-75 top-2 origin-[0] bg-[#09090d] px-2 peer-focus:px-2 peer-focus:text-purple-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Пароль</label>
                        </div>
                        <button type="submit" name="login" class="text-white border-2 hover:bg-white hover:text-black font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full mt-10">
                            <span class="inline-flex">Войти</span>
                        </button>
                        <div class="text-sm font-medium text-white"> Нет аккаунта?
                            <a href="/./register" class="hover:underline text-purple-600">Не беда! Можете прямо сейчас зарегистрировать аккаунт совершенно БЕСПЛАТНО (кликабельно)</a>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>