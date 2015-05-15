
<?php global $user; if ($messages && $user->uid == 1): ?>
  <div id="messages"><div class="section clearfix">
    <?php print $messages; ?>
  </div></div> <!-- /.section, /#messages -->
<?php endif; ?>

<?php print render($page['content']); ?>