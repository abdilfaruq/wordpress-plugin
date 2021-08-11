<?php

/**
 * @package Sertifikat
 */
/*
Plugin Name: Sertifikat
Description: Plugin untuk menampilkan data Domain dan Sertifikat SSL.
Version: 1.0.0
Author: Microvac
Author URI: microvac.co.id
License: GPLv2 or later
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit( 'restricted access' );
}

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class cert_dashboards_List extends WP_List_Table {
	/** Class constructor */
	public function __construct() {
		parent::__construct( [
			'singular' => __( 'cert_dashboard', 'sp' ), //singular name of the listed records
			'plural'   => __( 'cert_dashboards', 'sp' ), //plural name of the listed records
			'ajax'     => false //does this table support ajax?
		] );
	}

	/**
	 * Retrieve certificates data from the database
	 *
	 * @param int $per_page
	 * @param int $page_number
	 *
	 * @return mixed
	 */
	public static function get_cert_dashboards( $per_page = 1, $page_number = 1 ) {

		global $wpdb;
		$sql = "SELECT * FROM `sd_certificates`";

		if ( ! empty( $_REQUEST['orderby'] ) ) {
			$sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
			$sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
		}

		$sql .= " LIMIT $per_page";
		$sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;
		$result = $wpdb->get_results( $sql, 'ARRAY_A' );

		return $result;
	}

	/**
	 * Returns the count of records in the database.
	 *
	 * @return null|string
	 */
	public static function record_count() {
		global $wpdb;

		$sql = "SELECT COUNT(*) FROM `sd_certificates`";

		return $wpdb->get_var( $sql );
	}

	public static function totalDomain() {
		global $wpdb;

		$sql = "SELECT COUNT(*) FROM `sd_certificates`";

		$num = $wpdb->get_var( $sql );
		echo  $num ;
	}

	public static function jumlahHTTPS() {
		global $wpdb;

		$sql = "SELECT COUNT(*) FROM `sd_certificate_domains` WHERE status='cert_registered'";

		$num = $wpdb->get_var( $sql );
		echo  $num ;
	}

	public static function jumlahCert() {
		global $wpdb;

		$sql = "SELECT COUNT(*) FROM `sd_certificates` WHERE status='OK'";

		$num = $wpdb->get_var( $sql );
		echo  $num ;
	}

	public static function totalCert() {
		global $wpdb;

		$sql = "SELECT COUNT(*) FROM `sd_certificate_domains`";

		$num = $wpdb->get_var( $sql );
		echo  $num ;
	}

	/** Text displayed when no certificates data is available */
	public function no_items() {
		_e( 'No certificates avalaible.', 'sp' );
	}

	function column_totalDomain( $item ) {
		$totalDomain = $this->totalDomain();
		return $totalDomain;
	}

	function column_jumlahHTTPS( $item ) {
		$jumlahHTTPS = $this->jumlahHTTPS();
		return $jumlahHTTPS;
	}

	function column_jumlahCert( $item ) {
		$jumlahCert = $this->jumlahCert();
		return $jumlahCert;
	}

	function column_totalCert( $item ) {
		$totalCert = $this->totalCert();
		return $totalCert;
	}
	
	/**
	 *  Associative array of columns
	 *
	 * @return array
	 */
	function get_columns() {
		$columns = [
			'jumlahHTTPS'  => 'Jumlah Domain HTTPS',
			'totalDomain' => 'Total Domain', 
			'jumlahCert' => 'Jumlah Sertifikat Aktif',
			'totalCert' => 'Total Sertifikat'
		];

		return $columns;
	}

	/**
	 * Handles data query and filter, sorting, and pagination.
	 */
	public function prepare_items() {
		$per_page     = $this->get_items_per_page( 'cert_dashboards_per_page', 1 );
		$this->items = self::get_cert_dashboards( $per_page );
	}
}

class certificates_List extends WP_List_Table {
	
	public function __construct() {
		parent::__construct( [
			'singular' => __( 'certificate', 'sp' ), 
			'plural'   => __( 'certificates', 'sp' ), 
			'ajax'     => false 
		] );
	}

	public static function get_certificates( $per_page = 5, $page_number = 1 ) {

		global $wpdb;
		$sql = "SELECT * FROM sd_certificates";
		
		if ( ! empty( $_REQUEST['orderby'] ) ) {
			$sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
			$sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
		}

		$sql .= " LIMIT $per_page";
		$sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;
		$result = $wpdb->get_results( $sql, 'ARRAY_A' );

		return $result;
	}

	public static function record_count() {
		global $wpdb;

		$sql = "SELECT COUNT(*) FROM sd_certificates";

		return $wpdb->get_var( $sql );
	}

	public static function jumlahsts() {
		global $wpdb;
		
		$sql = "SELECT COUNT(*) FROM `sd_certificates` WHERE status='OK' IS NULL";
		if ('OK') {
			PRINT '1';
		}else{ 
			PRINT '0';
		}
	}

	public function no_items() {
		_e( 'No certificates avalaible.', 'sp' );
	}

	/**
	 * Render a column when no column specific method exist.
	 *
	 * @param array $item
	 * @param string $column_name
	 *
	 * @return mixed
	 */
	public function column_default( $item, $column_name ) {
        switch ( $column_name ) {
			case 'expired':
			case 'status':
				return $item[ $column_name ];
			default:
				return print_r( $item, true );	 
		}
	}

	function column_name( $item ) {
		$title = '<strong>' . $item['name'] . '</strong>';
		return $title;
	}

	function column_jumlahsts( $item ) {
		$jumlahsts = $this->jumlahsts();
		return $jumlahsts;
	}

	function get_columns() {
		$columns = [
			'name'    => __( 'Name', 'sp' ),
			'jumlahsts' => __( 'Jumlah Situs', 'sp'),
			'expired' => __( 'Expired', 'sp' ),
			'status'  => __( 'Status', 'sp' ) //Show the whole array for troubleshooting purposes
		];
		
		return $columns;
	}

	/**
	 * Columns to make sortable.
	 *
	 * @return array
	 */
	public function get_sortable_columns() {
		$sortable_columns = array(
			'name' => array( 'name', true ),
			'jumlahsts' => array( 'jumlahsts', true ),
			'expired' => array( 'expired', true ),
			'status' => array( 'status', false )
		);

		return $sortable_columns;
	}

	public function prepare_items() {

		$this->_column_headers = $this->get_column_info();

		$per_page     = $this->get_items_per_page( 'certificates_per_page', 5 );
		$current_page = $this->get_pagenum();
		$total_items  = self::record_count();
		
		$this->set_pagination_args( [
			'total_items' => $total_items, //to calculate the total number of items 
			'per_page'    => $per_page //to determine how many items to show on a page
		] );

		$this->items = self::get_certificates( $per_page, $current_page );
	}
}

class cert_domains_List extends WP_List_Table {

	public function __construct() {
		parent::__construct( [
			'singular' => __( 'cert_domain', 'sp' ), 
			'plural'   => __( 'cert_domains', 'sp' ), 
			'ajax'     => false 
		] );
	}

	public static function get_cert_domains( $per_page = 5, $page_number = 1 ) {

		global $wpdb;
		$sql = "SELECT * FROM sd_certificate_domains";

		if ( ! empty( $_REQUEST['orderby'] ) ) {
			$sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
			$sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
		}

		$sql .= " LIMIT $per_page";
		$sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;
		$result = $wpdb->get_results( $sql, 'ARRAY_A' );

		return $result;
	}

	public static function record_count() {
		global $wpdb;

		$sql = "SELECT COUNT(*) FROM sd_certificate_domains";

		return $wpdb->get_var( $sql );
	}

	public function no_items() {
		_e( 'No certificates avalaible.', 'sp' );
	}

	public function column_default( $item, $column_certificate_name ) {
		switch ( $column_certificate_name ) {
			case 'domain':
			case 'status':
				return $item[ $column_certificate_name ];
			default:
				return print_r( $item, true );
		}
	}

	function column_certificate_name( $item ) {
		$title = '<strong>' . $item['certificate_name'] . '</strong>';
		return $title;
	}

	function get_columns() {
		$columns = [
			'certificate_name'    => __( 'Certificate Name', 'sp' ),
			'domain' => __( 'Domain', 'sp' ),
			'status'  => __( 'Status', 'sp' )
		];

		return $columns;
	}

	public function prepare_items() {

		$this->_column_headers = $this->get_column_info();

		$per_page     = $this->get_items_per_page( 'cert_domains_per_page', 5 );
		$current_page = $this->get_pagenum();
		$total_items  = self::record_count();

		$this->set_pagination_args( [
			'total_items' => $total_items, 
			'per_page'    => $per_page
		] );

		$this->items = self::get_cert_domains( $per_page, $current_page );
	}
}

class cert_logs_List extends WP_List_Table {
	
	public function __construct() {
		parent::__construct( [
			'singular' => __( 'cert_log', 'sp' ),
			'plural'   => __( 'cert_logs', 'sp' ),
			'ajax'     => false 
		] );
	}

	public static function get_cert_logs( $per_page = 5, $page_number = 1 ) {

		global $wpdb;
		$sql = "SELECT * FROM sd_certificate_logs";

		if ( ! empty( $_REQUEST['orderby'] ) ) {
			$sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
			$sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
		}

		$sql .= " LIMIT $per_page";
		$sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;
		$result = $wpdb->get_results( $sql, 'ARRAY_A' );

		return $result;
	}

	public static function record_count() {
		global $wpdb;

		$sql = "SELECT COUNT(*) FROM sd_certificate_logs";

		return $wpdb->get_var( $sql );
	}

	public function no_items() {
		_e( 'No certificates avalaible.', 'sp' );
	}
	
	public function column_default( $item, $column_timestamp ) {
		switch ( $column_timestamp ) {
			case 'timestamp':
			case 'message':
				return $item[ $column_timestamp ];
			default:
				return print_r( $item, true ); 
		}
	}
	
	function get_columns() {
		$columns = [
			'timestamp'  => __( 'Timestamp', 'sp' ), 
			'message' => __( 'Message', 'sp' )
		];

		return $columns;
	}
	
	public function get_sortable_columns() {
		$sortable_columns = array(
			'timestamp' => array( 'timestamp', true ),
			'message' => array( 'message', true )
		);
				
		return $sortable_columns;
	}

	public function prepare_items() {

		$this->_column_headers = $this->get_column_info();

		$per_page     = $this->get_items_per_page( 'cert_logs_per_page', 5 );
		$current_page = $this->get_pagenum();
		$total_items  = self::record_count();

		$this->set_pagination_args( [
			'total_items' => $total_items,
			'per_page'    => $per_page 
		] );

		$this->items = self::get_cert_logs( $per_page, $current_page );
	}
}

class CertDashboards {

	// class instance
	static $instance;

	// certificate list table object
	public $cert_dashboards_obj;

	// class constructor
	public function __construct() {
		add_filter( 'set-screen-option', [ __CLASS__, 'set_screen' ], 10, 3 );
		add_action( 'network_admin_menu', [ $this, 'plugin_menu' ] );
	}

	public static function set_screen( $option, $value ) {
		return $value;
	}

	public function plugin_menu() {
		$hook = add_submenu_page(
			'settings.php',
			'Sertifikat HTTPS',
			'Sertifikat HTTPS',
			'sertifikat_options',
			'dashboard',
			[ $this, 'plugin_settings_page' ]
		);

		add_action( "load-$hook", [ $this, 'screen_option' ] );
	}

	/**
	 * Plugin settings page
	 */
	public function plugin_settings_page() {
		?>
		<div class="wrap">

		<?php
			if ( isset( $_GET['tab'] )) {
				$active_tab = $_GET[ 'tab' ];
			}
        ?>
			<h2 class="nav-tab-wrapper">
				<a href="?page=dashboard" class="nav-tab <?php echo $active_tab == '' ? 'nav-tab-active' : ''; ?>">Dashboard</a>
				<a href="?page=sertifikat" class="nav-tab">Sertifikat</a>
				<a href="?page=domain" class="nav-tab">Domain</a>
				<a href="?page=log" class="nav-tab">Log</a>
        	</h2>
			<div id="poststuff">
				<div id="post-body" class="metabox-holder columns-2">
					<div id="post-body-content">
						<div class="meta-box-sortables ui-sortable">
							<form method="post">
								<?php
								$this->cert_dashboards_obj->prepare_items();
								$this->cert_dashboards_obj->display(); ?>
							</form>
						</div>
					</div>
				</div>
				<br class="clear">
			</div>
		</div>
	<?php
	}

	/**
	 * Screen options
	 */
	public function screen_option() {

		$option = 'per_page';
		$args   = [
			'label'   => 'cert_dashboards',
			'default' => 1,
			'option'  => 'cert_dashboards_per_page'
		];

		add_screen_option( $option, $args );

		$this->cert_dashboards_obj = new cert_dashboards_List();
	}

	/** Singleton instance */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}

add_action( 'plugins_loaded', function () {
	CertDashboards::get_instance();
	}
);

class CertSertifikats {
	static $instance;
	public $certificates_obj;

	public function __construct() {
		add_filter( 'set-screen-option', [ __CLASS__, 'set_screen' ], 10, 3 );
		add_action( 'network_admin_menu', [ $this, 'plugin_menu' ] );
	}

	public static function set_screen( $status, $option, $value ) {
		return $value;
	}

	public function plugin_menu() {
		$hook = add_submenu_page(
			null,
			'Sertifikat HTTPS',
			'Sertifikat HTTPS',
			'sertifikat_options',
			'sertifikat',
			[ $this, 'plugin_settings_page' ]
		);

		add_action( "load-$hook", [ $this, 'screen_option' ] );
	}

	public function plugin_settings_page() {
		?>
		<div class="wrap">
		<?php
            if( isset( $_GET[ 'tab' ] ) ) {
                $active_tab = $_GET[ 'tab' ];
            }
        ?>
			<h2 class="nav-tab-wrapper">
				<a href="?page=dashboard" class="nav-tab">Dashboard</a>
				<a href="?page=sertifikat" class="nav-tab <?php echo $active_tab == '' ? 'nav-tab-active' : ''; ?>">Sertifikat</a>
				<a href="?page=domain" class="nav-tab">Domain</a>
				<a href="?page=log" class="nav-tab">Log</a>
        	</h2>
			<div id="poststuff">
				<div id="post-body" class="metabox-holder columns-2">
					<div id="post-body-content">
						<div class="meta-box-sortables ui-sortable">
							<!-- <form style="float: right;" method="post" action="" >
								<input type="text" placeholder="Search" name="search">
								<input type="submit" class="button-primary" value="Search" name="submit">
							</form> -->
							<form method="post">
								<?php
								$this->certificates_obj->prepare_items();
								$this->certificates_obj->display(); ?>
							</form>
						</div>
					</div>
				</div>
				<br class="clear">
			</div>
		</div>
	<?php
	}

	public function screen_option() {
		$option = 'per_page';
		$args   = [
			'label'   => 'certificates',
			'default' => 5,
			'option'  => 'certificates_per_page'
		];

		add_screen_option( $option, $args );
		$this->certificates_obj = new certificates_List();
	}

	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}

add_action( 'plugins_loaded', function () {
	CertSertifikats::get_instance();
	}
);

class CertDomains {

	static $instance;
	public $cert_domains_obj;

	public function __construct() {
		add_filter( 'set-screen-option', [ __CLASS__, 'set_screen' ], 10, 3 );
		add_action( 'network_admin_menu', [ $this, 'plugin_menu' ] );
	}

	public static function set_screen( $status, $option, $value ) {
		return $value;
	}

	public function plugin_menu() {

		$hook = add_submenu_page(
			null,
			'Sertifikat HTTPS',
			'Sertifikat HTTPS',
			'sertifikat_options',
			'domain',
			[ $this, 'plugin_settings_page' ]
		);

		add_action( "load-$hook", [ $this, 'screen_option' ] );
	}

	public function plugin_settings_page() {
		?>
		<div class="wrap">
		<?php
            if( isset( $_GET[ 'tab' ] ) ) {
				$active_tab = $_GET[ 'tab' ];
            }
        ?>
			<h2 class="nav-tab-wrapper">
				<a href="?page=dashboard" class="nav-tab">Dashboard</a>
				<a href="?page=sertifikat" class="nav-tab">Sertifikat</a>
				<a href="?page=domain" class="nav-tab <?php echo $active_tab == '' ? 'nav-tab-active' : ''; ?>">Domain</a>
				<a href="?page=log" class="nav-tab">Log</a>
        	</h2>
			<div id="poststuff">
				<div id="post-body" class="metabox-holder columns-2">
					<div id="post-body-content">
						<div class="meta-box-sortables ui-sortable">
							<form method="post">
								<?php
								$this->cert_domains_obj->prepare_items();
								$this->cert_domains_obj->display(); ?>
							</form>
						</div>
					</div>
				</div>
				<br class="clear">
			</div>
		</div>
	<?php
	}

	public function screen_option() {

		$option = 'per_page';
		$args   = [
			'label'   => 'cert_domains',
			'default' => 5,
			'option'  => 'cert_domains_per_page'
		];

		add_screen_option( $option, $args );

		$this->cert_domains_obj = new cert_domains_List();
	}

	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}

add_action( 'plugins_loaded', function () {
	CertDomains::get_instance();
	}
);

class CertLogs {
	
	static $instance;
	public $cert_logs_obj;
	public function __construct() {
		add_filter( 'set-screen-option', [ __CLASS__, 'set_screen' ], 10, 3 );
		add_action( 'network_admin_menu', [ $this, 'plugin_menu' ] );
	}


	public static function set_screen( $timestamp, $option, $value ) {
		return $value;
	}

	public function plugin_menu() {
		$hook = add_submenu_page(
			null, 
			'Sertifikat HTTPS',
			'Sertifikat HTTPS',
			'sertifikat_options', 
			'log', 
			[ $this, 'plugin_settings_page' ]
		);

		add_action( "load-$hook", [ $this, 'screen_option' ] );
	}

	public function plugin_settings_page() {
		?>
		<div class="wrap">
		<?php
            if ( isset( $_GET['tab'] )) {
				$active_tab = $_GET[ 'tab' ];
			}
        ?>
			<h2 class="nav-tab-wrapper">
				<a href="?page=dashboard" class="nav-tab">Dashboard</a>
				<a href="?page=sertifikat" class="nav-tab">Sertifikat</a>
				<a href="?page=domain" class="nav-tab">Domain</a>
				<a href="?page=log" class="nav-tab <?php echo $active_tab == '' ? 'nav-tab-active' : ''; ?>">Log</a>
			</h2>
			<div id="poststuff">
				<div id="post-body" class="metabox-holder columns-2">
					<div id="post-body-content">
						<div class="meta-box-sortables ui-sortable">
							<form method="post">
								<?php
								$this->cert_logs_obj->prepare_items();
								$this->cert_logs_obj->display(); ?>
							</form>
						</div>
					</div>
				</div>
				<br class="clear">
			</div>
		</div>
	<?php
	}

	public function screen_option() {

		$option = 'per_page';
		$args   = [
			'label'   => 'cert_logs',
			'default' => 5,
			'option'  => 'cert_logs_per_page'
		];

		add_screen_option( $option, $args );
		$this->cert_logs_obj = new cert_logs_List();
	}

	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}

add_action( 'plugins_loaded', function () {
	CertLogs::get_instance();
	}
);