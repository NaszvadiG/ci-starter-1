<?php header("Content-type: text/html; charset=utf-8"); ?>
<div class="control-group">
  <label class="control-label" for="<?php echo $item['varname']; ?>"><?php echo $item['name']; ?></label>
  <div class="controls">
    <input class="input-xlarge" type="number" id="<?php echo $item['varname']; ?>" name="<?php echo $item['varname']; ?>" value="<?php echo $item['value']; ?>" <?php echo $item['focus']; ?>>
  </div>
</div>
