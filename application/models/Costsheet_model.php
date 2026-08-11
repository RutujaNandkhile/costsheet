<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Costsheet_model extends CI_Model
{
    protected $table = 'costsheets';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Insert a new costsheet record
     * @param array $data
     * @return int inserted id
     */
    public function insert_costsheet($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * Get a single costsheet record by id
     * @param int $id
     * @return object|null
     */
    public function get_costsheet($id)
    {
        return $this->db->get_where($this->table, array('id' => $id))->row();
    }

    /**
     * Get all costsheet records, latest first
     * @return array
     */
    public function get_all_costsheets()
    {
        return $this->db->order_by('id', 'DESC')->get($this->table)->result();
    }

    /**
     * Delete a costsheet record by id
     * @param int $id
     * @return bool
     */
    public function delete_costsheet($id)
    {
        return $this->db->delete($this->table, array('id' => $id));
    }
}
