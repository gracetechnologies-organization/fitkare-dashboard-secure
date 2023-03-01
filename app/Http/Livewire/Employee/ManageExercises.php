<?php

namespace App\Http\Livewire\Employee;

use App\Models\Category;
use App\Models\Exercise;
use App\Models\ExerciseRelation;
use App\Models\Level;
use App\Models\Program;
use Carbon\Carbon;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ManageExercises extends Component
{
    use WithPagination;
    use WithFileUploads;

    public
    $ex_id,
    $ex_name,
    $ex_description,
    $ex_duration,
    $ex_thumbnail_url,
    $ex_thumbnail,
    $ex_video_url,
    $ex_video,
    $ex_category_id,
    $ex_level_id,
    $ex_program_id,
    $ex_from_day,
    $ex_till_day,
    $meta_info = [],
    $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'ex_name' => 'required|string|unique:exercises,ex_name',
        'ex_description' => 'required|string',
        'ex_duration' => 'required|integer|numeric',
        'ex_thumbnail' => 'required|image|max:100',
        'ex_video' => 'required|mimetypes:video/mp4|max:1024',
        // 'ex_category_id' => 'required|integer|numeric',
        // 'ex_level_id' => 'integer|numeric',
        // 'ex_program_id' => 'integer|numeric',
        // 'ex_from_day' => 'integer|numeric',
        // 'ex_till_day' => 'integer|numeric',
        'meta_info.*.ex_category_id' => 'required|integer|numeric',
        'meta_info.*.ex_level_id' => 'integer|numeric',
        'meta_info.*.ex_program_id' => 'integer|numeric',
        'meta_info.*.ex_from_day' => 'integer|numeric',
        'meta_info.*.ex_till_day' => 'integer|numeric',
    ];

    protected $messages = [
        /*
        |--------------------------------------------------------------------------
        | ex_name error messages
        |--------------------------------------------------------------------------
        */
        'ex_name.required' => 'Mere bhai exercise name must hai 😒',
        'ex_name.unique' => 'Yar unique data daal bhangra na daal 😒',
        'ex_name.alpha' => 'Jigar special characters accept nahi hon gy 🙂',
        /*
        |--------------------------------------------------------------------------
        | ex_description error messages
        |--------------------------------------------------------------------------
        */
        'ex_description.required' => 'Mere bhai description must hai 😒',
        /*
        |--------------------------------------------------------------------------
        | ex_duration error messages
        |--------------------------------------------------------------------------
        */
        'ex_duration.required' => 'Mere bhai duration must hai 😒',
        'ex_duration.integer' => 'khabrdar jo digits k siwa kuch dala 😡',
        /*
        |--------------------------------------------------------------------------
        | ex_thumbnail error messages
        |--------------------------------------------------------------------------
        */
        'ex_thumbnail.required' => 'Mere bhai thumbnail must hai 😒',
        'ex_thumbnail.image' => 'Yaar image daal dimag na kharab kr 😒',
        'ex_thumbnail.max' => 'Mai srif 100KB ki image upload krne dnga 🥳',
        /*
        |--------------------------------------------------------------------------
        | ex_video error messages
        |--------------------------------------------------------------------------
        */
        'ex_video.required' => 'Mere bhai video must hai 😒',
        'ex_video.mimetypes' => 'Bhai sahab video sirf .mp4 honi chahiye 😒',
        'ex_video.max' => 'Mai srif 1MB tk ki video upload krne dnga 🥳',
        /*
        |--------------------------------------------------------------------------
        | ex_category_id error messages
        |--------------------------------------------------------------------------
        */
        'ex_category_id.required' => 'Mere bhai category must hai 😒',
        'ex_category_id.integer' => 'khabrdar jo digits k siwa kuch dala 😡',
        /*
        |--------------------------------------------------------------------------
        | ex_level_id error messages
        |--------------------------------------------------------------------------
        */
        'ex_level_id.integer' => 'khabrdar jo digits k siwa kuch dala 😡',
        /*
        |--------------------------------------------------------------------------
        | ex_program_id error messages
        |--------------------------------------------------------------------------
        */
        'ex_program_id.integer' => 'khabrdar jo digits k siwa kuch dala 😡',
        /*
        |--------------------------------------------------------------------------
        | ex_days error messages
        |--------------------------------------------------------------------------
        */
        'ex_from_day.integer' => 'khabrdar jo digits k siwa kuch dala 😡',
        'ex_till_day.integer' => 'khabrdar jo digits k siwa kuch dala 😡',

        'meta_info.*.ex_category_id.required' => 'Mere bhai category must hai 😒',
        'meta_info.*.ex_level_id.integer' => 'khabrdar jo digits k siwa kuch dala 😡',
        'meta_info.*.ex_program_id.integer' => 'khabrdar jo digits k siwa kuch dala 😡',
        'meta_info.*.ex_from_day.integer' => 'khabrdar jo digits k siwa kuch dala 😡',
        'meta_info.*.ex_till_day.integer' => 'khabrdar jo digits k siwa kuch dala 😡',
    ];

    public function mount()
    {
        /*
        |--------------------------------------------------------------------------
        | Assigning values to the '0' index of $meta_info array so that it can work 
        | Every time the page re-renders from the begining 
        |--------------------------------------------------------------------------
        */
        $this->meta_info = [
            [
                'ex_category_id' => '',
                'ex_level_id' => '',
                'ex_program_id' => '',
                'ex_from_day' => '',
                'ex_till_day' => '',
            ]
        ];
    }

    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    public function resetModal()
    {
        $this->resetAllErrors();
        $this->ex_id = '';
        $this->ex_name = '';
        $this->ex_description = '';
        $this->ex_duration = '';
        $this->ex_thumbnail_url = '';
        $this->ex_thumbnail = '';
        $this->ex_video_url = '';
        $this->ex_video = '';
        $this->ex_category_id = '';
        $this->ex_level_id = '';
        $this->ex_program_id = '';
        $this->ex_from_day = '';
        $this->ex_till_day = '';
        unset($this->meta_info);
        /*
        |--------------------------------------------------------------------------
        | Again assigning values to the '0' index of $meta_info array so that it  
        | Will not through any error while opening the modal 
        |--------------------------------------------------------------------------
        */
        $this->meta_info = [
            [
                'ex_category_id' => '',
                'ex_level_id' => '',
                'ex_program_id' => '',
                'ex_from_day' => '',
                'ex_till_day' => '',
            ]
        ];
    }

    public function resetAllErrors()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function renderEditModal($id)
    {
        $exercise_data = Exercise::find($id);
        $relations_data = Exercise::select('exercise_relations.id as rel_id', 'exercises.id as ex_id', 'exercises.ex_name', 'categories.id as cat_id', 'categories.name as cat_name', 'levels.id as level_id', 'levels.name as level_name', 'programs.id as program_id', 'programs.name as program_name', 'exercise_relations.from_day', 'exercise_relations.till_day')
            ->leftJoin('exercise_relations', 'exercise_relations.ex_id', '=', 'exercises.id')
            ->leftJoin('categories', 'categories.id', '=', 'exercise_relations.cat_id')
            ->leftJoin('levels', 'levels.id', '=', 'exercise_relations.level_id')
            ->leftJoin('programs', 'programs.id', '=', 'exercise_relations.program_id')
            ->where('exercises.id', $id)
            ->get();
        // dd($data);
        if ($exercise_data && $relations_data) {
            $this->ex_id = $exercise_data->id;
            $this->ex_name = $exercise_data->ex_name;
            $this->ex_description = $exercise_data->ex_description;
            $this->ex_duration = $exercise_data->ex_duration;
            $this->ex_thumbnail_url = $exercise_data->ex_thumbnail_url;
            $this->ex_video_url = $exercise_data->ex_video_url;
            foreach ($relations_data as $singel_index => $value) {
                $this->meta_info[$singel_index] = [
                    'ex_category_id' => $value['cat_id'],
                    'ex_level_id' => $value['level_id'],
                    'ex_program_id' => $value['program_id'],
                    'ex_from_day' => $value['from_day'],
                    'ex_till_day' => $value['till_day'],
                ];
            }
            // dd($this->meta_info);
        } else {
            return redirect()->to(route('emp.exercises'))->with('error', 'Record Not Found.');
        }
    }

    public function renderDeleteModal($id)
    {
        $this->ex_id = $id;
    }

    public function add()
    {
        $this->validate();
        try {
            /* Perform some operation */
            $inserted_exercise = Exercise::create([
                'ex_name' => $this->ex_name,
                'ex_description' => $this->ex_description,
                'ex_duration' => $this->ex_duration,
                'ex_thumbnail_url' => $this->getImgURL(),
                'ex_video_url' => $this->getVideoURL(),
            ]);
            foreach ($this->meta_info as $singel_index) {
                $inserted_relations = ExerciseRelation::create([
                    'ex_id' => $inserted_exercise->id,
                    'cat_id' => $singel_index['ex_category_id'],
                    'level_id' => (!empty($singel_index['ex_level_id'])) ? $singel_index['ex_level_id'] : NULL,
                    'program_id' => (!empty($singel_index['ex_program_id'])) ? $singel_index['ex_program_id'] : NULL,
                    'from_day' => (!empty($singel_index['ex_from_day'])) ? $singel_index['ex_from_day'] : NULL,
                    'till_day' => (!empty($singel_index['ex_till_day'])) ? $singel_index['ex_till_day'] : NULL,
                ]);
            }
            /* Operation finished */
            $this->resetModal();
            sleep(1);
            $this->dispatchBrowserEvent('close-modal', ['id' => 'addModal']);
            if ($inserted_relations) {
                session()->flash('success', config('messages.INSERTION_SUCCESS'));
            } else {
                session()->flash('error', config('messages.INSERTION_FAILED'));
            }
        } catch (Exception $error) {
            report($error);
            session()->flash('error', config('messages.INVALID_DATA'));
        }
    }

    public function edit()
    {
        dd("Under Development");
        $this->validate();
        try {
            /* Perform some operation */
            // $updated = Exercise::find($this->ex_id);
            $exercise_updated = Exercise::where('id', '=', $this->ex_id)
                ->update([
                    'ex_name' => $this->ex_name,
                    'ex_description' => $this->ex_description,
                    'ex_duration' => $this->ex_duration,
                    'ex_thumbnail_url' => $this->ex_thumbnail_url,
                    'ex_video_url' => $this->ex_video_url,
                ]);
            // dd($exercise_updated->id);
            foreach ($this->meta_info as $singel_index) {
                $inserted_relations = ExerciseRelation::create([
                    'ex_id' => $this->ex_id,
                    'cat_id' => $singel_index['ex_category_id'],
                    'level_id' => (!empty($singel_index['ex_level_id'])) ? $singel_index['ex_level_id'] : NULL,
                    'program_id' => (!empty($singel_index['ex_program_id'])) ? $singel_index['ex_program_id'] : NULL,
                    'from_day' => (!empty($singel_index['ex_from_day'])) ? $singel_index['ex_from_day'] : NULL,
                    'till_day' => (!empty($singel_index['ex_till_day'])) ? $singel_index['ex_till_day'] : NULL,
                ]);
            }
            // 'ex_name' => $this->ex_name,
            // 'ex_description' => $this->ex_description,
            // 'ex_duration' => $this->ex_description,
            // 'ex_thumbnail_url' => $this->ex_description,
            // 'ex_video_url' => $this->ex_description,
            // $this->ex_category_id = '';
            // $this->ex_level_id = '';
            // $this->ex_program_id = '';
            // $this->ex_from_day = '';
            // $this->ex_till_day = '';

            /* Operation finished */

            // Check if the update was successful
            /*  */
            if ($exercise_updated->wasChanged()) {
                dd("updated");
            } else {
                dd("not updated");
            }
            /*  */
            $this->resetModal();
            sleep(1);
            $this->dispatchBrowserEvent('close-modal', ['id' => 'editModal']);
            if ($updated) {
                session()->flash('success', config('messages.UPDATION_SUCCESS'));
            } else {
                session()->flash('error', config('messages.UPDATION_FAILED'));
            }
        } catch (Exception $error) {
            report($error);
            session()->flash('error', config('messages.INVALID_DATA'));
        }
    }

    public function destroy()
    {
        try {
            /* Perform some operation */
            $soft_deleted = Exercise::where('id', '=', $this->ex_id)
                ->update([
                    'is_active' => 0,
                    'deleted_at' => Carbon::now()
                ]);
            // $soft_deleted = Exercise::find($this->ex_id)->delete();
            /* Operation finished */
            sleep(1);
            $this->dispatchBrowserEvent('close-modal', ['id' => 'deleteModal']);
            if ($soft_deleted) {
                session()->flash('success', config('messages.DELETION_SUCCESS'));
            } else {
                session()->flash('error', config('messages.DELETION_FAILED'));
            }
        } catch (Exception $error) {
            report($error);
            session()->flash('error', config('messages.INVALID_DATA'));
        }
    }

    public function getImgURL()
    {
        $this->ex_thumbnail_url = Carbon::now()->timestamp . "_" . $this->ex_thumbnail->getClientOriginalName();
        /*
        |--------------------------------------------------------------------------
        | Save the image to the default storage path "storage/app/public/images"
        |--------------------------------------------------------------------------
        */
        $this->ex_thumbnail->storeAs('public/images', $this->ex_thumbnail_url);
        return $this->ex_thumbnail_url;
    }

    public function getVideoURL()
    {
        $this->ex_video_url = Carbon::now()->timestamp . "_" . $this->ex_video->getClientOriginalName();
        /*
        |--------------------------------------------------------------------------
        | Save the video to the default storage path "storage/app/public/videos"
        |--------------------------------------------------------------------------
        */
        $this->ex_video->storeAs('public/videos', $this->ex_video_url);
        return $this->ex_video_url;
    }

    public function addMetaInfoRow()
    {
        /*
        |--------------------------------------------------------------------------
        | The following code will add a new index into the array  
        | It will also add an empty associative array on that newly created index 
        |--------------------------------------------------------------------------
        */
        $this->meta_info[] = [
            'ex_category_id' => '',
            'ex_level_id' => '',
            'ex_program_id' => '',
            'ex_from_day' => '',
            'ex_till_day' => '',
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = Exercise::where('ex_name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $categories = Category::orderBy('name', 'asc')->get();
        $levels = Level::orderBy('name', 'asc')->get();
        $programs = Program::orderBy('name', 'asc')->get();
        ///*  */ 
        // $exercise = Exercise::find(19);

        // // Get all exercise relations
        // $relations = $exercise->relations;

        // // Get all categories related to the exercise
        // $categories = $exercise->categories;

        // // Get all levels related to the exercise
        // $levels = $exercise->levels;

        // // Get all programs related to the exercise
        // $programs = $exercise->programs;
        // dd($relations);
        /*  */
        return view('livewire.employee.manage-exercises', ['data' => $data, 'categories' => $categories, 'levels' => $levels, 'programs' => $programs]);
    }
}