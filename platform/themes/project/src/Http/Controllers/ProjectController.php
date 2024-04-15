<?php

namespace Theme\Project\Http\Controllers;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Project\Models\Project;
use Botble\SeoHelper\SeoHelper;
use Botble\Slug\Facades\SlugHelper;
use Botble\Theme\Http\Controllers\PublicController;
use Theme;

class ProjectController extends PublicController
{
    public function getIndex()
    {
        return parent::getIndex();
    }

    public function getView(?string $key = null,?string $prefix = null)
    {
        return parent::getView($key);
    }

    public function getSiteMapIndex(string $key = null, string $extension = 'xml')
    {
        return parent::getSiteMapIndex();
    }

    public function getProject(Project $projectRepository){

        $projects = $projectRepository->all();
        \SeoHelper::setTitle('Project');

        return \Theme::scope('project',compact('projects'))->render();
    }

    public function getProjects($slug,Project $projectRepository){
        $slugData = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Project::class), Project::class);
        if(!$slugData){
            abort(404);
        }
        $project = $projectRepository->findOrFail($slugData->reference_id);
        \SeoHelper::setTitle('Project',$project->name);
        
        return \Theme::scope('projects',compact('project'))->render();
    }


}
