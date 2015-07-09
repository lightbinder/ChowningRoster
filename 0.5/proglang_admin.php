<!-- The other admin file that allows a user to add more programming languages to the dropdown menu for roster_add.php -->
  <!-- This file is very similar to level_add.php, so detailed comments are included there -->

<?php require_once("includes/header-require_login.php"); ?>

<?php require_once("includes/menu.php"); ?>

<?php
/* Acquiring the new proglang sent from proglang_admin.php */
$proglang_new = $_GET['proglang_add'];
$action = $_GET['submit'];

/* Checking to see if the form has been submitted */
if($action === "Add Programming Language")
{
	/* Making sure the file exists */
	if(file_exists("proglang.txt"))
	{
		/* Opening file for appending */
		$proglang_file = fopen("proglang.txt", "a+");
		
		/* Reading file contents to string in order to check if submitted proglang is already there */
		$proglang_file_contents = fread($proglang_file, filesize("proglang.txt"));
		
		/* Checking to see if submitted proglang is already present */
		if(stripos($proglang_file_contents, $proglang_new) === false)
		{
			/* Write new proglang to file */
			fwrite($proglang_file, "\r\n" . $proglang_new);
			
			/* Success Modal trigger */
			echo "
          <!-- Modal Script -->
          <script>
            $(document).ready(function() {
              $('#add_success').modal('toggle');
            });
          </script>\n\n";
		}
		else
		{
			/* Duplicate Programming Language Modal Trigger */
			echo "
          <!-- Modal Script -->
          <script>
            $(document).ready(function() {
              $('#add_duplicate').modal('toggle');
            });
          </script>\n\n";
		}
		fclose($proglang_file);
	}
	else
	{
		/* Missing File Error Modal Trigger */
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
              <h4 class="modal-title" id="myModalLabel">New Programming Language Added</h4>
            </div>
            <div class="modal-body">
              <p>The following Programming Language has been successfully added:</p>
              <ul>
                <li><?php echo $proglang_new; ?></li>
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
              <p>This Programming Language already exists.</p>
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
              <p>Could not find file to add Programming Language to.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Form for adding a programming language -->
      <h1>Current Languages</h1>
<?php
/* Checking for the proglang.txt file */
if(file_exists("proglang.txt"))
{
	/* Displaying the current programming languages */
	echo "      <ul>\n";

	$proglang_file = fopen("proglang.txt", "r");
	while($line = fgets($proglang_file))
	{
		$line = str_replace("\r\n", "", $line);
		echo "        <li>$line</li>\n";
	}
	fclose($proglang_file);

	echo "      </ul>\n";
}
else
{
	/* Error message for inability to find file */
	echo "      <p>Could not find file to display programming languages.</p>\n";
}
?>      
      <!-- New Programming Language Form -->
      <h1>Add Programming Language</h1>
      <form action="proglang_admin.php" method="get">
        <div class="form-group">
          <label for="proglang_add">New Programming Language:</label>
          <input id="proglang_add" class="form-control" type="text" name="proglang_add" pattern="[a-zA-Z0-9\#\+]{2,64}" autocomplete="off" required />
        </div>
        <div class="form-group">
          <input class="btn btn-default" type="submit" name="submit" value="Add Programming Language" />
        </div>
      </form>

<?php require_once("includes/footer.php"); ?>