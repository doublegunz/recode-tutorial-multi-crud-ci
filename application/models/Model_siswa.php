<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Model_siswa extends CI_Model 
	{

		function get_list()
		{
			$this->db->select("id, nama, umur, kelas");
			$this->db->from("siswa");
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get();

			return $query;
		}

		function get_edit($post)
		{
			$this->db->select("id, nama, umur, kelas");
			$this->db->from("siswa");
			$this->db->where_in('id', $post['check']);
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get();

			return $query;
		}

		function insert($result = array())
		{
			$total_array = count($result);

			if($total_array != 0)
			{
				$this->db->insert_batch('siswa', $result);
			}
		}

		function update($result = array())
		{
			$total_array = count($result);

			if($total_array != 0)
			{
				$this->db->update_batch('siswa', $result, 'id');
			}
		}

		function delete($post = array())
		{
			$total_array = count($post);

			if($total_array != 0)
			{
				$this->db->where_in('id', $post['check']);
				$this->db->delete('siswa');
			}
		}
	}
