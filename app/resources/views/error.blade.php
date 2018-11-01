Error!!<br>
<?php 

    var_dump($_REQUEST);

    $params = [
        'Param 1',
        'Param 2',
        'Param 3',
        [
            'Subparam 1',
            'Subparam 2'
        ],
        'Param 4',
        [
            'Subparam 3',
            'Subparam 4',
            'Subparam 5'
        ],
        'Param 5',
        'Param 6'
    ];
    
    var_dump($_db->user('Omar')
                    ->token('token')
                    ->nri('1814759185')
                    ->mode('modo')
                    ->search('searchData')
                    ->function('X.0.test')
                    ->params($params)
                    ->execute());
