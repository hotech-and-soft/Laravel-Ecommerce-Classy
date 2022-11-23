<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Model;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SelectStatus extends Component
{
    public Model $model;

    use LivewireAlert;

    public $field;

    public $status;

    public $uniqueId;

    protected $listeners = ['updating'];

    public function mount()
    {
        $this->status = (bool) $this->model->getAttribute($this->field);
        $this->uniqueId = uniqid();
    }

    public function updating($field, $value)
    {
        $this->model->setAttribute($this->field, $value)->save();

        $this->alert('success', __('Status Changed successfully!'), [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
            'text' => '',
            'showDenyButton' => false,
            'onDenied' => '',
        ]);
    }

    public function render()
    {
        return view('livewire.select-status');
    }
}
