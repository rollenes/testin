<?php

assert_options(ASSERT_WARNING, false);

return [
    'fails' => function() {
        return assert(false);
    }
];

