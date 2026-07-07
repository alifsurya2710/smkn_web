<?php

namespace App\Policies;

use App\Models\StudentReport;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StudentReportPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, StudentReport $studentReport): bool
    {
        return $user->id === $studentReport->student_id || $user->hasRole(['super_admin', 'admin']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, StudentReport $studentReport): bool
    {
        if ($user->hasRole('super_admin')) {
            return true;
        }

        // Guru can only edit reports of students in their own major
        if ($user->hasRole('guru')) {
            return $user->major_id === $studentReport->student->major_id;
        }

        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, StudentReport $studentReport): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, StudentReport $studentReport): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, StudentReport $studentReport): bool
    {
        return false;
    }
}
