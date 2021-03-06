<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Telegram;
use App\Models\Topic;
use App\Models\TopicReply;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Telegram\Bot\Laravel\Facades\Telegram as FacadesTelegram;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $forums  = Forum::latest()->get();
        $forum = Forum::find($id);
        return view('client.new-topic',compact('forums','forum'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $notify = 0;
        if($request->notify && $request->notify == "on"){
            $notify = 1;
        }

        $topic = new Topic();
        $topic->title = $request->title;
        $topic->desc = $request->desc;
        $topic->forum_id = $request->forum_id;
        $topic->user_id = auth()->id();
        $topic->notify = $notify;
        $topic->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = Topic::find($id);
        if($topic){
            $topic->increment('views',1);
        }
        return view('client.topic',compact('topic'));
    }

    /**
     * Save reply to the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reply(Request $request, $id)
    {
        $reply = new TopicReply();
        $reply->desc = $request->desc;
        $reply->user_id = auth()->id();
        $reply->topic_id = $id;
        $topic = Topic::find($id);
        $forumId = $topic->forum->id;
        $url = url('/client/topic/'.$reply->topic_id);
        $reply->save();
        Telegram::sendMessage([
            'chat_id'=>env('TELEGRAM_CHAT_ID', '-694394981'),
            'parse_mode'=>'HTML',
            'text'=>"<b>".auth()->user()->name."</b>"." replied to the topic: <b>".$topic->title."</b>\n"."<b>Reply: </b>".$request->desc."\n"."<a href='".$url."'>Read it here</a>"
        ]);
        toastr()->success('Reply sent successsfully');
        return back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reply = TopicReply::find($id);
        $reply->delete();
        toastr()->success("Reply deleted successfully");
        return back();
    }

    public function updates(){
        $updates = Telegram::getUpdates();
        dd($updates);
    }
}
