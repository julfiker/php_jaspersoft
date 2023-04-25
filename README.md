Integation jaspersoft REST API to php application to manage report in all format as jasper provided like pdf, docx and xlsx etc. I tried to make it easier to integration with jasper soft.   
 
## Install it to the application through composer   
`composer require julfiker/php-jaspersoft`  

### Laravel specific configuration 
 **1. First add service provider as below in to the config/app**   
`Julfiker\Jasper\JasperReportServiceProvider::class,`  
   
 **2. To publish the config**   
`php artisan vendor:publish --provider="Julfiker\Jasper\JasperReportServiceProvider"`   

 **3. Add following and configure jasper server credential in to the .env**
 ```dotenv
#### Jasper server credential configuration #######
JASPER_SERVER_URL=http://127.0.0.1:8888/jasperserver
JASPER_SERVER_USERNAME=jasperadmin
JASPER_SERVER_PASSWORD=jasperadmin  
JASPER_SERVER_REQUEST_TIMEOUT=30
```
 
### Instruction to use in to the Laravel
 **1. Using Helper function**
 ````php
 /** 
 * From controller action
 *
 * @param $path
 * @param string $type  pdf|xlsx|docx
 * @param string $name name of the report
 * @param array $params its optional, parameter of report in array if required. 
 */
 return render_report('{JASPER_REPORT_PATH}', 'pdf', "report_name", ["param" => 123]); 
   
````   
If you want to call from route define just follow as below   
````php 
Route::get('/testing', function (Redirect $redirect) {
    return render_report('{REPORT_PATH}', 'pdf', 'name_of_the_report');
});

````
**2. Using to generate route and make a link to render a report**
```php
echo route('julfiker.jasper.report.render', ['path' => "{report_path}", 'type' => 'pdf', "name" => "{name_of_report}", "param" => 1]);
```
**3.  Blade template**  
```blade
<a href="{{route('julfiker.jasper.report.render', ['path' => "{report_path}", 'type' => 'pdf', "name" => "{name_of_report}", "param" => 1])}}">Report</a>
OR
<a href="/jasper/report/render?path={report_path}&type=pdf&name=report_name&p=122">Report</a>
```
  
  
### Instruction to use it in other php based application
```php
use Julfiker\Jasper\Manager\JasperReport;

$jasper =  new JasperReport();
$jasper->setServerUrl('jasper_server_url')
       ->setUsername('jasper_user')
       ->setPassword('jasper_password')
       ->make();
     
try {
    $reportContent = $jasper
        ->setPath("{JASPER_REPORT_PATH}")
        ->setType("pdf")
        ->setParams(["param1"=> 1, "param2" => 2])
        ->generate();
  
  

   //If pdf render
   echo $reportContent;
   header('Content-Type: pdf');
   header('Content-Disposition: inline; filename=report.pdf');
   exit;
   
   //if download in excel file with xlsx
    echo $reportContent;
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename==report.xlsx');
    exit;
    
    //Note: If you response header framework specific where you are working on.
}
catch (\Exception $e) {
    echo $e->getMessage();
}

```

### Any Help?   
You can contact me through following access   
email: _mail.julfiker@gmail.com_  
skype: _eng.jewel_  
whatsapp: 01817108853


### You are welcome to contribute on it further improvement/update or extended usability for all. Just make a pull request.  
Thank you

 
