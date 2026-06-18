<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('about-zooland', function () {
    $this->info('ZooLand ERP Laravel starter is ready.');
});
