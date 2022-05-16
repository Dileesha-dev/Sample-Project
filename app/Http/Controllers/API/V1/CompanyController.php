<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

/**
 * @group Companies
 *
 * API endpoints for managing companies
 */

class CompanyController extends Controller
{
    /**
     * List of companies.
     *
     * @response {
     * 
     *  
     *  "payload": {
     *      "current_page": 1,
     *      "data": [
     *          {
     *              "id": 2,
     *              "name": "Thiel PLC",
     *              "email": "larkin.shirley@yahoo.com",
     *              "telephone": "(617) 886-4519",
     *              "logo_url": null,
     *              "logo_path": null,
     *              "logo_disk": null,
     *              "website": "http://www.koss.info/at-incidunt-consequatur-laboriosam",
     *              "created_at": null,
     *              "updated_at": null,
     *              "deleted_at": null
     *          },
     *          {
     *              "id": 3,
     *              "name": "O'Keefe-Gerlach",
     *              "email": "rosenbaum.danielle@deckow.com",
     *              "telephone": "+13463833094",
     *              "logo_url": null,
     *              "logo_path": null,
     *              "logo_disk": null,
     *              "website": "https://schowalter.info/minima-reprehenderit-perspiciatis-et-dolorem.html",
     *              "created_at": null,
     *              "updated_at": null,
     *              "deleted_at": null
     *          },
     *          {
     *              "id": 4,
     *              "name": "Rutherford, Kozey and Daugherty",
     *              "email": "kuhic.juanita@bruen.biz",
     *              "telephone": "+1 (903) 845-4185",
     *              "logo_url": null,
     *              "logo_path": null,
     *              "logo_disk": null,
     *              "website": "http://www.reichel.com/aspernatur-accusamus-eligendi-consequatur-distinctio-vero-corrupti.html",
     *              "created_at": null,
     *              "updated_at": null,
     *              "deleted_at": null
     *          },
     *          {
     *              "id": 5,
     *              "name": "Romaguera, Heidenreich and Quitzon",
     *              "email": "genevieve.keeling@jerde.com",
     *              "telephone": "+14324240878",
     *              "logo_url": null,
     *              "logo_path": null,
     *              "logo_disk": null,
     *              "website": "http://schulist.net/",
     *              "created_at": null,
     *              "updated_at": null,
     *              "deleted_at": null
     *          },
     *          {
     *              "id": 6,
     *              "name": "Crona Group",
     *              "email": "rosa74@dach.biz",
     *              "telephone": "(714) 591-7737",
     *              "logo_url": null,
     *              "logo_path": null,
     *              "logo_disk": null,
     *              "website": "http://www.barrows.com/omnis-nostrum-tempora-velit-voluptatem-illo-at-ratione-quis.html",
     *              "created_at": null,
     *              "updated_at": null,
     *              "deleted_at": null
     *          }
     *      ],
     *      "first_page_url": "http://127.0.0.1:8000/api/v1/companies?page=1",
     *      "from": 1,
     *      "last_page": 2,
     *      "last_page_url": "http://127.0.0.1:8000/api/v1/companies?page=2",
     *      "links": [
     *          {
     *              "url": null,
     *              "label": "&laquo; Previous",
     *              "active": false
     *          },
     *          {
     *              "url": "http://127.0.0.1:8000/api/v1/companies?page=1",
     *              "label": "1",
     *              "active": true
     *          },
     *          {
     *              "url": "http://127.0.0.1:8000/api/v1/companies?page=2",
     *              "label": "2",
     *              "active": false
     *          },
     *          {
     *              "url": "http://127.0.0.1:8000/api/v1/companies?page=2",
     *              "label": "Next &raquo;",
     *              "active": false
     *          }
     *      ],
     *      "next_page_url": "http://127.0.0.1:8000/api/v1/companies?page=2",
     *      "path": "http://127.0.0.1:8000/api/v1/companies",
     *      "per_page": 5,
     *      "prev_page_url": null,
     *      "to": 5,
     *      "total": 6
     *  },
     *  "message": "All Companies"
     *  }
     * }
     */
    public function index()
    {
        return response([
            'payload' => Company::paginate(5),
            'message' => 'All Companies'
        ]);
    }


    /**
     * Create Company.
     *
     * @response {
     * 
     *  "payload": {
     *      "name": "Red Oid Traders",
     *   "email": "jack@sparrow.ship",
     *   "telephone": "0718879234",
     *   "updated_at": "2022-05-16T06:12:19.000000Z",
     *   "created_at": "2022-05-16T06:12:19.000000Z",
     *   "id": 8
     *      },
     *      "message": "Created company"
     * }
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'string|unique:companies,email|nullable|max:255',
            'telephone' => 'max:10|nullable|regex:/(0)[0-9]{9}/',
            'website' => 'max:255|nullable',
        ]);

        $company = Company::create($data);

        return response([
            'payload' => $company,
            'message' => 'Created company'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove Company.
     *
     * @response {
     * 
     *  "message": "Company deleted!"
     * }
     * @response 404 {
     * 
     *  "message": "Company not found!"
     * }
     */
    public function destroy($id)
    {
        $company = Company::find($id);

        if(!$company){
            return response(['message' => 'Company not found!'], 404);
        }

        $company->delete();
        return response(['message' => 'Company deleted!'], 200);
    }
}
