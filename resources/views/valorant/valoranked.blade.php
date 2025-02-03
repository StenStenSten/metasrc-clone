<?php

$apiKey = 'your-api-key-here';  // Replace with your API key
$url = 'https://valorant-api.com/v1/agents';

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $apiKey
]);

// Execute cURL and get the response
$response = curl_exec($ch);

// Check if there was an error
if ($response === false) {
    echo 'Error fetching data: ' . curl_error($ch);
    exit;
}

// Decode the JSON response
$data = json_decode($response, true);

// Close cURL session
curl_close($ch);

// Process the agent data
if (isset($data['data'])) {
    foreach ($data['data'] as $agent) {
        echo $agent['displayName'] . '<br>';
    }
} else {
    echo 'No agent data available.';
}

$data = json_decode($response, true);

// Close cURL session
curl_close($ch);

// Start outputting HTML
echo "<html><head><title>Valorant Agents</title></head><body>";

// Check if agent data is available
if (isset($data['data'])) {
    echo "<h1>Valorant Agents List</h1>";
    echo "<div style='display: flex; flex-wrap: wrap;'>"; // Flexbox for cards layout

    // Loop through each agent and display their information
    foreach ($data['data'] as $agent) {
        echo "<div style='width: 200px; padding: 10px; margin: 10px; border: 1px solid #ccc; border-radius: 8px; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);'>";
        
        // Display agent's display name
        echo "<h3>" . htmlspecialchars($agent['displayName']) . "</h3>";
        
        // Display agent's role
        if (isset($agent['role']['displayName'])) {
            echo "<p><strong>Role:</strong> " . htmlspecialchars($agent['role']['displayName']) . "</p>";
        }

        // Display agent's description
        if (isset($agent['description'])) {
            echo "<p><strong>Description:</strong> " . htmlspecialchars($agent['description']) . "</p>";
        }

        // Display agent's abilities
        if (isset($agent['abilities']) && count($agent['abilities']) > 0) {
            echo "<h4>Abilities:</h4><ul>";
            foreach ($agent['abilities'] as $ability) {
                echo "<li><strong>" . htmlspecialchars($ability['displayName']) . ":</strong> " . htmlspecialchars($ability['description']) . "</li>";
            }
            echo "</ul>";
        }

        echo "</div>";
    }

    echo "</div>"; // Closing flex container
} else {
    echo '<p>No agent data available.</p>';
}

echo "</body></html>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valorant Ranked</title>
</head>
<body>
    <h1>Welcome to Valorant Ranked</h1>
</body>
</html>