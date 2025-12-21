<?php

// Minimal constants config used by legacy blades/controllers.
// You can expand this later (or load from DB) without changing controller logic.

return [
    // State => list of cities
    'state' => [
        'Delhi' => ['New Delhi', 'Dwarka', 'Rohini', 'Saket'],
        'Jammu & Kashmir' => ['Jammu', 'Srinagar', 'Anantnag', 'Baramulla'],
        'Punjab' => ['Amritsar', 'Ludhiana', 'Jalandhar', 'Patiala'],
        'Haryana' => ['Gurugram', 'Faridabad', 'Panipat', 'Hisar'],
        'Uttar Pradesh' => ['Lucknow', 'Kanpur', 'Varanasi', 'Noida'],
        'Maharashtra' => ['Mumbai', 'Pune', 'Nagpur', 'Nashik'],
        'Gujarat' => ['Ahmedabad', 'Surat', 'Vadodara', 'Rajkot'],
        'Rajasthan' => ['Jaipur', 'Jodhpur', 'Udaipur', 'Kota'],
        'Madhya Pradesh' => ['Bhopal', 'Indore', 'Gwalior', 'Jabalpur'],
        'Bihar' => ['Patna', 'Gaya', 'Bhagalpur', 'Muzaffarpur'],
    ],

    // Generic publish status dropdown used by legacy forms.
    'pagestatus' => [
        'Published' => 'Published',
        'Draft' => 'Draft',
        'Pending' => 'Pending',
    ],
];
