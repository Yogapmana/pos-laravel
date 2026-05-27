<?php

namespace App\Livewire\Admin;

use App\Models\ActivityLog;
use Livewire\Attributes\Computed;
use Livewire\Component;

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
    /** @var string */
    public $search = '';

    /** @var string */
    public $filterAction = '';

    /**
     * Get filtered activity logs
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    #[Computed]
    public function logs()
    {
        return ActivityLog::with('user')
            ->when($this->search, fn($q) => $q->where('description', 'like', '%' . $this->search . '%'))
            ->when($this->filterAction, fn($q) => $q->where('action', $this->filterAction))
            ->orderBy('created_at', 'desc')
            ->limit(100)
            ->get();
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