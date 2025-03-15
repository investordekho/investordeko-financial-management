<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    public function generateCaptcha()
    {
         // Enable full error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Check if GD functions exist
    if (!function_exists('imagecreate')) {
        dd("GD functions are not available. Please ensure the GD extension is enabled in your php.ini.");
    }
        // Generate a random 6-character string
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ123456789';
        $captchaText = substr(str_shuffle($characters), 0, 6);
        
        // Store the CAPTCHA text in session
        session(['captcha_text' => $captchaText]);

        // Define dimensions
        $width = 150;
        $height = 50;
        $image = \imagecreate($width, $height);

        // Colors: white background, black text
        $bgColor   = \imagecolorallocate($image, 255, 255, 255);
        $textColor = \imagecolorallocate($image, 0, 0, 0);

        // Add noise - random lines
        for ($i = 0; $i < 5; $i++) {
            $lineColor = \imagecolorallocate($image, rand(50,200), rand(50,200), rand(50,200));
            \imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $lineColor);
        }

        // Path to a TrueType font file (ensure this file exists)
        $fontPath = public_path('fonts/arial.ttf');
        if (!file_exists($fontPath)) {
            die('Font file not found. Please place a .ttf file in public/fonts/ directory.');
        }

        // Draw the text on the image with a random angle
        $angle = rand(-10, 10);
        $x = 20;
        $y = 35;
        \imagettftext($image, 24, $angle, $x, $y, $textColor, $fontPath, $captchaText);

        // Output the image
        header('Content-Type: image/png');
        \imagepng($image);
        \imagedestroy($image);
    }
}
