# Codeigniter---CMS
# Zip file is for the static files and index

<div>
	<pre>
	<VirtualHost *:80>
		DocumentRoot /var/www/cms
		ServerName cms.loc
		<Directory /var/www/cms>
			Options Indexes FollowSymLinks MultiViews
			AllowOverride All
			Require all granted
		</Directory>
	</VirtualHost>
	</pre>
<div>
