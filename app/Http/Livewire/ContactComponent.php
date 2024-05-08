<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use Illuminate\Support\Facades\Notification;
use App\Domain\Blog\Notifications\NotifySlackOfContactNotification;

class ContactComponent extends Component
{
    public string $email = '';
    public string $name = '';
    public string $message = '';

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email'],
            'message' => ['required', 'string', 'min:50', 'max:500'],
        ];
    }

    public function send(): void
    {
        $this->validate();

        Notification::route('slack', config('services.slack.webhook'))
            ->notify(new NotifySlackOfContactNotification($this->email, $this->name, $this->message));

        $this->email = '';
        $this->name = '';
        $this->message = '';

        session()->flash('success', 'Message sent successfully.');
    }

    public function render(): View
    {
        return view('livewire.contact-component');
    }
}
