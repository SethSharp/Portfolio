<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use Illuminate\Support\Facades\Notification;
use App\Domain\Blog\Notifications\NotifySlackOfContactNotification;

class Footer extends Component
{
    public $email = '';
    public $name = '';
    public $message = '';

    protected function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:999'],
            'name' => ['required', 'string', 'max:999'],
            'message' => ['required', 'string', 'max:999'],
        ];
    }

    public function send(): void
    {
        $this->validate();

        Notification::route('slack', config('services.slack.notifications.webhook'))
            ->notify(new NotifySlackOfContactNotification($this->email, $this->name, $this->message));

        $this->email = '';
        $this->name = '';
        $this->message = '';

        session()->flash('success', 'Message sent successfully.');
    }

    public function render(): View
    {
        return view('livewire.footer');
    }
}
