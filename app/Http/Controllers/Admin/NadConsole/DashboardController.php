<?php

namespace App\Http\Controllers\Admin\NadConsole;

use App\Http\Controllers\Controller;
use App\Models\YoutubeVideo;
use App\NadConsole\Models\Setting;
use App\NadConsole\Services\FormBuilder;
use App\Services\GoogleManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function getChannelForm(FormBuilder $fb, $videos, $selected)
    {
        $description = Setting::where(['name' => 'channel.description'])->first()->value;
        $description_text_home_page = Setting::where(['name' => 'channel.description_text_home_page'])->first()->value;
        $brief_video = Setting::where(['name' => 'channel.brief_video'])->first()->value;

        $fb->id = 'videosForm';
        $fb->hidden('tabName', ['value' => 'channel']);
        $fb->textarea('channel_description', ['label' => 'description_in_channel_page', 'required' => true, 'rules' => 'required', 'default' => $description]);
        $fb->textarea('channel_description_text_home_page', ['label' => 'channel_description_in_home_page', 'required' => true, 'rules' => 'required', 'default' => $description_text_home_page]);
        $fb->media('channel_brief_video', ['label' => 'channel_brief_video', 'default' => $brief_video, 'multiple' => false, 'saveField' => 'id', 'required' => true, 'rules' => 'required', 'types' => 'video/mp4']);

        $fb->extraField('channel_videos', ['videos' => $videos, 'selected' => $selected]);

        $action = route('admin.channel-manager.save');

        return $fb->render($action);
    }

    public function channelManagerIndex(FormBuilder $fb)
    {
        $videos = YoutubeVideo::all();
        $selected = json_encode(YoutubeVideo::where('show', true)->get()->pluck('id')->toArray());
        $form = $this->getChannelForm($fb, $videos, $selected);
        return view('admin.dashboard.channel.index')->with([
            'form' => $form
        ]);
    }

    public function channelManagerFetch(GoogleManager $gm)
    {
        $videos = $gm->fetch();
        foreach ($videos->items as $vid) {
            if (isset($vid->id->videoId)) {
                $data = [
                    'video_id' => $vid->id->videoId,
                    'video_title' => $vid->snippet->title,
                    'thumbnail' => $vid->snippet->thumbnails->medium->url,
                ];
                $video = YoutubeVideo::firstOrNew($data);
                if (!$video->exists) {
                    $data['show'] = false;
                    $video->fill($data)->save();
                }
            }
        }
        session()->flash('success_message', 'Videos list updated successfully');
        return redirect()->route('admin.channel-manager.index');
    }

    public function channelManagerSave(Request $request)
    {
        $setting = Setting::where('name', 'channel.description')->firstOrFail();
        $setting->value = $request->channel_description;
        $setting->save();
        $setting = Setting::where('name', 'channel.description_text_home_page')->firstOrFail();
        $setting->value = $request->channel_description_text_home_page;
        $setting->save();
        $setting = Setting::where('name', 'channel.brief_video')->firstOrFail();
        $setting->value = $request->channel_brief_video;
        $setting->save();
        Artisan::call('optimize:clear');
        
        $videosIds = explode(',', $request->videos);
        $allVideos = YoutubeVideo::all();
        foreach ($allVideos as $video) {
            $video->show = in_array($video->id, $videosIds) ? true : false;
            $video->save();
        }
        session()->flash('success_message', 'Show videos updated successfully');
        return redirect()->route('admin.channel-manager.index');
    }
}
