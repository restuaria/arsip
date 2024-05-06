<?php

class Template_op
{

    var $template_data_op = array();

    function set($name, $value)
    {
        $this->template_data_op[$name] = $value;
    }

    function load($template_op = '', $view = '', $view_data = array(), $return = FALSE)
    {
        $this->CI = &get_instance();
        $this->set('conten', $this->CI->load->view($view, $view_data, TRUE));
        return $this->CI->load->view($template_op, $this->template_data_op, $return);
    }
}
