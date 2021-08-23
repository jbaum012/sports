<?php

namespace App\Http\Requests\SportsGames;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSportsGame extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'game_group_id' => 'required',
            'home_team_id' => 'required|different:away_team_id',
            'away_team_id' => 'required|different:home_team_id',
            'home_team_spread' => 'sometimes',
            'away_team_spread' => 'sometimes',
            'starts_at' => 'required',
        ];
    }
}
