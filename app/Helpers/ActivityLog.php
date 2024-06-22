<?php
namespace App\Helpers;

use App\Models\ActivityLog;

function SystemLog($action_group, $action, $comment, $ip)
{
    $log = new ActivityLog;
    $log->user_id = \Auth::user()->id;
    $log->action_group = "$action_group";
    $log->action = $action;
    $log->remote_address = $ip;
    $log->comment = $comment;
    $log->status = 1;
    $log->save();
}
