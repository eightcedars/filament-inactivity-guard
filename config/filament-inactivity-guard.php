<?php

use Illuminate\Support\Carbon;

return [
    /**
     * Determine if the plugin is enabled
     */
    'enabled' => true,

    /**
     * How long to wait before an idle session is considered inactive.
     * This value must be in seconds
     */
    'inactivity_timeout' => Carbon::SECONDS_PER_MINUTE * 14,

    /**
     * How long to show an inactive session notice before logging the user out.
     * This value must be in seconds
     *
     * Set this to null or 0 to disable the notice and log out immediately a user's session becomes inactive
     */
    'notice_timeout' => 60,

    /**
     * This package watches for a list of browser events to determine if a user is still active.
     * You may customise as desired.
     *
     * Ensure that the list is not empty
     */
    'interaction_events' => ['mousemove', 'keydown', 'click', 'scroll'],
];
