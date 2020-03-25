<?php 

class Post extends AppModel {
    public $name = 'Post';

    public $validate = array(
        'title' => array(
            'rule' => 'noBlank'
        ),
        'body' => array(
            'rule' => 'noBlank'
        )
    );
}