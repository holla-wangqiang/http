#!/bin/env sh

cd /app

# sleep 3600;

# echo ""
# echo '-> 运行 PHPStan'
# ./vendor/bin/phpstan analyze -c phpstan.src.neon.dist --xdebug --ansi

echo ""
echo "-> 运行 Psalm"
./vendor/bin/psalm

echo ""
echo "-> 运行单元测试"
./vendor/bin/phpunit --colors=always

echo ""
echo "-> 执行 php-cs-fixer"
./vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php
