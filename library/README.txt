Commandes doctrine :

 - Récupérer analyse depuis la base : 		php command orm:convert-mapping --from-database xml ./library/Entity/Mapping --namespace="Entity\\"
 - Générer les entités depuis l'analyse : 	php command orm:generate-entities ./library --generate-annotations=true --no-backup
 - Générer les proxies des entités :	        php command orm:generate-proxies
 - Update la base de données : 			php command orm:schema-tool:update --force


 - Générer fichier de migration vide :          php command spelog:migrations generate
 - Lancer toute les migrations non faites :     php command spelog:migrations migrate <host>