    <?php

    /**
     * Get sql HELPER (subquery) Count table comment with post
     * @param Integer $status list (front y back) 'administrator'
     * @return String SQL
     */
    private function getSubqueryCounterComment($status, $id_post = '')
    {
        $ac_posts_id = 'ac_posts.id';
        
        if (!empty($id_post) && isset($id_post)) {
            $ac_posts_id = $id_post;
        }        
        
        if ($status == TRUE) { // List only status = 1
            $subquery = "(SELECT COUNT(ac_comments.id) FROM ac_comments WHERE ac_comments.id_post = $ac_posts_id AND ac_comments.approved = 1 AND ac_comments.status = 1) as comment_count";
        } else if ($status == FALSE) {
            $subquery = "(SELECT COUNT(ac_comments.id) FROM ac_comments WHERE ac_comments.id_post = $ac_posts_id) as comment_count";
        }
        
        return $subquery;        
    }




    /**
     * 
     */
    public function sumCommentCount($idPost)
    {
        $this->db->select('id,comment_count')->from($this->_name);
        $this->db->where('id', $idPost);
        $this->db->limit(1);
        $query = $this->db->get();
        $response = $query->row_array();  //var_dump($response);  
        if (is_array($response) && isset($response['comment_count'])) {
            $countNow = ((int) $response['comment_count']) + 1;   
            // update
            $this->db->where('id', $idPost); 
            $this->db->update( $this->_name, array('comment_count' => $countNow));
        }
    }