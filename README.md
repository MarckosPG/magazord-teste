# Entrega de Teste - Magazord

1 - Baixe o servidor de sua escolha (WampServer, Xampp, etc...)

2 - Copie todos os arquivos da pasta do projeto para a pasta "www" ou "htdocs" do servidor que você baixou geralmente localizado no C:\, *se a pasta www ou htdocs do servidor tiver algum arquivo, apague tudo antes de colar o projeto, pois no prejeto tem uma configuração na classe "Router" para para referenciar o caminho da raiz do prejeto. (fique a vontade para mudar as regras do .htaccess, se precisar colocar em uma pasta específica)

3 - Inicialize o serviror, garanta que o apache e mysql estejam iniciados também.

4 - Configure as credênciais do banco de daos no arquivo config.php que está localizada na pasta config.

5 - tendo o php e o composer instalados na máquina, abra o terminal dentro da pasta do projeto, e rode o comando para a migração do banco de dados: "php vendor/bin/doctrine orm:schema-tool:create" e execute o projeto.

6 - Abra o navegador digite localhost


