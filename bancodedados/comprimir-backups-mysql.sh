#Scripa para Comprimir arquivos em Backups.

DIRETORIO=/opt/backup/bd/

sleep 1
echo "Acessando o Diretório ... $DIRETORIO "
cd $DIRETORIO
sleep 1
echo "Comprimindo arquivos de Backup SQL ..."
FILE=backups-`date +%Y%m%d%H%M%S`.tar.xz
echo "Gerando arquivo de backup: [$FILE]."
tar -cJf $FILE *.sql 

sleep 1
echo "Excluindo arquivos desnecessários ..."
rm *.sql

echo "Processo finalizado ... "
ls -llh $FILE
echo "Arquivos compactados: "
tar -tf $FILE
echo "Commitando novos arquivos"
git add *
git commit -m "-- Commit automático --- $FILE"
git push
