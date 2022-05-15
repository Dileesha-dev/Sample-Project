<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyCover;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    protected $companyRepo;

    public function __construct(CompanyRepository $companyRepo)
    {
        $this->companyRepo = $companyRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company.index', ['companies' => Company::paginate(3)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->companyRepo->validateInput($request);
        $logoImageData = ($request->hasFile('logo') ? $this->companyRepo->uploadImage($request, Company::IS_LOGO) : null);
        $coversImageData = ($request->hasFile('covers') ?  $this->companyRepo->uploadImage($request, Company::IS_COVER) : null);
        $data = $request->except('logo', '_token');
        if($logoImageData) $data += ['logo_url' => $logoImageData['logo_url'], 'logo_path' => $logoImageData['logo_path'], 'logo_disk' => $logoImageData['logo_disk']];
        $company = Company::create($data);
        if($coversImageData){
            foreach ($coversImageData as $coversImage) {
                CompanyCover::create([
                    'company_id' => $company->id,
                    'cover_url' => $coversImage['cover_url'],
                    'cover_path' => $coversImage['cover_path'],
                    'cover_disk' => $coversImage['cover_disk']
                ]);
            }
        }
        return back()->with('success', 'Company Successfully Updated!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($company)
    {
        $company = Company::findOrFail($company);
        return view('company.show', ['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
