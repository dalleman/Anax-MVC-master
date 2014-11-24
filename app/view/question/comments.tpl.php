
<?php if (is_array($comments)) : ?>
		<form method='post'> 
	    <input type='hidden' name="page" value="<?=$page?>"> 
	    <input type='submit' name='doDeleteAll' value='Radera Alla' onClick="this.form.action = '<?=$this->url->create('comment/deleteAll')?>'" /> 
	</form>
<div class='comments'>
<?php $color=0; ?>
<?php foreach ($comments as $id => $comment) : ?>
<div class='comment' style='overflow:auto; padding:10px; padding-bottom:30px;<?php if (($color % 2) == 0) {echo "background-color: #556A8D; color:white;";} else {echo "background-color: white;";} ?>position:relative;'>
<?php $color++; ?>
<h4 style="clear:both;">Kommentar #<?=$id?> av <span class='commentName'><?=$comment['name']?></span></h4>
<p class='commentComment' style='margin:1px;'><img style='float:left;margin-right:5px; border:solid 3px #222A38;'src="<?php echo 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($comment['mail']))) . '.jpg?s=80';?>"><?=$comment['content']?></p>
<br>
<span class='commentInfo' style='position:absolute; bottom:4px; left:10px;'><b>Websida:</b> <?=$comment['web']?> <b>Mail:</b> <?=$comment['mail']?></span>
<span class='commentPosted' style='position:absolute; bottom:4px; right:2px;'>
	 <?=$comment['timestamp']?>
	<form method='post'> 
    <input type='hidden' name="page" value="<?=$page?>"> 
    <input type='submit' name='doEdit' value='Redigera' onClick="this.form.action = '<?=$this->url->create('comment/edit') .'/' . $id?>'" /> 
    <input type='submit' name='doDelete' value='Radera' onClick="this.form.action = '<?=$this->url->create('comment/delete') .'/' . $id?>'" /> 
</form></span>

</div>
<?php endforeach; ?>
</div>
<?php endif; ?>