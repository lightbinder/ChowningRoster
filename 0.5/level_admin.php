<!-- This page is one of the admin pages that will be locked in future versions -->

<?php require_once("includes/header-require_login.php"); ?>

<?php require_once("includes/menu.php"); ?>

<?php
/* Acquiring the new level sent from level_admin.php */
$level_new = $_GET['level_add'];

/* Checks if the user has submitted the form */
$action = $_GET['submit'];

/* Checking to see if the form has been submitted */
if($action == "Add Level")
{
	/* Making sure the file exists */
	if(file_exists("level.txt"))
	{
		/* Opening file for appending */
		$level_file = fopen("level.txt", "a+");
		
		/* Reading file contents to string in order to check if submitted level is already there */
		$level_file_contents = fread($level_file, filesize("level.txt"));
		
		/* Checking to see if submitted level is already present */
		if(stripos($level_file_contents, $level_new) === false)
		{
			/* Write new level to file */
			fwrite($level_file, "\r\n" . $level_new);
			
			/* Displays modal for level addition success */
			echo "
          <!-- Modal Script -->
          <script>
            $(document).ready(function() {
              $('#add_success').modal('toggle');
            });
          </script>\n\n";
		}
		
		/* Modal for duplicate level addition */
		else
		{
			echo "
          <!-- Modal Script -->
          <script>
            $(document).ready(function() {
              $('#add_duplicate').modal('toggle');
            });
          </script>\n\n";
		}
		fclose($level_file);
	}
	
	/* Modal for missing file error */
	else
	{
		echo "
          <!-- Modal Script -->
          <script>
            $(document).ready(function() {
              $('#add_file_error').modal('toggle');
            });
          </script>\n\n";
	}
}
?>

    <!-- Modal Section -->

      <!-- Add Success Modal -->
      <div class="modal fade" id="add_success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">New Level Added</h4>
            </div>
            <div class="modal-body">
              <p>The following level has been successfully added:</p>
              <ul>
                <li><?php echo $level_new; ?></li>
              </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Duplicate Person Modal -->
      <div class="modal fade" id="add_duplicate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Error:</h4>
            </div>
            <div class="modal-body">
              <p>This level already exists.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Missing File Error Modal -->
      <div class="modal fade" id="add_file_error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Error:</h4>
            </div>
            <div class="modal-body">
              <p>Could not find file to add level to.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


      <h1>Current Levels</h1>
<?php

/* Checking to make sure the level.txt file exists before manipulating it */
if(file_exists("level.txt"))
{
	/* Printing an unordered list of current levels available */
	echo "      <ul>\n";

	/* Using file handling introduced in version 0.2 */
	$level_file = fopen("level.txt", "r");
	while($line = fgets($level_file))
	{
		$line = str_replace("\r\n", "", $line);
		echo "        <li>$line</li>\n";
	}
	fclose($level_file);

	echo "      </ul>\n";
}
else
{
	/* Error message if file can't be found */
	echo "      <p>Could not find file to display levels.</p>\n";
}
?>
      
      <!-- Form allowing submission of a new level -->
      <h1>Add Level</h1>
      <form action="level_admin.php" method="get">
        <div class="form-group">
          <label for="level_add">New Level:</label>
          <input id="level_add" class="form-control" type="text" name="level_add" pattern="[a-zA-Z0-9\#\-]{2,64}" autocomplete="off" required />
        </div>
        <div class="form-group">
          <input class="btn btn-default" type="submit" name="submit" value="Add Level" />
        </div>
      </form>

<?php require_once("includes/footer.php"); ?>