<?php
/*
Plugin Name: Easy Digital Downloads - Status Board
Plugin URI: http://www.kungfugrep.com
Description: Integrates the Easy Digital Downloads API with the Status Board iPad App.
Version: 1.0
Author: Chris Klosowski
Author URI: http://www.kungfugrep.com
License: GPLv2 or later
*/

if ( version_compare( EDD_VERSION, '1.5.2', '>=') ) {
	add_filter( 'edd_api_valid_query_modes', 'edd_statusboard_mode' );
	add_filter( 'edd_api_output_data', 'edd_statusboard_output', 10, 3 );
	add_action( 'show_user_profile',   'edd_statusboard_profile_endpoint_display' );
}

function edd_statusboard_mode( $modes ) {
	$additional_modes = array( 'sbsales', 'sbearnings', 'sbhybrid' );

	return array_merge( $modes, $additional_modes );
}


function edd_statusboard_output( $data, $query_mode, $this ) {
	$api = new EDD_API;

	$statusboard_mode = false;

	switch ( $query_mode ) :
		case 'sbsales':
			$statusboard_mode = true;
			$statusboard_data['graph']['title'] = get_bloginfo( 'name' ) . ' - ' . __( 'Sales', 'edd-statusboard-txt' );
			// Format Sales
			$sales_stats = $api->get_stats( array(
					'type'      => 'sales',
					'product'   => null,
					'date'      => 'range',
					'startdate' => date( 'Ymd', strtotime( '-7 days' ) ),
					'enddate'   => date( 'Ymd' )
				) );

			$sales_data = edd_statusboard_format_datapoints( __( 'Sales', 'edd-statusboard-txt' ),
														array_slice( $sales_stats['sales'], 0, 8, true ),
														apply_filters( 'edd_statusboard_sales_color', 'orange' ) );
			$statusboard_data['graph']['datasequences'][] = $sales_data;
			break;

		case 'sbearnings':
			$statusboard_mode = true;
			$statusboard_data['graph']['title'] = get_bloginfo( 'name' ) .  ' - ' . __( 'Earnings', 'edd-statusboard-txt' );
			$statusboard_data['graph']['yAxis']['prefix'] = apply_filters( 'edd_statusbaord_earnings_prefix', '$' );
			$statusboard_data['graph']['yAxis']['suffix'] = apply_filters( 'edd_statusbaord_earnings_suffix', '' );

			// Format Earnings
			$earnings_stats = $api->get_stats( array(
					'type'      => 'earnings',
					'product'   => null,
					'date'      => 'range',
					'startdate' => date( 'Ymd', strtotime( '-7 days' ) ),
					'enddate'   => date( 'Ymd' )
				) );

			$earnings_data = edd_statusboard_format_datapoints( __( 'Earnings', 'edd-statusboard-txt' ), 
														array_slice( $earnings_stats['earnings'], 0, 8, true ),
														apply_filters( 'edd_statusboard_earnings_color', 'green' ) );
			$statusboard_data['graph']['datasequences'][] = $earnings_data;
			break;

		case 'sbhybrid':
			$statusboard_mode = true;
			$statusboard_data['graph']['title'] = get_bloginfo( 'name' ) . ' - ' . __( 'Sales & Earnings', 'edd-statusboard-txt' );
			// Format Hybrid
			$sales_stats = $api->get_stats( array(
					'type'      => 'sales',
					'product'   => null,
					'date'      => 'range',
					'startdate' => date( 'Ymd', strtotime( '-7 days' ) ),
					'enddate'   => date( 'Ymd' )
				) );

			$data_sales = edd_statusboard_format_datapoints( __( 'Sales', 'edd-statusboard-txt' ),
														array_slice( $sales_stats['sales'], 0, 8, true ),
														apply_filters( 'edd_statusboard_sales_color', 'orange' ) );
			$statusboard_data['graph']['datasequences'][] = $data_sales;

			$earnings_stats = $api->get_stats( array(
					'type'      => 'earnings',
					'product'   => null,
					'date'      => 'range',
					'startdate' => date( 'Ymd', strtotime( '-7 days' ) ),
					'enddate'   => date( 'Ymd' )
				) );

			$data_earnings = edd_statusboard_format_datapoints( __( 'Earnings', 'edd-statusboard-txt' ),
														array_slice( $earnings_stats['earnings'], 0, 8, true ),
														apply_filters( 'edd_statusboard_earnings_color', 'green' ) );
			$statusboard_data['graph']['datasequences'][] = $data_earnings;
			break;
	endswitch;

	if ( $statusboard_mode ) :
		$data = array( 'graph' => array() );
		$type = apply_filters( 'edd_statusboard_graph_type', 'bar' );
		$data['graph']['type'] = $type;
		$data = array_merge( $data, $statusboard_data );
	endif;

	return $data;
}

function edd_statusboard_profile_endpoint_display( $user ) {
	global $edd_options;

	if ( ( isset( $edd_options['api_allow_user_keys'] ) || current_user_can( 'manage_shop_settings' ) ) && current_user_can( 'view_shop_reports' ) ) {
		$user = get_userdata( $user->ID );
		$key = $user->edd_user_public_key;
		$token = hash( 'md5', $user->edd_user_secret_key . $user->edd_user_public_key );

		$sb_url_base = get_bloginfo( 'url' ) . '/edd-api';
		?>
		<h3><?php _e( 'Easy Digital Downloads - Status Board', 'edd-statusboard-txt' ); ?></h3>
		<table class="form-table">
			<tbody>
				<tr id="edd-sb-user-urls">
					<th>
						<label for="edd_set_api_key"><?php echo sprintf( __( 'Click a button to add the graph to Status Board. Requires an iPad with the <a href="%s" target="_blank">Status Board app</a> insatlled', 'edd-statusboard-txt' ), 'https://itunes.apple.com/us/app/status-board/id449955536?mt=8' ); ?></label>
					</th>
					<td>
						<a class="button secondary" id="sbsales" href="panicboard://?url=<?php echo urlencode( $sb_url_base . '/sbsales/?key=' . $key . '&token=' . $token ); ?>&panel=graph"><?php _e( 'Add Sales to Status Board', 'edd-statusboard-txt' ); ?></a> 
						<a class="button secondary" id="sbearnings" href="panicboard://?url=<?php echo urlencode( $sb_url_base . '/sbearnings/?key=' . $key . '&token=' . $token ); ?>&panel=graph"><?php _e( 'Add Earnings to Status Board', 'edd-statusboard-txt' ); ?></a> 
						<a class="button secondary" id="sbhybrid" href="panicboard://?url=<?php echo urlencode( $sb_url_base . '/sbhybrid/?key=' . $key . '&token=' . $token ); ?>&panel=graph"><?php _e( 'Add Hybrid to Status Board', 'edd-statusboard-txt' ); ?></a><br />
						<small>* <?php _e( 'These graphs are unique to your user. Each user with API Access should use their own profile to add graphs to Status Board.', 'edd-statusboard-txt' ); ?></small>
					</td>
				</tr>
			</tbody>
		</table>
	<?php }
}

function edd_statusboard_format_datapoints( $title = false, $datapoints, $color = 'green' ) {
	$return = array();

	$return['title'] = $title;
	$return['color'] = $color;

	foreach ( $datapoints as $date => $datapoint ) :
		$return['datapoints'][] = array( 'title' => date( apply_filters( 'edd_statusboard_date_format', 'n\/j' ), strtotime( $date ) ), 'value' => $datapoint );
	endforeach;

	return $return;
}