<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use Illuminate\Support\Facades\Notification;
use App\Domain\Blog\Notifications\NotifySlackOfContactNotification;

class Footer extends Component
{
    public $name = '';
    public $subject = '';
    public $content = '';

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:999'],
            'subject' => ['required', 'string', 'max:999'],
            'content' => ['required', 'string', 'max:999'],
        ];
    }

    public function send(): void
    {
        $this->validate();

        Notification::route('slack', config('services.slack.notifications.webhook'))
            ->notify(new NotifySlackOfContactNotification($this->name, $this->subject, $this->content));

        $this->name = '';
        $this->subject = '';
        $this->content = '';
    }

    public function render(): View
    {
        return view('livewire.footer');
    }
}
