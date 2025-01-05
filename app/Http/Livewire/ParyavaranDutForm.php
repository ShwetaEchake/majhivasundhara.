<?php

namespace App\Http\Livewire;

use App\Models\ContestentPd;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\ParyavaranDutImport;
use App\Models\User;
use Illuminate\Support\Facades\{Auth, DB, Log, Validator};
use Maatwebsite\Excel\Facades\Excel;


class ParyavaranDutForm extends Component
{
    use WithFileUploads;

    protected $listeners = ['refreshComponent' => 'renderableProperties'];

    public $isEditable = 0;
    public $formCount = 1;
    // FORM PROPERTIES
    public $name;
    public $age;
    public $gender;
    public $activity;
    public $image;
    public $hidden_image;
    public $hidden_id;
    public $is_submitted;
    public $excel_file;

    public function render()
    {
        return view('livewire.paryavaran-dut-form');
    }

    public function mount()
    {
        $this->renderableProperties();
    }

    public function submitForm()
    {
        if($this->name == null)
        {
            if($this->is_submitted == 1)
                return $this->emitTo('preview-contest-form', 'switchTab', 0);
            else
                return $this->emitTo('contest-form', 'switchTab', 0);
        }

        $this->addValidate(array_keys($this->name));

        if ($this->isEditable)
        {
            try
            {
                DB::beginTransaction();
                ContestentPd::where('user_id', Auth::user()->id)->delete();
                foreach (array_keys($this->name) as $i => $key)
                {
                    if($i > 10 )
                        continue;

                    ContestentPd::create([
                            'user_id' => Auth::user()->id,
                            'name' => $this->name[$key],
                            'age' => $this->age[$key],
                            'gender' => $this->gender[$key],
                            'activity' => $this->activity[$key],
                            'attached_file' => array_key_exists($key, $this->image ?? []) ? '/storage/user_files/'.$this->image[$key]->store('', 'user_files') : $this->hidden_image[$key],
                        ]);
                }
                DB::commit();

                // $this->dispatchBrowserEvent('swal:modal', ['type' => 'success', 'text' => 'तुमचा फॉर्म सबमिट केला गेला आहे']);
                $this->emitTo('contest-form', 'switchTab', 0);
            }
            catch (Exception $e)
            {
                Log::info($e);
                $this->dispatchBrowserEvent('swal:modal', ['type' => 'error', 'text' => 'तुमचा फॉर्म सबमिट करताना काहीतरी चूक झाली.']);
            }
        }
        else
        {
            try
            {
                DB::beginTransaction();
                ContestentPd::where('user_id', Auth::user()->id)->delete();
                foreach (array_keys($this->name) as $i =>  $key)
                {
                    if($i > 10 )
                        continue;

                    ContestentPd::create([
                        'user_id' => Auth::user()->id,
                        'name' => $this->name[$key],
                        'age' => $this->age[$key],
                        'gender' => $this->gender[$key],
                        'activity' => $this->activity[$key],
                        'attached_file' => array_key_exists($key, $this->image ?? []) ? '/storage/user_files/'.$this->image[$key]->store('', 'user_files') : '',
                    ]);
                }
                DB::commit();

                // $this->dispatchBrowserEvent('swal:modal', ['type' => 'success', 'text' => 'तुमचा फॉर्म सबमिट केला गेला आहे']);
                $this->emitTo('contest-form', 'switchTab', 0);
            }
            catch (Exception $e)
            {
                Log::info($e);
                $this->dispatchBrowserEvent('swal:modal', ['type' => 'error', 'text' => 'तुमचा फॉर्म सबमिट करताना काहीतरी चूक झाली.']);
            }
        }

    }

    public function add()
    {
        if($this->formCount < 10)
            $this->formCount++;
    }
    public function remove($id)
    {
        if($this->formCount > 1)
            $this->formCount--;

        if($id)
        {
            DB::table('contestent_pds')->where('id', $id)->delete();
            $this->renderableProperties();
        }
    }

    public function nextTab()
    {
        $this->submitForm();
        if($this->is_submitted == 1)
            return $this->emitTo('preview-contest-form', 'switchTab', 0);
        else
            return $this->emitTo('contest-form', 'switchTab', 0);
    }


    public function addValidate($idArray)
    {
        if ($this->isEditable)
        {
            $this->resetErrorBag();
            $fieldArray = [];
            $messageArray = [];
            foreach ($idArray as $id)
            {
                $fieldArray['name.' . $id] = 'required';
                $fieldArray['age.' . $id] = 'required';
                $fieldArray['gender.' . $id] = 'required';
                $fieldArray['activity.' . $id] = 'required';
                if (!array_key_exists($id, $this->hidden_image)) {
                    $fieldArray['image.' . $id] = 'required';
                    $messageArray['image.' . $id . '.required'] = 'Please upload image';
                }

                $messageArray['name.' . $id . '.required'] = 'Please select name';
                $messageArray['age.' . $id . '.required'] = 'Please enter age';
                $messageArray['gender.' . $id . '.required'] = 'Please enter gender';
                $messageArray['activity.' . $id . '.required'] = 'Please enter activity';
            }
            $validator = Validator::make(
                [
                    'name' => $this->name,
                    'age' => $this->age,
                    'gender' => $this->gender,
                    'activity' => $this->activity,
                    'image' => $this->image,
                ],
                $fieldArray,
                $messageArray
            );
            if ($validator->fails()) {
                $this->dispatchBrowserEvent('validate:scroll-to', [ 'query' => '[name="'.$validator->errors()->keys()[0].'"]'  ]);
            }
            $validator->validate();
        }
        else
        {
            $this->resetErrorBag();
            $fieldArray = [];
            $messageArray = [];
            foreach ($idArray as $id)
            {
                $fieldArray['name.' . $id] = 'required';
                $fieldArray['age.' . $id] = 'required';
                $fieldArray['gender.' . $id] = 'required';
                $fieldArray['activity.' . $id] = 'required';
                $fieldArray['image.' . $id] = 'required';

                $messageArray['name.' . $id . '.required'] = 'Please enter name';
                $messageArray['age.' . $id . '.required'] = 'Please enter age';
                $messageArray['gender.' . $id . '.required'] = 'Please enter age';
                $messageArray['activity.' . $id . '.required'] = 'Please enter activity';
                $messageArray['image.' . $id . '.required'] = 'Please select image';
            }

            $validator = Validator::make(
                [
                    'name' => $this->name,
                    'age' => $this->age,
                    'gender' => $this->gender,
                    'activity' => $this->activity,
                    'image' => $this->image,
                ],
                $fieldArray,
                $messageArray
            );
            if ($validator->fails())
            {
                $this->dispatchBrowserEvent('validate:scroll-to', [ 'query' => '[name="'.$validator->errors()->keys()[0].'"]'  ]);
            }
            $validator->validate();
        }
    }

    public function updatedExcelFile()
    {
        $path = $this->excel_file->store('files');
        User::where('id', Auth::user()->id)->update(['excel_path' => $path]);
        // Excel::import(new ParyavaranDutImport, $this->excel_file->store('files'));
        $this->emit('refreshComponent');
        $this->dispatchBrowserEvent('swal:modal', ['type' => 'success', 'text' => 'पर्यावरण दूत एक्सेल यशस्वीरित्या अपलोड केले.']);
    }




    public function renderableProperties()
    {
        $contestentPds = ContestentPd::where('user_id', Auth::user()->id)->get();
        $this->is_submitted = auth()->user()->is_submitted;

        if ($contestentPds->isNotEmpty())
        {
            $this->isEditable = 1;
            $this->formCount = $contestentPds->count();

            $this->hidden_id = [];
            $this->name = [];
            $this->age = [];
            $this->gender = [];
            $this->activity = [];
            $this->hidden_image = [];

            foreach ($contestentPds as $key => $contestentPd)
            {
                $this->hidden_id[$key+1] = $contestentPd->id;
                $this->name[$key+1] = $contestentPd->name;
                $this->age[$key+1] = $contestentPd->age;
                $this->gender[$key+1] = $contestentPd->gender;
                $this->activity[$key+1] = $contestentPd->activity;
                $this->hidden_image[$key+1] = $contestentPd->attached_file;
            }
        }
    }
}

