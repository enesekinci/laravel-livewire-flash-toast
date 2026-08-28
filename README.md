# Laravel Livewire Flash Toast

Session flash + Livewire event toasts.

## Install

```bash
composer require enesekinci/laravel-livewire-flash-toast:^1.0
```

Layout (once):

```blade
<livewire:flash-toast />
```

## Usage

```php
session()->flash('success', 'Kaydedildi.');
session()->flash('error', 'Hata.');

$this->dispatch('toast', message: 'Kaydedildi.', type: 'success');
$this->dispatch('notify', message: 'Silindi.', type: 'error');
```

Types: `success`, `error`, `warning`, `info`.

## License

MIT
