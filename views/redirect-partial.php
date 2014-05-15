<?php

$template = isset( $template ) ? $template : '';

$redirect['type'] = isset( $redirect['type'] ) ? $redirect['type'] : '';
$redirect['id'] = isset( $redirect['id'] ) ? $redirect['id'] : '';
$redirect['code'] = isset( $redirect['code'] ) ? $redirect['code'] : '301';
$redirect['url'] = isset( $redirect['url'] ) ? $redirect['url'] : '';

$types = array(
    'site' => 'Site',
    'post' => 'Post',
    'rel' => 'Relative',
    'abs' => 'Absolute'
);

?>
<table class="form-table redirect <?php echo $template ?>">
    <tr>
        <th scope="row">
            <label>Redirect Type</label>
        </th>
        <td>
            <select name="type[]">
                <?php
                    foreach ( $types as $type => $type_name ) {
                        echo "<option value='$type'" . ( $type == $redirect['type'] ? 'selected="selected"' : '' ) . " >$type_name</option>";
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label>Post ID</label>
        </th>
        <td>
            <input type="text" name="id[]"
                value="<?php echo esc_attr( $redirect['id'] ); ?>" class="regular-text code"/>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label>Redirect Code</label>
        </th>
        <td>
            <input type="text" name="code[]"
                value="<?php echo esc_attr( $redirect['code'] ); ?>" class="regular-text code"/>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label>Url</label>
        </th>
        <td>
            <input type="text" name="url[]"
                value="<?php echo esc_attr( $redirect['url'] ); ?>" class="regular-text code"/>
        </td>
    </tr>
</table>