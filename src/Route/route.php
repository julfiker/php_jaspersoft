<?php

Route::group(['middleware' => ['web']], function () {
    Route::any('/jasper/report/render/{title?}', 'Julfiker\Jasper\JasperReportPublisherController@render')->name('julfiker.jasper.report.render');
});

