<?php
    session_unset(); // Очищает данные сессии
    session_destroy(); // Уничтожает сессию
    if (headers_sent()) {
        echo '<meta http-equiv="refresh" content="0;url=https://cloudauthkey.local">';
    } else {
        header("Location: https://cloudauthkey.local");
    }
    exit();
?>