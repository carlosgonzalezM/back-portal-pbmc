<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Birthday;
use App\Http\Requests\StoreBirthdayRequest;
use App\Http\Requests\UpdateBirthdayRequest;
use App\Http\Resources\BirthdayResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BirthdayController extends Controller
{
    public function index()
    {
        return BirthdayResource::collection(
            Birthday::query()->orderBy('id','desc')->paginate(10)
        );
    }
    public function store(StoreBirthdayRequest $request)
    {
        $data = $request->validated();
        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = Str::random(32).".".$data['image']->getClientOriginalExtension();
            Storage::disk('public')->put($imageName, file_get_contents($data['image']));
        }
        $data['image'] = $imageName;
        $birthday = Birthday::create($data);

        return response(new BirthdayResource($birthday), 201);
    }
    public function show(Birthday $birthday)
    {
        return new BirthdayResource($birthday);
    }
    public function update(UpdateBirthdayRequest $request, Birthday $birthday)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = Str::random(32) . '.' . $request->image->getClientOriginalExtension();
            Storage::disk('public')->put($imageName, file_get_contents($request->image));
            $data['image'] = $imageName;
        }
        $birthday->update($data);

        return new BirthdayResource($birthday);
    }
    public function destroy(Birthday $birthday)
    {
        $birthday->delete();
        return response("",204);
    }
    public function getBirthdayMonth()
    {
            $now = Carbon::now();

            $currentMonth = $now->month;

            $month = null;

            $birthdaysThisMonth = Birthday::query()
            ->whereMonth('date_birthday', '=', $currentMonth)
            ->orderBy('date_birthday', 'asc')
            ->get();


            switch($currentMonth){
                case(1):
                    $month = "Enero";
                    break;
                case(2):
                    $month = "Febrero";
                    break;
                case(3):
                    $month = "Marzo";
                    break;
                case(4):
                    $month = "Abril";
                    break;
                case(5):
                    $month = "Mayo";
                    break;
                case(6):
                    $month = "Junio";
                    break;
                case(7):
                    $month = "Julio";
                    break;
                case(8):
                    $month = "Agosto";
                    break;
                case(9):
                    $month = "Septiembre";
                    break;
                case(10):
                    $month = "Octubre";
                    break;
                case(11):
                    $month = "Noviembre";
                    break;
                case(12):
                    $month = "Diciembre";
                    break;
            }

        $birthdaysFormatted = $birthdaysThisMonth->map(function ($birthday) {
            return [
                'id' => $birthday->id,
                'user_id' => $birthday->user_id,
                'image' => $birthday->image,
                'full_name' => $birthday->first_name . ' ' . $birthday->last_name,
                'area' => $birthday->area,
                'date_birthday' => Carbon::parse($birthday->date_birthday)->day,
            ];
        });

            return [
                'currentMonth' => $month,
                'birthdays' => $birthdaysFormatted
            ];
    }

}
