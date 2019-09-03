package com.softexpert.ujs.davidhood;

import android.app.Activity;
import android.content.Intent;
import android.media.MediaPlayer;
import android.net.Uri;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.VideoView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.softexpert.ujs.davidhood.httpModule.RequestBuilder;
import com.softexpert.ujs.davidhood.httpModule.ResponseElement;
import com.softexpert.ujs.davidhood.httpModule.RunanbleCallback;
import com.softexpert.ujs.davidhood.models.AdvertiseModel;
import com.softexpert.ujs.davidhood.utils.Utils;
import com.softexpert.ujs.davidhood.widget.AlertUtil;
import com.softexpert.ujs.davidhood.widget.ProgressDialog;

import java.util.Timer;
import java.util.TimerTask;
import java.util.concurrent.TimeUnit;

public class VideoPlayerActivity extends AppCompatActivity {
    VideoView videoView;
    TextView txt_progress;
    ImageButton btn_play;
    AdvertiseModel advertiseModel;
    int duration;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_video_player);
        advertiseModel = (AdvertiseModel) getIntent().getSerializableExtra("SEL_VIDEO");

        btn_play = (ImageButton)findViewById(R.id.btn_play);
        btn_play.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (videoView.isPlaying()) {
                    btn_play.setBackgroundResource(R.drawable.play);
                    videoView.pause();
                } else {
                    btn_play.setBackgroundResource(R.drawable.pause);
                    videoView.start();
                }
            }
        });
        btn_play.setEnabled(false);
        ImageButton btn_close = (ImageButton)findViewById(R.id.btn_close);
        btn_close.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
        txt_progress = (TextView)findViewById(R.id.txt_progress);
        final ImageView img_loading = (ImageView)findViewById(R.id.img_loading);
        videoView =(VideoView)findViewById(R.id.video_view);
        videoView.setVideoURI(Uri.parse(advertiseModel.videoURL));
        Glide.with(this).load(R.drawable.loading).asGif().diskCacheStrategy(DiskCacheStrategy.SOURCE).crossFade().into(img_loading);
        videoView.requestFocus();
        videoView.start();


        videoView.setOnPreparedListener(new MediaPlayer.OnPreparedListener() {
            @Override
            public void onPrepared(MediaPlayer mediaPlayer) {
                img_loading.setVisibility(View.GONE);
                btn_play.setEnabled(true);
                btn_play.setBackgroundResource(R.drawable.pause);
                duration = videoView.getDuration();
                start_timer();
            }
        });
        videoView.setOnCompletionListener(new MediaPlayer.OnCompletionListener() {
            @Override
            public void onCompletion(MediaPlayer mp) {
                btn_play.setBackgroundResource(R.drawable.play);

                Intent intent = new Intent(VideoPlayerActivity.this, VideoEndActivity.class);
                intent.putExtra("SEL_VIDEO", advertiseModel);
                startActivity(intent);
            }
        });

    }

    private Timer timer = new Timer();
    private Handler handler = new Handler();

    private void start_timer(){
        timer = new Timer();
        handler = new Handler();

        timer.scheduleAtFixedRate(new TimerTask(){
            @Override
            public void run() {
                handler.post(new Runnable() {
                    @Override
                    public void run() {
                        if (videoView != null) {
                            if (videoView.isPlaying()) {
                                video_progress();
                            }
                        }
                    }
                });
            }
        }, 0, 500);
    }
    private void kill_timer() {
        if (timer != null) {
            timer.cancel();
            timer.purge();
            timer = null;
        }
    }
    void video_progress() {
        String cur = Utils.getFormattedTimeStr(videoView.getCurrentPosition());
        String total = Utils.getFormattedTimeStr(duration);
        txt_progress.setText(cur + "/" + total);
    }

    @Override
    protected void onDestroy() {
        kill_timer();
        videoView = null;
        super.onDestroy();
    }

    @Override
    protected void onResume() {
        super.onResume();
        if (App.BACK_TO_HOME) {
            App.BACK_TO_HOME = false;
            finish();
        }
    }
}
