<?php

namespace App\Service;

class StaticHelper
{

    public static function filters($request): ?array
    {
        return [
            'page' => $request->query->getInt('page', 1) ?? 1,
            'recordsPerPage' => $request->query->get('recordsPerPage') ?? 25,
            'sort' => $request->query->get('sort'),
            'direction' => $request->query->get('direction') ?? 'desc',
            'search' => $request->query->get('search'),
        ];
    }

}
