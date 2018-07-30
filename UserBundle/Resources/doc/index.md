#Instalar fos-user-bundle version 2

composer require friendsofsymfony/user-bundle "~2.0"

#Cargar en el kernel
            new FOS\UserBundle\FOSUserBundle(),



#Reemplazar el contenido de app/config/security.yml por

security:
    encoders:
        FOS\UserBundle\Model\UserInterface: bcrypt

    role_hierarchy:
        ROLE_ADMIN:       ROLE_USER
        ROLE_SUPER_ADMIN: ROLE_ADMIN

    providers:
        fos_userbundle:
            id: fos_user.user_provider.username

    firewalls:
        main:
            pattern: ^/
            form_login:
                provider: fos_userbundle
                csrf_token_generator: security.csrf.token_manager
                default_target_path: homepage
                always_use_default_target_path: true                
                # if you are using Symfony < 2.8, use the following config instead:
                #csrf_provider: form.csrf_provider

            logout:       true
            anonymous:    true

    access_control:
        - { path: ^/login$, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/register, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/resetting, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/admin/, role: ROLE_ADMIN }



#Agregar al final de app/config/config.yml


fos_user:
    db_driver: orm # other valid values are 'mongodb' and 'couchdb'
    firewall_name: main
    user_class: UserBundle\Entity\User
    from_email:
        address: "%mailer_user%"
        sender_name: "%mailer_user%"        

#Configurar en app/config/parameters.yml el mailer_user


# app/config/routing.yml
fos_user:
    resource: "@FOSUserBundle/Resources/config/routing/all.xml"            


#Cargar en el kernel

            new UserBundle\UserBundle(),  

#Chequear en el composer.json que se incluya en el autoload el bundle ejemplo:

    "autoload": {
        "psr-4": {
            "AppBundle\\": "src/AppBundle",
            "UserBundle\\": "src/UserBundle"
        },
        "classmap": [ "app/AppKernel.php", "app/AppCache.php" ]
    },

#Luego ejecutar

composer dump-autoload

php bin\console assets:install              