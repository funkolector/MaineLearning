<link rel='shortcut icon' href="<?php echo plugins_url() . '/bebop/core/resources/images/bebop_icon.png';?>">

<?php include_once( WP_PLUGIN_DIR . '/bebop/core/templates/admin/bebop-admin-menu.php' ); ?>
<div id='bebop_admin_container'>
	<div class='postbox full_width center_margin margin-bottom_22px'>
		<h3><?php _e( 'Bebop Errors', 'bebop' ); ?></h3>
		<div class='inside'>
			<p><?php _e( 'Logs any errors which the plugin has produced. Please report by opening a issue ticket on our <a target="_blank" href="https://github.com/lncd/bebop/issues">Github Issue Tracker</a>.', 'bebop' ); ?></p>
		</div>
	</div>
	<?php
	
	$number_of_rows = bebop_tables::count_table_rows( 'bp_bebop_error_log' );
	
	if ( count( $number_of_rows ) ) {
		echo '<a class="button-secondary" href="' .$_SERVER['PHP_SELF'] . '?' . http_build_query( $_GET ) . '&clear_table=true">' . __( 'Flush table data', 'bebop' ) . '</a>';
	}
	
	$page_vars = bebop_pagination_vars( 100 );
	$bebop_pagination = bebop_pagination( $number_of_rows, $page_vars['per_page'] );
	echo $bebop_pagination;
	
	$table_row_data = bebop_tables::fetch_table_data( 'bp_bebop_error_log', $page_vars['page_number'], $page_vars['per_page'] );
	if ( count( $table_row_data ) > 0 ) {
		?>		
		<table class="widefat margin-top_22px">
			<thead>
				<tr>
					<th><?php _e( 'Error ID', 'bebop' ); ?></th>
					<th><?php _e( 'Timestamp', 'bebop' ); ?></th>
					<th><?php _e( 'Error Type', 'bebop' ); ?></th>
					<th><?php _e( 'Error Message', 'bebop' ); ?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th><?php _e( 'Error ID', 'bebop' ); ?></th>
					<th><?php _e( 'Timestamp', 'bebop' ); ?></th>
					<th><?php _e( 'Error Type', 'bebop' ); ?></th>
					<th><?php _e( 'Error Message', 'bebop' ); ?></th>
				</tr>
			</tfoot>
			<tbody>
				<?php
				foreach ( $table_row_data as $row_data ) {
				echo '<tr>
					<td>' . bebop_tables::sanitise_element( $row_data->id ) . '</td>' .
					'<td>' . bebop_tables::sanitise_element( $row_data->timestamp ) . '</td>
					<td>' . bebop_tables::sanitise_element( $row_data->error_type ) . '</td>
					<td>' . bebop_tables::sanitise_element( $row_data->error_message ) . '</td>
				</tr>';
			}
			?>
			</tbody>
		</table>
		<?php
		echo $bebop_pagination;
	}
	else {
		 _e( 'No data for this page was found.', 'bebop' );
	}
	?>
<!-- End bebop_admin_container -->
</div>