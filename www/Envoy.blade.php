
@task('www-setup', ['on' => 'web'])

    @if ( empty($domain_name) || empty($git_repo) )
        echo "domain name or git url empty. exiting..."
        exit
    @endif

    #check if www folder exists already
    #if [ -d {{ $www_root }} ]

    #change to www dir
    echo "enter www path"
    cd {{ $www_path }}

    #do git clone
    echo "start git clone"
    sudo git clone {{ $git_repo }} {{ $domain_name }}

    #enter app dir
    echo "enter app di"r
    cd {{ $app_root }}

    echo "do composer install"
    sudo composer install --no-interaction

    echo "make .env copy"
    sudo cp .env.example .env

    echo "fix permissions on .env ./storage,  ./bootstrap & public"
    sudo chmod 777 .env
    sudo chmod 777 -R ./storage/*
#    sudo chmod 777 -R ./storage/logs/*
    sudo chmod 777 -R ./bootstrap/*
    sudo chmod 777 ./public

    echo "generate key"
    php artisan key:generate
#    php artisan storage:link

    php artisan clear-compiled
    php artisan config:clear
    php artisan view:clear
    php artisan route:clear

    echo "optimize laravel"
    php artisan optimize

    echo "restart php-fpm"
    sudo service php{{ $php_version }}-fpm reload

    echo "www-setup done"
@endtask