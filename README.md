## Symfony 7 starter
1. git clone https://github.com/andreyshibaev/symfonyproject7.git
2. cd symfonyproject7
3. composer install
4. php bin/console sass:build (for production)
5. php bin/console asset-map:compile (for production)
6. create a local new database
7. php bin/console make:migration (if needed)
8. php bin/console doctrine:migrations:migrate
9. php bin/console create-secret-key
10. copy the file ".env" and rename it to ".env.local"
11. add the generated key to the file ".env.local"
12. composer dump-env prod (for production)
13. composer require symfony/apache-pack (for production)
14. composer require symfony/rate-limiter
15. php bin/console sass:build --watch (for development)
16. add your data in .env.local file 