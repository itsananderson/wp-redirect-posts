<div class="wrap">
    <?php
    $template = 'template';
    include( 'redirect-partial.php' );
    $template = '';
    ?>
    <form method="POST" action="">
        <div class="redirects">
            <?php
            foreach ( $options['redirects'] as $id => $redirect ) {
                include( 'redirect-partial.php' );
            }
            ?>
        </div>
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label>Site Replace Base</label>
                </th>
                <td>
                    <input type="text" name="site-replace-base"
                        value="<?php echo esc_attr( isset( $options['site_replace_base'] ) ? $options['site_replace_base'] : '' ); ?>" class="regular-text code"/>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label>Site Redirect Base</label>
                </th>
                <td>
                    <input type="text" name="site-redirect-base"
                        value="<?php echo esc_attr( isset( $options['site_redirect_base'] ) ? $options['site_redirect_base'] : '' ); ?>" class="regular-text code"/>
                </td>
            </tr>
        </table>
        <input type="button" class="button" id="add-redirect" value="Add Redirect" />
        <input type="submit" class="button button-primary" value="Save" />
    </form>
</div>
<style type="text/css">
    .redirect.template {
        display: none;
    }
    
    .redirects .redirect {
        background-color:  #ccc;
        margin-top:  10px;
        margin-bottom:  10px;
        padding: 10px;
    }
    
    .redirects .redirect th {
        padding-left:  10px;
    }
</style>
<script type="text/javascript">
    jQuery(function ($) {
        $('#add-redirect').click(function (e) {
            e.preventDefault();

            $('.redirect.template').clone().removeClass('template').appendTo($('.redirects'));

            return false;
        });
        
        $('#add-redirect').click();
    });
</script>