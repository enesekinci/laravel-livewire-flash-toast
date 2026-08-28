<?php

namespace EnesEkinci\FlashToast\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ToastHost extends Component
{
    /** @var list<array{id: string, type: string, message: string}> */
    public array $toasts = [];

    public function mount(): void
    {
        foreach (['success', 'error', 'warning', 'info'] as $type) {
            if ($message = session()->pull($type)) {
                $this->push($type, (string) $message);
            }
        }

        if ($message = session()->pull('status')) {
            $this->push('success', (string) $message);
        }
    }

    #[On('toast')]
    public function onToast(string $message, string $type = 'success'): void
    {
        $this->push($type, $message);
    }

    #[On('notify')]
    public function onNotify(string $message, string $type = 'success'): void
    {
        $this->push($type, $message);
    }

    public function dismiss(string $id): void
    {
        $this->toasts = array_values(array_filter(
            $this->toasts,
            fn (array $toast) => $toast['id'] !== $id
        ));
    }

    protected function push(string $type, string $message): void
    {
        $type = in_array($type, ['success', 'error', 'warning', 'info'], true) ? $type : 'info';
        $message = trim($message);

        if ($message === '') {
            return;
        }

        $this->toasts[] = [
            'id' => uniqid('toast_', true),
            'type' => $type,
            'message' => $message,
        ];

        // Keep last 5
        $this->toasts = array_slice($this->toasts, -5);
    }

    public function render(): View
    {
        return view('flash-toast::livewire.host');
    }
}
