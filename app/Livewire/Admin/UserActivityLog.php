<?php

namespace App\Livewire\Admin;

use App\Models\ActivityLog;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * UserActivityLog Component - User activity log viewer
 *
 * Displays a log of user activities including create, update,
 * and delete operations on models
 *
 * @author Dapur Bunda Bahagia
 * @version 1.0
 */
class UserActivityLog extends Component
{
    use WithPagination;

    /** @var string */
    public $search = '';

    /** @var string */
    public $filterAction = '';

    /** @var string */
    public $filterDate = '';

    /**
     * Reset pagination when search or filters change
     */
    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilterAction() { $this->resetPage(); }
    public function updatingFilterDate() { $this->resetPage(); }

    /**
     * Get filtered activity logs
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    #[Computed]
    public function logs()
    {
        return ActivityLog::with('user')
            ->when($this->search, fn($q) => $q->where('description', 'like', '%' . $this->search . '%'))
            ->when($this->filterAction, fn($q) => $q->where('action', $this->filterAction))
            ->when($this->filterDate, fn($q) => $q->whereDate('created_at', $this->filterDate))
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    }

    /**
     * Get action badge color class
     *
     * @param string $action
     * @return string
     */
    public function getActionColor(string $action): string
    {
        return match($action) {
            'created' => 'bg-success/10 text-success',
            'updated' => 'bg-info/10 text-info',
            'deleted' => 'bg-error/10 text-error',
            default => 'bg-slate-100 text-slate',
        };
    }

    /**
     * Render the activity log view
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.admin.user-activity-log', [
            'logs' => $this->logs,
        ])
            ->layout('layouts.admin', [
                'title' => 'Log Aktivitas - Dapur Bunda Bahagia',
                'headerTitle' => 'Log Aktivitas',
                'headerSubtitle' => 'Riwayat aktivitas pengguna',
            ]);
    }
}