<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Decoders\DataUriImageDecoder;
use PhpParser\Node\Stmt\Break_;
use Illuminate\Support\Facades\Log;

class img extends Controller
{
    public function index(Request $request)
    {
        return view("imgsetter");
    }
    public function processImage(Request $request)
    {
        // Получаем загруженное изображение
        $file = $request->file('image');

        // Проверка, что файл был загружен
        if ($file->isValid()) {
            // Преобразование в ресурс файла

            // Преобразование в строку Base64
            $base64Data = base64_encode(file_get_contents($file->getRealPath()));

            // Преобразование в Data URI
            $dataUri = 'data:image/jpeg;base64,' . $base64Data;

            $manager = new ImageManager(new Driver());

            // read image only from data uri or base64 encoded data
            $image = $manager->read($dataUri, DataUriImageDecoder::class);
            $image1 = $manager->read($dataUri, DataUriImageDecoder::class);

            $image2 = $manager->read($dataUri, DataUriImageDecoder::class);

            $image->cover(700, 700);
            $image1->cover(400, 400);
            $image2->cover(200, 200);

            $image->toPng()->save('images/foo.png');
            $image1->toPng()->save('images/foo1.png');
            $image2->toPng()->save('images/foo2.png');
            // Вывод изображения (пример)
            return 0;
        }

        return response()->json(['error' => 'Invalid file'], 400);

        // // Оригинальный размер 700x700
        // $image700 = Image::make($image)->fit(700, 700);
        // $image700->save(public_path('images/700x700_' . $image->getClientOriginalName()));

        // // Размер 400x400
        // $image400 = Image::make($image)->fit(400, 400);
        // $image400->save(public_path('images/400x400_' . $image->getClientOriginalName()));

        // // Размер 200x200
        // $image200 = Image::make($image)->fit(200, 200);
        // $image200->save(public_path('images/200x200_' . $image->getClientOriginalName()));

        return "Изображения успешно обработаны и сохранены.";
    }
    public function ImageAddMicro(Request $request)
    {
        // Получаем загруженное изображение

        $manager = new ImageManager(Driver::class);

        for ($i = 1; $i < 420; $i++) {

            for ($a = 0; $a < 15; $a++) {
                if (file_exists("images/product/" . $i . "_" . $a . "_small.webp")) {

                    $file = $manager->read("images/product/" . $i . "_" . $a . "_small.webp"); // 800 x 600

                    $file->scale(height: 200)->scale(width: 200); //  400 x 300

                    $file->toWebp()->save("images/product/" . $i . "_" . $a . "_small.webp");
                    Log::channel('custom_log')->info("images/product/" . $i . "_" . $a . "_small.webp");
                } else break;
            }
        }

        return 0;
        // // Оригинальный размер 700x700
        // $image700 = Image::make($image)->fit(700, 700);
        // $image700->save(public_path('images/700x700_' . $image->getClientOriginalName()));

        // // Размер 400x400
        // $image400 = Image::make($image)->fit(400, 400);
        // $image400->save(public_path('images/400x400_' . $image->getClientOriginalName()));

        // // Размер 200x200
        // $image200 = Image::make($image)->fit(200, 200);
        // $image200->save(public_path('images/200x200_' . $image->getClientOriginalName()));


    }
}