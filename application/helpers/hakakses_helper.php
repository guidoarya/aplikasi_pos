<?php

function check_not_admin()
{
    $ci =& get_instance();
    $user_session = $ci->session->userdata('role');
    if($user_session != 'Admin') {
        redirect('dashboard');
    }
}