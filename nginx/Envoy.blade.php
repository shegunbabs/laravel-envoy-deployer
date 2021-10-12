
@task('nginx-setup', ['on' => 'web'])

    if [ -d /etc/nginx/sites-available/{{ $domain_name }} ]; then
        echo "Bloc already exists"
        exit 1
    fi

    #switch to sites-available
    cd /etc/nginx/sites-available

    #create server bloc
    sudo touch {{ $domain_name }}
    sudo chmod 777 {{ $domain_name }}
    echo -e "{{ $rawNginxConfig }}" >> {{ $domain_name }}
    sudo chmod 644 {{ $domain_name }}

    #switch to sites-enabled
    cd /etc/nginx/sites-enabled

    #create soft link
    echo "create symbolic link"
    sudo ln -s /etc/nginx/sites-available/{{ $domain_name }} {{ $domain_name }}

    #restart nginx
    echo "reload nginx"
    sudo systemctl restart nginx > /dev/null

    echo "nginx-setup done"

@endtask