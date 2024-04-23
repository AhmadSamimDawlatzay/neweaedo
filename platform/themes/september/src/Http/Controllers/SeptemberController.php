<?php

namespace Theme\September\Http\Controllers;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Ecommerce\Facades\Cart;
use Botble\Project\Models\Project;
use Botble\Slug\Facades\SlugHelper;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Http\Controllers\PublicController;
use Botble\Volunteer\Models\Volunteer;
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

    // volunteer
    public function getVolunteer(Volunteer $volunteer){

        return \Theme::scope('volunteer')->render();
    }


    public function storeVolunteer(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'education_level' => 'required|integer',
            'experience_level' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'phone' => 'required|string|max:12',
            'remark' => 'max:500',
            'image' => 'required|image',
            'cv' => 'required|file',
            'id_card_front' => 'required|image',
            'id_card_back' => 'required|image',
        ]);

        // Store the uploaded files and get their paths
        $imagePath = $request->file('image')->store('images');
        $cvPath = $request->file('cv')->store('cvs');
        $idCardFrontPath = $request->file('id_card_front')->store('id_cards');
        $idCardBackPath = $request->file('id_card_back')->store('id_cards');

        // Create a new Volunteer record
        $volunteer = Volunteer::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'education_level' => $validatedData['education_level'],
            'experience_level' => $validatedData['experience_level'],
            'position' => $validatedData['position'],
            'phone' => $validatedData['phone'],
            'remark' => $validatedData['remark'],
            'image' => $imagePath,
            'cv' => $cvPath,
            'id_card_front' => $idCardFrontPath,
            'id_card_back' => $idCardBackPath,
        ]);

    // Return a success message
    // return response()->json(['message' => 'Volunteer created successfully'], 201);
    // return response()->json(['success' => 'User deleted successfully']);
    return redirect()->back()->with('message', 'Volunteer created successfully');

    }

}
