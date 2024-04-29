<?php

namespace Theme\September\Http\Controllers;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Donate\Models\Donate;
use Botble\Donation\Models\Donation;
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
        if (!$request->ajax()) {
            return $response->setNextUrl(route('public.index'));
        }

        return $response->setData([
            'count' => Cart::instance('cart')->count(),
            'html' => Theme::partial('cart-panel'),
        ]);
    }

    // project
    public function getProject(Project $projectRepository)
    {
        $projects = $projectRepository->where('status', 'published')->paginate();
        \SeoHelper::setTitle('Project');

        return \Theme::scope('projects', compact('projects'))->render();
    }

    public function getProjects($slug, Project $projectRepository)
    {
        $slugData = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Project::class), Project::class);
        if (!$slugData) {
            abort(404);
        }
        $project = $projectRepository->findOrFail($slugData->reference_id);
        \SeoHelper::setTitle('Project', $project->name);

        return \Theme::scope('project', compact('project'))->render();
    }

    // Donation
    public function getDonation(Donation $donationRepository)
    {
        $donations = $donationRepository->where('status', 'published')->paginate();
        \SeoHelper::setTitle('Donations');

        return \Theme::scope('donations', compact('donations'))->render();
    }

    public function getDonations($slug, Donation $donationRepository)
    {
        $slugData = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Donation::class), Donation::class);
        if (!$slugData) {
            abort(404);
        }
        $donation = $donationRepository->findOrFail($slugData->reference_id);
        \SeoHelper::setTitle('Donation', $donation->name);

        return \Theme::scope('donation', compact('donation'))->render();
    }

    // Donate
    public function getDonate(Donate $donate)
    {
        return \Theme::scope('donate')->render();
    }

    public function storeDonate(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:12',
            'remark' => 'max:1000',
            'amount' => 'required',
            'donation_id' => 'required',
        ]);

        // Create a new Donation record
        $donate = Donate::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'remark' => $validatedData['remark'],
            'amount' => $validatedData['amount'],
            'donation_id' => $validatedData['donation_id'],

        ]);

        // Return a success message
        return redirect()->back()->with('message', 'Donation sent successfully');
    }

    // volunteer
    public function getVolunteer(Volunteer $volunteer)
    {
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
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'cv' => 'required|mimes:pdf,doc,docx|max:2048',
            'id_card_front' => 'required|image',
            'id_card_back' => 'required|image',
        ]);

        // Store the uploaded files using RvMedia::handleUpload
        $image = \RvMedia::handleUpload($request->file('image'), 0);

        $cv = \RvMedia::handleUpload($request->file('cv'), 0);
        $idCardFront = \RvMedia::handleUpload($request->file('id_card_front'), 0);
        $idCardBack = \RvMedia::handleUpload($request->file('id_card_back'), 0);

        // $cv = \RvMedia::handleUpload($request->file('cv'), 0);

        // Create a new Volunteer record
        $volunteer = Volunteer::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'education_level' => $validatedData['education_level'],
            'experience_level' => $validatedData['experience_level'],
            'position' => $validatedData['position'],
            'phone' => $validatedData['phone'],
            'remark' => $validatedData['remark'],
            'image' => $image['data']['url'],
            'cv' => $cv['data']['url'],
            'id_card_front' => $idCardFront['data']['url'],
            'id_card_back' => $idCardBack['data']['url'],
        ]);

        // Return a success message
        return redirect()->back()->with('message', 'Volunteer created successfully');
    }


}
