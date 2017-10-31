<?php

class MY_Session extends CI_Session {

    /**
     * Update an existing session
     *
     * @access    public
     * @return    void
    */
    function sess_update() {
     $CI =&get_instance();

        if ( ! $CI->input->is_ajax_request())
        {
            parent::sess_update();
        }
    }
}
