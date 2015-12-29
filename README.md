
#directory_list

###List files within a directory using PHP

Place these files within any directory you wish to view the contents of, such as a local sites directory.

Initially inspired by [a css-tricks blog post](https://css-tricks.com/snippets/php/display-styled-directory-contents/), though the script has been rewritten to work with later versions of PHP.

###Hiding these files within the directory 

Add a "." to the begining of the files, .index.php for example, to make the files hidden and left out of the list. 

When the files are hidden, you may also want to update the DirectoryIndex in your .htaccess file to prefer the hidden index over the visible index.

[jQuery](https://jquery.com/) + [Tablesorter](https://github.com/christianbach/tablesorter) are included for sorting the tables.

###Screenshot

![Screenshot](/screenshot.jpg?raw=true)
