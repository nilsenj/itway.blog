<?php

return array(


    /* 
    |--------------------------------------------------------------------------
    | These are config variables for Disqus commenting system
    |--------------------------------------------------------------------------
    | To use these you first have to create a new forum on Disqus: http://disqus.com/
    | Then copy and paste the PublicKey and the forum name found in the integrations.
    |
    */
    'disqus'   => array(
        'publicKey'    => env('disqus_publicKey'),
        'forum'        => '',
        'requestUrl'   => env('disqus_requestUrl'),
        'threadFormat' => 'ident:',
        'disqus_shortname'      => env('disqus_shortname'),

    ),
);
