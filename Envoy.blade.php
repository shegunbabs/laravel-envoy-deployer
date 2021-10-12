@servers(['web' => 'shegun@shegunbabs.com -p2442', 'local' => 'vagrant@192.168.10.10'])


@setup

    $domain_name = $domain;                                 //via --domain=...
    $git_repo = $git;                                       //via --git=...

    $www_path = $www_path ?? "/var/www";                    //via --www_path=...
    $app_root = "$www_path/$domain_name";
    $php_version = $php_version ?? "8.0";                   //via --php_version=...
    $nginx_stub = "./nginx/nginx-bloc.stub";

    $replacement = [
        '%domain_name%' => $domain_name,
        '%www_root%' => "$app_root/public",
        '%php_version%' => $php_version,
    ];

    $rawConfig = file_get_contents($nginx_stub);
    $rawNginxConfig = str_replace(array_keys($replacement), array_values($replacement), $rawConfig);

@endsetup

@import('www/Envoy.blade.php')

@import('nginx/Envoy.blade.php')

@story('deploy')
    www-setup
    nginx-setup
@endstory
