<?php
// Przywileje i role//

function add_synergia_member_and_delete_other_roles()
{
    // możliwości dla 'project'
    $project_capabilities = array(
        'delete_projects' => true,
        'delete_published_projects' => true,
        'edit_projects' => true,
        'edit_others_projects' => false,
        'edit_others_posts' => true, //potrzebne do wyświetlania bloku z wypadającą listą współautorów
        'edit_published_projects' => true,
        'publish_projects' => true,
        'read' => true,
        'upload_files' => true,
        'edit_posts' => true, //potrzebne do wyświetlania innych członków w wypadającej liście
        );

    add_role('synergia_member', __('Członek Synergii'), $project_capabilities);

    add_role('ex_synergia_member', __('Były członek Synergii'), array(
        'delete_projects' => false,
        'delete_published_projects' => false,
        'edit_projects' => true,
        'edit_others_projects' => true,
        'edit_others_posts' => true,
        'edit_published_projects' => true,
        'publish_projects' => false,
        'read' => true,
        'upload_files' => false,
        ));

    remove_role('editor');
    remove_role('contributor');
    remove_role('author');
    remove_role('subscriber');
//    remove_role( 'synergia_member' );
    $synergia_member = get_role('synergia_member');

//    foreach(){} dlaczegoś nie zadziałał :(
//    bez tego nie wyświetlają się projekty w admince
//    dla administratora
    $administrator = get_role('administrator');
    $administrator->add_cap('delete_projects');
    $administrator->add_cap('delete_published_projects');
    $administrator->add_cap('delete_others_projects');
    $administrator->add_cap('edit_projects');
    $administrator->add_cap('edit_others_projects');
    $administrator->add_cap('edit_published_projects');
    $administrator->add_cap('publish_projects');
}
    add_action('after_switch_theme', 'add_synergia_member_and_delete_other_roles');
//    add_action('init', 'add_synergia_member_and_delete_other_roles');
?>
