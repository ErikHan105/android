package com.softexpert.ujs.davidhood;

import android.content.Intent;
import android.graphics.Color;
import android.net.Uri;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Gravity;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.softexpert.ujs.davidhood.httpModule.RequestBuilder;
import com.softexpert.ujs.davidhood.httpModule.ResponseElement;
import com.softexpert.ujs.davidhood.httpModule.RunanbleCallback;
import com.softexpert.ujs.davidhood.models.AdvertiseModel;
import com.softexpert.ujs.davidhood.widget.AlertUtil;
import com.softexpert.ujs.davidhood.widget.ProgressDialog;

import org.json.JSONArray;

public class VideoEndActivity extends AppCompatActivity {
    AdvertiseModel advertiseModel;
    LinearLayout ly_qa, ly_more;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_video_end);
        advertiseModel = (AdvertiseModel) getIntent().getSerializableExtra("SEL_VIDEO");

        TextView txt_question = (TextView)findViewById(R.id.txt_question);
        txt_question.setText(advertiseModel.question);
        ly_qa = (LinearLayout)findViewById(R.id.ly_qa);
        ly_more = (LinearLayout)findViewById(R.id.ly_more);
        if (advertiseModel.question.length() == 0) {
            read_videoRequest();
        } else {
            ly_qa.setVisibility(View.VISIBLE);
            ly_more.setVisibility(View.GONE);
        }
        ListView listView;
        listView = (ListView)findViewById(R.id.list_answer);
        JSONArray answer_array = null;
        try {
            answer_array = new JSONArray(advertiseModel.answer_json_array);
        } catch (Exception e) {
            e.printStackTrace();
        }
        final String[] values = new String[answer_array.length()];
        final int[] isright = new int[answer_array.length()];
        for (int i = 0; i < answer_array.length(); i++) {
            try {
                values[i] = answer_array.getJSONObject(i).getString("answer");
                isright[i] = answer_array.getJSONObject(i).getInt("isright");
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
        ArrayAdapter<String> adapter = new ArrayAdapter<String>(this, R.layout.cell_answer, R.id.txt_answer, values);
        listView.setAdapter(adapter);
        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
                if (isright[i] == 1) {
                    read_videoRequest();
                    Toast.makeText(getApplicationContext(), getString(R.string.right_answer_message), Toast.LENGTH_SHORT).show();
                } else {
                    finish();
                    Toast.makeText(getApplicationContext(), getString(R.string.wrong_answer_message), Toast.LENGTH_SHORT).show();
                }
            }
        });

        Button btn_more = (Button)findViewById(R.id.btn_more);
        btn_more.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                try {
                    Intent browserIntent = new Intent(Intent.ACTION_VIEW, Uri.parse(advertiseModel.companyURL));
                    startActivity(browserIntent);
                } catch (Exception e) {
                    Toast.makeText(VideoEndActivity.this, getString(R.string.invalid_url_message), Toast.LENGTH_SHORT).show();
                }
            }
        });

        Button btn_back = (Button)findViewById(R.id.btn_back);
        btn_back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
    }


    private void read_videoRequest() {
        ProgressDialog.showDlg(VideoEndActivity.this);
        RequestBuilder requestBuilder = new RequestBuilder(App.serverUrl);
        requestBuilder
                .addParam("type", "read_video")
                .addParam("user_id", App.getJsonValue(App.readPreference_JsonObject(App.MY_INFO), "id"))
                .addParam("advertise_id", String.valueOf(advertiseModel._id))
                .sendRequest(callback);
    }
    RunanbleCallback callback = new RunanbleCallback() {
        @Override
        public void finish(ResponseElement element) {
            int code = element.getStatusCode();
            ProgressDialog.hideDlg();
            switch (code) {
                case 200:
                    ly_qa.setVisibility(View.GONE);
                    ly_more.setVisibility(View.VISIBLE);
                    App.BACK_TO_HOME = true;
                    break;
                case 500:
                    AlertUtil.showAlert(VideoEndActivity.this, getString(R.string.server_connection_error_message));
                    break;
                default:
                    break;
            }
        }

    };
}
