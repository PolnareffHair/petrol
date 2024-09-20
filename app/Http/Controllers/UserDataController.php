<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class UserDataController extends Controller
{
    public function SetData(Request $request)
    {
        $user = Auth::user();

        // Логирование входных данных
        Log::info('Request data: ', $request->all());

        $validator = Validator::make($request->all(), [
            'phone_number' => ["nullable", 'string', 'max:18', 'unique:' . User::class],
            'email' => ["nullable", 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'name' => ["nullable", 'string', 'max:255'],
            'password' => ["nullable", Password::defaults()]
        ]);


        if ($validator->fails()) {
            // Логирование ошибок валидации
            Log::error('Validation errors: ', $validator->errors()->all());

            return response()->json([
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $fields = ['phone_number', 'name', 'email', 'password'];
        $hasChanges = false;

        foreach ($fields as $field) {
            if ($request->filled($field)) {
                if ($field === 'password') {
                    $user->password = Hash::make($request->input($field));
                } else {
                    $user->{$field} = $request->input($field);
                }
                $hasChanges = true;
            }
        }

        if (!$hasChanges) {
            // Логирование ошибки пустого запроса
            Log::warning('No fields to update');

            return response()->json(["answer" => "Запрос не содержит данных для обновления", "type" => "0"], 400);
        }

        // Сохранение данных
        $user->save(); //метод есть если что

    
        return response()->json(["answer" => "Данні успішно оновлено", "type" => "1"], 200);
    }

    public function GetFavoritesProducts(Request $request) {}
}
