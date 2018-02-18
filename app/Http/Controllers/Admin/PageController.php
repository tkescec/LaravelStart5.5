<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Traits\FlashMessage;

class PageController extends Controller
{
    use FlashMessage;

    public function __construct()
    {
        // Middleware
        $this->middleware('sentinel.auth');
        $this->middleware('sentinel.access:pages.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel.access:pages.view', ['only' => ['index', 'show']]);
        $this->middleware('sentinel.access:pages.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel.access:pages.destroy', ['only' => ['destroy', 'restore']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Count pages from status
        $publish_count = Page::where('draft',0)->count();
        $draft_count = Page::where('draft',1)->count();
        $trash_count = Page::onlyTrashed()->count();


        switch($request->get('status')) {
            case 'published':
                $pages = Page::where('draft',0)->orderBy('created_at','DESC')->get();
            break;
            case 'drafted':
                $pages = Page::where('draft',1)->orderBy('created_at','DESC')->get();
            break;
            case 'trashed':
                $pages = Page::onlyTrashed()->orderBy('created_at','DESC')->get();
            break;
            default:
                $pages = Page::all();
            break;
        }

        return view('admin.pages.index')
            ->with('pages',$pages)
            ->with('publish_count',$publish_count)
            ->with('draft_count',$draft_count)
            ->with('trash_count',$trash_count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        // Collect data from request
        $data = array(
            'title'     => trim($request->get('page_title')),
            'content'   => $request->get('page_desc'),
            'draft'     => $request->get('status')
        );

        // Instance Page Model
        $page = new Page();

        // Save data
        try{
            $page->savePage($data);
        } catch(Exception $e) {
            session()->flash('danger', $e->getMessage());
            return redirect()->back();
        }

        FlashMessage::flashing('success', 'You have successfully added a new page.');
        return redirect()->route('pages.index','status=published');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find Page
        $page = Page::findOrFail($id);

        return view('admin.pages.edit')->with('page', $page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PageRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id)
    {
        // Find Page
        $page = Page::findOrFail($id);

        // Collect data from request
        $data = array(
            'title'     => trim($request->get('page_title')),
            'content'   => $request->get('page_desc'),
            'draft'     => $request->get('status')
        );

        // Save data
        try{
            $page->updatePage($data);
        } catch(Exception $e) {
            FlashMessage::flashing('danger', $e->getMessage());
            return redirect()->back();
        }

        FlashMessage::flashing('success', "Page '{$page->title}' has been updated.");
        return redirect()->route('pages.index','status=published');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Find Page
        $page = Page::withTrashed()->findOrFail($id);

        switch($request->get('status')) {
            case 'published':
            case 'drafted':
                $page->delete();
                FlashMessage::flashing('success', "Page '{$page->title}' has been moved to trash.");
            break;
            case 'trashed':
                $page->forceDelete();
                FlashMessage::flashing('success', "Page '{$page->title}' has been removed.");
            break;
            default:
                FlashMessage::flashing('error', "Page '{$page->title}' can not be deleted at this time. Please try again later.");
            break;
        }

        return redirect()->back();
    }

    /**
     * Restore the specified resource from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function restore($id)
     {
         // Find Page
         $page = Page::withTrashed()->findOrFail($id);

         // Restore page from trash
         $page->restore();

         FlashMessage::flashing('success', "Page '{$page->title}' has been restored.");
         return redirect()->route('pages.index','status=published');
     }
}
