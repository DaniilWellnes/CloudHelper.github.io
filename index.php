<?php
$host = 'localhost';
$port = 3306;
$user = 'root';
$password = 'root';
$dbname = 'cloud'; // Укажите название вашей базы данных

// Подключение к базе данных
$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // SQL-запросы для получения количества строк в таблицах
    $accountsCreated = $pdo->query("SELECT COUNT(*) FROM `accounts`")->fetchColumn(); /*fetchColumn()+1;*/
    $createdApps = $pdo->query("SELECT COUNT(*) FROM `apps`")->fetchColumn();
    $licensesGenerated = $pdo->query("SELECT COUNT(*) FROM `keys`")->fetchColumn();
    $usersLoggedIn = $pdo->query("SELECT COUNT(*) FROM `accounts`")->fetchColumn();
        
} catch (PDOException $e) {
    $accountsCreated = "-";
    $createdApps = "-";
    $licensesGenerated = "-";
    $usersLoggedIn = "-";
}
?>

<!DOCTYPE html>
<html lang="ru" class="bg-[#09090d] text-white overflow-x-hidden" data-scrapbook-source="https://cloudauthkey.win/" data-scrapbook-create="20250228092141084" data-scrapbook-title="CloudAuthKey">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="CloudAuthKey">
    <meta content="Secure your software against piracy, an issue causing $422 million in losses annually - Fair pricing &amp; Features not seen in competitors" name="description">
    <meta content="CloudAuthKey" name="author">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="CloudAuthKey, Cloud Authentication, Key Authentication, Authentication, API authentication, Security, Encryption authentication, Authenticated encryption, Cybersecurity, Developer, SaaS, Software Licensing, Licensing">
    <meta property="og:description" content="Secure your software against piracy, an issue causing $422 million in losses annually - Fair pricing &amp; Features not seen in competitors">
    <meta property="og:image" content="https://cdn.cloudauthkey.cc/front/assets/img/favicon.png">
    <meta property="og:site_name" content="CloudAuthKey | Secure your software from piracy.">
    <link rel="shortcut icon" type="image/jpg" href="favicon.png">

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="CloudAuthKey - Open Source Auth">
    <meta itemprop="description" content="Secure your software against piracy, an issue causing $422 million in losses annually - Fair pricing &amp; Features not seen in competitors">
    <meta itemprop="image" content="https://cdn.cloudauthkey.cc/front/assets/img/favicon.png">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@CloudAuthKey">
    <meta name="twitter:title" content="CloudAuthKey - Open Source Auth">
    <meta name="twitter:description" content="Secure your software against piracy, an issue causing $422 million in losses annually - Fair pricing &amp; Features not seen in competitors">
    <meta name="twitter:creator" content="@CloudAuthKey">
    <meta name="twitter:image" content="https://cdn.cloudauthkey.cc/front/assets/img/favicon.png">

    <!-- Open Graph data -->
    <meta property="og:title" content="CloudAuthKey - Open Source Auth">
    <meta property="og:type" content="website">
    <meta property="og:url" content="./">

    <meta name="apple-itunes-app" content="app-id=6503321465">

    <title>CloudAuthKey</title>

    <!-- Start SmartBanner configuration -->
    <meta name="smartbanner:title" content="CloudAuthKey">
    <meta name="smartbanner:author" content="CloudAuthKey LLC">
    <meta name="smartbanner:price" content="FREE">
    <meta name="smartbanner:price-suffix-google" content=" - In Google Play">
    <meta name="smartbanner:icon-google" content="https://cdn-icons-png.flaticon.com/512/732/732208.png">
    <meta name="smartbanner:button" content="VIEW">
    <meta name="smartbanner:button-url-google" content="https://play.google.com/store/apps/details?id=com.wnelson03.rn">
    <meta name="smartbanner:enabled-platforms" content="android">
    <meta name="smartbanner:close-label" content="Close">
    <link rel="stylesheet" href="smartbanner.min.css.html">
    
    <!-- End SmartBanner configuration -->

    <!-- Canonical SEO -->
    <link rel="canonical" href="https://CloudAuthKey.local">

    <link rel="stylesheet" href="output.css">
    <link rel="stylesheet" type="text/css" href="animate.min.css">
    
    
    
<style>
    .pricing-cards-container {
        max-width: 100%;
        overflow-x: auto;
        padding: 20px 0;
        -webkit-overflow-scrolling: touch;
    }
    .pricing-cards {
        display: inline-flex;
        flex-wrap: nowrap;
        gap: 20px;
        padding: 0 20px;
        margin: 0 auto;
    }
    .pricing-card {
        background-color: #0f0f17;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        padding: 30px;
        width: 280px;
        transition: transform 0.3s ease;
        flex: 0 0 auto;
    }
    .pricing-card:hover {
        transform: translateY(-5px);
    }
    .pricing-card h2 {
        margin-top: 0;
        color: white;
        font-size: 24px;
        font-weight: 700;
    }
    .pricing-price {
        font-size: 28px;
        font-weight: bold;
        margin: 15px 0;
        color: #a855f7;
    }
    .pricing-description {
        color: #9ca3af;
        margin-bottom: 20px;
        font-size: 14px;
        line-height: 1.5;
    }
    .pricing-users {
        font-weight: bold;
        margin-bottom: 15px;
        color: white;
    }
    .pricing-features {
        list-style-type: none;
        padding: 0;
        margin: 0 0 25px 0;
    }
    .pricing-features li {
        margin-bottom: 10px;
        position: relative;
        padding-left: 25px;
        color: #d1d5db;
        font-size: 14px;
    }
    .pricing-features li:before {
        content: "•";
        position: absolute;
        left: 0;
        color: #a855f7;
        font-size: 20px;
        line-height: 1;
    }
    .pricing-button {
        display: inline-block;
        padding: 12px 24px;
        background-color: #7e22ce;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 600;
        text-align: center;
        width: 100%;
        box-sizing: border-box;
        transition: background-color 0.3s ease;
        border: none;
        cursor: pointer;
    }
    .pricing-button:hover {
        background-color: #9333ea;
    }
    .pricing-divider {
        height: 1px;
        background-color: #1f1f2e;
        margin: 20px 0;
    }
    .pricing-note {
        text-align: center;
        margin-top: 10px;
        font-size: 12px;
        color: #9ca3af;
    }
    
    /* Для десктопов - центрируем карточки без прокрутки */
    @media (min-width: 1024px) {
        .pricing-cards-container {
            overflow-x: visible;
            display: flex;
            justify-content: center;
        }
        .pricing-cards {
            display: flex;
            flex-wrap: nowrap;
            max-width: 1200px;
            padding: 0;
        }
    }
</style>
    
    
    
    
    
    
</head>

<body>
    <header>
        <nav class="border-gray-200 px-4 lg:px-5 py-1 mb-1">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="https://CloudAuthKey.local" class="flex items-center">
                    <img src="logo-1-dark.png" class="mr-0 h-20 mt-0" alt="CloudAuthKeyLogo">
                </a>
                <div class="flex items-center lg:order-2">
                    <a href="free-trial/" class="text-white font-medium rounded-lg text-sm px-4 py-2 lg:px-5 lg:py-2.5 mr-2 bg-purple-600 hover:bg-purple-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        Бесплатный демо аккаунт
                    </a>
                    <a href="https://CloudAuthKey.local/login" class="text-white font-medium rounded-lg text-sm px-4 py-2 lg:px-5 lg:py-2.5 mr-2 bg-purple-600 hover:bg-purple-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        Вход
                    </a>
                    <a href="https://CloudAuthKey.local/register" class="text-white font-medium rounded-lg text-sm px-4 py-2 lg:px-5 lg:py-2.5 mr-2 bg-purple-600 hover:bg-purple-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        Регистрация
                    </a>
                    <button data-collapse-toggle="mmenu" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden focus:outline-none focus:ring-0" aria-controls="mmenu" aria-expanded="false">
                        <span class="sr-only">Открыть главное меню</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mmenu">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <!-- Navigation links can be added here -->
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="">
        <div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-16">
            <div class="grid items-center gap-8 mb-8 lg:mb-16 lg:gap-12 lg:grid-cols-12">
                <div class="col-span-6 text-center sm:mb-6 lg:text-left lg:mb-0">
                    <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl text-white animate-on-scroll">
                        Регистрируйся и создавай приложение, не думая как пользовательно будет авторизироваться.
                    </h1>
                    <p class="max-w-xl mx-auto mb-6 font-base lg:mx-0 xl:mb-8 md:text-lg xl:text-xl text-gray-400 animate-on-scroll-right">
                        CloudAuthKey объединяет возможность авторизации сторонних приложений через систему взаимодействия с приложениями владельца.
                    </p>
                    <a href="./register" target="_blank" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-purple-600 hover:bg-purple-700 focus:ring-2 focus:ring-purple-500 transition duration-200 animate-on-scroll">
                        Регистрация
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="./login" target="_blank" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white rounded-lg bg-purple-600 hover:bg-purple-700 border border-purple-600 focus:ring-2 focus:ring-purple-500 transition duration-200 animate-on-scroll">
                        Вход
                    </a>
                </div>
                <div class="col-span-6 animate-on-scroll-right">
                    <div class="relative mx-auto border-[#0f0f17] bg-[#0f0f17] border-[8px] rounded-t-xl h-[172px] max-w-[301px] md:h-[294px] md:max-w-[512px]">
                        <div class="rounded-lg overflow-hidden h-[156px] md:h-[278px]">
                            <img src="dashboard-pic.png" class="h-[156px] md:h-[278px] w-full" alt="">
                        </div>
                    </div>
                    <div class="relative mx-auto bg-[#0f0f17] rounded-b-xl rounded-t-sm h-[17px] max-w-[351px] md:h-[21px] md:max-w-[597px]">
                        <div class="absolute left-1/2 top-0 -translate-x-1/2 rounded-b-xl w-[56px] h-[5px] md:w-[96px] md:h-[8px] bg-[#09090d]">
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid gap-8 sm:gap-12 md:grid-cols-3 pt-12 animate-on-scroll-in-up" id="features">
                <div class="flex justify-center">
                    <img src="security.png" class="w-6 h-6 mr-3 shrink-0 filter brightness-0 invert-[40%] sepia-[100%] saturate-[500%] hue-rotate-[200deg]" alt="Security Icon">
                    <div>
                        <h3 class="mb-1 text-lg font-semibold leading-tight text-white">
                            Все данные хранятся на стороне сервера
                        </h3>
                        <p class="font-light text-gray-400">
                            Такие как переменные, параменты и другие.
                        </p>
                    </div>
                </div>
                <div class="flex justify-center">
                    <svg class="w-6 h-6 mr-3 text-blue-500 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <img src="security1.png" class="w-6 h-6 mr-3 shrink-0 filter brightness-0 invert-[40%] sepia-[100%] saturate-[500%] hue-rotate-[200deg]" alt="Security Icon">
                    </svg>
                    <div>
                        <h3 class="mb-1 text-lg font-semibold leading-tight text-white">
                            Конфиденциальность на первом месте
                        </h3>
                        <p class="font-light text-gray-400">
                            Нам важны ваши потребности, ваших пользователей и неприкосновенность ваших данных.
                        </p>
                    </div>
                </div>
                <div class="flex justify-center">
                    <svg class="w-6 h-6 mr-3 text-blue-500 shrink-0" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <img src="provodnic5.png" class="w-6 h-6 mr-3 shrink-0 filter brightness-0 invert-[40%] sepia-[100%] saturate-[500%] hue-rotate-[200deg]" alt="Security Icon">
                    </svg>
                    <div>
                        <h3 class="mb-1 text-lg font-semibold leading-tight text-white">
                            Управляйте приложениями легко
                        </h3>
                        <p class="font-light text-gray-400">
                            С нашим API продавца вы можете управлять своим приложением из любой точки мира!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <section class="mt-32 animate-on-scroll-right">
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">

            
            
            
                                <div class="flex flex-wrap justify-center -m-8 2xl:-m-16 pt-12">
                        <div class="w-auto text-center p-4 md:mr-2">
                            <h3 class="mb-2.5 text-3xl font-semibold text-purple-600" style="letter-spacing: -0.5px;" data-v="accountsCreated" id="accs">
                                <?php echo $accountsCreated; ?>
                            </h3>
                            <p class="font-medium text-gray-400 tracking-tight">
                                Аккаунты
                            </p>
                        </div>
                        <div class="w-auto text-center p-4 md:mr-2">
                            <h3 class="mb-2.5 text-3xl font-semibold text-purple-600" style="letter-spacing: -0.5px;" data-v="createdApps" id="apps">
                                <?php echo $createdApps; ?>
                            </h3>
                            <p class="font-medium text-gray-400 tracking-tight">
                                Приложения
                            </p>
                        </div>
                        <div class="w-auto text-center p-4 md:mr-2">
                            <h3 class="mb-2.5 text-3xl font-semibold text-purple-600" style="letter-spacing: -0.5px;" data-v="licensesGenerated" id="licenses">
                                <?php echo $licensesGenerated; ?>
                            </h3>
                            <p class="font-medium text-gray-400 tracking-tight">
                                Ключи
                            </p>
                        </div>
                        <div class="w-auto text-center p-4">
                            <h3 class="mb-2.5 text-3xl font-semibold text-purple-600" style="letter-spacing: -0.5px;" data-v="usersLoggedin" id="activeUsers">
                                <?php echo $usersLoggedIn; ?>
                            </h3>
                            <p class="font-medium text-gray-400 tracking-tight">
                                Пользователей в сети
                            </p>
                        </div>
                    </div>
            
            
            
            
            
            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-white">
                    Создавайте <span class="text-purple-600">безопасные </span>
                    и <span class="text-purple-600">надежные </span>
                    приложения с CloudAuthKey
                </h2>
                <p class="mb-6 font-light md:text-lg text-gray-400">
                    CloudAuthKey - это облачная платформа аутентификации по подписке, которая позволяет с легкостью внедрить аутентификацию в ваше программное обеспечение, веб-сайт или приложение.
                </p>
            </div>
        </div>
    </section>

  
<section id="plans">
        <div class="max-w-screen-xl px-4 py-8 mx-auto lg:px-6 sm:py-16 lg:py-24">
            <div class="flex flex-wrap -m-7">
                <div class="w-full p-7 animate-on-scroll-in-up animate__animated animate__backInUp">
                    <div class="h-full p-8 border border-[#0f0f17] rounded-xl bg-[#0f0f17]">
                        <div class="flex flex-wrap justify-between border-b border-gray-800 pb-7 mb-7">
                            <div class="w-full xl:w-auto">
                                <h3 class="font-bold text-2xl text-white">Пробный</h3>
                            </div>
                            <div class="w-full xl:w-auto xl:text-right">
                                <h3 class="mb-0.5 font-bold text-2xl text-white">
                                     <span id="tester_mode">0 </span><span class="text-sm mr-0.5">₽</span>
                                </h3>
                                <p class="text-sm text-gray-400">
                                    Ограниченный доступ для тех, кто хочет поэкспериментировать с реализацией CloudAuthKey
                                </p>
                            </div>
                        </div>
                        <ul class="mb-8 md:grid md:grid-cols-2">
                            <li class="flex items-center mb-4 font-medium text-base text-white">
                                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z">
                                    </path>
                                </svg>
                                <p>
                                    Пользователей: 10
                                </p>
                            </li>
                            <li class="flex items-center mb-4 font-medium text-base text-white">
                                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z">
                                    </path>
                                </svg>
                                <p>
                                    Загруженных файлов: (10 MB)
                                </p>
                            </li>
                            <li class="flex items-center mb-4 font-medium text-base text-white">
                                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z">
                                    </path>
                                </svg>
                                <p>
                                    Глобальных переменных: 5
                                </p>
                            </li>
                            <li class="flex items-center mb-4 font-medium text-base text-white">
                                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z">
                                    </path>
                                </svg>
                                <p>
                                    Пользовательские переменные
                                </p>
                            </li>
                            <li class="flex items-center mb-4 font-medium text-base text-white">
                                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z">
                                    </path>
                                </svg>
                                <p>
                                    Журналы (включая логи Discord): 20
                                </p>
                            </li>
                            <li class="flex items-center mb-4 font-medium text-base text-white">
                                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z">
                                    </path>
                                </svg>
                                <p>
                                    Черный/белый список оборудования/IP-адресов
                                </p>
                            </li>
                            <li class="flex items-center mb-4 font-medium text-base text-white">
                                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z">
                                    </path>
                                </svg>
                                <p>
                                    Веб-загрузчик
                                </p>
                            </li>
                            <li class="flex items-center mb-4 font-medium text-base text-white">
                                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z">
                                    </path>
                                </svg>
                                <p>
                                    Чаты
                                </p>
                            </li>
                            <li class="flex items-center mb-4 font-medium text-base text-white">
                                <svg class="h-5 w-5 mr-2.5 text-red-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm4.207 12.793-1.414 1.414L12 13.414l-2.793 2.793-1.414-1.414L10.586 12 7.793 9.207l1.414-1.414L12 10.586l2.793-2.793 1.414 1.414L13.414 12l2.793 2.793Z">
                                    </path>
                                </svg>
                                <p>
                                    Создание вебхуков
                                </p>
                            </li>
                            <li class="flex items-center mb-4 font-medium text-base text-white">
                                <svg class="h-5 w-5 mr-2.5 text-red-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm4.207 12.793-1.414 1.414L12 13.414l-2.793 2.793-1.414-1.414L10.586 12 7.793 9.207l1.414-1.414L12 10.586l2.793-2.793 1.414 1.414L13.414 12l2.793 2.793Z">
                                    </path>
                                </svg>
                                <p>
                                    Доступ для реселлера &amp; менеджера
                                </p>
                            </li>
                            <li class="flex items-center mb-4 font-medium text-base text-white">
                                <svg class="h-5 w-5 mr-2.5 text-red-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm4.207 12.793-1.414 1.414L12 13.414l-2.793 2.793-1.414-1.414L10.586 12 7.793 9.207l1.414-1.414L12 10.586l2.793-2.793 1.414 1.414L13.414 12l2.793 2.793Z">
                                    </path>
                                </svg>
                                <p>
                                    Доступ к SellerAPI
                                </p>
                            </li>
                            <li class="flex items-center mb-4 font-medium text-base text-white">
                                <svg class="h-5 w-5 mr-2.5 text-red-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm4.207 12.793-1.414 1.414L12 13.414l-2.793 2.793-1.414-1.414L10.586 12 7.793 9.207l1.414-1.414L12 10.586l2.793-2.793 1.414 1.414L13.414 12l2.793 2.793Z">
                                    </path>
                                </svg>
                                <p>
                                    Дискорд бот
                                </p>
                            </li>
                        </ul>

                        <button type="button" class="text-white border-2 hover:bg-white hover:text-black focus:ring-0 focus:outline-none transition duration-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center mb-3 w-full">
                            <a href="./register/">
                                <span class="inline-flex">Начать бесплатно
                                    <svg class="w-3.5 h-3.5 ml-2 mt-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"></path>
                                    </svg></span>
                            </a>
                        </button>

                        <p class="text-sm text-gray-500 text-center">Данные карты не требуются</p>
                    </div>
                </div>
                
                
                
                <div class="w-full p-7 animate-on-scroll-in-up animate__animated animate__backInUp">
    <div class="h-full p-8 border border-[#0f0f17] rounded-xl bg-[#0f0f17]">
        <div class="flex flex-wrap justify-between border-b border-gray-800 pb-7 mb-7">
            <div class="w-full xl:w-auto">
                <h3 class="font-bold text-2xl text-white">Предприятие <span class="text-xs">(Исходный код)</span></h3>
            </div>
            <div class="w-full xl:w-auto xl:text-right">
                <h3 class="mb-0.5 font-bold text-2xl text-transparent bg-clip-text bg-gradient-to-r to-[#4fea74] from-[#1db233]">
                    <span class="text-sm mr-0.5">$</span><span id="developer_mode">14.99 / Год</span>
                </h3>
                <p class="text-sm text-gray-400">
                    Обширные лимиты плюс полный доступ к системе реселлеров. Большинство людей начинают здесь.
                </p>
            </div>
        </div>
        <ul class="mb-8 md:grid md:grid-cols-2">
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Пользователи: Неограниченно
                </p>
            </li>
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Загрузка файлов: (50 MB)
                </p>
            </li>
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Глобальные переменные: Неограниченно
                </p>
            </li>
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Переменные пользователя
                </p>
            </li>
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Логи (включая логи Discord): Неограниченно
                </p>
            </li>
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Черный/Белый список аппаратных устройств/IP
                </p>
            </li>
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Веб-загрузчик
                </p>
            </li>
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Чат-комнаты
                </p>
            </li>
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Безопасность API: 2FA, HMAC, IP-блокировки
                </p>
            </li>
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Боты-реселлеры
                </p>
            </li>
        </ul>
    </div>
</div>

                
                

                    <div class="w-full p-7 animate-on-scroll-in-up animate__animated animate__backInUp">
    <div class="h-full p-8 border border-[#0f0f17] rounded-xl bg-[#0f0f17]">
        <div class="flex flex-wrap justify-between border-b border-gray-800 pb-7 mb-7">
            <div class="w-full xl:w-auto">
                <h3 class="font-bold text-2xl text-white">Предприятие <span class="text-xs">(Исходный код)</span></h3>
            </div>
            <div class="w-full xl:w-auto xl:text-right">
                <h3 class="mb-0.5 font-bold text-2xl text-transparent bg-clip-text bg-gradient-to-r to-[#36e2dd] from-[#1e96fc]">
                    <span class="text-sm mr-0.5">$</span><span id="seller_mode">24.99 / Год</span>
                </h3>
                <p class="text-sm text-gray-400">
                    Полноценный спонсор, мы ценим вас за поддержание работы наших серверов!
                </p>
            </div>
        </div>
        <ul class="mb-8 md:grid md:grid-cols-2">
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Пользователи: Без ограничений
                </p>
            </li>
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Загрузка файлов: (75 МБ)
                </p>
            </li>
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Глобальные переменные: Без ограничений
                </p>
            </li>
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Переменные пользователя
                </p>
            </li>
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Логи (включая логи Discord): Без ограничений
                </p>
            </li>
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Черный/Белый список оборудования/IP
                </p>
            </li>
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Веб-загрузчик
                </p>
            </li>
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Чат-комнаты
                </p>
            </li>
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Создание вебхуков
                </p>
            </li>
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Доступ для реселлеров и менеджеров
                </p>
            </li>
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Доступ к SellerAPI
                </p>
            </li>
            <li class="flex items-center mb-4 font-medium text-base text-white">
                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z"></path>
                </svg>
                <p>
                    Discord бот
                </p>
            </li>
        </ul>

        <a href="https://cloudauthkey.local/upgrade/" class="block text-[#1e96fc] border-2 border-[#1e96fc] hover:bg-[#1e96fc] hover:text-white focus:ring-0 focus:outline-none transition duration-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center mt-3 w-full">
            Приобрести Seller сейчас
        </a>
    </div>
</div>
              
                
                
                
                
                
                
                
                
                
                
                
                
                <div class="w-full p-7 animate-on-scroll-in-up animate__animated animate__backInUp">
                    <div class="h-full p-8 border border-[#0f0f17] rounded-xl bg-[#0f0f17]">
                        <div class="flex flex-wrap justify-between border-b border-gray-800 pb-7 mb-7">
                            <div class="w-full xl:w-auto">
                                <h3 class="font-bold text-2xl text-white">Enterprise <span class="text-xs">(Source
                                        Code)</span></h3>
                            </div>
                            <div class="w-full xl:w-auto xl:text-right">
                                <h3 class="mb-0.5 font-bold text-2xl text-transparent bg-clip-text bg-gradient-to-r to-[#eeba0b] from-[#f4e409]">
                                    <span class="text-sm mr-0.5">$</span>79.99 / One-Time
                                </h3>
                                <p class="text-sm text-gray-400">
                                    Выбирайте крупномасштабные проекты за единовременную плату в размере 79,99 долл. США. <br>Доступ к исходному коду платных функций KeyAuth, индивидуальная поддержка по настройке и многое другое.
                                </p>
                            </div>
                        </div>
                        <ul class="mb-8 md:grid md:grid-cols-2">
                            <li class="flex items-center mb-4 font-medium text-base text-white">
                                <svg class="h-5 w-5 mr-2.5 text-red-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm4.207 12.793-1.414 1.414L12 13.414l-2.793 2.793-1.414-1.414L10.586 12 7.793 9.207l1.414-1.414L12 10.586l2.793-2.793 1.414 1.414L13.414 12l2.793 2.793Z">
                                    </path>
                                </svg>
                                <p>
                                    Cloud Hosted Subscription (KeyAuth Servers)
                                </p>
                            </li>
                            <li class="flex items-center mb-4 font-medium text-base text-white">
                                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z">
                                    </path>
                                </svg>
                                <p>
                                    Partial Source code of paid KeyAuth features
                                </p>
                            </li>
                            <li class="flex items-center mb-4 font-medium text-base text-white">
                                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z">
                                    </path>
                                </svg>
                                <p>
                                    One-on-one setup support
                                </p>
                            </li>
                            <li class="flex items-center mb-4 font-medium text-base text-white">
                                <svg class="h-5 w-5 mr-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2Zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706Z">
                                    </path>
                                </svg>
                                <p>
                                    Tutorial video showing how to host KeyAuth for 100% free
                                </p>
                            </li>
                        </ul>

                        <a href="https://paddle.keyauth.cc/enterprise/" class="block text-[#eeba0b] border-2 border-[#eeba0b] hover:bg-[#eeba0b] hover:text-white focus:ring-0 focus:outline-none transition duration-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center mt-3 w-full">
                            Purchase Enterprise Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <footer>
        <div class="p-4 py-6 mx-auto max-w-screen-xl md:p-8 lg:-10 pt-32 md:pt-0">
            <div class="grid grid-cols-2 gap-8 lg:grid-cols-6">
                <div class="col-span-2">
                    <a href="" class="flex items-center mb-2 text-2xl font-semibold text-white lg:mb-0">
                        CloudAuthKey LLC
                    </a>
                    <p class="my-4 font-light text-gray-400">
                        CloudAuthKey — это революционное, доступное и простое в использовании решение для лицензирования вашего программного обеспечения.
                    </p>
                    <ul class="flex mt-5 space-x-6">
                        <li>
                            <a target="_blank" href="https://youtube.com/CloudAuthKey" class="hover:text-white text-gray-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.593 7.203a2.506 2.506 0 0 0-1.762-1.766c-1.566-.43-7.83-.437-7.83-.437s-6.265-.007-7.832.404a2.56 2.56 0 0 0-1.766 1.778c-.413 1.566-.417 4.814-.417 4.814s-.004 3.264.406 4.814c.23.857.905 1.534 1.763 1.765 1.582.43 7.83.437 7.83.437s6.265.007 7.831-.403a2.515 2.515 0 0 0 1.767-1.763c.414-1.565.417-4.812.417-4.812s.02-3.265-.407-4.831ZM9.996 15.005l.005-6 5.207 3.005-5.212 2.995Z">
                                    </path>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://github.com/CloudAuthKey/" class="hover:text-white text-gray-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M12.026 2a9.973 9.973 0 0 0-9.974 9.974c0 4.406 2.857 8.145 6.82 9.465.5.09.68-.217.68-.481 0-.237-.008-.865-.011-1.696-2.775.602-3.361-1.338-3.361-1.338-.452-1.152-1.107-1.459-1.107-1.459-.905-.619.069-.605.069-.605 1.002.07 1.527 1.028 1.527 1.028.89 1.524 2.336 1.084 2.902.829.09-.645.35-1.085.635-1.334-2.214-.251-4.542-1.107-4.542-4.93 0-1.087.389-1.979 1.024-2.675-.101-.253-.446-1.268.099-2.64 0 0 .837-.269 2.742 1.021a9.582 9.582 0 0 1 2.496-.336 9.555 9.555 0 0 1 2.496.336c1.906-1.291 2.742-1.021 2.742-1.021.545 1.372.203 2.387.099 2.64.64.696 1.024 1.587 1.024 2.675 0 3.833-2.33 4.675-4.552 4.922.355.308.675.916.675 1.846 0 1.334-.012 2.41-.012 2.737 0 .267.178.577.687.479C19.146 20.115 22 16.379 22 11.974 22 6.465 17.535 2 12.026 2Z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="lg:mx-auto">
                    <h3 class="mb-6 text-sm font-semibold uppercase text-white">Ссылки</h3>
                    <ul class="text-gray-400">
                        <li class="mb-4">
                            <a href="https://www.youtube.com/CloudAuthKey" target="_blank" class="hover:underline">Youtube</a>
                        </li>
                        <li class="mb-4">
                            <a href="https://github.com/CloudAuthKey" target="_blank" class="hover:underline">GitHub</a>
                        </li>
                    </ul>
                </div>
                <div class="lg:mx-auto">
                    <h2 class="mb-6 text-sm font-semibold uppercase text-white">
                        Наиболее используемые примеры
                    </h2>
                    <ul class="text-gray-400">
                        <li class="mb-4">
                            <a target="_blank" href="https://github.com/CloudAuthKey/CloudAuthKey-CPP-Example" class="hover:underline">
                                C++ <span class="text-xs">(CPP)</span>
                            </a>
                        </li>
                        <li class="mb-4">
                            <a target="_blank" href="https://github.com/CloudAuthKey/CloudAuthKey-CSHARP-Example" class="hover:underline">C# <span class="text-xs">(CSharp)</span></a>
                        </li>
                        <li class="mb-4">
                            <a target="_blank" href="https://github.com/CloudAuthKey/CloudAuthKey-JS-Example" class="hover:underline">JavaScript <span class="text-xs">(JS)</span></a>
                        </li>
                        <li class="mb-4">
                            <a target="_blank" href="https://github.com/CloudAuthKey/CloudAuthKey-Python-Example" class="hover:underline">Python <span class="text-xs">(PY)</span></a>
                        </li>
                    </ul>
                </div>
                <div class="lg:mx-auto">
                    <h2 class="mb-6 text-sm font-semibold uppercase text-white">Другое &amp; Поддержка</h2>
                    <ul class="text-gray-400">
                        <li class="mb-4">
                            <a target="_blank" href="https://t.me/CloudAuthKey" class="hover:underline">
                                Центр поддержки
                            </a>
                        </li>
                        <li class="mb-4">
                            <a target="_blank" href="https://cloudauthkey.local/free-trial/" class="hover:underline">
                                Демо аккаунт
                            </a>
                        </li>
                        <li class="mb-4">
                            <a target="_blank" href="https://t.me/cloudauthkey" class="hover:underline">
                                Telegram
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="my-6 border-[#0f0f17] sm:mx-auto lg:my-8">
            <span class="block mb-6 text-sm text-gray-400 lg:mb-0 text-center">© 2025 -  <a href="#" class="hover:underline">CloudAuthKey LLC</a>. Все права защищены.
            </span>
        </div>
    </footer>
</body>
</html>