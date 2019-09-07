<?php
/**
 * Template Insert Button
 */
?>
<# if ( 'valid' === window.MasterAddonsData.license.status || ! pro ) { #>
    <button class="elementor-template-library-template-action ma-el-modal-template-insert elementor-button elementor-button-success">
        <i class="eicon-file-download"></i><span class="elementor-button-title"><?php
            echo __( 'Insert', MELA_TD );
        ?></span>
    </button>
<# } else { #>
<a class="template-library-activate-license elementor-button elementor-button-go-pro" href="{{{ window.MasterAddonsData.license.activateLink }}}" target="_blank">
    <i class="fa fa-external-link" aria-hidden="true"></i>
    {{{ window.MasterAddonsData.license.proMessage }}}
</a>
<# } #>