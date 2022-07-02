## Hakkında

Bu proje laravel 8, ile geliştirilmiş, development ortamı laravel/sail ile docker üzerine kurulu basit bir blog sistemidir.

## Kurulum
### Gereksinimler
* php 8.1
* composer
* npm
* tercihen docker

#
* Projeyi çektikten sonra ilk olarak ***.env.example*** dosyasından kendi ***.env*** dosyamızı türetiyoruz. Gerekli ayarlamaları yapıyoruz.
* ***php artisan key:generate***
* ***composer install***
* Docker kurulu bir bilgisayarda çalışıyorsak ***./vendor/bin/sail up*** komutunu çalıştırıyoruz.
* Sail ile devam edeceksek ***./vendor/bin/sail shell***
* ***npm i***
* ***npm run dev***
* ***php artisan migrate --seed***
