<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
abstract class Base_Model extends Super_Base_Model
{
    // initial for field active, initial 1 or 0 into string yes or no
    public static $status = array(
        1 => "Yes",
        0 => "No"
    );

    public static $status_from = array(
        1 => "Avian",
        2 => "Bukan Avian"
    );

    // initial for field admin_type, initial 1, 2 and 3 into string Superadmin, Admin and Viewer
    public static $admin_type = array(
        1 => "Superadmin",
    );

    public static $is_show = array(
        1 => "Show",
        0 => "Hide",
    );

    public static $is_interior = array(
        1 => "Yes",
        0 => "No",
    );

    public static $colorable = array(
        1 => "Yes",
        0 => "No",
    );

    public static $is_published = array(
        1 => "Yes",
        0 => "No",
    );

    public static $show_in = array(
        1 => "All",
        2 => "User",
        3 => "Profesional",
    );

    public static $menu_type = array(
        1 => "User",
        2 => "Profesional"
    );

    public static $branch_type = array(
        1 => "Branch",
        2 => "Agent"
    );

    public static $article_type = array(
        1 => "Tips",
        2 => "Article",
        3 => "News"
    );

    public static $show_type_filter = array(
        1 => "Show",
        0 => "Hide"
    );

    public static $is_hot = array(
        1=> "Yes",
        0=> "No"
    );

    public static $in_show = array(
        1 => "Yes",
        0 => "No"
    );

    public static $is_popup = array(
        1 => "Yes",
        0 => "No",
    );

    public static $is_avian = array(
        1 => "Yes",
        0 => "No",
    );

    public static $show_popup = array(
        1 => "Yes",
        0 => "No"
    );

    public static $status_review = array(
        2 => "Rejected",
        1 => "Approved",
        0 => "Unapproved"
    );

    public static $visualizer_type = array(
        0 => "Hide",
        1 => "Show in Interior",
        2 => "Show in Exterior",
        3 => "Show in Interior & Exterior",
    );

    public static $is_banned = array(
        1 => "Yes",
        0 => "No",
    );

    public static $tipe_csr = array(
        1 => "Pendidikan",
        2 => "Lingkungan",
        3 => "Bencana Alam",
    );

    public static $tinting_text_product_detail = array(
        0 => ".",
        1 => " dan hanya ready mix.",
        2 => " dan hanya tinting.",
        3 => ", bisa ready mix dan tinting.",
    );

    /**
     * Constructor, use child implementation to set protected class variables.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * this function is for private use only, to get query result as a single row only.
     */
    protected function _get_row()
    {
        $result = $this->db->get()->row_array();

        if (isset($result['status']) && array_key_exists($result['status'], self::$status) === TRUE) {
            $result['status_name'] = self::$status[$result['status']];
        }

        if (isset($result['is_show']) && array_key_exists($result['is_show'], self::$is_show) === TRUE) {
            $result['is_show_name'] = self::$is_show[$result['is_show']];
        }

        if (isset($result['is_banned']) && array_key_exists($result['is_banned'], self::$is_banned) === TRUE) {
            $result['is_banned_name'] = self::$is_banned[$result['is_banned']];
        }

        if (isset($result['is_hot_item']) && array_key_exists($result['is_hot_item'], self::$is_show) === TRUE) {
            $result['is_hot_item_name'] = self::$is_hot[$result['is_hot_item']];
        }

        if (isset($result['is_published']) && array_key_exists($result['is_published'], self::$is_published) === TRUE) {
            $result['is_published_name'] = self::$is_published[$result['is_published']];
        }

        if (isset($result['is_interior']) && array_key_exists($result['is_interior'], self::$is_interior) === TRUE) {
            $result['is_interior_name'] = self::$is_interior[$result['is_interior']];
        }

        if (isset($result['colorable']) && array_key_exists($result['colorable'], self::$colorable) === TRUE) {
            $result['colorable_name'] = self::$colorable[$result['colorable']];
        }

        if (isset($result['visualizer_type']) && array_key_exists($result['visualizer_type'], self::$visualizer_type) === TRUE) {
            $result['visualizer_type_name'] = self::$visualizer_type[$result['visualizer_type']];
        }

        if ($this->_table == "dtb_admin" && isset($result['type']) && array_key_exists($result['type'], self::$admin_type) === TRUE) {
            $result['type_name'] = self::$admin_type[$result['type']];
        }

        if ($this->_table == "dtb_menu" && isset($result['type']) && array_key_exists($result['type'], self::$menu_type) === TRUE) {
            $result['type_name'] = self::$menu_type[$result['type']];
        }

        if ($this->_table == "dtb_branch" && isset($result['type']) && array_key_exists($result['type'], self::$branch_type) === TRUE) {
            $result['type_name'] = self::$branch_type[$result['type']];
        }

        if ($this->_table == "dtb_article" && isset($result['type']) && array_key_exists($result['type'], self::$article_type) === TRUE) {
            $result['type_name'] = self::$article_type[$result['type']];
        }

        if ($this->_table == "dtb_product" && isset($result['show_in_filter']) && array_key_exists($result['show_in_filter'], self::$in_show) === TRUE) {
            $result['show_in_name'] = self::$in_show[$result['show_in_filter']];
        }

        if (isset($result['sticky_flag']) && array_key_exists($result['sticky_flag'], self::$status) === TRUE) {
            $result['sticky_flag_name'] = self::$status[$result['sticky_flag']];
        }

        if (isset($result['is_from_avian']) && array_key_exists($result['is_from_avian'], self::$status_from) === TRUE) {
            $result['is_from_avian_name'] = self::$status_from[$result['is_from_avian']];
        }

        if (isset($result['status_review']) && array_key_exists($result['status_review'], self::$status_from) === TRUE) {
            $result['status_review_name'] = self::$status_review[$result['status_review']];
        }

        if (isset($data['show_in_store_filter']) && array_key_exists($data['show_in_store_filter'], self::$is_show) === TRUE) {
            $result['show_filter_name'] = self::$is_show[$data['show_in_store_filter']];
        }

        //execute extends in child class.
        $result = $this->_extend_get_row($result);

        return $result;
    }

    /**
     * this function is for private use only, to get query result as array.
     */
    protected function _get_array()
    {
        $result = $this->db->get()->result_array();

        if (count($result) > 0) {
			foreach ($result as $key => $data) {

                if (isset($data['status']) && array_key_exists($data['status'], self::$status) === TRUE) {
                    $result[$key]['status_name'] = self::$status[$data['status']];
                }

                if (isset($data['is_show']) && array_key_exists($data['is_show'], self::$is_show) === TRUE) {
                    $result[$key]['is_show_name'] = self::$is_show[$data['is_show']];
                }

                if (isset($data['is_banned']) && array_key_exists($data['is_banned'], self::$is_banned) === TRUE) {
                    $result[$key]['is_banned_name'] = self::$is_banned[$data['is_banned']];
                }

                if (isset($data['is_published']) && array_key_exists($data['is_published'], self::$is_published) === TRUE) {
                    $result[$key]['is_published_name'] = self::$is_published[$data['is_published']];
                }

                if (isset($data['is_interior']) && array_key_exists($data['is_interior'], self::$is_interior) === TRUE) {
                    $result[$key]['is_interior_name'] = self::$is_interior[$data['is_interior']];
                }

                if (isset($data['colorable']) && array_key_exists($data['colorable'], self::$colorable) === TRUE) {
                    $result[$key]['colorable_name'] = self::$colorable[$data['colorable']];
                }

                if (isset($data['visualizer_type']) && array_key_exists($data['visualizer_type'], self::$visualizer_type) === TRUE) {
                    $result[$key]['visualizer_type_name'] = self::$visualizer_type[$data['visualizer_type']];
                }

                if ($this->_table == "dtb_admin" && isset($data['type']) && array_key_exists($data['type'], self::$admin_type) === TRUE) {
                    $result[$key]['type_name'] = self::$admin_type[$data['type']];
                }

                if ($this->_table == "dtb_menu" && isset($data['type']) && array_key_exists($data['type'], self::$menu_type) === TRUE) {
                    $result[$key]['type_name'] = self::$menu_type[$data['type']];
                }

                if ($this->_table == "dtb_branch" && isset($data['type']) && array_key_exists($data['type'], self::$branch_type) === TRUE) {
                    $result[$key]['type_name'] = self::$branch_type[$data['type']];
                }

                if ($this->_table == "dtb_article" && isset($data['type']) && array_key_exists($data['type'], self::$article_type) === TRUE) {
                    $result[$key]['type_name'] = self::$article_type[$data['type']];
                }

                if ($this->_table == "dtb_product" && isset($result['show_in_filter']) && array_key_exists($result['show_in_filter'], self::$is_show) === TRUE) {
                    $result['show_in_name'] = self::$is_show[$result['show_in_filter']];
                }

                if (isset($data['is_hot_item']) && array_key_exists($data['is_hot_item'], self::$is_hot) === TRUE) {
                    $result[$key]['hot_name'] = self::$is_hot[$data['is_hot_item']];
                }

                if (isset($data['show_in_filter']) && array_key_exists($data['show_in_filter'], self::$in_show) === TRUE) {
                    $result[$key]['show_in_name'] = self::$in_show[$data['show_in_filter']];
                }

                if (isset($data['sticky_flag']) && array_key_exists($data['sticky_flag'], self::$status) === TRUE) {
                    $result[$key]['sticky_flag_name'] = self::$status[$data['sticky_flag']];
                }

                if (isset($data['is_from_avian']) && array_key_exists($data['is_from_avian'], self::$status_from) === TRUE) {
                    $result[$key]['is_from_avian_name'] = self::$status_from[$data['is_from_avian']];
                }

                if (isset($data['show_in_store_filter']) && array_key_exists($data['show_in_store_filter'], self::$is_show) === TRUE) {
                    $result[$key]['show_filter_name'] = self::$is_show[$data['show_in_store_filter']];
                }

            }
		}

        //execute extends in child class.
        $result = $this->_extend_get_array($result);

        return $result;
    }

}
