<?php include('includes/header.php'); ?>
    <div class="container main-wrap">
    	<!-- <a class="medium-green-button" href="#">Create</a> -->
    	<section class="bundle-creation">
    		<button type="button" class="btn btn-primary btn-lg large-text btn-create-bundle"><i class="glyphicon glyphicon-plus"></i>Create a Bundle</button>

	    	<div class="btn-group step-navigator">
				  <button type="button" class="btn btn-default enabled">Group</button>
				  <button type="button" class="btn btn-default">Links</button>
				  <button type="button" class="btn btn-default">Options</button>
				  <button type="button" class="btn btn-default">Preview</button>
				</div>

    		<div id="step1" class="creation-create-group step">
    				<h3 class="group-title">Group</h3>
    				<p class="step-description">Create a group for this link, what's category does this link belong to? Example: tutorials, my favorite movies, good reads, etc</p>
    		</div>

    		<div class="creation-enter-links step">
    				<h3 class="group-title">Links</h3>
    				<p class="step-description">Enter as many links as you like, optionally set a title for this link</p>
    		</div>

    		<div class="creation-settings step">
    				<h3 class="group-title">Options</h3>
    				<p class="step-description">You may setup settings such as public/private, expiration time and edit permissions</p>
    		</div>

    		<div class="creation-preview step">
    				<h3 class="group-title">Preview</h3>
    				<p class="step-description">This is how your bundle will look like</p>
    		</div>
    	</section>
    </div> <!-- /container -->
<?php include('includes/footer.php'); ?>
