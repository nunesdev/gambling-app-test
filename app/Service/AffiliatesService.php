<?php

namespace App\Service;

use Illuminate\Support\Facades\File;

class AffiliatesService 
{
  public function getAllAffiliatesByFile()
  {
    try
    {
      $file = storage_path('app/public/affiliates.txt');
      $matriz=[];
      foreach(file($file) as $line) 
      {
        $matriz[] = json_decode($line);
      }
      return $matriz;
    }
    catch (Illuminate\Contracts\Filesystem\FileNotFoundException $exception)
    {
        die("The file doesn't exist");
    }
  }
}