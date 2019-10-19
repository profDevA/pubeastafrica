<tr>
    <th scope="row"><?php _e('Button skin', 'nextend-facebook-connect'); ?></th>
    <td>
        <fieldset>
            <label>
                <input type="radio" name="skin"
                       value="uniform" <?php if ($settings->get('skin') == 'uniform') : ?> checked="checked" <?php endif; ?>>
                <span><?php _e('Uniform', 'nextend-facebook-connect'); ?></span><br/>
                <img src="<?php echo plugins_url('images/google/uniform.png', NSL_ADMIN_PATH) ?>"/>
            </label>
            <label>
                <input type="radio" name="skin"
                       value="light" <?php if ($settings->get('skin') == 'light') : ?> checked="checked" <?php endif; ?>>
                <span><?php _e('Light', 'nextend-facebook-connect'); ?></span><br/>
                <img src="<?php echo plugins_url('images/google/light.png', NSL_ADMIN_PATH) ?>"/>
            </label>
            <label>
                <input type="radio" name="skin"
                       value="dark" <?php if ($settings->get('skin') == 'dark') : ?> checked="checked" <?php endif; ?>>
                <span><?php _e('Dark', 'nextend-facebook-connect'); ?></span><br/>
                <img src="<?php echo plugins_url('images/google/dark.png', NSL_ADMIN_PATH) ?>"/>
            </label><br>
        </fieldset>
    </td>
</tr>