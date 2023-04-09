Integation jaspersoft REST API to php application to manage report in all format as jasper provided like pdf, docx and xlsx etc. I tried to make it easier to integration with jasper soft.   
 
## Install it to the application through composer   
`composer install <package name>`

### Laravel specific configuration 
1. First add service provider as below in to the config/app   
`Julfiker\Jasper\JasperReportServiceProvider::class,`  
   
2. To publishing config   
`php artisan vendor:publish --provider="Julfiker\Jasper\JasperReportServiceProvider"`


