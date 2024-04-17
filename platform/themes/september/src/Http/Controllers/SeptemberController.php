<?php

namespace Theme\September\Http\Controllers;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Ecommerce\Facades\Cart;
use Botble\Project\Models\Project;
use Botble\Slug\Facades\SlugHelper;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Http\Controllers\PublicController;
use Illuminate\Http\Request;

class SeptemberController extends PublicController
{
    public function ajaxCart(Request $request, BaseHttpResponse $response)
    {
        if (! $request->ajax()) {
            return $response->setNextUrl(route('public.index'));
        }

        return $response->setData([
            'count' => Cart::instance('cart')->count(),
            'html' => Theme::partial('cart-panel'),
        ]);
    }

    public function getProject(Project $projectRepository){

        $projects = $projectRepository->where('status','published')->paginate();
        \SeoHelper::setTitle('Project');

        return \Theme::scope('projects',compact('projects'))->render();
    }

    public function getProjects($slug,Project $projectRepository){
        $slugData = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Project::class), Project::class);
        if(!$slugData){
            abort(404);
        }
        $project = $projectRepository->findOrFail($slugData->reference_id);
        \SeoHelper::setTitle('Project',$project->name);

        return \Theme::scope('project',compact('project'))->render();
    }
}
