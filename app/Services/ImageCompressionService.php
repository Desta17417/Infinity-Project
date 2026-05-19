<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageCompressionService
{
    /**
     * Kompresi dan simpan gambar motor
     * Menggunakan GD Library (built-in PHP) sebagai default
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path Folder destinasi
     * @param int $maxWidth Lebar maksimal
     * @param int $quality Kualitas kompresi (1-100)
     * @return string Path file yang tersimpan
     */
    public static function compressAndStore($file, $path = 'motors', $maxWidth = 1200, $quality = 75)
    {
        try {
            // Coba gunakan Intervention Image jika tersedia
            if (class_exists('\Intervention\Image\Facades\Image')) {
                return self::compressWithIntervention($file, $path, $maxWidth, $quality);
            }
            
            // Fallback ke GD Library
            return self::compressWithGD($file, $path, $maxWidth, $quality);
        } catch (\Exception $e) {
            \Log::error('Image compression error: ' . $e->getMessage());
            throw new \Exception('Gagal memproses gambar: ' . $e->getMessage());
        }
    }

    /**
     * Kompresi menggunakan Intervention Image (jika diinstall)
     */
    private static function compressWithIntervention($file, $path, $maxWidth, $quality)
    {
        $image = \Intervention\Image\Facades\Image::make($file);

        if ($image->width() > $maxWidth) {
            $image->resize($maxWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        $fileName = time() . '_' . uniqid() . '.jpg';
        $fullPath = $path . '/' . $fileName;

        $imageStream = $image->stream('jpg', $quality);
        Storage::disk('public')->put($fullPath, $imageStream);

        return $fullPath;
    }

    /**
     * Kompresi menggunakan GD Library (built-in PHP)
     * Tersedia di semua instalasi XAMPP standar
     */
    private static function compressWithGD($file, $path, $maxWidth, $quality)
    {
        // Validasi GD Library
        if (!extension_loaded('gd')) {
            throw new \Exception('GD Library tidak tersedia. Silakan aktifkan ekstensi GD di php.ini');
        }

        $tmpPath = $file->getRealPath();
        $mimeType = $file->getMimeType();

        // Tentukan fungsi untuk membaca gambar berdasarkan tipe
        switch ($mimeType) {
            case 'image/jpeg':
            case 'image/jpg':
                $source = imagecreatefromjpeg($tmpPath);
                $format = 'jpg';
                break;
            case 'image/png':
                $source = imagecreatefrompng($tmpPath);
                $format = 'png';
                break;
            case 'image/webp':
                if (function_exists('imagecreatefromwebp')) {
                    $source = imagecreatefromwebp($tmpPath);
                    $format = 'webp';
                } else {
                    throw new \Exception('Format WebP tidak didukung di server ini');
                }
                break;
            default:
                throw new \Exception('Format gambar tidak didukung');
        }

        if (!$source) {
            throw new \Exception('Gagal membaca gambar');
        }

        // Hitung dimensi baru
        $originalWidth = imagesx($source);
        $originalHeight = imagesy($source);

        if ($originalWidth > $maxWidth) {
            $newWidth = $maxWidth;
            $newHeight = round(($originalHeight / $originalWidth) * $maxWidth);
        } else {
            $newWidth = $originalWidth;
            $newHeight = $originalHeight;
        }

        // Buat canvas baru
        $resized = imagecreatetruecolor($newWidth, $newHeight);

        // Pertahankan transparansi untuk PNG
        if ($format === 'png') {
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
            $transparent = imagecolorallocatealpha($resized, 255, 255, 255, 127);
            imagefilledrectangle($resized, 0, 0, $newWidth, $newHeight, $transparent);
        }

        // Copy dan resize gambar
        imagecopyresampled($resized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

        // Generate nama file unik (selalu convert ke JPG untuk kompresi lebih baik)
        $fileName = time() . '_' . uniqid() . '.jpg';
        $storagePath = $path . '/' . $fileName;
        $tempFile = sys_get_temp_dir() . '/' . $fileName;

        // Simpan ke temp file dengan quality
        imagejpeg($resized, $tempFile, $quality);

        // Upload ke storage
        $fileContent = file_get_contents($tempFile);
        Storage::disk('public')->put($storagePath, $fileContent);

        // Cleanup
        imagedestroy($source);
        imagedestroy($resized);
        @unlink($tempFile);

        return $storagePath;
    }

    /**
     * Dapatkan estimasi ukuran file setelah kompresi
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @return int Ukuran dalam KB
     */
    public static function getEstimatedSize($file)
    {
        // Rough estimate: kompresi 70% dari ukuran original
        $originalSize = $file->getSize();
        return ceil(($originalSize * 0.3) / 1024);
    }

    /**
     * Hapus gambar dari storage
     * 
     * @param string $path Path gambar
     * @return bool
     */
    public static function deleteImage($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        return false;
    }
}
