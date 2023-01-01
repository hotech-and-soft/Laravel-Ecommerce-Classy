<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Mail\ContactForm as MailContactForm;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class Contact extends Component
{
    // public Conversation $conversation;

    public $name;

    public $email;

    public $phone_number;

    public $message;

    protected $listeners = [
        'submit',
    ];

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->phone_number = '';
        $this->message = '';
    }

    public function mount()
    {
        // $this->conversation = $conversation;
    }


    public function render(): View|Factory
    {
        return view('livewire.front.contact');
    }

    protected $rules = [
        'conversation.name'         => 'required',
        'conversation.email'        => 'required|email',
        'conversation.phone_number' => 'required',
        'conversation.message'      => 'required',
    ];

    public function submit()
    {
        $this->validate();

        $this->conversation->save();

        // $this->alert('success', __('Your Message is sent succesfully.') );

        $this->resetInputFields();

        // $user = User::find(1);
        // $user_email = $user->email;
        // Mail::to($user_email)->send(new MailContactForm($contact));
    }
}
