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
        $userId = $userData['ownerid'];
        $userRole = htmlspecialchars($userData['role'], ENT_QUOTES, 'UTF-8');
    } else {
        die("Пользователь не найден в базе данных");
    }
} catch (PDOException $e) {
    die("Ошибка получения данных пользователя: " . $e->getMessage());
}

// Проверяем приложения при загрузке страницы
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

    <!-- Мобильное меню (скрыто по умолчанию) -->
    <div id="mobile-menu" class="hidden md:hidden bg-[#0f0f17] border-t border-[#09090d]">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="https://CloudAuthKey.online/" target="_blank" class="block px-3 py-2 text-white hover:opacity-60 hover:bg-[#09090d] rounded-md text-sm">
                <i class="ri-code-s-slash-line mr-2"></i>Документация
            </a>
            <a href="https://github.com/CloudAuthKey" target="_blank" class="block px-3 py-2 text-white hover:opacity-60 hover:bg-[#09090d] rounded-md text-sm">
                <i class="ri-github-fill mr-2"></i>Примеры приложений
            </a>
            <a href="https://youtube.com/CloudAuthKey" target="_blank" class="block px-3 py-2 text-white hover:opacity-60 hover:bg-[#09090d] rounded-md text-sm">
                <i class="ri-youtube-line mr-2"></i>Видео обзоры
            </a>
            <a href="https://t.me/CloudAuthKey" target="_blank" class="block px-3 py-2 text-white hover:opacity-60 hover:bg-[#09090d] rounded-md text-sm">
                <i class="ri-telegram-2-line mr-2"></i>Телеграм
            </a>
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
            <span class="sr-only">Выход</span>
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
            <a href="/panel/data-app/" class="flex items-center p-2 rounded-lg text-gray-300 hover:text-white group">
                <span class="ml-3">Приложения</span>
            </a>
    </li>
</ul>
<ul class="space-y-2 font-medium">
        <li>
            <a href="/panel/application/" class="flex items-center p-2 rounded-lg text-gray-300 hover:text-white group">
                <span class="ml-3">Данные приложения</span>
            </a>
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
        <span class="flex items-center p-2 rounded-lg text-purple-500 cursor-not-allowed opacity-50">
            <span class="ml-3">Ключи</span>
        </span>
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
<div class="p-4 bg-[#09090d] block sm:flex items-center justify-between lg:mt-1.5">
    <div class="mb-1 w-full bg-[#0f0f17] rounded-xl">
        <div class="mb-4 p-4">
            <nav class="flex mb-5" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2">
        <li class="inline-flex items-center">
            <a href="https://keyauth.win/app/?page=manage-apps" class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-white">
                <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"></path>
                </svg>
                Manage Apps
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <i class="lni lni-angle-double-right mr-2"></i>
                <label class="inline-flex items-center text-sm font-medium text-gray-400">Current App:
                    asd </label>
            </div>
        </li>
                        <i class="lni lni-angle-double-right mr-2"></i>
                <label class="inline-flex items-center text-sm font-medium text-red-600">
                    You don't have a subscription!                    <a href="https://keyauth.win/app/?page=upgrade" class="text-blue-600 hover:underline">
                        &nbsp;Upgrade Now.
                    </a>
                </label>
                </ol>
</nav>            <h1 lang="" class="text-xl font-semibold text-white-900 sm:text-2xl">Licenses</h1>
            <p class="text-xs text-gray-500">Licenses allow your users to register on your application.</p>
            <br>

            <div class="p-4 flex flex-col">
                <div class="overflow-x-auto">
                    <form method="POST">
                        <!-- Key Functions -->
                        <button type="button" class="inline-flex text-white bg-blue-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-200" data-modal-toggle="create-key-modal" data-modal-target="create-key-modal">
                            <i class="ri-add-circle-line mr-2"></i>Create Keys
                        </button>

                        <button type="button" class="inline-flex text-white bg-blue-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-200" data-modal-toggle="add-time-modal" data-modal-target="add-time-modal">
                            <i class="ri-time-line mr-2"></i>Add Time To Unused Keys
                        </button>
                        
                        <button name="dlkeys" class="inline-flex text-white bg-blue-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-200">
                            <i class="ri-download-line mr-2"></i>Export Keys
                        </button>
                    </form>
                    <!-- End Key Functions -->

                    <!-- Delete Key Functions -->
                    <button class="inline-flex text-white bg-red-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-200" data-modal-toggle="delete-all-keys-modal" data-modal-target="delete-all-keys-modal">
                        <i class="ri-delete-bin-2-line mr-2"></i>Delete All Keys
                    </button>
                    <button class="inline-flex text-white bg-red-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-200" data-modal-toggle="delete-all-used-keys-modal" data-modal-target="delete-all-used-keys-modal">
                        <i class="ri-delete-bin-2-line mr-2"></i>Delete All Used Keys
                    </button>
                    <button class="inline-flex text-white bg-red-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-200" data-modal-toggle="delete-all-unused-keys-modal" data-modal-target="delete-all-unused-keys-modal">
                        <i class="ri-delete-bin-2-line mr-2"></i>Delete All Unused Keys
                    </button>

                    <button id="dropdownselection" data-dropdown-toggle="licenseSelecteddropdown" class="inline-flex text-white bg-red-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-200 hidden" type="button">
                        <i class="ri-cursor-line mr-2"></i>Selection Options
                    </button>

                    <div id="licenseSelecteddropdown" class="z-10 hidden bg-[#09090d] divide-y divide-gray-100 rounded-lg shadow w-44" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 10px);" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom">
                        <ul class="py-2 text-sm text-white">
                            <li>
                                <form method="post">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" id="selected" name="selected" value="">
                                    <a href="#" class="block px-4 py-2 focus:bold ml-2 hover:text-red-700">Delete selected</a>
                                </form>
                            </li>
                            <li>
                                <form method="post">
                                    <input type="hidden" name="action" value="banKeyMulti">
                                    <input type="hidden" id="selected" name="selected" value="">
                                    <a href="#" class="block px-4 py-2 focus:bold ml-2 hover:text-red-700">Ban selected</a>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <!-- End Delete Key Functions -->

                    
                    <!-- Create Key Modal -->
                    <div id="create-key-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center">
                        <div class="relative w-full max-w-md max-h-full">
                                                        <!-- Modal content -->
                            <div class="relative bg-[#0f0f17] rounded-lg border border-[#1d4ed8] shadow">
                                <div class="px-6 py-6 lg:px-8">
                                    <h3 class="text-xl font-medium text-white-900">Create A New Key</h3>
                                    <hr class="h-px mb-4 mt-4 bg-gray-700 border-0">
                                    <form class="space-y-6" method="POST">
                                        <div>
                                            <div class="relative mb-4">
                                                <input type="text" inputmode="numeric" min="1" max="100" id="amount" name="amount" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-white bg-transparent rounded-lg border-1 border-gray-700 appearance-none focus:ring-0  peer" placeholder=" " autocomplete="on" value="" required="" data-popover-target="amount-popover">
                                                <label for="amount" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-[#0f0f17] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">License
                                                    Amount</label>

                                                <div data-popover="" id="amount-popover" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-[#09090d] rounded-lg shadow-sm opacity-0" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 10px);" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom">
            <div class="px-3 py-2 bg-[#09090d]/70 rounded-t-lg">
                <h3 class="font-semibold text-white">License Amount</h3>
            </div>
            <div class="px-3 py-2">
                <p>The amount of licenses you would like to create.</p>
            </div>
            <div data-popper-arrow="" style="position: absolute; left: 0px; transform: translate(0px, 0px);"></div>
        </div>                                            </div>

                                            <div class="relative mb-4">
                                                <input type="text" maxlength="49" id="mask" name="mask" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-white bg-transparent rounded-lg border-1 border-gray-700 appearance-none focus:ring-0  peer" placeholder="*****-*****-*****-*****" autocomplete="on" value="******-******-******-******-******-******" required="" data-popover-target="mask-popover">
                                                <label for="mask" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-[#0f0f17] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">License
                                                    Mask</label>

                                                <div data-popover="" id="mask-popover" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-[#09090d] rounded-lg shadow-sm opacity-0" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 10px);" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom">
            <div class="px-3 py-2 bg-[#09090d]/70 rounded-t-lg">
                <h3 class="font-semibold text-white">License Mask</h3>
            </div>
            <div class="px-3 py-2">
                <p>The format of the license. You can use * to generate random characters.</p>
            </div>
            <div data-popper-arrow="" style="position: absolute; left: 0px; transform: translate(0px, 0px);"></div>
        </div>                                            </div>

                                            <div class="flex items-center justify-between mb-4">
                                                <div class="flex items-center">
                                                    <input id="lowercaseLetters" name="lowercaseLetters" type="checkbox" class="w-4 h-4 text-blue-600 bg-[#0f0f17] border-gray-300 rounded focus:ring-blue-500 focus:ring-2" checked="" data-popover-target="lowercase-popover">
                                                    <label for="lowercaseLetters" class="ml-2 text-sm font-medium text-white-900">
                                                        Lowercase Letters</label>
                                                    <div data-popover="" id="lowercase-popover" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-[#09090d] rounded-lg shadow-sm opacity-0" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 10px);" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom">
            <div class="px-3 py-2 bg-[#09090d]/70 rounded-t-lg">
                <h3 class="font-semibold text-white">Lowercase Letters</h3>
            </div>
            <div class="px-3 py-2">
                <p>Include lowercase letters in your license.</p>
            </div>
            <div data-popper-arrow="" style="position: absolute; left: 0px; transform: translate(0px, 0px);"></div>
        </div>                                                </div>
                                                <div class="flex items-center">
                                                    <input id="capitalLetters" name="capitalLetters" type="checkbox" class="w-4 h-4 text-blue-600 bg-[#0f0f17] border-gray-300 rounded focus:ring-blue-500 focus:ring-2" checked="" data-popover-target="capital-popover">
                                                    <label for="capitalLetters" class="ml-2 text-sm font-medium text-white-900">
                                                        Uppercase Letters</label>
                                                    <div data-popover="" id="capital-popover" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-[#09090d] rounded-lg shadow-sm opacity-0" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 10px);" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom">
            <div class="px-3 py-2 bg-[#09090d]/70 rounded-t-lg">
                <h3 class="font-semibold text-white">Capital Letters</h3>
            </div>
            <div class="px-3 py-2">
                <p>Include capital letters in your license.</p>
            </div>
            <div data-popper-arrow="" style="position: absolute; left: 0px; transform: translate(0px, 0px);"></div>
        </div>                                                </div>
                                            </div>


                                            <div class="relative mb-4 pt-2">
                                                <select id="level" name="level" class="bg-[#0f0f17] border border-gray-700 text-white-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" data-popover-target="level-popover">
                                                    
                                                    <option value="1" selected="">
                                                        1 (default)</option>
                                                                                                    </select>

                                                <div data-popover="" id="level-popover" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-[#09090d] rounded-lg shadow-sm opacity-0" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 10px);" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom">
            <div class="px-3 py-2 bg-[#09090d]/70 rounded-t-lg">
                <h3 class="font-semibold text-white">License Level</h3>
            </div>
            <div class="px-3 py-2">
                <p>The level/subscription you would like to assign to your license(s).</p>
            </div>
            <div data-popper-arrow="" style="position: absolute; left: 0px; transform: translate(0px, 0px);"></div>
        </div>                                            </div>

                                            <div class="relative mb-4">
                                                <input type="text" maxlength="69" id="note" name="note" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-white bg-transparent rounded-lg border-1 border-gray-700 appearance-none focus:ring-0  peer" placeholder=" " autocomplete="on" value="" data-popover-target="note-popover">
                                                <label for="note" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-[#0f0f17] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">License
                                                    Note</label>

                                                <div data-popover="" id="note-popover" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-[#09090d] rounded-lg shadow-sm opacity-0" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 10px);" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom">
            <div class="px-3 py-2 bg-[#09090d]/70 rounded-t-lg">
                <h3 class="font-semibold text-white">License Note</h3>
            </div>
            <div class="px-3 py-2">
                <p>A unique message for a license.</p>
            </div>
            <div data-popper-arrow="" style="position: absolute; left: 0px; transform: translate(0px, 0px);"></div>
        </div>                                            </div>

                                            <div class="relative mb-4">
                                                <select id="expiry" name="expiry" class="bg-[#0f0f17] border border-gray-700 text-white-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" data-popover-target="expiry-popover">
                                                    <option value="1" selected="">
                                                        Seconds
                                                    </option>
                                                    <option value="60">
                                                        Minutes
                                                    </option>
                                                    <option value="3600">
                                                        Hours
                                                    </option>
                                                    <option value="86400">
                                                        Days
                                                    </option>
                                                    <option value="604800">
                                                        Weeks
                                                    </option>
                                                    <option value="2629743">
                                                        Months
                                                    </option>
                                                    <option value="31556926">
                                                        Years
                                                    </option>
                                                    <option value="315569260">
                                                        Lifetime
                                                    </option>
                                                </select>
                                                <label for="expiry" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-[#0f0f17] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">License
                                                    Expiry Unit</label>

                                                <div data-popover="" id="expiry-popover" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-[#09090d] rounded-lg shadow-sm opacity-0" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 10px);" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom">
            <div class="px-3 py-2 bg-[#09090d]/70 rounded-t-lg">
                <h3 class="font-semibold text-white">License Expiry (unit)</h3>
            </div>
            <div class="px-3 py-2">
                <p>The unit the license will expire in.</p>
            </div>
            <div data-popper-arrow="" style="position: absolute; left: 0px; transform: translate(0px, 0px);"></div>
        </div>                                            </div>

                                            <div class="relative mb-4">
                                                <input type="text" inputmode="numeric" maxlength="4" id="duration" name="duration" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-white bg-transparent rounded-lg border-1 border-gray-700 appearance-none focus:ring-0  peer" placeholder=" " autocomplete="on" pattern="\d*" value="" required="" data-popover-target="duration-popover">
                                                <label for="duration" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-[#0f0f17] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">License
                                                    Duration</label>

                                                <div data-popover="" id="duration-popover" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-[#09090d] rounded-lg shadow-sm opacity-0" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 10px);" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom">
            <div class="px-3 py-2 bg-[#09090d]/70 rounded-t-lg">
                <h3 class="font-semibold text-white">License Expiry (duration)</h3>
            </div>
            <div class="px-3 py-2">
                <p>The duration the license will expire in. (Unit * Duration = Expiry)</p>
            </div>
            <div data-popper-arrow="" style="position: absolute; left: 0px; transform: translate(0px, 0px);"></div>
        </div>                                            </div>
                                        </div>
                                        <button type="submit" name="genkeys" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Generate
                                            Keys</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Create Key Modal -->

                    <!-- Add Time To Key Modal -->
                    <div id="add-time-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center">
                        <div class="relative w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-[#0f0f17] rounded-lg border border-[#1d4ed8] shadow">
                                <div class="px-6 py-6 lg:px-8">
                                    <h3 class="mb-4 text-xl font-medium text-white-900">Add Time To Unused Licenses</h3>
                                    <hr class="h-px mb-4 mt-4 bg-gray-700 border-0">
                                    <form class="space-y-6" method="POST">
                                        <div>

                                            <div class="relative mb-4  ">
                                                <select id="expiry" name="expiry" class="bg-[#0f0f17] border border-gray-700 text-white-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                    <option value="1" selected="">Seconds</option>
                                                    <option value="60">Minutes</option>
                                                    <option value="3600">Hours</option>
                                                    <option value="86400">Days</option>
                                                    <option value="604800">Weeks</option>
                                                    <option value="2629743">Months</option>
                                                    <option value="31556926">Years</option>
                                                    <option value="315569260">Lifetime</option>
                                                </select>
                                                <label for="expiry" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-[#0f0f17] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Unit
                                                    of Time To Add</label>
                                            </div>

                                            <div class="relative mb-4">
                                                <input type="text" inputmode="numeric" min="1" id="time" name="time" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-white bg-transparent rounded-lg border-1 border-gray-700 appearance-none focus:ring-0  peer" autocomplete="on" placeholder="" required="" value="">
                                                <label for="time" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-[#0f0f17] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Time
                                                    To Add</label>
                                            </div>

                                        </div>
                                        <button name="addtime" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add
                                            Time</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Add Time To Key Modal -->

                    <!-- Import Keys Modal -->
                    <div id="import-key-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-[#0f0f17] rounded-lg border border-[#1d4ed8] shadow">
                                <div class="px-6 py-6 lg:px-8">
                                    <h3 class="mb-4 text-xl font-medium text-white-900">Import Licenses .json</h3>
                                    <hr class="h-px mb-4 mt-4 bg-gray-700 border-0">
                                    <form class="space-y-6" method="POST" enctype="multipart/form-data">
                                        <div class="relative">
                                            <input class="block w-full text-sm text-gray-400 border border-gray-700 rounded-lg cursor-pointer focus:outline-none" id="file_input" name="file_input" type="file">
                                        </div>
                                        <button type="submit" name="importkeysFile" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Import
                                            Licenses</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Import Keys Modal -->

                    <!-- Delete All Keys Modal -->
                    <div id="delete-all-keys-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center">
                        <div class="relative w-full max-w-md max-h-full">
                            <div class="relative bg-[#0f0f17] border border-red-700 rounded-lg shadow">
                                <div class="p-6 text-center">
                                    <div class="flex items-center p-4 mb-4 text-sm text-white border border-yellow-500 rounded-lg bg-[#0f0f17]" role="alert">
                                        <span class="sr-only">Info</span>
                                        <div>
                                            <span class="font-medium">Notice!</span> This will not delete users (prevent
                                            them from logging in). Go to https://keyauth.cc/app/?page=users for that.
                                            
                                        </div>
                                    </div>
                                    <h3 class="mb-5 text-lg font-normal text-gray-200">Are you sure you want to delete
                                        all of your keys? This can not be undone.</h3>
                                    <form method="POST">
                                        <button data-modal-hide="delete-all-keys-modal" name="delkeys" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                            Yes, I'm sure
                                        </button>
                                        <button data-modal-hide="delete-all-keys-modal" type="button" class="inline-flex text-white bg-gray-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-200">No,
                                            cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Delete All Keys Modal -->

                    <!-- Delete All Used Keys Modal -->
                    <div id="delete-all-used-keys-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center">
                        <div class="relative w-full max-w-md max-h-full">
                            <div class="relative bg-[#0f0f17] border border-red-700 rounded-lg shadow">
                                <div class="p-6 text-center">
                                    <div class="flex items-center p-4 mb-4 text-sm text-white border border-yellow-500 rounded-lg bg-[#0f0f17]" role="alert">
                                        <span class="sr-only">Info</span>
                                        <div>
                                            <span class="font-medium">Notice!</span> This will not delete users (prevent
                                            them from logging in). Go to https://keyauth.cc/app/?page=users for that.
                                            
                                        </div>
                                    </div>
                                    <h3 class="mb-5 text-lg font-normal text-gray-200">Are you sure you want to delete
                                        all of your used keys? This can not be undone.</h3>
                                    <form method="POST">
                                        <button data-modal-hide="delete-all-used-keys-modal" name="deleteallused" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                            Yes, I'm sure
                                        </button>
                                        <button data-modal-hide="delete-all-used-keys-modal" type="button" class="inline-flex text-white bg-gray-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-200">No,
                                            cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Delete All Used Keys Modal -->

                    <!-- Delete All Unused Keys Modal -->
                    <div id="delete-all-unused-keys-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center">
                        <div class="relative w-full max-w-md max-h-full">
                            <div class="relative bg-[#0f0f17] border border-red-700 rounded-lg shadow">
                                <div class="p-6 text-center">
                                    <div class="flex items-center p-4 mb-4 text-sm text-white border border-yellow-500 rounded-lg bg-[#0f0f17]" role="alert">
                                        <span class="sr-only">Info</span>
                                        <div>
                                            <span class="font-medium">Notice!</span> This will not delete users (prevent
                                            them from logging in). Go to https://keyauth.cc/app/?page=users for that.
                                            
                                        </div>
                                    </div>
                                    <h3 class="mb-5 text-lg font-normal text-gray-200">Are you sure you want to delete
                                        all of your unused keys? This can not be undone.</h3>
                                    <form method="POST">
                                        <button data-modal-hide="delete-all-unused-keys-modal" name="deleteallunused" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                            Yes, I'm sure
                                        </button>
                                        <button data-modal-hide="delete-all-unused-keys-modal" type="button" class="inline-flex text-white bg-gray-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-200">No,
                                            cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Delete All Unused Keys Modal -->

                    <!-- Delete Key Modal -->
                    <div id="del-key" tabindex="-1" class="modal fixed inset-0 flex items-center justify-center z-50 hidden">
                        <div class="relative w-full max-w-md max-h-full">
                            <div class="relative bg-[#0f0f17] border border-red-700 rounded-lg shadow">
                                <div class="p-6 text-center">
                                    <div class="flex items-center p-4 mb-4 text-sm text-white border border-yellow-500 rounded-lg bg-[#0f0f17]" role="alert">
                                        <span class="sr-only">Info</span>
                                        <div>
                                            <span class="font-medium">Notice!</span> This will not delete the user
                                            (prevent them from logging in) unless you check Delete User Too
                                            
                                        </div>
                                    </div>
                                    <h3 class="mb-5 text-lg font-normal text-gray-200">Are you sure you want to delete
                                        this key? This can not be undone.</h3>
                                    <form method="POST">
                                        <div class="flex items-center mb-4">
                                            <input id="delUserToo" name="delUserToo" type="checkbox" class="w-4 h-4 text-blue-600 bg-[#0f0f17] border-gray-300 rounded focus:ring-blue-500 focus:ring-2" checked="">
                                            <label for="delUserToo" class="ml-2 text-sm font-medium text-white-900">Delete user too</label>
                                        </div>

                                        <button name="deletekey" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2 delkey">
                                            Yes, I'm sure
                                        </button>
                                        <button type="button" class="inline-flex text-white bg-gray-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-200">No,
                                            cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Delete Key Modal -->

                    <!-- Ban License Modal Actions-->
                    <div id="ban-key-modal" tabindex="-1" class="modal fixed inset-0 flex items-center justify-center z-50 hidden">
                        <div class="relative w-full max-w-md max-h-full">
                            <div class="relative bg-[#0f0f17] border border-red-700 rounded-lg shadow">
                                <div class="p-6 text-center">
                                    <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-700 rounded-lg bg-[#0f0f17]" role="alert">
                                        <span class="sr-only">Info</span>
                                        <div>
                                            <span class="font-medium text-red-400">Notice! This will not ban the user
                                                (prevent them from logging in) unless you check Ban User Too</span>
                                        </div>
                                    </div>
                                    <h3 class="mb-5 text-lg font-normal text-gray-200">Are you sure you want to ban this
                                        license?
                                        <form method="POST">
                                            <div class="relative mb-4 mt-2">
                                                <input type="text" id="reason" name="reason" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-white bg-transparent rounded-lg border-1 border-gray-700 appearance-none focus:ring-0 peer focus:border-red-700" placeholder=" " autocomplete="on" value="">
                                                <label for="reason" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-[#0f0f17] px-2 peer-focus:px-2 peer-focus:text-red-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                                    Reason</label>
                                            </div>
                                            <div class="flex items-center mb-4 pt-4">
                                                <input id="banUserToo" name="banUserToo" type="checkbox" class="w-4 h-4 text-blue-600 bg-[#0f0f17] border-gray-300 rounded focus:ring-blue-500 focus:ring-2" checked="">
                                                <label for="banUserToo" class="ml-2 text-sm font-medium text-white-900">Ban User
                                                    Too?</label>
                                            </div>
                                            <button name="bankey" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2 bankey">
                                                Yes, I'm sure
                                            </button>
                                            <button type="button" class="inline-flex text-white bg-gray-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-200">No,
                                                cancel</button>
                                        </form>
                                </h3></div>
                            </div>
                        </div>
                    </div>
                    <!-- End Ban License Modal Actions-->

                    <!-- START TABLE -->
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg pt-5">
                        <div id="kt_datatable_licenses_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-6 d-flex align-items-center justify-conten-start"><div class="dataTables_length" id="kt_datatable_licenses_length"><label>Show <select name="kt_datatable_licenses_length" aria-controls="kt_datatable_licenses" class="form-select form-select-sm form-select-solid"><option value="10" selected="">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></label></div></div><div class="col-sm-6 d-flex align-items-center justify-content-end"><div id="kt_datatable_licenses_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm form-control-solid" placeholder="" aria-controls="kt_datatable_licenses" value=""></label></div></div></div><div class="table-responsive"><table id="kt_datatable_licenses" class="w-full text-sm text-left text-white dataTable no-footer" aria-describedby="kt_datatable_licenses_info" style="width: 1572px;">
                            <thead>
                                <tr class="border-2 border-gray-200 text-blue-700 px-7"><th scope="col" class="px-6 py-3 sorting" tabindex="0" aria-controls="kt_datatable_licenses" rowspan="1" colspan="1" style="width: 97px;" aria-label="Select: activate to sort column ascending">Select</th><th scope="col" class="px-6 py-3 sorting sorting_desc" tabindex="0" aria-controls="kt_datatable_licenses" rowspan="1" colspan="1" style="width: 70px;" aria-sort="descending" aria-label="Key: activate to sort column ascending">Key</th><th scope="col" class="px-6 py-3 sorting" tabindex="0" aria-controls="kt_datatable_licenses" rowspan="1" colspan="1" style="width: 187px;" aria-label="Creation Date: activate to sort column ascending">Creation Date</th><th scope="col" class="px-6 py-3 sorting" tabindex="0" aria-controls="kt_datatable_licenses" rowspan="1" colspan="1" style="width: 184px;" aria-label="Generated By: activate to sort column ascending">Generated By</th><th scope="col" class="px-6 py-3 sorting" tabindex="0" aria-controls="kt_datatable_licenses" rowspan="1" colspan="1" style="width: 130px;" aria-label="Duration: activate to sort column ascending">Duration</th><th scope="col" class="px-6 py-3 sorting" tabindex="0" aria-controls="kt_datatable_licenses" rowspan="1" colspan="1" style="width: 85px;" aria-label="Note: activate to sort column ascending">Note</th><th scope="col" class="px-6 py-3 sorting" tabindex="0" aria-controls="kt_datatable_licenses" rowspan="1" colspan="1" style="width: 125px;" aria-label="Used On: activate to sort column ascending">Used On</th><th scope="col" class="px-6 py-3 sorting" tabindex="0" aria-controls="kt_datatable_licenses" rowspan="1" colspan="1" style="width: 121px;" aria-label="Used By: activate to sort column ascending">Used By</th><th scope="col" class="px-6 py-3 sorting" tabindex="0" aria-controls="kt_datatable_licenses" rowspan="1" colspan="1" style="width: 99px;" aria-label="Status: activate to sort column ascending">Status</th><th scope="col" class="px-6 py-3 sorting" tabindex="0" aria-controls="kt_datatable_licenses" rowspan="1" colspan="1" style="width: 114px;" aria-label="Actions: activate to sort column ascending">Actions</th></tr>
                            </thead><tbody><tr class="odd"><td valign="top" colspan="10" class="dataTables_empty">No data available in table</td></tr></tbody>
                        </table><div id="kt_datatable_licenses_processing" class="dataTables_processing" style="display: none;">Processing...</div></div><div class="row"><div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start"><div class="dataTables_info" id="kt_datatable_licenses_info" role="status" aria-live="polite" style="color: rgb(107, 114, 128);">Showing no records</div></div><div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end"><div class="dataTables_paginate paging_simple_numbers" id="kt_datatable_licenses_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="kt_datatable_licenses_previous"><a href="#" aria-controls="kt_datatable_licenses" data-dt-idx="0" tabindex="0" class="page-link"><i class="previous"></i></a></li><li class="paginate_button page-item next disabled" id="kt_datatable_licenses_next"><a href="#" aria-controls="kt_datatable_licenses" data-dt-idx="1" tabindex="0" class="page-link"><i class="next"></i></a></li></ul></div></div></div></div>
                    </div>
                    <p class="text-xs text-red-600">Dropdown actions in <b>RED</b> do not show a confirmation!<a class="text-blue-700"> Dropdown actions in <b>BLUE</b> will show a confirmation!</a></p>

                    
                    <!-- END TABLE -->

                </div>

                        </div></div></div></div></main>
    </div>
</div>
<link href="lineicons.css" rel="stylesheet">
