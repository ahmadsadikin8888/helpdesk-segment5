<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_profiling_monthly_model extends CI_Model
{
    protected $tbl;
    protected $limit = 0;
    protected $offset = 10;

    function __construct()
    {
        parent::__construct();
        $this->tbl = "trans_profiling_monthly";
        $this->db_profiling = $this->load->database('db_profiling',TRUE);
    }

    function get_results($where = array(), $fields = array('*'), $limit = array(), $order_by = array())
    {
        $data = array();
        //select field
        if (is_array($fields)) {
            $this->db_profiling->select(implode(',', $fields));
        }
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                switch ($field) {
                    default:
                        $this->db_profiling->where($field, $value);
                        break;
                    case "or_where":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->or_where($fi, $val);
                        }
                        break;
                    case "or_where_null":
                        foreach ($value as $val) {
                            $this->db_profiling->where($val, NULL, FALSE);
                        }
                        break;
                    case "or_where_null_multi":
                        foreach ($value as $val_arr) {
                            foreach ($val_arr as $val) {
                                $this->db_profiling->where($val, NULL, FALSE);
                            }
                        }
                        break;
                    case "like":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->like($fi, $val, 'both');
                        }
                        break;
                    case "or_like":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->or_like($fi, $val, 'both');
                        }
                        break;
                    case "join":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->join($fi, $val);
                        }
                        break;
                    case "join_left":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->join($fi, $val, "INNER");
                        }
                        break;
                }
            }
        }
        //order
        if (count($order_by) > 0) {
            foreach ($order_by as $field => $typ) {
                $this->db_profiling->order_by($field, $typ);
            }
        }
        //limit
        if (count($limit) > 0) {
            $query = $this->db_profiling->get($this->db_profilingtbl, $limit['limit'], $limit['offset']);
        } else {
            $query = $this->db_profiling->get($this->db_profilingtbl);
        }
        if ($result = $query->result()) {
            $data['results'] = $result;
        }
        $data['num'] = $query->num_rows();
        return $data;
    }
    function get_results_array($where = array(), $fields = array('*'), $limit = array(), $order_by = array())
    {
        $data = array();
        //select field
        if (is_array($fields)) {
            $this->db_profiling->select(implode(',', $fields));
        }
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                switch ($field) {
                    default:
                        $this->db_profiling->where($field, $value);
                        break;
                    case "or_where":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->or_where($fi, $val);
                        }
                        break;
                    case "or_where_null":
                        foreach ($value as $val) {
                            $this->db_profiling->where($val, NULL, FALSE);
                        }
                        break;
                    case "or_where_null_multi":
                        foreach ($value as $val_arr) {
                            foreach ($val_arr as $val) {
                                $this->db_profiling->where($val, NULL, FALSE);
                            }
                        }
                        break;
                    case "like":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->like($fi, $val, 'both');
                        }
                        break;
                    case "or_like":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->or_like($fi, $val, 'both');
                        }
                        break;
                    case "join":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->join($fi, $val);
                        }
                        break;
                    case "join_left":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->join($fi, $val, "INNER");
                        }
                        break;
                }
            }
        }
        //order
        if (count($order_by) > 0) {
            foreach ($order_by as $field => $typ) {
                $this->db_profiling->order_by($field, $typ);
            }
        }
        //limit
        if (count($limit) > 0) {
            $query = $this->db_profiling->get($this->db_profilingtbl, $limit['limit'], $limit['offset']);
        } else {
            $query = $this->db_profiling->get($this->db_profilingtbl);
        }
        if ($result = $query->result_array()) {
            $data['results'] = $result;
        }
        $data['num'] = $query->num_rows();
        return $data;
    }

    function get_row($where = array(), $fields = array('*'), $order_by = array())
    {
        $data = array();
        //select field
        if (is_array($fields)) {
            $this->db_profiling->select(implode(',', $fields));
        }
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                switch ($field) {
                    default:
                        $this->db_profiling->where($field, $value);
                        break;
                    case "or_where":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->or_where($fi, $val);
                        }
                        break;
                    case "or_where_null":
                        foreach ($value as $val) {
                            $this->db_profiling->where($val, NULL, FALSE);
                        }
                        break;
                    case "like":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->like($fi, $val);
                        }
                        break;
                    case "or_like":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->or_like($fi, $val);
                        }
                        break;
                    case "join":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->join($fi, $val);
                        }
                        break;
                    case "join_left":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->join($fi, $val, "left");
                        }
                        break;
                }
            }
        }
        //order
        if (count($order_by) > 0) {
            foreach ($order_by as $field => $typ) {
                $this->db_profiling->order_by($field, $typ);
            }
        }
        $query = $this->db_profiling->get($this->db_profilingtbl);
        if ($result = $query->row()) {
            $data = $result;
        }
        return $data;
    }

    function get_count($where = array(), $limit = array(), $groupby = false, $select = array("id"))
    {
        $data = array();
        //select field
        $this->db_profiling->select($select);
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                switch ($field) {
                    default:
                        $this->db_profiling->where($field, $value);
                        break;
                    case "or_where":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->or_where($fi, $val);
                        }
                        break;
                    case "or_where_null":
                        foreach ($value as $val) {
                            $this->db_profiling->where($val, NULL, FALSE);
                        }
                        break;
                    case "like":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->like($fi, $val);
                        }
                        break;
                    case "or_like":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->or_like($fi, $val);
                        }
                        break;
                    case "join":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->join($fi, $val);
                        }
                        break;
                    case "join_left":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->join($fi, $val, "left");
                        }
                        break;
                }
            }
        }
        if ($groupby) {
            $this->db_profiling->group_by($groupby);
        }
        return $this->db_profiling->count_all_results($this->db_profilingtbl);
    }

    function add($data = array())
    {
        $this->db_profiling->insert($this->db_profilingtbl, $data);
        return $this->db_profiling->insert_id();
    }

    function get_field($data = array())
    {
        $fields = $this->db_profiling->list_fields($this->db_profilingtbl);
        return $fields;
    }

    function edit($where = array(), $data = array())
    {
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                $this->db_profiling->where($field, $value);
            }
            $this->db_profiling->update($this->db_profilingtbl, $data);
            return TRUE;
        }
        return false;
    }

    function delete($where = array())
    {
        if (is_array($where) && count($where) > 0) {
            foreach ($where as $field => $value) {
                $this->db_profiling->where($field, $value);
            }
            $this->db_profiling->delete($this->db_profilingtbl);
        }
    }

    function get_sum($where = array(), $fields)
    {
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                switch ($field) {
                    default:
                        $query = $this->db_profiling->where($field, $value);
                        break;
                    case "or_where":
                        foreach ($value as $fi => $val) {
                            $query = $this->db_profiling->or_where($fi, $val);
                        }
                        break;
                    case "like":
                        foreach ($value as $fi => $val) {
                            $query = $this->db_profiling->like($fi, $val, 'both');
                        }
                        break;
                    case "or_like":
                        foreach ($value as $fi => $val) {
                            $query = $this->db_profiling->or_like($fi, $val, 'both');
                        }
                        break;
                    case "join":
                        foreach ($value as $fi => $val) {
                            $query = $this->db_profiling->join($fi, $val);
                        }
                        break;
                    case "join_left":
                        foreach ($value as $fi => $val) {
                            $this->db_profiling->join($fi, $val, "left");
                        }
                        break;
                }
            }
        }
        $query = $this->db_profiling->select_sum($fields, 'num');
        $query = $this->db_profiling->get($this->db_profilingtbl);
        $result = $query->result();
        return $result[0]->num;
    }
    function live_query($query)
    {
        $query = $this->db_profiling->query($query);
        return $query;
    }
};
