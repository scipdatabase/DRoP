<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set('Asia/Kolkata');
$counter_file = __DIR__ . '/visitor_count.txt';

// Ensure file exists
if (!file_exists($counter_file)) {
    file_put_contents($counter_file, '0');
}

// 1. INCREMENT LOGIC WITH FILE LOCKING (Prevents Data Corruption)
if (!isset($_SESSION['has_counted_visit'])) {
    $fp = fopen($counter_file, "r+");
    if (flock($fp, LOCK_EX)) { // Lock the file so no other process can touch it
        $count = (int)fread($fp, filesize($counter_file) ?: 1);
        $count++;

        ftruncate($fp, 0);      // Clear file
        rewind($fp);           // Move pointer to start
        fwrite($fp, $count);   // Write new count
        fflush($fp);            // Flush output
        flock($fp, LOCK_UN);    // Unlock file

        $visitor_count = $count;
        $_SESSION['has_counted_visit'] = true;
    }
    fclose($fp);
} else {
    // Just read the value if already counted this session
    $visitor_count = (int)file_get_contents($counter_file);
}

// 2. GEOLOCATION LOGIC (Optimized with a timeout)
$visitor_ip = $_SERVER['REMOTE_ADDR'];
$current_visitor_country = "India"; // Default fallback

// Use a context with a timeout so a slow API doesn't hang your portal load
$ctx = stream_context_create(['http' => ['timeout' => 2]]);
$api_response = @file_get_contents("http://ip-api.com/json/{$visitor_ip}", false, $ctx);

if ($api_response) {
    $api_data = json_decode($api_response);
    if ($api_data && $api_data->status == 'success') {
        $current_visitor_country = $api_data->country;
    }
}
