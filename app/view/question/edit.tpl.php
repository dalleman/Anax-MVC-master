<div class='comment-form'> 
    <form method=post>
			<input type=hidden name="redirect" value="<?=$this->url->create('')?>">
        <input type=hidden name="page" value="<?=$page?>">
				<input type=hidden name="id" value="<?=$id?>">
				<input type=hidden name="timestamp" value='<?=time()?>'>
        <fieldset> 
        <legend>Redigera Kommentar</legend> 
        <p><label>Kommentar:<br/><textarea name='content'><?=$content?></textarea></label></p> 
        <p><label>Namn:<br/><input type='text' name='name' value='<?=$name?>'/></label></p> 
        <p><label>Hemsida:<br/><input type='text' name='web' value='<?=$web?>'/></label></p> 
        <p><label>Email:<br/><input type='text' name='mail' value='<?=$mail?>'/></label></p> 
        <p class=buttons> 
            <input type='submit' name='doSubmit' value='Uppdatera' onClick="this.form.action = '<?=$this->url->create('comment/save') .'/' . $id?>'" />
            <input type='reset' value='Reset'/> 
            <input type='submit' name='doCancel' value='Avbryt' onClick="this.form.action = ''"/> 
        </p> 
        </fieldset> 
    </form> 
</div>