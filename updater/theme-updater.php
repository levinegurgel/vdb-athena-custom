<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://athena.viverdeblog.com', // Site where EDD is hosted
		'item_name'      => ATH_THEME_NAME, // Name of theme
		'theme_slug'     => ATH_THEME_SLUG, // Theme slug
		'version'        => ATH_THEME_VERSION, // The current version of this theme
		'author'         => 'Viver de Blog', // The author of this theme
		'download_id'    => '', // Optional, used for generating a license renewal link
		'renew_url'      => '', // Optional, allows for a custom license renewal link
		'beta'           => false, // Optional, set to true to opt into beta versions
	),

	// Strings
	$strings = array(
		'theme-license'             => __( 'Licença', ATH_THEME_SLUG ),
		'enter-key'                 => __( 'Insira sua licença para receber as atualizações do tema.', ATH_THEME_SLUG ),
		'license-key'               => __( 'Chave de licença', ATH_THEME_SLUG ),
		'license-action'            => __( 'Ações da licença', ATH_THEME_SLUG ),
		'deactivate-license'        => __( 'Desativar licença', ATH_THEME_SLUG ),
		'activate-license'          => __( 'Ativar licença', ATH_THEME_SLUG ),
		'status-unknown'            => __( 'Licença com status desconhecido.', ATH_THEME_SLUG ),
		'renew'                     => __( 'Renovar?', ATH_THEME_SLUG ),
		'unlimited'                 => __( 'ilimitado', ATH_THEME_SLUG ),
		'license-key-is-active'     => __( 'Sua licença está ativo :)', ATH_THEME_SLUG ),
		'expires%s'                 => __( 'Expira %s.', ATH_THEME_SLUG ),
		'expires-never'             => __( 'Sua licença não expira nunca :)', ATH_THEME_SLUG ),
		'%1$s/%2$-sites'            => __( 'Você possui %1$s / %2$s sites ativos.', ATH_THEME_SLUG ),
		'license-key-expired-%s'    => __( 'License key expired %s.', ATH_THEME_SLUG ),
		'license-key-expired'       => __( 'Sua licença expirou.', ATH_THEME_SLUG ),
		'license-keys-do-not-match' => __( 'Sua licença não é válida. <a href="https://pay.hotmart.com/Y13595729L?off=nf4imz34&checkoutMode=10&split=12" target="_blank"> Adquira sua licença aqui. <a/>', ATH_THEME_SLUG ),
		'license-is-inactive'       => __( 'Sua licença está desativada. <a href="https://pay.hotmart.com/Y13595729L?off=nf4imz34&checkoutMode=10&split=12" target="_blank"> Adquira sua licença aqui. <a/>', ATH_THEME_SLUG ),
		'license-key-is-disabled'   => __( 'Sua licença está desativada. <a href="https://pay.hotmart.com/Y13595729L?off=nf4imz34&checkoutMode=10&split=12" target="_blank"> Adquira sua licença aqui. <a/>', ATH_THEME_SLUG ),
		'site-is-inactive'          => __( 'Site inativo.', ATH_THEME_SLUG ),
		'license-status-unknown'    => __( 'Status desconhecido.', ATH_THEME_SLUG ),
		'update-notice'             => __( "Ao atualizar este tema você perderá todas as customizações feitas até o momento. Clique em 'cancelar' para parar ou 'ok' para prosseguir.", ATH_THEME_SLUG ),
		'update-available'          => __( '<strong>%1$s %2$s</strong> disponível. <a href="%3$s" class="thickbox" title="%4s">Veja o que há de novo</a> ou <a href="%5$s"%6$s>atualize agora</a>.', ATH_THEME_SLUG ),
	)

);