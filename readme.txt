# 1) Tell Composer where the local CoreAuth package lives
composer config repositories.projectname path "C:/Users/Sir/Desktop/BaseProject/packages/CoreAuth"

# 2) Require your package
composer require dapunjabi/coreauth:* -W

# 3) Run the CoreAuth installer
php artisan coreauth:install