<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hellotreedigital\Cms\Models\CmsPage;
use Hellotreedigital\Cms\Models\Language;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Hellotreedigital\Cms\Controllers\CmsPageController;
use Hash;

class NewsListCmsController extends Controller
{
    public $appends_to_query;
    
    public function __construct(CmsPageController $cmsPageController)
    {
        $this->cmsPageController = $cmsPageController;
        $this->appends_to_query = '';
        if (
            request('page') ||
            request('per_page') ||
            request('custom_search') ||
            request('sort_by') ||
            request('sort_by_direction')
        ) $this->appends_to_query .= '?';
        if (request('page')) $this->appends_to_query .= 'page=' . request('page') . '&';
        if (request('per_page')) $this->appends_to_query .= 'per_page=' . request('per_page') . '&';
        if (request('custom_search')) $this->appends_to_query .= 'custom_search=' . request('custom_search') . '&';
        if (request('sort_by')) $this->appends_to_query .= 'sort_by=' . request('sort_by') . '&';
        if (request('sort_by_direction')) $this->appends_to_query .= 'sort_by_direction=' . request('sort_by_direction') . '&';
    }

    public function index($route = 'news-list')
    {
        $page = CmsPage::where('route', $route)->firstOrFail();
        $page_fields = json_decode($page['fields'], true);
        $extra_variables = $this->cmsPageController->getPageExtraVariables($page_fields);

        $model = 'App\\' . $page['model_name'];
        if ($page['single_record']) {
            $row = $model::first();
            if (!$row) abort(403, "Single record page has no record");
            return redirect(config('hellotree.cms_route_prefix') . '/' . $route . '/' . $row['id']);
        }

        // Default order
        $order_by = 'id';
        $order_direction = 'desc';
        $order_by_column_relationship = null;

        if (request('sort_by')) {
            foreach ($page_fields as $page_field) {
                if ($page_field['name'] == request('sort_by')) {
                    if ($page_field['form_field'] == 'select' || $page_field['form_field'] == 'select multiple') {
                        $order_by_column_relationship = $page_field;
                    }
                }
            }
            if (!$order_by_column_relationship) {
                $order_by = request('sort_by');
                $order_direction = request('sort_by_direction');
            }
        } else {
            if ($page['sort_by']) {
                $order_by = $page['sort_by'];
                $order_direction = $page['sort_by_direction'];
            } elseif ($page['order_display']) {
                $order_by = 'ht_pos';
                $order_direction = 'asc';
            }
        }
        
        $rows = $model::select($page->database_table . '.*')
            ->when($page['order_display'] && $order_by == 'ht_pos' , function ($query) use ($page) {
                return $query->orderBy($page->database_table . '.' . 'ht_pos');
            })
            ->when(request('custom_validation'), function ($query) use ($page) {
                foreach (request('custom_validation') as $validation) {
                    if ($validation['constraint'] == 'whereHas' && isset($validation['value'][1]) && count($validation['value'][1])) {
                        // Didn't use whereHas because it is making issues on same table relationship
                        $pivot_table = Str::singular($validation['value'][0]) . '_' . Str::singular($page->database_table);
                        $column_name = $validation['table'] == $page->database_table ? 'other_' . Str::singular($validation['table']) . '_id' : Str::singular($validation['table']) . '_id';
                        $second_table = uniqid();

                        $query
                            ->join($pivot_table, $pivot_table . '.' . Str::singular($page->database_table) . '_id', $page->database_table . '.id')
                            ->join($validation['table'] . ' as ' . $second_table, $pivot_table . '.' . $column_name, $second_table . '.id')
                            ->whereRaw($second_table . '.id in (' . implode(',', $validation['value'][1]) . ')');
                    } else {
                        if (isset($validation['value'][1]) && $validation['value'][1]) {
                            $query = call_user_func_array([$query, $validation['constraint']], $validation['value']);
                        }
                    }
                }
                return $query;
            })
            ->when(request('custom_search'), function ($query) use ($page_fields) {
                foreach ($page_fields as $field) {
                    if (
                        $field['form_field'] == 'password' ||
                        $field['form_field'] == 'password with confirmation' ||
                        $field['form_field'] == 'select' ||
                        $field['form_field'] == 'select multiple' ||
                        $field['form_field'] == 'checkbox' ||
                        $field['form_field'] == 'image' ||
                        $field['form_field'] == 'multiple images' ||
                        $field['form_field'] == 'file' ||
                        $field['form_field'] == 'map coordinates'
                    ) continue;
                    $query->orWhere($field['name'], 'like', '%' . request('custom_search') . '%');
                }
                return $query;
            })
            ->when(
                $order_by_column_relationship,
                function ($query) use ($order_by_column_relationship, $page) {
                    $query->when(
                        $order_by_column_relationship['form_field'] == 'select',
                        function ($query) use ($order_by_column_relationship, $page) {
                            $query
                                ->leftJoin($order_by_column_relationship['form_field_additionals_1'], $order_by_column_relationship['form_field_additionals_1'] . '.id', '=', $page['database_table'] . '.' . $order_by_column_relationship['name'])
                                ->orderBy($order_by_column_relationship['form_field_additionals_1'] . '.' . $order_by_column_relationship['form_field_additionals_2'], request('sort_by_direction'));
                        },
                        function ($query) {
                        }
                    );
                },
                function ($query) use ($page, $order_by, $order_direction) {
                    $query->orderBy($page->database_table . '.' . $order_by, $order_direction);
                }
            )
            ->when($page['server_side_pagination'], function ($query) {
                return $query->paginate(request('per_page') ? request('per_page') : 10);
            }, function ($query) {
                return $query->get();
            });

        $appends_to_query = $this->appends_to_query;

        $view = view()->exists('cms::pages/' . $route . '/index') ? 'cms::pages/' . $route . '/index' : 'cms::pages/cms-page/index';
        return view($view, compact('page', 'page_fields', 'rows', 'extra_variables', 'appends_to_query'));
    }

}
