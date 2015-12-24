<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>Directory Listing</title>
        <link rel="stylesheet" href="css/production.css">
    </head>
    <body>
        <?php

            // Open this directory 
            $myDirectory = opendir(".");

            // Get each entry
            while($entryName = readdir($myDirectory)) {
                $dirArray[] = $entryName;
            }

            // Close directory
            closedir($myDirectory);

            $parent = getcwd();

            // Print header and start table markup
            print("<header><h1>Browsing " . $parent . "</h1></header>");
            print("<main><table id='files'><thead><tr><th>Filename</th><th>Type</th><th>Size</th><th>Modified</th></tr></thead>");

            // Sort the array
            sort($dirArray);

            // Count the items
            $indexCount = count($dirArray);

            // Format the size properly
            function formatSize ($bytes) {
                if ($bytes > 99999) {
                    $bytes = $bytes . ' GB';
                } elseif ($bytes > 9999) {
                    $bytes = $bytes / 10000 . ' MB';
                } elseif ($bytes > 999) {
                    $bytes = $bytes / 1000 . ' KB';
                } elseif ($bytes > 1) {
                    $bytes = $bytes . ' bytes';
                } elseif ($bytes == 1) {
                    $bytes = $bytes . ' byte';
                } else {
                    $bytes = '0 bytes';
                }

                return $bytes;
            }

            // Loop through array and print
            for( $index = 0; $index < $indexCount; $index++ ) {

                // Declare variables for the current directory item
                $filename = $dirArray[$index];
                $filetype = filetype($dirArray[$index]);
                $size = filesize($dirArray[$index]);
                $modified = date("M j Y g:i A", filemtime($dirArray[$index]));

                $size = formatSize($size);

                // Split the filename at the "."
                list($name, $extension) = explode(".", $filename);

                // Switch block for file extension names
                switch ($extension) {
                    case "png": $extension="PNG Image"; 
                    break;
                    case "jpg": $extension="JPEG Image"; 
                    break;
                    case "svg": $extension="SVG Image"; 
                    break;
                    case "gif": $extension="GIF Image"; 
                    break;
                    case "txt": $extension="Text File"; 
                    break;
                    case "php": $extension="PHP Script"; 
                    break;
                    case "js":  $extension="Javascript File"; 
                    break;
                    case "css": $extension="CSS File"; 
                    break;
                    case "pdf": $extension="PDF Document"; 
                    break;
                    case "zip": $extension="ZIP Archive"; 
                    break;
                    
                    default: $extension=strtoupper($extension)." File"; break;
                }

                // If this item is a directory itself change the extension name and declare a class variable with the string folder
                if (is_dir($dirArray[$index])) {
                    $extension = "Folder";
                    $class = "folder";
                } else {
                    $class = "";
                }

                // Only show non hidden files by only showing them if they don't contain a "." in positions 0 or 1 of the string
                if (substr("$dirArray[$index]", 0, 1) != "."){

                    // Print the item
                    print("<tr><td class=" . $class . "><a href=" . $filename . ">$filename</a></td>");
                    print("<td>" . $extension . "</td>"); 
                    print("<td>" . $size . "</td>"); 
                    print("<td>" . $modified . "</td></tr>"); 
                }
            } 
        ?>
        <script src="js/lib/jquery-1.11.3.min.js"></script>
        <script src="js/lib/jquery.tablesorter.min.js"></script>
        <script src="js/build/global.min.js"></script>
    </body>
</html>