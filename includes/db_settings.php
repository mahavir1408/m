<?php    
        switch(ENV_NAME)
        {
                case 'local':
                        define('DB_NAME', 'mahavir');
                        define('DB_HOST', 'localhost');
                        define('DB_USER', 'root');
                        define('DB_PASSWORD', 'm@h@v!rm21');
                        define('DB_DEBUG', FALSE);
                        break;
                case 'prod':
                        define('DB_NAME', 'mahavir');
                        define('DB_HOST', 'localhost');
                        define('DB_USER', 'root');
                        define('DB_PASSWORD', 'm@h@v!rm21');
                        define('DB_DEBUG', FALSE);
                        break;               
        }