# Script de Backup Banco de dados MySQL #
############################################################
# Confifgurações no Crontab                                #
############################################################
# Executar backup do banco a meia noite e ao meio dia
# Este horário está considerando GMT-2
# 00 03,15 * * * root /fontes/banco_de_dados/backup_mysql.sh
############################################################
#Servidor
HOST="localhost"
HOST_DESTINO="mysql06-farm59.uni5.net"
#Base de Dados
DATABASE="e2f10"
DATABASE_DESTINO="e2f10"

#Data
NOW=$(date "+%Y%m%d%H%M%S")
echo "Iniciando Backup e Replica $NOW ..."

#User
USER="backup"
PASSWORD="8GPLWeQYmdvYdvX9"

USER_DESTINO="e2f10"
PASSWORD_DESTINO="e2f12345678"

#File 
FILE="backup-$DATABASE"-"$NOW.sql"
#Diretorio
DIRETORIO=/tmp/

mysqldump $DATABASE -h$HOST -u$USER -p$PASSWORD --routines > $DIRETORIO$FILE
mysql -h$HOST_DESTINO -u$USER_DESTINO -p$PASSWORD_DESTINO $DATABASE_DESTINO < $DIRETORIO$FILE

echo "Replica finalizada $DIRETORIO$FILE"
