<?php header("Content-type: text/html; charset=utf-8"); ?>
<div class="form-group">
    <label for="<?php echo $item['varname']; ?>" class="col-sm-2 control-label"><?php echo $item['name']; ?></label>
    <div class="col-sm-10">
        <input type="password" class="form-control" id="<?php echo $item['varname']; ?>" name="<?php echo $item['varname']; ?>" value="<?php echo $item['value']; ?>">
        <span class="help-block"><strong>Note:</strong> If you don't want to change the password, leave this field empty.</span>
    </div>
</div>
