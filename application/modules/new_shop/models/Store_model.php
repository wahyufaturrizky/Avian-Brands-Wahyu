<?php if (!defined("BASEPATH")) exit('No direct script access allowed');

class Store_model extends Base_Model {

    public function __construct() {
        parent::__construct();
        $this->_table = 'mst_store_addon';
        $this->_table_alias = 'dst';
        $this->_pk_field = 'id';
    }

    /**
     * extending _get_row function in base class.
     * see base_model for more info.
     */
    protected function _extend_get_row($result)
    {
        return $result;
    }

    /**
     * extending _get_array function in base class.
     * see base_model for more info.
     */
    protected function _extend_get_array($result)
    {
        return $result;
    }

    /**
     * extending insert function in base class.
     * see base_model for more info.
     */
    protected function _extend_insert($datas)
    {
        //need to extend something?
    }

    /**
     * extending update function in base class.
     * see base_model for more info.
     */
    protected function _extend_update($datas, $condition)
    {
        //need to extend something?
    }

    /**
     * extending delete function in base class.
     * see base_model for more info.
     */
    protected function _extend_delete($condition)
    {

    }

    //get lat long of name "xxx"
	public function getLatLongByNameLimit1 ($name,$category,$lat_user,$long_user) {
		if ($name != "") {
			$query = "select * ,IFNULL((
                6373 * acos (
                  cos ( radians(?) )
                  * cos( radians( latitude ) )
                  * cos( radians( longitude ) - radians(?) )
                  + sin ( radians(?) )
                  * sin( radians( latitude ) )
                )
            ),0) AS user_distance from dtb_store_v2 where is_active = 1 and latitude != 0 and longitude != 0 and latitude is not null and longitude is not null and nama_customer LIKE ?";

			if (!empty($category)) {

				$query .= " and (";
				$i = 0;
				$total = count($category);
				foreach ($category as $cat) {
					$query .= " " .$cat['store_column'] . " = 1";
					$i++;
					if ($i < $total) $query .= " or ";
				}
				$query .= " )";

				// foreach ($category as $cat) {
					// $query .= " and avail_products LIKE '%\"{$cat}\"%'";
				// }
			}

            $query .= " ORDER BY user_distance asc";

			$query .= " limit 1";

			return $this->db->query($query, array($lat_user,$long_user,$lat_user,"%".$name."%"))->row_array();
		} else {
			return array();
		}
	}

	//get lat long of name "xxx"
	public function getLatLongByProductNameLimit1 ($products) {
		$query = "SELECT * from dtb_store_v2";

		if (!empty($products)) {
			$query .= " where is_active = 1 and latitude != 0 and longitude != 0 and latitude is not null and longitude is not null and ";
			$i = 0;
			$total = count($products);
			foreach ($products as $prd) {
				// $query .= " avail_products LIKE '%\"{$prd['product_category_id']}\"%'";
				$query .= " " .$prd['store_column'] . " = 1";
				$i++;
				if ($i < $total) $query .= " or ";
			}

			$query .= " limit 1";

			return $this->db->query($query)->row_array();
		}

		return array();
	}

    //get lat long of name "xxx"
	public function getLatLongByProductNameLimit1_apiv1 ($products) {
        $query = "SELECT * from dtb_store";

		if (!empty($products)) {
			$query .= " where is_show = 1 and status = 1 and latitude != 0 and longitude != 0 and latitude is not null and longitude is not null and ";
			$i = 0;
			$total = count($products);
			foreach ($products as $prd) {
				// $query .= " avail_products LIKE '%\"{$prd['product_category_id']}\"%'";
				$query .= " avail_products LIKE '%\"{$prd['id']}\"%'";
				$i++;
				if ($i < $total) $query .= " or ";
			}

			$query .= " limit 1";

			return $this->db->query($query)->row_array();
		}

		return array();
	}

    public function getStoreByRadiusRAND ($lat_user,$long_user,$lat,$long,$distance,$limit = null,$premium = null,$cust_color= null,$search = null,$search_by = null,$category = array(),$products = array()) {
        $query = "SELECT
                    msa.kode_customer,
                    pretty_url,
                    v2.nama_customer,
                    v2.alamat,
                    opening_hour,
                    phone,
                    msa.foto_toko_url,
                    v2.alamat,
                    v2.latitude,
                    v2.longitude,
                    (
                        6373 * acos (
                            cos ( radians(?) )
                            * cos( radians( v2.latitude ) )
                            * cos( radians( v2.longitude ) - radians(?) )
                            + sin ( radians(?) )
                            * sin( radians( v2.latitude ) )
                        )
                    ) AS distance,
                    IFNULL(
                        (
                            6373 * acos (
                                cos ( radians(?) )
                                * cos( radians( v2.latitude ) )
                                * cos( radians( v2.longitude ) - radians(?) )
                                + sin ( radians(?) )
                                * sin( radians( v2.latitude )
                            )
                        )
                    ),0) AS user_distance,
                    IFNULL(vs.rating_avg,0) as user_rating_avg,
                    IFNULL(v2.rating_avianbrands,0) as rating_avianbrands

                FROM
                    mst_store_addon msa
                    LEFT JOIN dtb_store_v2 v2 ON v2.kode_customer = msa.kode_customer
                    LEFT JOIN view_store_rating vs ON vs.foreign_key = msa.kode_customer

                WHERE
                    v2.latitude != 0
                    AND v2.longitude != 0
                    AND v2.latitude IS NOT NULL
                    AND v2.longitude IS NOT NULL
                    AND msa.is_show = ?
                    AND v2.is_active = ?";

		if (count($category) > 0) {
			$query .= " and (";
			$i = 0;
			$total = count($category);
			foreach ($category as $cat) {
	            $query .= " v2." .$cat['store_column'] . " = 1";
				$i++;
				if ($i < $total) $query .= " or ";
			}
			$query .= " )";
		}

        //kurang product
        if ($search != "") {
            if ($search_by == 2) {
                //search by toko name
                $query .= " and (v2.nama_customer like ?)";

            } else if ($search_by == 3) {
                //search by product name
				if (count($products) > 0) {
					$query .= " and (";
					$i = 0;
					$total = count($products);
					foreach ($products as $prd) {
						$query .= " v2." .$prd['store_column'] . " = 1";
						$i++;
						if ($i < $total) $query .= " or ";
					}
					$query .= " )";
				}
            }
        }

        if ($search != "" && $search_by == 2) {
            $query .= " HAVING distance < ? ORDER BY rand(".$limit.")";
        } else {
            $query .= " HAVING distance < ? ORDER BY rand(".$limit.")";
            // $query .= " GROUP By ROUND(distance) HAVING distance < ? ORDER BY distance";
        }

        if ($limit) {
            $query .= " limit $limit";
        }

		// print_r($query); exit;

        if ($search != "" && $search_by != 1 && $search_by != 3) {
            if ($search != "" && $search_by == 2) {
                return $this->db->query($query, array($lat,$long,$lat,$lat_user,$long_user,$lat_user,SHOW,STATUS_ACTIVE, "%".$search."%",$distance))->result_array();
            }
        } else {
            if ($search_by == 3 && empty($products)) {
      				return array();
      			} else {
      				return $this->db->query($query, array($lat,$long,$lat,$lat_user,$long_user,$lat_user,SHOW,STATUS_ACTIVE,$distance))->result_array();
      			}
        }

    }

    //for search module
    public function getStoreByRadiusAPI ($lat_user,$long_user,$lat,$long,$distance,$limit = null,$cust_color= null,$search = null,$search_by = null,$category = array(),$products = array()) {
        $query = "SELECT id as store_id, latitude, longitude, (
                6373 * acos (
                  cos ( radians(?) )
                  * cos( radians( latitude ) )
                  * cos( radians( longitude ) - radians(?) )
                  + sin ( radians(?) )
                  * sin( radians( latitude ) )
                )
              ) AS distance, (
                6373 * acos (
                  cos ( radians(?) )
                  * cos( radians( latitude ) )
                  * cos( radians( longitude ) - radians(?) )
                  + sin ( radians(?) )
                  * sin( radians( latitude ) )
                )
              ) AS user_distance FROM dtb_store where latitude != 0 and longitude != 0 and latitude is not null and longitude is not null and is_show = ? and status = ?";

        if ($cust_color != "") {
            $query .= " and can_custom_color = ".$cust_color;
        }

		if (!empty($category)) {
			if (array_search("3",$category) !== FALSE) $category[] = 6;
		}

        if (count($category) > 0) {
			$query .= " and (";
			$i = 0;
			$total = count($category);
			foreach ($category as $cat) {
                $cat = trim($cat);
				$query .= " avail_products LIKE '%\"{$cat}\"%'";
				$i++;
				if ($i < $total) $query .= " or ";
			}
			$query .= " )";

			// foreach ($category as $cat) {
				// $query .= " and avail_products LIKE '%\"{$cat}\"%'";
			// }
		}

        //kurang product
        if ($search != "") {
            if ($search_by == 2) {
                //search by toko name
                $query .= " and (name like ?)";

            } else if ($search_by == 3) {
                //search by product name
				if (count($products) > 0) {
					$query .= " and (";
					$i = 0;
					$total = count($products);
					foreach ($products as $prd) {
                        $prd['id'] = trim($prd['id']);
						$query .= " avail_products LIKE '%\"{$prd['id']}\"%'";
						$i++;
						if ($i < $total) $query .= " or ";
					}
					$query .= " )";
				}
            }
        }


        if ($search != "" && $search_by == 2) {
            $query .= " HAVING distance < ? ORDER BY user_distance";
        } else {
            $query .= " HAVING distance < ? ORDER BY distance";
        }

        if ($limit) {
            $query .= " limit $limit";
        }

		// print_r($query); exit;

		if ($search != "" && $search_by != 1 && $search_by != 3) {
            if ($search != "" && $search_by == 2) {
                return $this->db->query($query, array($lat,$long,$lat,$lat_user,$long_user,$lat_user,SHOW,STATUS_ACTIVE, "%".$search."%",$distance))->result_array();
            }
        } else {
			if ($search_by == 3 && empty($products)) {
				return array();
			} else {
				return $this->db->query($query, array($lat,$long,$lat,$lat_user,$long_user,$lat_user,SHOW,STATUS_ACTIVE,$distance))->result_array();
			}
        }

    }


    public function getClosestStore ($lat_user, $long_user, $limit = null) {
        $query = "SELECT customer_id as id_customer, kode_customer, latitude, longitude, (
                6373 * acos (
                  cos ( radians(?) )
                  * cos( radians( latitude ) )
                  * cos( radians( longitude ) - radians(?) )
                  + sin ( radians(?) )
                  * sin( radians( latitude ) )
                )
              ) AS distance, nama_customer FROM dtb_store_v2 where latitude != 0 and longitude != 0 and latitude is not null and longitude is not null and is_active = 1";


        $query .= " HAVING distance < 10000 ORDER BY distance";

        if ($limit) {
            $query .= " limit $limit";
        }

        return $this->db->query($query, array($lat_user, $long_user, $lat_user))->result_array();
    }

}
