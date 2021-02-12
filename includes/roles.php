<?php
/**
 * Register Task Logger role.
 */
function project_crear_role() {
	add_role( 'project_manager', 'Project Manager');
}

function project_remover_role() {
	remove_role( 'project_manager', 'Project Manager');
}


function project_agregar_capabilities() {

	$roles = array( 'administrator', 'editor', 'project_manager' );

	foreach( $roles as $the_role ) {
		$role = get_role( $the_role );
		$role->add_cap( 'read' );
		$role->add_cap( 'edit_projects' );
		$role->add_cap( 'publish_projects' );
		$role->add_cap( 'edit_published_projects' );
	}

	$manager_roles = array( 'administrator', 'editor' );

	foreach( $manager_roles as $the_role ) {
		$role = get_role( $the_role );
		$role->add_cap( 'read_private_projects' );
		$role->add_cap( 'edit_others_projects' );
		$role->add_cap( 'edit_private_projects' );
		$role->add_cap( 'delete_projects' );
		$role->add_cap( 'delete_published_projects' );
		$role->add_cap( 'delete_private_projects' );
		$role->add_cap( 'delete_others_projects' );
	}

}

function project_remover_capabilities() {

	$manager_roles = array( 'administrator', 'editor' );

	foreach( $manager_roles as $the_role ) {
		$role = get_role( $the_role );
		$role->remove_cap( 'read' );
		$role->remove_cap( 'edit_projects' );
		$role->remove_cap( 'publish_projects' );
		$role->remove_cap( 'edit_published_projects' );
		$role->remove_cap( 'read_private_projects' );
		$role->remove_cap( 'edit_others_projects' );
		$role->remove_cap( 'edit_private_projects' );
		$role->remove_cap( 'delete_projects' );
		$role->remove_cap( 'delete_published_projects' );
		$role->remove_cap( 'delete_private_projects' );
		$role->remove_cap( 'delete_others_projects' );
	}

}

