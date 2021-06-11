<?php

if (!function_exists('show_text_table_data')) {
    function show_text_table_data($data_paginate): string
    {
        if ($data_paginate) {
            $from = ($data_paginate->currentPage() - 1) * $data_paginate->perPage() + 1;
            $to = $from + $data_paginate->count() - 1;
            return trans('core::table.text_data_result', [
                'num' => $data_paginate->count(),
                'from' => $from,
                'to' => $to,
                'total' => $data_paginate->total()
            ]);
        }
        return '';
    }
}