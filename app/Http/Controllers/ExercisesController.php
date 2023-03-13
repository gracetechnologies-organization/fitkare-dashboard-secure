<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Exercise;
use App\Models\ExerciseRelation;
use Exception;
use Illuminate\Http\Request;

class ExercisesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Custom Helper Functions Begin
    |--------------------------------------------------------------------------
    */

    /**
     * It will return the given collection
     * In a associative array format
     * @return array
     * @author Muhammad Abdullah Mirza
     */
    public function getCategoriesArray($collection): array
    {
        if ($collection->count() != 0) {
            foreach ($collection as $single_category) {
                $array[] = [
                    'id' => $single_category->id,
                    'name' => $single_category->name,
                    'created_at' => $single_category->created_at,
                    'updated_at' => $single_category->updated_at,
                ];
            }
        } else {
            $array = [];
        }
        return $array;
    }
    /**
     * It will return the given collection
     * In a associative array format
     * @return array
     * @author Muhammad Abdullah Mirza
     */
    public function getLevelsArray($collection): array
    {
        if ($collection->count() != 0) {
            foreach ($collection as $single_level) {
                $array[] = [
                    'ex_level_id' => $single_level->id,
                    'ex_level_name' => $single_level->name,
                    'created_at' => $single_level->created_at,
                    'updated_at' => $single_level->updated_at,
                ];
            }
        } else {
            $array = [];
        }
        return $array;
    }
    /**
     * It will return the given collection
     * In a associative array format
     * @return array
     * @author Muhammad Abdullah Mirza
     */
    public function getProgramsArray($collection): array
    {
        if ($collection->count() != 0) {
            foreach ($collection as $single_program) {
                $array[] = [
                    'ex_prog_id' => $single_program->id,
                    'ex_prog_name' => $single_program->name,
                    'created_at' => $single_program->created_at,
                    'updated_at' => $single_program->updated_at,
                ];
            }
        } else {
            $array = [];
        }
        return $array;
    }
    /**
     * It will return the given collection
     * In a associative array format
     * @return array
     * @author Muhammad Abdullah Mirza
     */
    public function getDaysArray($collection): array
    {
        if ($collection->count() != 0) {
            foreach ($collection as $single_relation) {
                $array[] = [
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
            $array = [];
        }
        return $array;
    }
    /*
    |--------------------------------------------------------------------------
    | Custom Helper Functions End
    |--------------------------------------------------------------------------
    */

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
            foreach ($exercises as $single_exercise) {
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
                        'category' => Category::find($cat_id),
                        'levels' => $this->getLevelsArray($single_exercise->levels),
                        'programs' => $this->getProgramsArray($single_exercise->programs),
                        'days' => $this->getDaysArray($single_exercise->relations)
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
    /**
     * List all data for Neck Workout App
     * @return \Illuminate\Http\JsonResponse
     * @author Muhammad Abdullah Mirza
     */
    public function listAllDataNeckWorkout()
    {
        try {
            $data = [];
            $exercises = Exercise::with('relations', 'categories', 'levels', 'programs')
                ->where('is_active', 1)
                ->whereHas('relations', function ($query) {
                    $query->whereIn('cat_id', [10, 11, 12]);
                })
                ->orderByDesc('created_at')
                ->get();
            // dd($exercises);
            foreach ($exercises as $single_exercise) {
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
                        'category' => $this->getCategoriesArray($single_exercise->categories),
                        'programs' => $this->getProgramsArray($single_exercise->programs),
                    ]);
            }
            return response()->json([
                'data' => $data,
                'success' => 1,
                'message' => ''
            ]);
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