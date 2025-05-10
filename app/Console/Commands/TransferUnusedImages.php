<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TransferUnusedImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:transfer-unused';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer unused images to the blank folder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userImagesPath = public_path('storage/user_images');
        $blankImagesPath = public_path('storage/blank');

        // Ensure the blank directory exists
        if (!File::exists($blankImagesPath)) {
            File::makeDirectory($blankImagesPath, 0755, true);
        }

        // Get all image filenames in the user_images directory
        $allImages = File::files($userImagesPath);

        // Get all image filenames referenced in the database
        $usedImages = DB::table('users')->pluck('user_image')->toArray();

        $movedCount = 0;

        foreach ($allImages as $image) {
            $imageName = $image->getFilename();

            // Check if the image is not in the database
            if (!in_array('user_images/' . $imageName, $usedImages)) {
                // Move the image to the blank directory
                File::move($image->getPathname(), $blankImagesPath . '/' . $imageName);
                $movedCount++;
                $this->info("Moved: {$imageName}");
            }
        }

        $this->info("Total images moved: {$movedCount}");
    }
}

// To run this command, use the following command in your terminal:
// php artisan images:transfer-unused
// Make sure to adjust the paths and database table names as per your application structure.
// This command will move all images that are not referenced in the users table to the blank directory.