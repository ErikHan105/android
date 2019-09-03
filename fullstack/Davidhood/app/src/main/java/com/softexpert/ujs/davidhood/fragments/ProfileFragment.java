package com.softexpert.ujs.davidhood.fragments;


import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.softexpert.ujs.davidhood.App;
import com.softexpert.ujs.davidhood.LoginActivity;
import com.softexpert.ujs.davidhood.MainActivity;
import com.softexpert.ujs.davidhood.ProfileEditActivity;
import com.softexpert.ujs.davidhood.R;
import com.softexpert.ujs.davidhood.VideoPlayerActivity;
import com.softexpert.ujs.davidhood.httpModule.RequestBuilder;
import com.softexpert.ujs.davidhood.httpModule.ResponseElement;
import com.softexpert.ujs.davidhood.httpModule.RunanbleCallback;
import com.softexpert.ujs.davidhood.widget.AlertUtil;
import com.softexpert.ujs.davidhood.widget.ProgressDialog;

/**
 * A simple {@link Fragment} subclass.
 */
public class ProfileFragment extends Fragment {
    MainActivity activity;
    Button btn_ask;
    LinearLayout ly_refresh;
    TextView txt_first_name, txt_last_name, txt_address, txt_postal_code, txt_iban, txt_birth_date, txt_email;
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View v = inflater.inflate(R.layout.fragment_profile, container, false);
        Button btn_here = (Button)v.findViewById(R.id.btn_here);
        btn_here.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(activity, ProfileEditActivity.class);
                intent.addFlags(Intent.FLAG_ACTIVITY_NO_ANIMATION);
                startActivity(intent);
            }
        });
        txt_first_name = v.findViewById(R.id.edit_first_name);
        txt_last_name = v.findViewById(R.id.edit_last_name);
        txt_address = v.findViewById(R.id.edit_address);
        txt_postal_code = v.findViewById(R.id.edit_postal_code);
        txt_iban = v.findViewById(R.id.edit_iban);
        txt_birth_date = v.findViewById(R.id.edit_birth_date);
        txt_email = v.findViewById(R.id.edit_email);
        ly_refresh = (LinearLayout)v.findViewById(R.id.ly_refresh);

        btn_ask = (Button)v.findViewById(R.id.btn_ask);
        btn_ask.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                ask_transferRequest();
            }
        });
        ImageButton btn_refresh = (ImageButton)v.findViewById(R.id.btn_refresh);
        btn_refresh.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                ProgressDialog.showDlg(activity);
                check_transferRequest();
            }
        });
        btn_ask.setEnabled(false);
        return v;
    }

    private void check_transferRequest() {
        RequestBuilder requestBuilder = new RequestBuilder(App.serverUrl);
        requestBuilder
                .addParam("type", "check_transfer")
                .addParam("user_id", App.getJsonValue(App.readPreference_JsonObject(App.MY_INFO), "id"))
                .sendRequest(callback1);
    }
    RunanbleCallback callback1 = new RunanbleCallback() {
        @Override
        public void finish(ResponseElement element) {
            int code = element.getStatusCode();
            ProgressDialog.hideDlg();
            switch (code) {
                case 200:
                    App.setPreference_JsonObject(App.MY_INFO, element.getJsonObject("data"));
                    activity.updateCHF();
                    btn_ask.setBackgroundColor(Color.DKGRAY);
                    ly_refresh.setVisibility(View.GONE);
                    if (Float.valueOf(App.getJsonValue(App.readPreference_JsonObject(App.MY_INFO), "price")) >= 20) {
                        btn_ask.setEnabled(true);
                        btn_ask.setBackgroundColor(getResources().getColor(R.color.colorPrimary));
                    }
                    break;
                case 201:
                    App.setPreference_JsonObject(App.MY_INFO, element.getJsonObject("data"));
                    ly_refresh.setVisibility(View.VISIBLE);
                    btn_ask.setEnabled(false);
                    btn_ask.setBackgroundColor(Color.DKGRAY);
                    break;
                case 500:
                    AlertUtil.showAlert(activity, getString(R.string.server_connection_error_message));
                    break;
                default:
                    break;
            }
        }

    };


    private void ask_transferRequest() {
        btn_ask.setEnabled(false);
        ProgressDialog.showDlg(activity);
        RequestBuilder requestBuilder = new RequestBuilder(App.serverUrl);
        requestBuilder
                .addParam("type", "ask_transfer")
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
                    ly_refresh.setVisibility(View.VISIBLE);
                    btn_ask.setEnabled(false);
                    btn_ask.setBackgroundColor(Color.DKGRAY);
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
        check_transferRequest();
    }

    @Override
    public void onDetach() {
        super.onDetach();
    }

    @Override
    public void onResume() {
        super.onResume();

        txt_first_name.setText(App.getJsonValue(App.readPreference_JsonObject(App.MY_INFO), "first_name"));
        txt_last_name.setText(App.getJsonValue(App.readPreference_JsonObject(App.MY_INFO), "last_name"));
        txt_address.setText(App.getJsonValue(App.readPreference_JsonObject(App.MY_INFO), "address"));
        txt_postal_code.setText(App.getJsonValue(App.readPreference_JsonObject(App.MY_INFO), "postal_code"));
        txt_iban.setText(App.getJsonValue(App.readPreference_JsonObject(App.MY_INFO), "iban"));
        txt_birth_date.setText(App.getJsonValue(App.readPreference_JsonObject(App.MY_INFO), "birth_date"));
        txt_email.setText(App.getJsonValue(App.readPreference_JsonObject(App.MY_INFO), "email"));

        check_transferRequest();

    }
}
