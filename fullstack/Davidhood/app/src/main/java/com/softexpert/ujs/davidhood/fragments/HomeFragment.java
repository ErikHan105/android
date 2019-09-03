package com.softexpert.ujs.davidhood.fragments;

import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.os.Handler;
import android.support.v4.app.Fragment;
import android.support.v4.widget.SwipeRefreshLayout;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.Toast;

import com.softexpert.ujs.davidhood.App;
import com.softexpert.ujs.davidhood.LoginActivity;
import com.softexpert.ujs.davidhood.MainActivity;
import com.softexpert.ujs.davidhood.R;
import com.softexpert.ujs.davidhood.VideoPlayerActivity;
import com.softexpert.ujs.davidhood.adapters.AdvertiseListAdapter;
import com.softexpert.ujs.davidhood.httpModule.RequestBuilder;
import com.softexpert.ujs.davidhood.httpModule.ResponseElement;
import com.softexpert.ujs.davidhood.httpModule.RunanbleCallback;
import com.softexpert.ujs.davidhood.models.AdvertiseModel;
import com.softexpert.ujs.davidhood.widget.AlertUtil;
import com.softexpert.ujs.davidhood.widget.ProgressDialog;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;

public class HomeFragment extends Fragment {
    MainActivity activity;
    ListView listView;
    ArrayList<AdvertiseModel> arrayList =new ArrayList<>();
    SwipeRefreshLayout mSwipeRefreshLayout;
    AdvertiseListAdapter advertiseListAdapter;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View v = inflater.inflate(R.layout.fragment_home, container, false);
        mSwipeRefreshLayout = (SwipeRefreshLayout) v.findViewById(R.id.ly_refresh);
        mSwipeRefreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                get_advertisementRequest();
            }
        });
        listView = (ListView)v.findViewById(R.id.list_advertise);
        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
                AdvertiseModel advertiseModel = arrayList.get(i);
                if (advertiseModel.type.equals("once")) {
                    long updated_time = Long.parseLong(advertiseModel.updated);
                    long current_time = System.currentTimeMillis()/1000;
                    if (current_time < updated_time+24*3600) {
                        Toast.makeText(activity, getString(R.string.once_video_message), Toast.LENGTH_SHORT).show();
                        return;
                    }
                }
                Intent intent = new Intent(activity, VideoPlayerActivity.class);
                intent.putExtra("SEL_VIDEO", arrayList.get(i));
                startActivity(intent);
            }
        });
        return v;
    }
    private void refreshContent(){
        advertiseListAdapter = new AdvertiseListAdapter(activity, arrayList);
        listView.setAdapter(advertiseListAdapter);
        mSwipeRefreshLayout.setRefreshing(false);
    }
    void initArray(JSONArray array)
    {
        arrayList.clear();
        for (int i = 0; i < array.length(); i++) {
            try {
                JSONObject object = array.getJSONObject(i);
                int id = object.getInt("id");
                String title = object.getString("title");
                String description = object.getString("description");
                String chf = object.getString("price");
                String url = object.getString("url");
                String cnt = object.getString("cnt");
                String type = object.getString("type");
                String question = object.getString("question");
                String updated = object.getString("created");
                String company_url = object.getString("company_url");
                String answer_json_array = object.getString("answer");
                String google_id = url.replace("https://drive.google.com/open?id=", "");
                String thumbnail = "https://drive.google.com/thumbnail?authuser=0&sz=w320&id=" + google_id;
                url = "https://drive.google.com/uc?export=download&id=" + google_id;
                AdvertiseModel advertiseModel = new AdvertiseModel(id, thumbnail, url, title, description, chf, cnt, type, question, answer_json_array, updated, company_url);
                arrayList.add(advertiseModel);
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }

    private void get_advertisementRequest() {
        ProgressDialog.showDlg(activity);
        RequestBuilder requestBuilder = new RequestBuilder(App.serverUrl);
        requestBuilder
                .addParam("type", "get_advertisement")
                .addParam("user_id", App.getJsonValue(App.readPreference_JsonObject(App.MY_INFO), "id"))
                .sendRequest(callback);
    }
    RunanbleCallback callback = new RunanbleCallback() {
        @Override
        public void finish(ResponseElement element) {
            int code = element.getStatusCode();
            ProgressDialog.hideDlg();
            switch (code) {
                case 200:
                    initArray(element.getArray("data"));
                    refreshContent();
                    activity.updateCHF();
                    break;
                case 400:
                    AlertUtil.showAlert(activity, getString(R.string.invalid_user_message));
                    break;
                case 500:
                    AlertUtil.showAlert(activity, getString(R.string.server_connection_error_message));
                    break;
                default:
                    break;
            }
        }

    };

    @Override
    public void onAttach(Context context) {
        super.onAttach(context);
        activity = (MainActivity)context;
    }

    @Override
    public void onResume() {
        super.onResume();
        get_advertisementRequest();
    }

    @Override
    public void onDetach() {
        super.onDetach();
    }

}
