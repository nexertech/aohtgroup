<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\ContactMessage;
use App\Models\JobApplication;
use App\Models\News;
use App\Models\Visitor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVisitors = Visitor::count();
        $contactMessagesCount = ContactMessage::count();
        $jobApplicationsCount = JobApplication::count();
        // $newsCount = News::where('is_published', true)->count(); // Temporarily disabled
        $newsCount = 0; // Placeholder

        $recentActivities = ActivityLog::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalVisitors',
            'contactMessagesCount',
            'jobApplicationsCount',
            'newsCount',
            'recentActivities'
        ));
    }
}
