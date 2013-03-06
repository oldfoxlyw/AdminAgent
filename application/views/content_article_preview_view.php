<div id="content">
    <div id="main">
    
        <h1><?php echo $result->news_title; ?></h1>
        <div class="pad20">
        	<?php echo $result->news_content; ?>
        </div>
        
    </div>
</div>
<script language="javascript">
$(function() {
	$("#newsStatus").change(function() {
		window.location = '<?php echo $root_path; ?>content/articles/lists?status=' + $(this).val();
	});
});
</script>