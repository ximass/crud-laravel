INSTALAÇÃO (necessário possuir o composer instalado na máquina):

1) git clone https://github.com/ximass/crud-laravel.git no diretório desejado

2) dentro do diretório do projeto clonado rodar: 

    2.1) composer install           (baixa as dependencias)

    2.2) php artisan key:generate   (validação)

    2.3) php artisan serve          (inicia o servidor)

3) importar o arquivo banco.sql para o Mysql

obs: talvez seja necessário alterar as configurações no arquivo .env para conexão local com o db;
