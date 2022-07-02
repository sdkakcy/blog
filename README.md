## Hakkında

Bu proje laravel 8, ile geliştirilmiş, development ortamı laravel/sail ile docker üzerine kurulu basit bir blog sistemidir.

* php versiyonu: 8.1.7
* mysql versiyonu: 8.0.29
* node.js versiyonu: 16.15.1
* npm versiyonu: 8.13.2

## Kurulum
### Gereksinimler
* php 7.3 ve üzeri bir php sürümü
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

***
## Giriş
* http://localhost/login

* E-posta: admin@admin.com
* Şifre: admin
