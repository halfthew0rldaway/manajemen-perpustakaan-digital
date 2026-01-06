<?php

if (!function_exists('indonesian_timezone')) {
    /**
     * Get Indonesian timezone abbreviation based on timezone
     * 
     * @param string|null $timezone
     * @return string
     */
    function indonesian_timezone($timezone = null)
    {
        $timezone = $timezone ?? config('app.timezone');

        $timezones = [
            'Asia/Jakarta' => 'WIB',
            'Asia/Makassar' => 'WITA',
            'Asia/Jayapura' => 'WIT',
            'Asia/Pontianak' => 'WIB',
            'Asia/Ujung_Pandang' => 'WITA',
        ];

        return $timezones[$timezone] ?? 'WIB';
    }
}

if (!function_exists('format_datetime_indonesia')) {
    /**
     * Format datetime with Indonesian timezone
     * 
     * @param mixed $datetime
     * @param string $format
     * @return string
     */
    function format_datetime_indonesia($datetime, $format = 'd M Y H:i')
    {
        if (!$datetime) {
            return '-';
        }

        if (is_string($datetime)) {
            $datetime = \Carbon\Carbon::parse($datetime);
        }

        $tz = indonesian_timezone();
        return $datetime->format($format) . ' ' . $tz;
    }
}

if (!function_exists('now_indonesia')) {
    /**
     * Get current datetime with Indonesian timezone
     * 
     * @return \Carbon\Carbon
     */
    function now_indonesia()
    {
        return \Carbon\Carbon::now(config('app.timezone'));
    }
}

if (!function_exists('timezone_options')) {
    /**
     * Get Indonesian timezone options for select dropdown
     * 
     * @return array
     */
    function timezone_options()
    {
        return [
            'Asia/Jakarta' => 'WIB (Waktu Indonesia Barat)',
            'Asia/Makassar' => 'WITA (Waktu Indonesia Tengah)',
            'Asia/Jayapura' => 'WIT (Waktu Indonesia Timur)',
        ];
    }
}
