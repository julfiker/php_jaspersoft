<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/jesper/report/render', 'Julfiker\Jasper\JasperReportPublisherController@render')->name('julfiker.jasper.report.render');
});

