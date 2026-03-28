<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\{InvoiceResource, InvoiceCollection};
use Illuminate\Http\Request;
use App\Filters\V1\InvoicesFilter;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $filter = new InvoicesFilter();
        $queryItems = $filter->transform($request); // [['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            return new InvoiceCollection(Invoice::paginate());
        } else {
            $invoices = Invoice::where($queryItems)->paginate();

            return new InvoiceCollection($invoices->appends($request->query()));
        }
    }

    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    public function destroy(Invoice $invoice)
    {
        //
    }
}
