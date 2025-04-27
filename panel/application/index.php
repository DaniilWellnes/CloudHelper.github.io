<?php
session_start();

// Проверка авторизации
if (!isset($_SESSION['user'])) {
    die("Сессия не найдена, авторизируйтесь заново :)");
}

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

// Получаем данные пользователя из базы данных
try {
    $user = $_SESSION['user'];
    $stmt = $conn->prepare("SELECT ownerid, role FROM accounts WHERE username = :username");
    $stmt->bindParam(':username', $user);
    $stmt->execute();
    
    if ($stmt->rowCount() === 1) {
        $userData = $stmt->fetch();
        $userId = $userData['ownerid']; // Используем ownerid вместо id
        $userRole = htmlspecialchars($userData['role'], ENT_QUOTES, 'UTF-8');
    } else {
        die("Пользователь не найден в базе данных");
    }
} catch (PDOException $e) {
    die("Ошибка получения данных пользователя: " . $e->getMessage());
}

// Получаем приложения пользователя
$userApps = [];
try {
    $stmt = $conn->prepare("SELECT name, enabled FROM apps WHERE ownerid = :ownerid");
    $stmt->bindParam(':ownerid', $userId);
    $stmt->execute();
    $userApps = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log("Ошибка получения приложений пользователя: " . $e->getMessage());
}

// Логируем посещение личного кабинета
try {
    $event = "Посещение личного кабинета";
    $app = "CloudKeyAuth";
    $time = date('Y-m-d H:i:s');
    
    $auditStmt = $conn->prepare(
        "INSERT INTO auditlog (user, event, time, app) 
         VALUES (:user, :event, :time, :app)"
    );
    $auditStmt->bindParam(':user', $user);
    $auditStmt->bindParam(':event', $event);
    $auditStmt->bindParam(':time', $time);
    $auditStmt->bindParam(':app', $app);
    $auditStmt->execute();
} catch (PDOException $e) {
    error_log("Ошибка записи в auditlog: " . $e->getMessage());
}

$username = htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8');
?>













<!DOCTYPE html><html lang="ru" class="bg-[#09090d] text-white overflow-x-hidden dark" data-bybit-channel-name="tJ_DQ5sz5cWO2LrOOCPy7" data-bybit-is-default-wallet="true" data-scrapbook-source="https://cloudauthkey.local" data-scrapbook-create="20250315104223293"><head><meta charset="UTF-8"><style>body {transition: opacity ease-in 0.2s; } 
body[unresolved] {opacity: 0; display: block; overflow: hidden; position: relative; } 
</style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="highlight.css">
    
    
    

    <link href="remixicon.css" rel="stylesheet">

    <link href="lineicons.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/jpg" href="favicon.png">

    <link href="datatables.bundle.css" rel="stylesheet" type="text/css">

    <meta name="apple-itunes-app" content="app-id=6503321465">

    <title>CloudAuthKey</title>

    

    <link rel="stylesheet" href="dashboard.css">
    
    <link rel="stylesheet" href="css2.css">

    <link rel="stylesheet" href="output.css">
<body style="overflow: visible;">
    

    <nav class="fixed top-0 left-0 right-0 z-50 w-full bg-[#0f0f17] border-b border-[#09090d] shadow-lg">
    <div class="py-3 px-3 lg:px-5 lg:pl-3">
        <div class="flex justify-between items-center">
            <div class="flex justify-start items-center">
                <div class="hidden p-2 text-white rounded cursor-pointer lg:inline hover:opacity-60 transition duration-200 -ml-8">
                    <div class="w-6 h-6"></div>
                </div>
                <a href="https://cloudauthkey.local">
                    <img src="KeyauthBanner.png" alt="CloudAuthKey Icon" style="max-width: 303px; height: auto;">
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-4">
                <a href="https://CloudAuthKey.online/" target="_blank" class="inline-flex items-center text-white hover:opacity-60 hover:text-blue-400 transition duration-200 text-sm px-4 py-2">
                    <i class="ri-code-s-slash-line mr-2"></i>Документация
                </a>

                <a href="https://github.com/CloudAuthKey" target="_blank" class="inline-flex items-center text-white hover:opacity-60 hover:text-blue-400 transition duration-200 text-sm px-4 py-2">
                    <i class="ri-github-fill mr-2"></i>Примеры приложений
                </a>

                <a href="https://youtube.com/CloudAuthKey" target="_blank" class="inline-flex items-center text-white hover:opacity-60 hover:text-blue-400 transition duration-200 text-sm px-4 py-2">
                    <i class="ri-youtube-line mr-2"></i>Видео обзоры
                </a>

                <a href="https://t.me/CloudAuthKey" target="_blank" class="inline-flex items-center text-white hover:opacity-60 hover:text-blue-400 transition duration-200 text-sm px-4 py-2">
                    <i class="ri-telegram-2-line mr-2"></i>Телеграм
                </a>
            </div>

            <!-- Мобильное меню (бургер) -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-white hover:opacity-60 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Добавьте этот скрипт для работы мобильного меню -->
<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>

<!-- Добавьте этот стиль, чтобы основной контент не скрывался под навигацией -->
<style>
    body {
        padding-top: 64px; /* Высота навигационной панели */
    }
</style>

<div class="flex overflow-hidden pt-16 bg-[#09090d]">
    
    
<style>
/* Hide vertical scrollbar for Webkit-based browsers (e.g., Chrome, Safari) */
*::-webkit-scrollbar {
    display: none;
}
</style>

<aside id="sidebar" class="flex hidden fixed top-0 left-0 z-20 flex-col flex-shrink-0 pt-16 w-64 h-full duration-200 lg:flex transition-width" aria-label="Sidebar">
    <div class="flex relative flex-col flex-1 pt-0 min-h-0 bg-[#0f0f17] border-r border-[#0f0f17]">
        <div class="flex overflow-y-auto flex-col flex-1 pt-5 pb-4">
            <div class="flex-1 px-3 space-y-1 bg-[#0f0f17] mt-8">
                
                
                
                <!-- Модальное окно выхода -->
<div class="w-full max-w-sm border border-gray-700 rounded-lg shadow">
    <div class="flex justify-end px-4 pt-2">
        <button id="dropdownButton" class="inline-block text-gray-500 hover:opacity-60 focus:ring-0 p-1.5" type="button" onclick="document.getElementById('logout-modal').classList.remove('hidden')">
            <span class="sr-only">Open dropdown</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"></path>
            </svg>
        </button>
    </div>
    <div class="flex items-center px-4 pb-4 ml-6">
        <img class="w-12 h-12 rounded-full mr-3" src="favicon.png" alt="profile image">
        <div class="ml-4 flex flex-col mr-4">
            <h5 class="text-lg font-medium text-white-700 ml-5"><?= $username ?></h5>
            <label class="text-sm text-gray-400"><b>Срок действия истекает:</b> Никогда</label>
        </div>
    </div>

    <div class="px-4 pb-4">
        <p class="text-center text-purple-500 text-sm font-black px-1.5 py-0.5 rounded border border-purple-500 mb-2">
        <?php echo $userRole; ?>
        </p>
    </div>
    
</div>

<!-- Модальное окно выхода -->
<div id="logout-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center flex hidden" aria-modal="true" role="dialog">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-[#0f0f17] rounded-lg border border-gray-700 shadow">
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-white">Подтверждение выхода</h3>
                <hr class="h-px mb-4 mt-4 bg-gray-700 border-0">
                <p class="text-gray-400 mb-6">Вы уверены, что хотите выйти из аккаунта?</p>
                <form class="space-y-6" method="POST" action="https://cloudauthkey.local/app/logout">
                    <div class="flex justify-end space-x-4">
                        <button type="button" onclick="document.getElementById('logout-modal').classList.add('hidden')" class="text-white bg-gray-700 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-200">
                            Отмена
                        </button>
                        <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-200">
                            Выйти
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Встроенный JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('logout-modal');

        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });
</script>

    <!-- Модальное окно выхода -->
    

                
                

                        <ul class="space-y-2 font-medium">
                            <li>
                                <a href="https://cloudauthkey.local/panel/data-app" class="flex items-center p-2 rounded-lg text-gray-300 hover:text-white hover:bg-purple-600 group">
                                    <span class="ml-3">Приложения</span>
                                </a>
                            </li>
                        </ul>

                        <ul class="space-y-2 font-medium">
                            <li>
                                <span class="flex items-center p-2 rounded-lg text-purple-500 cursor-not-allowed opacity-50">
                                    <span class="ml-3">Данные приложения</span>
                                </span>
                            </li>
                        </ul>
                
<div class="mb-4 border-b border-[#0f0f17]">
    <ul class="flex items-center text-base font-medium text-center" id="myTab" role="tablist">                  
        <li class="text-purple hover:text-purple p-4" id="account-tab" data-tabs-target="#account" role="tab" data-tbt="account" aria-controls="account" aria-selected="true" data-popover-target="account-popover">
            Настройки приложения
        </li>
    </ul>
</div>

<div class="rounded-lg" id="app" role="tabpanel" aria-labelledby="app-tab">
    <ul class="space-y-2 font-medium">
        <li>
            <a href="/panel/app/licenses/" class="flex items-center p-2 rounded-lg text-gray-300 hover:text-white group">
                <span class="ml-3">Ключи</span>
            </a>
        </li>
        <li>
            <a href="/panel/app/users/" class="flex items-center p-2 rounded-lg text-gray-300 hover:text-white group">
                <span class="ml-3">Пользователи</span>
            </a>
        </li>
        <li>
            <a href="/panel/app/tokens/" class="flex items-center p-2 rounded-lg text-gray-300 hover:text-white group">
                <span class="ml-3">Токены</span>
            </a>
        </li>
        <li>
            <a href="/panel/app/subscriptions/" class="flex items-center p-2 rounded-lg text-gray-300 hover:text-white group">
                <span class="ml-3">Подписки для приложения</span>
            </a>
        </li>
        <li>
            <a href="/panel/app/chats/" class="flex items-center p-2 rounded-lg text-gray-300 hover:text-white group">
                <span class="ml-3">Чаты</span>
            </a>
        </li>
        <li>
            <a href="/panel/app/sessions/" class="flex items-center p-2 rounded-lg text-gray-300 hover:text-white group">
                <span class="ml-3">Сессии</span>
            </a>
        </li>
        <li>
            <a href="/panel/app/webhooks/" class="flex items-center p-2 rounded-lg text-gray-300 hover:text-white group">
                <span class="ml-3">Вебхуки</span>
            </a>
        </li>
        <li>
            <a href="/panel/app/files/" class="flex items-center p-2 rounded-lg text-gray-300 hover:text-white group">
                <span class="ml-3">Файлы</span>
            </a>
        </li>
        <li>
            <a href="/panel/app/vars/" class="flex items-center p-2 rounded-lg text-gray-300 hover:text-white group">
                <span class="ml-3">Серверные переменные</span>
            </a>
        </li>
        <li>
            <a href="/panel/app/logs/" class="flex items-center p-2 rounded-lg text-gray-300 hover:text-white group">
                <span class="ml-3">История действий</span>
            </a>
        </li>
        <li>
            <a href="/panel/app/blacklists/" class="flex items-center p-2 rounded-lg text-gray-300 hover:text-white group">
                <span class="ml-3">Черный список</span>
            </a>
        </li>
        <li>
            <a href="/panel/app/whitelists/" class="flex items-center p-2 rounded-lg text-gray-300 hover:text-white group">
                <span class="ml-3">Белый список</span>
            </a>
        </li>
        <li>
            <a href="/panel/app/app-settings/" class="flex items-center p-2 rounded-lg text-gray-300 hover:text-white group">
                <span class="ml-3">Настройки</span>
            </a>
        </li>
        <li>
            <a href="/panel/app/audit-logs/" class="flex items-center p-2 rounded-lg text-gray-300 hover:text-white group">
                <span class="ml-3">Журналы аудита</span>
            </a>
        </li>
    </ul>
</div>
                
                
                                        <div class="mb-4 border-b border-[#0f0f17]">
    <ul class="flex items-center text-base font-medium text-center" id="myTab" role="tablist">                  
        <li class="text-white hover:text-white p-4" id="account-tab" data-tabs-target="#account" role="tab" data-tbt="account" aria-controls="account" aria-selected="true" data-popover-target="account-popover">
            Прочее
        </li>
    </ul>
</div>
                
                
                    <div class="p-0 rounded-lg" id="account" role="tabpanel" aria-labelledby="account-tab">
                        <ul class="space-y-2 font-medium">
                            <li>
                                <a href="/forms/" class="flex items-center p-2 rounded-lg text-gray-300 hover:text-white group">
                                    <span class="ml-3">Обратная связь</span>
                                </a>
                            </li>

                            <li>
                                <a href="/upgrade/" class="flex items-center p-2 rounded-lg text-gray-300 hover:text-white group">
                                    <span class="ml-3">Пожертвование</span>
                                </a>
                            </li>

                            <li>
                                <a href="/panel/app/account-settings" class="flex items-center p-2 rounded-lg text-gray-300 hover:text-white group">
                                    <span class="ml-3">Настройки</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                            
                            
                        </ul>
                    </div>
                        
                        
                        
                        
                        
                        
                </div>

                </div>
            </div>
        </div>
    </div>
</aside>
    <div class="hidden fixed inset-0 z-10" id="sidebarBackdrop"></div>
    <div id="main-content" class="overflow-y-auto relative w-full h-full lg:ml-64">
        <main>

            
            
            
<div class="mb-4 p-8">
            <nav class="flex mb-5" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2">
        <li class="inline-flex items-center">
            <a href="https://cloudauthkey.local/panel/data-app/" class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-white">
                <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"></path>
                </svg>
                Управление приложениями
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <i class="lni lni-angle-double-right mr-2"></i>
                <label class="inline-flex items-center text-sm font-medium text-gray-400">Текущее приложение:
                    тут название приложения </label>
            </div>
        </li>
                        <i class="lni lni-angle-double-right mr-2"></i>
                <label class="inline-flex items-center text-sm font-medium text-red-600">
                    У вас нет подписки!<a href="https://cloudauthkey.local/upgrade/" class="text-purple-600 hover:underline">
                        &nbsp;Приобрести сейчас.
                    </a>
                </label>
                </ol>
</nav>            <h1 class="text-xl font-semibold text-white-900 sm:text-2xl">

                                Управление приложением - тут название приложения                            </h1>
            <p class="text-xs text-gray-500">Вот тут-то все и начинается. <a href="https://t.me/CloudAuthKey" target="_blank" class="text-purple-600 hover:underline">Узнать подробнее</a>.</p>
            <br>

            

            <div class="flex flex-col">
                <div class="overflow-x-auto">
                    <!-- Alert Box -->
                    <div id="alert" class="flex items-start p-4 mb-4 text-red-800 rounded-lg bg-[#09090d]" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4 mt-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"></path>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ml-3 text-sm font-medium text-red-500">
                            <div>Секреты приложений больше не нужны из-за нашей новой конечной точки API 1.1.</div>
                            <div class="mt-1">Если вы используете API 1.0, нажмите на вкладку "Perl", чтобы просмотреть секрет. Тем не менее, настоятельно рекомендуется обновиться до 1.1!</div>
                        </div>
                    </div>
                    <!-- End Alert Box -->
                                        <p class="text-base text-gray-300">Учетные данные приложения</p>
                    <p class="text-xs text-gray-500">Просто замените код заполнителя в примере на эти</p>

                    <div class="mb-4 border-b border-gray-200">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                            <li class="mr-2" role="presentation">
                                <button class="inline-block p-4 rounded-t-lg text-gray-400 hover:text-white transition duration-200 text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500" id="csharp-tab" data-tabs-target="#csharp" type="button" role="tab" aria-controls="csharp" aria-selected="true">C#</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button class="inline-block p-4 rounded-t-lg text-gray-400 hover:text-white transition duration-200 dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" id="cplusplus-tab" data-tabs-target="#cplusplus" type="button" role="tab" aria-controls="cplusplus" aria-selected="false">C++</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button class="inline-block p-4 rounded-t-lg text-gray-400 hover:text-white transition duration-200 dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" id="python-tab" data-tabs-target="#python" type="button" role="tab" aria-controls="python" aria-selected="false">Python</button>
                            </li>
                            <li role="presentation">
                                <button class="inline-block p-4 rounded-t-lg text-gray-400 hover:text-white transition duration-200 dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" id="php-tab" data-tabs-target="#php" type="button" role="tab" aria-controls="php" aria-selected="false">PHP</button>
                            </li>
                            <li role="presentation">
                                <button class="inline-block p-4 rounded-t-lg text-gray-400 hover:text-white transition duration-200 dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" id="js-tab" data-tabs-target="#js" type="button" role="tab" aria-controls="js" aria-selected="false">JavaScript</button>
                            </li>
                            <li role="presentation">
                                <button class="inline-block p-4 rounded-t-lg text-gray-400 hover:text-white transition duration-200 dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" id="j-tab" data-tabs-target="#j" type="button" role="tab" aria-controls="j" aria-selected="false">Java</button>
                            </li>
                            <li role="presentation">
                                <button class="inline-block p-4 rounded-t-lg text-gray-400 hover:text-white transition duration-200 dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" id="vb-tab" data-tabs-target="#vb" type="button" role="tab" aria-controls="vb" aria-selected="false">VB.Net</button>
                            </li>
                            <li role="presentation">
                                <button class="inline-block p-4 rounded-t-lg text-gray-400 hover:text-white transition duration-200 dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" id="rust-tab" data-tabs-target="#rust" type="button" role="tab" aria-controls="rust" aria-selected="false">Rust</button>
                            </li>
                            <li role="presentation">
                                <button class="inline-block p-4 rounded-t-lg text-gray-400 hover:text-white transition duration-200 dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" id="go-tab" data-tabs-target="#go" type="button" role="tab" aria-controls="go" aria-selected="false">Go</button>
                            </li>
                            <li role="presentation">
                                <button class="inline-block p-4 rounded-t-lg text-gray-400 hover:text-white transition duration-200 dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" id="lua-tab" data-tabs-target="#lua" type="button" role="tab" aria-controls="lua" aria-selected="false">Lua</button>
                            </li>
                            <li role="presentation">
                                <button class="inline-block p-4 rounded-t-lg text-gray-400 hover:text-white transition duration-200 dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" id="ruby-tab" data-tabs-target="#ruby" type="button" role="tab" aria-controls="ruby" aria-selected="false">Ruby</button>
                            </li>
                            <li role="presentation">
                                <button class="inline-block p-4 rounded-t-lg text-gray-400 hover:text-white transition duration-200 dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" id="perl-tab" data-tabs-target="#perl" type="button" role="tab" aria-controls="perl" aria-selected="false">Perl</button>
                            </li>
                        </ul>
                    </div>
                    <div id="myTabContent">
                        <div class="p-4 rounded-lg bg-[#09090d]" id="csharp" role="tabpanel" aria-labelledby="csharp-tab">
                            <pre id="csharp-creds" class="copy-target text-gray-400 bg-[#09090d] overflow-x-auto hljs language-java"><span class="hljs-keyword">public</span> <span class="hljs-keyword">static</span> <span class="hljs-type">api</span> <span class="hljs-variable">CloudAuthKey приложение</span> <span class="hljs-operator">=</span> <span class="hljs-keyword">new</span> <span class="hljs-title class_">api</span>(
    name: <span class="hljs-string">"asd"</span>, <span class="hljs-comment">// App name</span>
    ownerid: <span class="hljs-string">"damGbE3ncn"</span>, <span class="hljs-comment">// Account ID</span>
    version: <span class="hljs-string">"1.0"</span> <span class="hljs-comment">// Application version. Used for automatic downloads see video here https://www.youtube.com/watch?v=kW195PLCBKs</span>
    <span class="hljs-comment">//path: @"Your_Path_Here" // (OPTIONAL) see tutorial here https://www.youtube.com/watch?v=I9rxt821gMk&amp;t=1s</span>
);</pre>
                            <br>
                            <button type="button" class="copy-button mt-3 inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200" data-copy-target="csharp-creds">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 2H10c-1.103 0-2 .897-2 2v4H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2v-4h4c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2ZM4 20V10h10l.002 10H4Zm16-6h-4v-4c0-1.103-.897-2-2-2h-4V4h10v10Z">
                                    </path>
                                    <path d="M6 12h6v2H6v-2Zm0 4h6v2H6v-2Z"></path>
                                </svg>

                                Copy Credentials</button>
                            <a href="https://github.com/KeyAuth/KeyAuth-CSHARP-Example" target="_blank" type="button" class="inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200">

                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m13 3 3.293 3.293-7 7 1.414 1.414 7-7L21 11V3h-8Z"></path>
                                    <path d="M19 19H5V5h7l-2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-5l-2-2v7Z">
                                    </path>
                                </svg>

                                View
                                C# Example</a>
                            <a href="https://github.com/KeyAuth/KeyAuth-Unity-Example" target="_blank" type="button" class="inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200">

                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m13 3 3.293 3.293-7 7 1.414 1.414 7-7L21 11V3h-8Z"></path>
                                    <path d="M19 19H5V5h7l-2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-5l-2-2v7Z">
                                    </path>
                                </svg>

                                View
                                Unity Example</a>

                            <a href="https://youtu.be/5x4YkTmFH-U?si=K9Jlm81ZvRvolGEI" target="_blank" type="button" class="inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200">

                                <svg class="w-5 h-5 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21.593 7.203a2.506 2.506 0 0 0-1.762-1.766C18.265 5.007 12 5 12 5s-6.264-.007-7.831.404a2.56 2.56 0 0 0-1.766 1.778c-.413 1.566-.417 4.814-.417 4.814s-.004 3.264.406 4.814c.23.857.905 1.534 1.763 1.765 1.582.43 7.83.437 7.83.437s6.265.007 7.831-.403a2.515 2.515 0 0 0 1.767-1.763c.414-1.565.417-4.812.417-4.812s.02-3.265-.407-4.831zM9.996 15.005l.005-6 5.207 3.005-5.212 2.995z"></path></svg>

                                View
                                Tutorial Video</a>
                        </div>
                        <div class="p-4 rounded-lg bg-[#09090d] hidden" id="cplusplus" role="tabpanel" aria-labelledby="cplusplus-tab">
                            <pre id="cpp-creds" class="copy-target text-gray-400 bg-[#09090d] overflow-x-auto hljs language-cpp">std::string name = <span class="hljs-built_in">skCrypt</span>(<span class="hljs-string">"asd"</span>).<span class="hljs-built_in">decrypt</span>(); <span class="hljs-comment">// App name</span>
std::string ownerid = <span class="hljs-built_in">skCrypt</span>(<span class="hljs-string">"damGbE3ncn"</span>).<span class="hljs-built_in">decrypt</span>(); <span class="hljs-comment">// Account ID</span>
std::string secret = <span class="hljs-built_in">skCrypt</span>(<span class="hljs-string">"cc68e6a57da45d65be16f05241cacfa547777df180db1a741fbcb20e627578a7"</span>).<span class="hljs-built_in">decrypt</span>(); <span class="hljs-comment">// Application secret (not used in latest C++ example)</span>
std::string version = <span class="hljs-built_in">skCrypt</span>(<span class="hljs-string">"1.0"</span>).<span class="hljs-built_in">decrypt</span>(); <span class="hljs-comment">// Application version. Used for automatic downloads see video here https://www.youtube.com/watch?v=kW195PLCBKs</span>
std::string url = <span class="hljs-built_in">skCrypt</span>(<span class="hljs-string">"https://keyauth.win/api/1.3/"</span>).<span class="hljs-built_in">decrypt</span>(); <span class="hljs-comment">// change if using KeyAuth custom domains feature</span>
std::string path = <span class="hljs-built_in">skCrypt</span>(<span class="hljs-string">""</span>).<span class="hljs-built_in">decrypt</span>(); <span class="hljs-comment">// (OPTIONAL) see tutorial here https://www.youtube.com/watch?v=I9rxt821gMk&amp;t=1s</span>
</pre>
                            <br>
                            <button type="button" class="copy-button mt-3 inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200" data-copy-target="cpp-creds">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 2H10c-1.103 0-2 .897-2 2v4H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2v-4h4c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2ZM4 20V10h10l.002 10H4Zm16-6h-4v-4c0-1.103-.897-2-2-2h-4V4h10v10Z">
                                    </path>
                                    <path d="M6 12h6v2H6v-2Zm0 4h6v2H6v-2Z"></path>
                                </svg>

                                Copy Credentials</button>
                            <a href="https://github.com/KeyAuth/KeyAuth-CPP-Example" target="_blank" type="button" class="inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200">

                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m13 3 3.293 3.293-7 7 1.414 1.414 7-7L21 11V3h-8Z"></path>
                                    <path d="M19 19H5V5h7l-2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-5l-2-2v7Z">
                                    </path>
                                </svg>

                                View
                                C++ Example</a>

                            <a href="https://youtu.be/GEXpZo3sce0?si=-stUWCHlPVKFK42o" target="_blank" type="button" class="inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200">

                                <svg class="w-5 h-5 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21.593 7.203a2.506 2.506 0 0 0-1.762-1.766C18.265 5.007 12 5 12 5s-6.264-.007-7.831.404a2.56 2.56 0 0 0-1.766 1.778c-.413 1.566-.417 4.814-.417 4.814s-.004 3.264.406 4.814c.23.857.905 1.534 1.763 1.765 1.582.43 7.83.437 7.83.437s6.265.007 7.831-.403a2.515 2.515 0 0 0 1.767-1.763c.414-1.565.417-4.812.417-4.812s.02-3.265-.407-4.831zM9.996 15.005l.005-6 5.207 3.005-5.212 2.995z"></path></svg>

                                View
                                Tutorial Video</a>
                        </div>
                        <div class="p-4 rounded-lg bg-[#09090d] hidden" id="python" role="tabpanel" aria-labelledby="python-tab">
                            <pre id="py-creds" class="copy-target text-gray-400 bg-[#09090d] overflow-x-auto hljs language-perl">keyauthapp = api(
    name = <span class="hljs-string">"asd"</span>, <span class="hljs-comment"># App name </span>
    ownerid = <span class="hljs-string">"damGbE3ncn"</span>, <span class="hljs-comment"># Account ID</span>
    version = <span class="hljs-string">"1.0"</span>, <span class="hljs-comment"># Application version. Used for automatic downloads see video here https://www.youtube.com/watch?v=kW195PLCBKs</span>
    hash_to_check = getchecksum()
)</pre>
                            <br>
                            <button type="button" class="copy-button mt-3 inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200" data-copy-target="py-creds">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 2H10c-1.103 0-2 .897-2 2v4H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2v-4h4c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2ZM4 20V10h10l.002 10H4Zm16-6h-4v-4c0-1.103-.897-2-2-2h-4V4h10v10Z">
                                    </path>
                                    <path d="M6 12h6v2H6v-2Zm0 4h6v2H6v-2Z"></path>
                                </svg>

                                Copy Credentials</button>
                            <a href="https://github.com/KeyAuth/KeyAuth-Python-Example" target="_blank" type="button" class="inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200">

                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m13 3 3.293 3.293-7 7 1.414 1.414 7-7L21 11V3h-8Z"></path>
                                    <path d="M19 19H5V5h7l-2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-5l-2-2v7Z">
                                    </path>
                                </svg>

                                View
                                Py Example</a>
                        </div>
                        <div class="p-4 rounded-lg bg-[#09090d] hidden" id="php" role="tabpanel" aria-labelledby="php-tab">
                            <pre id="php-creds" class="copy-target text-gray-400 bg-[#09090d] overflow-x-auto hljs language-perl">$name = <span class="hljs-string">"asd"</span>; <span class="hljs-regexp">//</span> App name 
$ownerid = <span class="hljs-string">"damGbE3ncn"</span>; <span class="hljs-regexp">//</span> Account ID </pre> 
                            <br>
                            <button type="button" class="copy-button mt-3 inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200" data-copy-target="php-creds">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 2H10c-1.103 0-2 .897-2 2v4H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2v-4h4c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2ZM4 20V10h10l.002 10H4Zm16-6h-4v-4c0-1.103-.897-2-2-2h-4V4h10v10Z">
                                    </path>
                                    <path d="M6 12h6v2H6v-2Zm0 4h6v2H6v-2Z"></path>
                                </svg>

                                Copy Credentials</button>
                            <a href="https://github.com/KeyAuth/KeyAuth-PHP-Example" target="_blank" type="button" class="inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200">

                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m13 3 3.293 3.293-7 7 1.414 1.414 7-7L21 11V3h-8Z"></path>
                                    <path d="M19 19H5V5h7l-2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-5l-2-2v7Z">
                                    </path>
                                </svg>

                                View
                                PHP Example</a>
                        </div>
                        <div class="p-4 rounded-lg bg-[#09090d] hidden" id="js" role="tabpanel" aria-labelledby="js-tab">
                            <pre id="js-creds" class="copy-target text-gray-400 bg-[#09090d] overflow-x-auto hljs language-cpp"><span class="hljs-type">const</span> KeyAuthApp = <span class="hljs-keyword">new</span> <span class="hljs-built_in">KeyAuth</span>(
    <span class="hljs-string">"asd"</span>, <span class="hljs-comment">// App name </span>
    <span class="hljs-string">"damGbE3ncn"</span>, <span class="hljs-comment">// Account ID</span>
    <span class="hljs-string">"cc68e6a57da45d65be16f05241cacfa547777df180db1a741fbcb20e627578a7"</span>, <span class="hljs-comment">// Encryption key, keep hidden and protect this string in your code!</span>
    <span class="hljs-string">"1.0"</span>, <span class="hljs-comment">// Application version. Used for automatic downloads see video here https://www.youtube.com/watch?v=kW195PLCBKs</span>
);</pre>
                            <br>
                            <button type="button" class="copy-button mt-3 inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200" data-copy-target="js-creds">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 2H10c-1.103 0-2 .897-2 2v4H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2v-4h4c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2ZM4 20V10h10l.002 10H4Zm16-6h-4v-4c0-1.103-.897-2-2-2h-4V4h10v10Z">
                                    </path>
                                    <path d="M6 12h6v2H6v-2Zm0 4h6v2H6v-2Z"></path>
                                </svg>

                                Copy Credentials</button>
                            <a href="https://github.com/mazkdevf/KeyAuth-JS-Example" target="_blank" type="button" class="inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200">

                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m13 3 3.293 3.293-7 7 1.414 1.414 7-7L21 11V3h-8Z"></path>
                                    <path d="M19 19H5V5h7l-2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-5l-2-2v7Z">
                                    </path>
                                </svg>

                                View
                                JS Example</a>
                        </div>
                        <div class="p-4 rounded-lg bg-[#09090d] hidden" id="j" role="tabpanel" aria-labelledby="j-tab">
                            <pre id="j-creds" class="copy-target text-gray-400 bg-[#09090d] overflow-x-auto hljs language-java"><span class="hljs-keyword">private</span> <span class="hljs-keyword">static</span> <span class="hljs-type">String</span> <span class="hljs-variable">ownerid</span> <span class="hljs-operator">=</span> <span class="hljs-string">"damGbE3ncn"</span>, <span class="hljs-comment">// Account ID</span>
<span class="hljs-keyword">private</span> <span class="hljs-keyword">static</span> <span class="hljs-type">String</span> <span class="hljs-variable">appname</span> <span class="hljs-operator">=</span> <span class="hljs-string">"asd"</span>, <span class="hljs-comment">// App name</span>
<span class="hljs-keyword">private</span> <span class="hljs-keyword">static</span> <span class="hljs-type">String</span> <span class="hljs-variable">version</span> <span class="hljs-operator">=</span> <span class="hljs-string">"1.0"</span> <span class="hljs-comment">// Application version. Used for automatic downloads see video here https://www.youtube.com/watch?v=kW195PLCBKs</span></pre>
                            <br>
                            <button type="button" class="copy-button mt-3 inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200" data-copy-target="j-creds">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 2H10c-1.103 0-2 .897-2 2v4H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2v-4h4c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2ZM4 20V10h10l.002 10H4Zm16-6h-4v-4c0-1.103-.897-2-2-2h-4V4h10v10Z">
                                    </path>
                                    <path d="M6 12h6v2H6v-2Zm0 4h6v2H6v-2Z"></path>
                                </svg>

                                Copy Credentials</button>
                            <a href="https://github.com/KeyAuth-Archive/KeyAuth-JAVA-api" target="_blank" type="button" class="inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200">

                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m13 3 3.293 3.293-7 7 1.414 1.414 7-7L21 11V3h-8Z"></path>
                                    <path d="M19 19H5V5h7l-2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-5l-2-2v7Z">
                                    </path>
                                </svg>

                                View
                                Java Example</a>
                        </div>
                        <div class="p-4 rounded-lg bg-[#09090d] hidden" id="vb" role="tabpanel" aria-labelledby="vb-tab">
                            <pre id="vb-creds" class="copy-target text-gray-400 bg-[#09090d] overflow-x-auto hljs language-vbnet"><span class="hljs-keyword">Private</span> <span class="hljs-keyword">Shared</span> name <span class="hljs-keyword">As</span> <span class="hljs-type">String</span> = <span class="hljs-string">"asd"</span> <span class="hljs-comment">' App name</span>
<span class="hljs-keyword">Private</span> <span class="hljs-keyword">Shared</span> ownerid <span class="hljs-keyword">As</span> <span class="hljs-type">String</span> = <span class="hljs-string">"damGbE3ncn"</span> <span class="hljs-comment">' Account ID</span>
<span class="hljs-keyword">Private</span> <span class="hljs-keyword">Shared</span> secret <span class="hljs-keyword">As</span> <span class="hljs-type">String</span> = <span class="hljs-string">"cc68e6a57da45d65be16f05241cacfa547777df180db1a741fbcb20e627578a7"</span> <span class="hljs-comment">' Encryption key, keep hidden and protect this string in your code!</span>
<span class="hljs-keyword">Private</span> <span class="hljs-keyword">Shared</span> version <span class="hljs-keyword">As</span> <span class="hljs-type">String</span> = <span class="hljs-string">"1.0"</span> <span class="hljs-comment">' Application version. Used for automatic downloads see video here https://www.youtube.com/watch?v=kW195PLCBKs</span></pre>
                            <br>
                            <button type="button" class="copy-button mt-3 inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200" data-copy-target="vb-creds">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 2H10c-1.103 0-2 .897-2 2v4H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2v-4h4c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2ZM4 20V10h10l.002 10H4Zm16-6h-4v-4c0-1.103-.897-2-2-2h-4V4h10v10Z">
                                    </path>
                                    <path d="M6 12h6v2H6v-2Zm0 4h6v2H6v-2Z"></path>
                                </svg>

                                Copy Credentials</button>
                            <a href="https://github.com/KeyAuth/KeyAuth-VB-Example" target="_blank" type="button" class="inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200">

                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m13 3 3.293 3.293-7 7 1.414 1.414 7-7L21 11V3h-8Z"></path>
                                    <path d="M19 19H5V5h7l-2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-5l-2-2v7Z">
                                    </path>
                                </svg>

                                View
                                VB Example</a>
                        </div>
                        <div class="p-4 rounded-lg bg-[#09090d] hidden" id="rust" role="tabpanel" aria-labelledby="rust-tab">
                            <pre id="rust-creds" class="copy-target text-gray-400 bg-[#09090d] overflow-x-auto hljs language-rust"><span class="hljs-keyword">let</span> <span class="hljs-keyword">mut </span><span class="hljs-variable">keyauthapp</span> = keyauth::v1_2::KeyauthApi::<span class="hljs-title function_ invoke__">new</span>(
    <span class="hljs-string">"asd"</span>, <span class="hljs-comment">// App name</span>
    <span class="hljs-string">"damGbE3ncn"</span>, <span class="hljs-comment">// Account ID</span>
    <span class="hljs-string">"cc68e6a57da45d65be16f05241cacfa547777df180db1a741fbcb20e627578a7"</span>,  <span class="hljs-comment">// Encryption key, keep hidden and protect this string in your code!</span>
    <span class="hljs-string">"1.0"</span>, <span class="hljs-comment">// Application version. Used for automatic downloads see video here https://www.youtube.com/watch?v=kW195PLCBKs</span>
    <span class="hljs-string">"https://keyauth.win/api/1.2/"</span>, <span class="hljs-comment">// This is the API URL, change this to your custom domain if you have it enabled</span>
);</pre>
                            <br>
                            <button type="button" class="copy-button mt-3 inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200" data-copy-target="rust-creds">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 2H10c-1.103 0-2 .897-2 2v4H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2v-4h4c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2ZM4 20V10h10l.002 10H4Zm16-6h-4v-4c0-1.103-.897-2-2-2h-4V4h10v10Z">
                                    </path>
                                    <path d="M6 12h6v2H6v-2Zm0 4h6v2H6v-2Z"></path>
                                </svg>

                                Copy Credentials</button>
                            <a href="https://github.com/KeyAuth/KeyAuth-Rust-Example" target="_blank" type="button" class="inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200">

                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m13 3 3.293 3.293-7 7 1.414 1.414 7-7L21 11V3h-8Z"></path>
                                    <path d="M19 19H5V5h7l-2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-5l-2-2v7Z">
                                    </path>
                                </svg>

                                View
                                Rust Example</a>
                        </div>
                        <div class="p-4 rounded-lg bg-[#09090d] hidden" id="go" role="tabpanel" aria-labelledby="go-tab">
                            <pre id="go-creds" class="copy-target text-gray-400 bg-[#09090d] overflow-x-auto hljs language-cpp">KeyAuthApp.<span class="hljs-built_in">Api</span>(
    <span class="hljs-string">"asd"</span>, <span class="hljs-comment">// App name</span>
    <span class="hljs-string">"damGbE3ncn"</span>, <span class="hljs-comment">// Account ID</span>
    <span class="hljs-string">"cc68e6a57da45d65be16f05241cacfa547777df180db1a741fbcb20e627578a7"</span>,  <span class="hljs-comment">// Encryption key, keep hidden and protect this string in your code!</span>
    <span class="hljs-string">"1.0"</span>, <span class="hljs-comment">// Application version. Used for automatic downloads see video here https://www.youtube.com/watch?v=kW195PLCBKs</span>
    <span class="hljs-string">"null"</span>, <span class="hljs-comment">// Token Path (PUT "null" IF YOU DO NOT WANT TO USE THE TOKEN VALIDATION SYSTEM! MUST DISABLE VIA APP SETTINGS)</span>
)
</pre>
                            <br>
                            <button type="button" class="copy-button mt-3 inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200" data-copy-target="go-creds">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 2H10c-1.103 0-2 .897-2 2v4H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2v-4h4c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2ZM4 20V10h10l.002 10H4Zm16-6h-4v-4c0-1.103-.897-2-2-2h-4V4h10v10Z">
                                    </path>
                                    <path d="M6 12h6v2H6v-2Zm0 4h6v2H6v-2Z"></path>
                                </svg>

                                Copy Credentials</button>
                            <a href="https://github.com/KeyAuth/KeyAuth-Go-Example" target="_blank" type="button" class="inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200">

                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m13 3 3.293 3.293-7 7 1.414 1.414 7-7L21 11V3h-8Z"></path>
                                    <path d="M19 19H5V5h7l-2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-5l-2-2v7Z">
                                    </path>
                                </svg>

                                View
                                Go Example</a>
                        </div>
                        <div class="p-4 rounded-lg bg-[#09090d] hidden" id="lua" role="tabpanel" aria-labelledby="lua-tab">
                            <pre id="lua-creds" class="copy-target text-gray-400 bg-[#09090d] overflow-x-auto hljs language-lua"><span class="hljs-keyword">local</span> name = <span class="hljs-string">"asd"</span>; <span class="hljs-comment">-- App name</span>
<span class="hljs-keyword">local</span> ownerid = <span class="hljs-string">"damGbE3ncn"</span>; <span class="hljs-comment">-- Account ID</span>
<span class="hljs-keyword">local</span> version = <span class="hljs-string">"1.0"</span>; <span class="hljs-comment">-- Application version. Used for automatic downloads see video here https://www.youtube.com/watch?v=kW195PLCBKs</span></pre>
                            <br>
                            <button type="button" class="copy-button mt-3 inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200" data-copy-target="lua-creds">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 2H10c-1.103 0-2 .897-2 2v4H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2v-4h4c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2ZM4 20V10h10l.002 10H4Zm16-6h-4v-4c0-1.103-.897-2-2-2h-4V4h10v10Z">
                                    </path>
                                    <path d="M6 12h6v2H6v-2Zm0 4h6v2H6v-2Z"></path>
                                </svg>

                                Copy Credentials</button>
                            <a href="https://github.com/mazkdevf/KeyAuth-Lua-Examples" target="_blank" type="button" class="inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200">

                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m13 3 3.293 3.293-7 7 1.414 1.414 7-7L21 11V3h-8Z"></path>
                                    <path d="M19 19H5V5h7l-2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-5l-2-2v7Z">
                                    </path>
                                </svg>

                                View
                                Lua Example</a>
                        </div>
                        <div class="p-4 rounded-lg bg-[#09090d] hidden" id="ruby" role="tabpanel" aria-labelledby="ruby-tab">
                            <pre id="ruby-creds" class="copy-target text-gray-400 bg-[#09090d] overflow-x-auto hljs language-perl">KeyAuth.new.Api(
    <span class="hljs-string">"asd"</span>, <span class="hljs-comment"># App name</span>
    <span class="hljs-string">"damGbE3ncn"</span>, <span class="hljs-comment"># Account ID</span>
    <span class="hljs-string">"cc68e6a57da45d65be16f05241cacfa547777df180db1a741fbcb20e627578a7"</span>, <span class="hljs-comment"># Encryption key, keep hidden and protect this string in your code!</span>
    <span class="hljs-string">"1.0"</span> <span class="hljs-comment"># Application version. Used for automatic downloads see video here https://www.youtube.com/watch?v=kW195PLCBKs</span>
)</pre>
                            <br>
                            <button type="button" class="copy-button mt-3 inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200" data-copy-target="ruby-creds">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 2H10c-1.103 0-2 .897-2 2v4H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2v-4h4c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2ZM4 20V10h10l.002 10H4Zm16-6h-4v-4c0-1.103-.897-2-2-2h-4V4h10v10Z">
                                    </path>
                                    <path d="M6 12h6v2H6v-2Zm0 4h6v2H6v-2Z"></path>
                                </svg>

                                Copy Credentials</button>
                            <a href="https://github.com/mazkdevf/KeyAuth-Ruby-Example" target="_blank" type="button" class="inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200">

                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m13 3 3.293 3.293-7 7 1.414 1.414 7-7L21 11V3h-8Z"></path>
                                    <path d="M19 19H5V5h7l-2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-5l-2-2v7Z">
                                    </path>
                                </svg>

                                View
                                Ruby Example</a>
                        </div>
                        <div class="p-4 rounded-lg bg-[#09090d] hidden" id="perl" role="tabpanel" aria-labelledby="perl-tab">
                            
                            <pre id="perl-creds" class="copy-target text-gray-400 bg-[#09090d] overflow-x-auto hljs language-ruby"><span class="hljs-title class_">KeyAuth</span><span class="hljs-symbol">:</span><span class="hljs-symbol">:Api</span>(
                            <span class="hljs-string">"asd"</span>, <span class="hljs-comment"># App name</span>
                            <span class="hljs-string">"damGbE3ncn"</span>, <span class="hljs-comment"># Account ID</span>
                            <span class="hljs-string">"cc68e6a57da45d65be16f05241cacfa547777df180db1a741fbcb20e627578a7"</span>, <span class="hljs-comment"># Encryption key, keep hidden and protect this string in your code!</span>
                            <span class="hljs-string">"1.0"</span> <span class="hljs-comment"># Application version. Used for automatic downloads see video here https://www.youtube.com/watch?v=kW195PLCBKs</span>
                        );</pre>
                            <br>
                            <button type="button" class="copy-button mt-3 inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200" data-copy-target="perl-creds">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 2H10c-1.103 0-2 .897-2 2v4H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2v-4h4c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2ZM4 20V10h10l.002 10H4Zm16-6h-4v-4c0-1.103-.897-2-2-2h-4V4h10v10Z">
                                    </path>
                                    <path d="M6 12h6v2H6v-2Zm0 4h6v2H6v-2Z"></path>
                                </svg>

                                Copy Credentials</button>
                            <a href="https://github.com/mazkdevf/KeyAuth-Perl-Example" target="_blank" type="button" class="inline-flex text-white bg-[#0f0f17] hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-200">

                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m13 3 3.293 3.293-7 7 1.414 1.414 7-7L21 11V3h-8Z"></path>
                                    <path d="M19 19H5V5h7l-2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-5l-2-2v7Z">
                                    </path>
                                </svg>

                                View
                                Perl Example</a>
                        </div>
                    </div>
                    
                    <div class="mt-3 gap-1.5 grid grid-cols-1 sm:grid-cols-2 md:block md:grid-cols-0">
                            
                            <button class="inline-flex text-white bg-blue-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 transition duration-200" data-modal-toggle="create-app-modal" data-modal-target="create-app-modal">
                            <i class="ri-add-circle-line mr-2"></i>
                            Создать приложение
                            </button>

                            <button class="inline-flex text-white bg-purple-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 transition duration-200" data-modal-toggle="rename-app-modal" data-modal-target="rename-app-modal">
                            <i class="ri-edit-line"></i>
                            Переименовать приложение
                            </button>

                                                <button class="inline-flex text-white bg-orange-500 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 transition duration-200" data-modal-toggle="pause-app-modal" data-modal-target="pause-app-modal"> 
                            <i class="ri-pause-line mr-2"></i>
                            Приостановить приложение &amp; Пользователей
                        </button>
                        
                        <button class="inline-flex text-white bg-green-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 transition duration-200" data-modal-toggle="refresh-app-modal" data-modal-target="refresh-app-modal"> 
                            <i class="ri-refresh-line mr-2"></i>
                            Сбросить секрет ключ приложения
                        </button>

                        <button class="inline-flex text-white bg-red-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 transition duration-200" data-modal-toggle="delete-app-modal" data-modal-target="delete-app-modal">
                            <i class="ri-delete-bin-2-line mr-2"></i>
                            Удалить приложение
                        </button>
                        
                                            </div>
                </div>
            </div>
        </div>
            
            
            
            
            
        
        <!-- Create New App Modal -->
        <div id="create-app-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-[#0f0f17] rounded-lg border border-blue-700 shadow">
                    <div class="px-6 py-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-medium text-white-900">Создать новое приложение</h3>
                        <hr class="h-px mb-4 mt-4 bg-gray-700 border-0">
                        <form class="space-y-6" method="POST">
                            <div>
                                <div class="relative">
                                    <input type="text" id="appname" name="appname" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-white bg-transparent rounded-lg border-1 border-gray-700 appearance-none focus:ring-0 peer" placeholder=" " autocomplete="on" required="" value="">
                                    <label for="appname" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-[#0f0f17] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Application
                                        name</label>
                                </div>
                            </div>
                            <button type="submit" name="create_app" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create
                                App</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Create A App Modal -->

        <!-- Rename App Modal -->
        <div id="rename-app-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-[#0f0f17] border border-purple-700 rounded-lg shadow">
                    <div class="px-6 py-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-medium text-white-900">Rename Application</h3>
                        <form class="space-y-6" method="POST">
                            <div class="relative mb-4">
                                <input type="text" id="appname" name="appname" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-white bg-transparent rounded-lg border-1 border-gray-700 appearance-none focus:ring-0 peer focus:border-purple-700" placeholder=" " autocomplete="on" required="" value="">
                                <label for="appname" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-[#0f0f17] px-2 peer-focus:px-2 peer-focus:text-purple-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">New
                                    Application
                                    Name</label>
                            </div>
                            <button type="submit" name="rename_app" class="w-full text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Rename
                                Application</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Rename App Modal -->

        <!-- Pause App and Users Modal -->
        <div id="pause-app-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-[#0f0f17] border border-yellow-700  rounded-lg shadow">
                    <div class="p-6 text-center">
                        <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-[#0f0f17]" role="alert">
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium text-white">Notice! Pausing your app and users will make your
                                    application
                                    unuseable until you unpause it.</span>
                            </div>
                        </div>
                        <h3 class="mb-5 text-lg font-normal text-gray-200">Are you sure
                            you want
                            to
                            pause your application and users?</h3>
                        <form method="POST">
                            <button data-modal-hide="pause-app-modal" name="pauseapp" class="text-white bg-yellow-600 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Yes, I'm sure
                            </button>
                            <button data-modal-hide="pause-app-modal" type="button" class="inline-flex text-white bg-gray-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-200">No,
                                cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Pause App and Users Modal -->

        <!-- Unpause App and Users Modal -->
        <div id="unpause-app-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-[#0f0f17] border border-yellow-700  rounded-lg shadow">
                    <div class="p-6 text-center">
                        <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-[#0f0f17]" role="alert">
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium text-white">Notice! You're about to unpause your application.
                                    Making it
                                    accesible to all users.</span>
                            </div>
                        </div>
                        <h3 class="mb-5 text-lg font-normal text-gray-200">Are you sure
                            you want
                            to
                            unpause your application and users?</h3>
                        <form method="POST">
                            <button data-modal-target="unpause-app-modal" data-modal-hide="unpause-app-modal" name="unpauseapp" class="text-white bg-yellow-600 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Yes, I'm sure
                            </button>
                            <button data-modal-target="unpause-app-modal" data-modal-hide="unpause-app-modal" type="button" class="inline-flex text-white bg-gray-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-200">No,
                                cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="refresh-app-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-[#0f0f17] border border-green-700 rounded-lg shadow">
                    <div class="p-6 text-center">
                        <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-[#0f0f17]" role="alert">
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium text-white">Notice! Make sure you change your application
                                    secret in
                                    your
                                    program after refreshing.</span>
                            </div>
                        </div>
                        <h3 class="mb-5 text-lg font-normal text-gray-200">Are you sure
                            you want
                            to
                            refresh your application secret?</h3>
                        <form method="POST">
                            <button data-modal-hide="refresh-app-modal" name="refreshapp" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Yes, I'm sure
                            </button>
                            <button data-modal-hide="refresh-app-modal" type="button" class="inline-flex text-white bg-gray-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-200">No,
                                cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="delete-app-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-[#0f0f17] border border-red-700 rounded-lg shadow">
                    <div class="p-6 text-center">
                        <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-700 rounded-lg bg-[#0f0f17]" role="alert">
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium text-red-400">Notice! You're about to delete your application.
                                    <b>This
                                        can
                                        NOT be undone</b></span>
                            </div>
                        </div>
                        <h3 class="mb-5 text-lg font-normal text-gray-200">Please enter "Confirm Deletion" to delete
                            app: </h3>
                        <form method="POST">
                            <div>
                                <div class="relative mb-4">
                                    <input type="text" id="confirmappname" name="confirmappname" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-white bg-transparent rounded-lg border-1 border-gray-700 appearance-none focus:ring-0  peer focus:border-red-700" placeholder="Confirm Deletion" autocomplete="on" required="" value="">
                                    <label for="confirmappname" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-[#0f0f17] px-2 peer-focus:px-2 peer-focus:text-red-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Type - Confirm Deletion</label>
                                </div>
                            </div>
                            <button data-modal-hide="delete-app-modal" name="deleteapp" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Yes, I'm sure
                            </button>
                            <button data-modal-hide="delete-app-modal" type="button" class="inline-flex text-white bg-gray-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-200">No,
                                cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div></div></main>
    </div>
</div>
<link href="lineicons.css" rel="stylesheet">