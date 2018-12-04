# Script de Backup Banco de dados MySQL #
############################################################
# Confifgurações no Crontab                                #
############################################################
# Executar backup do banco a meia noite e ao meio dia
# Este horário está considerando GMT-2
# 00 02,14 * * * root /fontes/banco_de_dados/backup_mysql.sh
# Comprimir os Backups todo dia as 2 horas da manhã
# 01 4 * * * root /fontes/banco_de_dados/comprimir-backups-mysql.sh
############################################################
#Servidor
HOST="localhost"
#Base de Dados
DATABASE="e2f10"
DATABASE2="tnmcondominios"
#Data
NOW=$(date "+%Y%m%d%H%M%S")
echo "Iniciando Backup $NOW ..."
#User
USER="backup"
PASSWORD="8GPLWeQYmdvYdvX9"
#File 
FILE="backup-$DATABASE"-"$NOW.sql"
FILE2="backup-$DATABASE2"-"$NOW.sql"
#Diretorio
DIRETORIO=/opt/backup/bd/

mysqldump $DATABASE -h$HOST -u$USER -p$PASSWORD --routines >> $DIRETORIO$FILE
mysqldump $DATABASE2 -h$HOST -u$USER -p$PASSWORD --routines >> $DIRETORIO$FILE2

echo "Backup finalizado $DIRETORIO$FILE"
