<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\JoinRequest;
use App\Models\Property;
class CompanyController extends Controller
{
    public function index()
    {
        $title = 'Societate imobiliară';

        $user = auth()->user();
        $company = $user->company;

        return view('pages.company.assigned-company', compact('title', 'company'));
    }

    public function agencies_view()
    {
        $title = 'Societați imobiliare';

        $companies = Company::with(['members.properties'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $recentProperties = Property::latest()->take(3)->get();
        $featuredProperties = Property::where('featured', true)->take(3)->get();

        return view('pages.company.view-companies', compact('title', 'companies', 'recentProperties', 'featuredProperties'));
    }

    public function agencyProperties($companyId)
    {
        $company = Company::with('members.properties')->findOrFail($companyId);

        $title = 'Proprietăți publicate de ' . $company->name;

        $properties = Property::whereIn('user_id', $company->members->pluck('id'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.company.company-properties', compact('title', 'company', 'properties'));
    }

    public function assign()
    {
        $title = 'Alătură-te unei societăți';

        // Get all companies to display
        $companies = Company::all();

        return view('pages.company.assign-company', compact('title', 'companies'));
    }

    public function join(Company $company)
    {
        $user = auth()->user();

        if ($user->company_id) {
            return redirect()->route('companies.index')->with('error', 'Ești deja membru al unei societăți.');
        }

        if (!$company) {
            return redirect()->route('companies.index')->with('error', 'Societatea nu a fost găsită.');
        }

        // Check if the user has already requested to join this company
        if ($company->joinRequests()->where('user_id', $user->id)->exists()) {
            return redirect()->route('companies.index')->with('error', 'Ai deja o cerere în așteptare.');
        }

        // Store the join request
        $company->joinRequests()->create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        return redirect()->route('companies.index')->with('success', 'Cererea ta de alăturare este în așteptare.');
    }


    public function create()
    {
        $title = 'Creează o societate';

        return view('pages.company.create-company', compact('title'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:companies,name',
                'cui' => 'required|string|max:255|unique:companies,cui',
                'address' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:companies,email',
                'mobile_phone' => 'required|string|max:20',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        }

        $user = auth()->user();

        if ($user->type !== 'Agent imobiliar') {
            return redirect()->back()->with('error', 'Doar agenții imobiliari pot crea o societate.');
        }

        if ($user->company_id) {
            return redirect()->back()->with('error', 'Ești deja într-o societate.');
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/companies'), $imageName);
            $imagePath = 'img/companies/' . $imageName;
        }

        $company = Company::create([
            'name' => $request->name,
            'cui' => $request->cui,
            'address' => $request->address,
            'email' => $request->email,
            'mobile_phone' => $request->mobile_phone,
            'image' => $imagePath,
            'leader_id' => $user->id,
        ]);

        $user->company_id = $company->id;
        $user->save();

        return redirect()->route('companies.index')->with('success', 'Societate creată cu succes!');
    }



    public function edit($id)
    {
        $title = 'Editare societate';
        $company = Company::findOrFail($id);

        if (auth()->user()->id !== $company->leader_id) {
            abort(403, 'Nu ai permisiunea să editezi această companie.');
        }

        return view('pages.company.edit', compact('company', 'title'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        // Check if the current user is the leader of the company
        if (auth()->user()->id !== $company->leader_id) {
            abort(403, 'Nu ai permisiunea să editezi această companie.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'mobile_phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update company details
        $company->update($request->except('image'));

        // Handle image upload if there is a new image
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($company->image && file_exists(public_path($company->image))) {
                unlink(public_path($company->image)); // Delete the old image
            }

            // Store new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/companies'), $imageName);
            $imagePath = 'img/companies/' . $imageName;

            // Update the company with the new image
            $company->update(['image' => $imagePath]);
        }

        return redirect()->route('companies.index')->with('success', 'Compania a fost actualizată.');
    }



    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        if (auth()->user()->id !== $company->leader_id) {
            abort(403, 'Nu ai permisiunea să ștergi această companie.');
        }

        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Compania a fost ștearsă.');
    }

    public function members($id)
    {
        $title = 'Membrii societății';

        $company = Company::with('members')->findOrFail($id);
        $user = auth()->user();

        if ($user->company_id !== $company->id) {
            abort(403, 'Nu ai permisiunea să vizualizezi membrii acestei companii.');
        }

        return view('pages.company.members', compact('company', 'title'));
    }

    public function acceptMember($companyId, $userId)
    {
        $company = Company::findOrFail($companyId);
        $user = User::findOrFail($userId);

        if (auth()->user()->id !== $company->leader_id) {
            abort(403, 'Nu ai permisiunea să accepți membri.');
        }

        $user->update(['company_id' => $company->id]);

        return redirect()->back()->with('success', 'Utilizatorul a fost acceptat.');
    }
    public function removeMember($companyId, $memberId)
    {
        $company = Company::find($companyId);
        if (!$company) {
            return redirect()->back()->with('error', 'Compania nu a fost găsită.');
        }


        if (auth()->id() !== $company->leader_id) {
            return redirect()->back()->with('error', 'Nu ai permisiunea de a elimina membri.');
        }

        $member = User::find($memberId);
        if (!$member) {
            return redirect()->back()->with('error', 'Membrul nu a fost găsit.');
        }


        if ($member->company_id !== $company->id) {
            return redirect()->back()->with('error', 'Utilizatorul nu este membru al acestei companii.');
        }
        JoinRequest::where('company_id', $company->id)->where('user_id', $memberId)->delete();

        $member->update(['company_id' => null]);

        return redirect()->back()->with('success', 'Membrul a fost eliminat cu succes.');
    }

    public function leaveCompany()
    {
        $user = auth()->user();

        if (!$user->company_id) {
            return redirect()->back()->with('error', 'Nu ești membru al unei societăți.');
        }

        $company = Company::find($user->company_id);

        if (!$company) {
            return redirect()->back()->with('error', 'Societatea nu a fost găsită.');
        }

        if ($user->id === $company->leader_id) {
            return redirect()->back()->with('error', 'Liderul nu poate părăsi societatea.');
        }

        $user->update(['company_id' => null]);
        JoinRequest::where('company_id', $company->id)->where('user_id', $user->id)->delete();

        return redirect()->route('dash')->with('success', 'Ai părăsit societatea cu succes.');
    }
    public function approveJoinRequest($companyId, $requestId)
    {
        $company = Company::findOrFail($companyId);
        $joinRequest = $company->joinRequests()->findOrFail($requestId);

        // Ensure only the leader can approve/reject
        if (auth()->user()->id !== $company->leader_id) {
            abort(403, 'Nu ai permisiunea să aprobi această cerere.');
        }

        // Update the request status
        $joinRequest->status = 'approved';
        $joinRequest->save();

        // Assign the user to the company
        $joinRequest->user->company_id = $company->id;
        $joinRequest->user->save();

        return redirect()->route('companies.members', $company->id)->with('success', 'Cererea a fost aprobată!');
    }

    public function rejectJoinRequest($companyId, $requestId)
    {
        $company = Company::findOrFail($companyId);
        $joinRequest = $company->joinRequests()->findOrFail($requestId);

        // Ensure only the leader can approve/reject
        if (auth()->user()->id !== $company->leader_id) {
            abort(403, 'Nu ai permisiunea să respingi această cerere.');
        }

        // Reject the request
        $joinRequest->delete();

        return redirect()->route('companies.members', $company->id)->with('error', 'Cererea a fost respinsă.');
    }


}
