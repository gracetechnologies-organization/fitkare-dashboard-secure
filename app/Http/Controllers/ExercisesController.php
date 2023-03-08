<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\ExerciseRelation;
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
        $data = [];
        $exercises = Exercise::with('relations','categories', 'levels', 'programs')
            ->where('is_active', 1)
            ->whereHas('relations', function ($query) use ($cat_id) {
                $query->where('cat_id', $cat_id);
            })
            ->orderByDesc('created_at')
            ->get();
        // dd($exercises);
        // exit();
        foreach ($exercises as $single_exercise) {
            $levels_array = [];
            $programs_array = [];
            // // Relations
            // dd($single_exercise->relations[0]);
            if(isset($single_exercise->categories[0]))
            {
                $category = [
                    'ex_cat_id' => $single_exercise->categories[0]->id,
                    'ex_cat_name' => $single_exercise->categories[0]->name,
                    'created_at' => $single_exercise->categories[0]->created_at,
                    'updated_at' => $single_exercise->categories[0]->updated_at,
                ];
            }
            else{
                $category = [];
            }

            // dd($single_exercise->levels->count());


            // $myCollection = collect([]);
            // if($myCollection->count() == 0){
            //     echo "empty";
            // }else{
            //     echo "not empty";
            // }
            // dd($myCollection);
            
            if($single_exercise->levels->count() != 0)
            {
                foreach($single_exercise->levels as $single_level){
                    $levels_array[] = [
                        'ex_level_id' => $single_level->id,
                        'ex_level_name' => $single_level->name,
                        'created_at' => $single_level->created_at,
                        'updated_at' => $single_level->updated_at,
                    ];
                }
            }
            else{
                $levels_array = [];
            }
            // dd($levels_array);

            if($single_exercise->programs->count() != 0)
            {
                foreach($single_exercise->programs as $single_program){
                    $programs_array[] = [
                        'ex_prog_id' => $single_program->id,
                        'ex_prog_name' => $single_program->name,
                        'created_at' => $single_program->created_at,
                        'updated_at' => $single_program->updated_at,
                    ];
                }
            }
            else{
                $programs_array = [];
            }
            // dd($programs_array);

            $days = [
                'from_day' => (isset($single_exercise->relations[0]->from_day)) ? $single_exercise->relations[0]->from_day : NULL,
                'till_day' => (isset($single_exercise->relations[0]->till_day)) ? $single_exercise->relations[0]->till_day : NULL,
            ];
            
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
                    'days' => $days
                ]);
        }

        return response()->json([
            'data' => $data,
            'success' => 1,
            'message' => '',
        ], 200);

        // try {
        //     $data = [];
        //     $data = Cache::remember('listUniqueDataBackWorkout', (60*60*24) , function() use($data) {
        //             // category_id:9 == Back Muscle Workout
        //              $exercises = ArmVideoDay::select('arm_video_days.exercise_id', 'arm_exercises.exercise_title as ex_title', 'arm_exercises.exercise_desc as ex_description', 'arm_categories.id as ex_cate_id', 
        //                             'arm_categories.category_name', 'arm_levels.id as ex_level_id', 'arm_levels.level_title', 'arm_exercises.exercise_duration as ex_duration', 'arm_video_urls.video_url as video_url_path')
        //                             ->join('arm_exercises', 'arm_exercises.id', '=', 'arm_video_days.exercise_id')
        //                             ->join('arm_categories', 'arm_categories.id', '=', 'arm_exercises.category_id')
        //                             ->join('arm_levels', 'arm_levels.id', '=', 'arm_exercises.level_id')
        //                             ->join('arm_video_urls', 'arm_video_urls.exercise_id', '=', 'arm_exercises.id')
        //                             ->where('arm_exercises.category_id', '=', 9)
        //                             ->groupBy('arm_video_days.exercise_id', 'arm_exercises.exercise_title', 'arm_exercises.exercise_desc', 'arm_categories.id', 'arm_categories.category_name', 'arm_levels.id', 
        //                             'arm_levels.level_title', 'arm_exercises.exercise_duration', 'arm_video_urls.video_url')
        //                             ->get();
        //             foreach ($exercises as $exercise) {
        //                 array_push($data, (object) 
        //                     [
        //                         'ex_id' => $exercise['exercise_id'],
        //                         'ex_title' => $exercise['ex_title'],
        //                         'ex_identity' => $exercise['ex_title'] . "_" . $exercise['ex_level_id'],
        //                         'ex_description' => $exercise['ex_description'],
        //                         'ex_duration' => $exercise['ex_duration'],
        //                         'ex_cat_id' => $exercise['ex_cate_id'],
        //                         'ex_cat_name' => $exercise['category_name'],
        //                         'ex_level_id' => $exercise['ex_level_id'],
        //                         'ex_level_name' => $exercise['level_title'],
        //                         'ex_day' => 0,
        //                         'video_url_path' => url('/') . '/public/uploads/' . $exercise['video_url_path'],
        //                     ]);
        //                 }
        //         return $data;
        //     });
        //     return response()->json([
        //         'data' => $data,
        //         'success' => 1,
        //         'message' => '',
        //     ], 200);
        // } catch (\Exception $e) {
        //     report($e);
        //     return response()->json([
        //         'data' => [],
        //         'success' => 0,
        //         'message' => $e->getMessage(),
        //     ], 500);
        // }
    }
}