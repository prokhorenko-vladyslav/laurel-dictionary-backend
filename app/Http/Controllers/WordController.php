<?php

namespace App\Http\Controllers;

use App\Http\Resources\WordResource;
use App\Models\Dictionary;
use App\Models\User;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class WordController extends Controller
{
    public function index(int $dictionaryId)
    {
        $words = Word::query()
                    ->where('dictionary_id', $dictionaryId)
                    ->whereNotIn('id', User::current()->learnedWords()->pluck('id'))
                    ->with('audio')
                    ->paginate();

        return WordResource::collection($words);
    }
}
