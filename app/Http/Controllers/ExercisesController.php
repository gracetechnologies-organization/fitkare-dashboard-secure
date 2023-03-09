<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Exercise;
use App\Models\ExerciseRelation;
use Exception;
use Illuminate\Http\Request;

class ExercisesController extends Controller
{
    /**
     * List all data for Butt Reduce App
     * @return \Illuminate\Http\JsonResponse
     * @author Muhammad Abdullah Mirza
     */
    public function listAllDataButtReduce($cat_id)
    {
        try {
            $data = [];
            $exercises = Exercise::with('relations', 'categories', 'levels', 'programs')
                ->where('is_active', 1)
                ->whereHas('relations', function ($query) use ($cat_id) {
                    $query->where('cat_id', $cat_id);
                })
                ->orderByDesc('created_at')
                ->get();
            // dd($exercises);
            $category = Category::find($cat_id);
            foreach ($exercises as $single_exercise) {
                $category_array = [];
                $levels_array = [];
                $programs_array = [];
                $days_array = [];
                // // Relations
                // dd($single_exercise->relations[0]);
                if ($single_exercise->categories->count() != 0) {
                    foreach ($single_exercise->categories as $single_category) {
                        $category_array[] = [
                            'ex_cat_id' => $single_category->id,
                            'ex_cat_name' => $single_category->name,
                            'created_at' => $single_category->created_at,
                            'updated_at' => $single_category->updated_at,
                        ];
                    }
                } else {
                    $category_array = [];
                }
               
                // if (isset($single_exercise->categories[0])) {
                //     $category = [
                //         'ex_cat_id' => $single_exercise->categories[0]->id,
                //         'ex_cat_name' => $single_exercise->categories[0]->name,
                //         'created_at' => $single_exercise->categories[0]->created_at,
                //         'updated_at' => $single_exercise->categories[0]->updated_at,
                //     ];
                // } else {
                //     $category = [];
                // }

                // dd($single_exercise->levels->count());
                if ($single_exercise->levels->count() != 0) {
                    foreach ($single_exercise->levels as $single_level) {
                        $levels_array[] = [
                            'ex_level_id' => $single_level->id,
                            'ex_level_name' => $single_level->name,
                            'created_at' => $single_level->created_at,
                            'updated_at' => $single_level->updated_at,
                        ];
                    }
                } else {
                    $levels_array = [];
                }
                // dd($levels_array);

                if ($single_exercise->programs->count() != 0) {
                    foreach ($single_exercise->programs as $single_program) {
                        $programs_array[] = [
                            'ex_prog_id' => $single_program->id,
                            'ex_prog_name' => $single_program->name,
                            'created_at' => $single_program->created_at,
                            'updated_at' => $single_program->updated_at,
                        ];
                    }
                } else {
                    $programs_array = [];
                }
                // dd($programs_array);

                if ($single_exercise->relations->count() != 0) {
                    foreach ($single_exercise->relations as $single_relation) {
                        $days_array[] = [
                            'ex_relation_id' => $single_relation->id,
                            'ex_id' => $single_relation->ex_id,
                            'cat_id' => $single_relation->cat_id,
                            'level_id' => $single_relation->level_id,
                            'program_id' => $single_relation->program_id,
                            'from_day' => $single_relation->from_day,
                            'till_day' => $single_relation->till_day,
                            'created_at' => $single_relation->created_at,
                            'updated_at' => $single_relation->updated_at,
                        ];
                    }
                } else {
                    $days_array = [];
                }

                // $days = [
                //     'from_day' => (isset($single_exercise->relations[0]->from_day)) ? $single_exercise->relations[0]->from_day : NULL,
                //     'till_day' => (isset($single_exercise->relations[0]->till_day)) ? $single_exercise->relations[0]->till_day : NULL,
                // ];

                array_push($data, (object) 
                    [
                        'ex_id' => $single_exercise->id,
                        'ex_title' => $single_exercise->ex_name,
                        'ex_description' => $single_exercise->ex_description,
                        'ex_duration' => $single_exercise->ex_duration,
                        'video_thumbnail' => asset('storage/images/' . $single_exercise->ex_thumbnail_url),
                        'video_url_path' => asset('storage/videos/' . $single_exercise->ex_video_url),
                        'is_active' => $single_exercise->is_active,
                        'created_at' => $single_exercise->created_at,
                        'updated_at' => $single_exercise->updated_at,
                        'deleted_at' => $single_exercise->deleted_at,
                        'category' => $category,
                        'levels' => $levels_array,
                        'programs' => $programs_array,
                        'days' => $days_array
                    ]);
            }
            return response()->json([
                'data' => $data,
                'success' => 1,
                'message' => '',
            ], 200);
        } catch (Exception $error) {
            report($error);
            return response()->json([
                'data' => [],
                'success' => 0,
                'message' => $error->getMessage()
            ], 500);
        }
    }
}