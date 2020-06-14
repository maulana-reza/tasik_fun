<?php 
/**
 * Menu list
 */
function get_all_menu()
{
	$menu = [
		[
			'url'	=> site_url('admin/dashboard'),
			'name' 	=>'dashboard',
		],

		[
			'url'	=> site_url('admin/dokumentasi'),
			'name' 	=>'dokumentasi',
		],
		[
			'url'	=> site_url('admin/about'),
			'name' 	=>'tentang kami',
		],
	];
	return $menu;
}
function menu_client()
{
	$menu = [
		[
			'url'	=> site_url('home'),
			'name' 	=>'HOME',
		],

		[
			'url'	=> site_url('dokumentasi'),
			'name' 	=>'KEGIATAN',
		],
		[
			'url'	=> site_url('about'),
			'name' 	=>'TENTANG KAMI',
		],
	];
	return $menu;


}
?>