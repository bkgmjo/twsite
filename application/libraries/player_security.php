<?php
    /*    Basic security class o)-<| */
    class Player_security {
        public function __construct() {
            $this->ci =& get_instance();
        }

        public function isLoggedIn() {
            return ($this->ci->session->userdata('logged_in') == 'true');
        }

        public function login($playerData) {
            $this->ci->session->set_userdata(array(
                'logged_in'   => 'true', 
                'player_name' => $playerData['player_name'],
                'player_id'   => $playerData['id']
            ));
        }

		public function hasAccess($to) {
			$this->ci->load->model('access_model');
			
			if(!$this->isLoggedIn()) return false;

			return $this->ci->access_model->hasAccess($this->ci->session->userdata('player_id'), $to);
		}

        public function logout() {
            $this->ci->session->set_userdata(array('logged_in' => ''));
            $this->ci->session->sess_destroy();
        }
    }
