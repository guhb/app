<?php $value = $object->getValue(); ?>
<?php if($context == SD_CONTEXT_EDITING): ?>
	<div class="input-group">
		<?php if ($object->getPropertyName() == 'schema:description') : ?>
			<textarea name="<?=$object->getPropertyName();?>"><?=$value;?></textarea>
		<?php else : ?>
			<input type="text" value="<?=$value;?>" name="<?=$object->getPropertyName();?>" />
		<?php endif; ?>
	</div>
<?php else: ?>
<?php if(empty($value)): ?>
	<p class="empty">empty</p>
<?php else: ?><?=$object->getValue();?><?php endif; ?>
<?php endif; ?>
