# AGENTS.md — laravel-livewire-flash-toast

## Purpose
Global toast notifications for Livewire admin apps.

## Hard rules for AI agents
1. Mount once in the admin layout: `<livewire:flash-toast />`.
2. After create/update/delete success, **always** notify:
   - Prefer `$this->dispatch('toast', message: '...', type: 'success')`
   - Or `session()->flash('success', '...')` before redirect
3. On failure, use `type: 'error'`.
4. Do **not** invent custom alert banners / `alert()` / inline green boxes for routine feedback.
5. Do **not** ask the user how to show success — use toast.
6. Keep messages short and in `APP_LOCALE` (use app translations when available).
7. Never block UX with modals for simple success messages (use toast; confirm package for destructive asks).
