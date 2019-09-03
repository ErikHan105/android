package com.softexpert.ujs.davidhood.fragments;


import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.ActivityCompat;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;

import com.softexpert.ujs.davidhood.App;
import com.softexpert.ujs.davidhood.AskQuestionsActivity;
import com.softexpert.ujs.davidhood.LoginActivity;
import com.softexpert.ujs.davidhood.MainActivity;
import com.softexpert.ujs.davidhood.PublishActivity;
import com.softexpert.ujs.davidhood.R;
import com.softexpert.ujs.davidhood.TermsActivity;
import com.softexpert.ujs.davidhood.VideoPlayerActivity;
import com.softexpert.ujs.davidhood.WelcomeActivity;
import com.softexpert.ujs.davidhood.httpModule.RequestBuilder;
import com.softexpert.ujs.davidhood.httpModule.ResponseElement;
import com.softexpert.ujs.davidhood.httpModule.RunanbleCallback;
import com.softexpert.ujs.davidhood.widget.AlertUtil;
import com.softexpert.ujs.davidhood.widget.ProgressDialog;

/**
 * A simple {@link Fragment} subclass.
 */
public class SettingsFragment extends Fragment {
    MainActivity activity;
    ListView listView;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View v = inflater.inflate(R.layout.fragment_settings, container, false);
        listView = (ListView) v.findViewById(R.id.list_settings);
        final String[] values = new String[] {getString(R.string.general_condition), getString(R.string.about_us), getString(R.string.ask_questions), getString(R.string.publish_advertisement), getString(R.string.logout)};
        ArrayAdapter<String> adapter = new ArrayAdapter<String>(activity,
                android.R.layout.simple_list_item_1, android.R.id.text1, values);
        listView.setAdapter(adapter);
        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
                switch (i) {
                    case 0:
                        Intent intent0 = new Intent(activity, TermsActivity.class);
                        intent0.putExtra("SEL_TITLE", values[0]);
                        intent0.putExtra("SEL_TERMS", getString(R.string.general_condition_detail));
                        startActivity(intent0);
                        break;
                    case 1:
                        Intent intent1 = new Intent(activity, TermsActivity.class);
                        intent1.putExtra("SEL_TITLE", values[1]);
                        intent1.putExtra("SEL_TERMS", getString(R.string.about_us_detail));
                        startActivity(intent1);
                        break;
                    case 2:
                        Intent intent3 = new Intent(activity, AskQuestionsActivity.class);
                        startActivity(intent3);
                        break;
                    case 3:
                        Intent intent4 = new Intent(activity, PublishActivity.class);
                        startActivity(intent4);
                        break;
                    case 4:
                        App.removePreference(App.MY_INFO);
                        Intent intent = new Intent(activity, WelcomeActivity.class);
                        startActivity(intent);
                        activity.finish();
                        break;
                    default:
                }
            }
        });
        return v;
    }

    @Override
    public void onAttach(Context context) {
        super.onAttach(context);
        activity = (MainActivity)context;
    }

    @Override
    public void onDetach() {
        super.onDetach();
    }
}
