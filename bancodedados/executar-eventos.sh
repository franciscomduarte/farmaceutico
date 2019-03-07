#Scripa para Executar Agendamento PHP

DIRETORIO=/var/www/html/projeto-exemplo/modulos/alerta/

sleep 1
echo "Acessando o Diretório ... $DIRETORIO "
cd $DIRETORIO
sleep 1
echo "Executando o arquivo ..."
php bundles-nao-preenchidos.php
echo "Fim da execucao do agendamento"
