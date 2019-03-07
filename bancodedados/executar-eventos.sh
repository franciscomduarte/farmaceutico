#Scripa para Executar Agendamento PHP

DIRETORIO=/var/www/html/projeto-exemplo/modulos/alerta/

sleep 1
echo "Acessando o Diretório ... $DIRETORIO "
cd $DIRETORIO
sleep 1
echo "Executando o arquivo ..."
php -f bundles-nao-preenchidos.php amFuYWluYVNBQlJJTkFkZVBBVUxBU0FtYW50aGFGT1M=
echo "Fim da execucao do agendamento"
