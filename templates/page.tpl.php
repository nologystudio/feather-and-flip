	
	
        
	<?php global $user; if ($messages && $user->uid == 1): ?>
		<div id="messages">
			<div class="section clearfix">
	    		<?php print $messages; ?>
			</div>
		</div> 
	<?php endif; ?>
	
	<?php print render($page['content']); ?>