<?php 
/**
 * Menu list
 */
function get_all_menu()
{
	$menu = [
		[
			'url'	=> site_url('admin'),
			'name' 	=>'dashboard',
		],
		[
			'url'	=> site_url('admin/Article'),
			'name' 	=>'Artikel',
		],
		[
			'url'	=> site_url('admin/wisata'),
			'name' 	=>'Tempat Wisata',
		],

		[
			'url'	=> site_url('admin/wisata'),
			'name' 	=>'Tentang kami',
		],
		[
			'url'	=> site_url('auth/logout'),
			'name' 	=>'keluar',
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
