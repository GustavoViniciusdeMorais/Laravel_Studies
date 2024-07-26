 #!/bin/bash
php artisan cache:clear
php artisan route:cache
php artisan view:clear
# composer dump-autoload