<!-- 後台訂單頁-變更門市 -->
<?php
	if ( !defined('ABSPATH') ) {
 	   	define('ABSPATH', $_SERVER['DOCUMENT_ROOT'] . '/');
	}
	require_once(ABSPATH . 'wp-load.php');

	header("Content-Type:text/html; charset=utf-8");

    $CVSStoreName = sanitize_text_field($_REQUEST['CVSStoreName']);
    $CVSAddress   = sanitize_text_field($_REQUEST['CVSAddress']);
    $CVSTelephone = sanitize_text_field($_REQUEST['CVSTelephone']);
    $CVSStoreID   = sanitize_text_field($_REQUEST['CVSStoreID']);
?>
<script type="text/javascript">
<!--
window.opener.document.getElementById("_shipping_purchaserStore").value   = "<?php echo esc_html($CVSStoreName);?>";
window.opener.document.getElementById("_shipping_purchaserAddress").value = "<?php echo esc_html($CVSAddress);?>";
window.opener.document.getElementById("_shipping_purchaserPhone").value   = "<?php echo esc_html($CVSTelephone);?>";
window.opener.document.getElementById("_shipping_CVSStoreID").value       = "<?php echo esc_html($CVSStoreID);?>";
alert('門市變更完成，請儲存訂單');
window.close();
//-->
</script>