<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spend;
use App\Models\Category;
use App\Models\Project;
use App\Models\SpendFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Facades\Response;
use Dompdf\Dompdf;
use Dompdf\Options;

class SpendController extends Controller
{
    protected $project;
    protected $category;
    protected $spend;

    public function __construct(Project $project, Category $category, Spend $spend)
    {
        $this->project = $project;
        $this->category = $category;
        $this->spend = $spend;
    }

    public function index()
    {
        $spends = $this->spend->with(['category', 'project', 'user'])->get();
        return view('spends.index', compact('spends'));
    }
    public function create()
    {
        // Fetch only the projects assigned to the currently authenticated user
        $projects = Auth::user()->projects;
    
        // Fetch all categories
        $categories = $this->category->all();
    
        // Pass both projects and categories to the view
        return view('spends.create', compact('projects', 'categories'));
    }




    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'project_id' => 'required',
            'totalAmount' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $requestData = $request->except('_token', 'image');
        $requestData['created_by'] = Auth::user()->id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Carbon::now()->timestamp . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $filename);
            $requestData['image'] = $filename;
        }

        $spend = $this->spend->create($requestData);

        if ($spend) {
            if ($request->hasFile('image')) {
                $spendFile = new SpendFile();
                $spendFile->spend_id = $spend->id;
                $spendFile->fileName = $filename;
                $spendFile->location = public_path('uploads');
                $spendFile->save();
            }
            return redirect()->route('spendsList')->withSuccess("Spend created successfully.");
        } else {
            return redirect()->back()->withError("Failed to create spend. Please try again.");
        }
    }
    public function edit($id)
    {
        $spend = $this->spend->findOrFail($id);
        $categories = $this->category->getcategoryDDL();
        $projects = $this->project->getProjectsDDL();
        return view('spends.edit', compact('spend', 'categories', 'projects'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'project_id' => 'required',
            'totalAmount' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $requestData = $request->except('_token', 'image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Carbon::now()->timestamp . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $filename);
            $requestData['image'] = $filename;
        }

        $spend = $this->spend->findOrFail($id);
        $spend->update($requestData);

        if ($request->hasFile('image')) {
            $spendFile = SpendFile::where('spend_id', $id)->first();
            if ($spendFile) {
                $spendFile->fileName = $filename;
                $spendFile->save();
            } else {
                $spendFile = new SpendFile();
                $spendFile->spend_id = $spend->id;
                $spendFile->fileName = $filename;
                $spendFile->location = 'uploads';
                $spendFile->save();
            }
        }

        return redirect()->route('spendsList')->withSuccess("Spend updated successfully.");
    }

    public function show($id)
    {
        $spend = $this->spend->findOrFail($id);
        return view('spends.show', compact('spend'));
    }
    public function destroy($id)
    {
        $spend = $this->spend->findOrFail($id);
        $spend->delete();
        return redirect()->route('spendsList')->withSuccess("Spend deleted successfully.");
    }

    public function report()
{
    // Fetch only the projects assigned to the currently authenticated user
    $projects = Auth::user()->projects;
    
    // Fetch all categories
    $categories = $this->category->getcategoryDDL();

    // Pass both projects and categories to the view
    return view('spends.report', compact('projects','categories'));
}

    public function filterReport(Request $request)
    {
        $spends = $this->spend->filterData($request->except('_token'));
        // dd($spends->toArray());
        $totalAmount = $spends->sum('totalAmount');
        $content = '';
        foreach ($spends as $key => $spend) {
            $image = '';
            if (!empty($spend->spend_files)) {
                $image = asset($spend->spend_files[0]->location . "/" . $spend->spend_files[0]->fileName);
                // $image = '<img src="'.$image.'" alt="Image" >';
            }
            $content .= '<tr>
             <td>' . ++$key . '</td>
             <td>' . $spend->title . '</td>
             <td>' . $spend->category->title . '</td>
             <td>' . $spend->project->name . '</td>
             <td>$' . number_format($spend->totalAmount, 2) . '</td>
             <td> <a data-toggle="modal" data-bigimage=' . $image . ' data-target="#myModal" onclick="modal_data(this)" ><i class = "mdi mdi-image"> </i></a>
            </td>
             <td>' . $spend->user->name . '</td>
            </tr>';
        }
        return json_encode(['contect' => $content , 'totalAmount' => $totalAmount]);
    }

    public function downloadPDF(Request $request)
{
    $spends = $this->spend->filterData($request->except('_token'));

    // Calculate total amount
    $totalAmount = $spends->sum('totalAmount');

    // Generate HTML content for the table
    $html = '<style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    border: 1px solid black;
                    padding: 8px;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
                }
            </style>';
    
    $html .= '<table>';
    $html .= '<tr><th>Spend</th><th>Category</th><th>Project</th><th>Amount</th><th>Created By</th></tr>';
    
    foreach ($spends as $spend) {
        $html .= "<tr>";
        $html .= "<td>{$spend->title}</td>";
        $html .= "<td>{$spend->category->title}</td>";
        $html .= "<td>{$spend->project->name}</td>";
        $html .= "<td>{$spend->totalAmount}</td>";
        $html .= "<td>{$spend->user->name}</td>";
        $html .= "</tr>";
    }

    // Add table footer with total amount
    $html .= '<tfoot><tr><th colspan="3">Total Amount:</th><td>$' . $totalAmount . '</td><th></th></tr></tfoot>';
    
    $html .= '</table>';

    // Generate PDF using Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    // Download PDF
    $dompdf->stream('spends_report.pdf', array('Attachment' => true));
}

    public function downloadCSV(Request $request)
    {
        $spends = $this->spend->filterData($request->except('_token'));

        $csvData = "Spend,Category,Project,Amount,Created By\n";
        foreach ($spends as $spend) {
            $csvData .= "\"{$spend->title}\",\"{$spend->category->title}\",\"{$spend->project->name}\",\"{$spend->totalAmount}\",\"{$spend->user->name}\"\n";
        }
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=spends_report.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        return Response::make($csvData, 200, $headers);
    }
}
