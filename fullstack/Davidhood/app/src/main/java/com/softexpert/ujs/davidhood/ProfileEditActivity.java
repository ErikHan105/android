package com.softexpert.ujs.davidhood;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.Toast;

import com.softexpert.ujs.davidhood.httpModule.RequestBuilder;
import com.softexpert.ujs.davidhood.httpModule.ResponseElement;
import com.softexpert.ujs.davidhood.httpModule.RunanbleCallback;
import com.softexpert.ujs.davidhood.widget.AlertUtil;
import com.softexpert.ujs.davidhood.widget.ProgressDialog;

public class ProfileEditActivity extends AppCompatActivity {
    boolean isEmailChecked = false;
    boolean isPasswordChecked = false;
    Button btn_update;
    String email, password, confirm_password;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile_edit);

        final EditText edit_email = (EditText)findViewById(R.id.edit_email);
        final EditText edit_password = (EditText)findViewById(R.id.edit_password);
        final EditText edit_confirm_password = (EditText)findViewById(R.id.edit_confirm_password);
        btn_update = (Button)findViewById(R.id.btn_update);
        Button btn_cover = (Button)findViewById(R.id.btn_cover);
        btn_cover.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
        final ImageButton btn_check_email = (ImageButton)findViewById(R.id.btn_check_email);
        btn_check_email.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (!isEmailChecked) {
                    btn_check_email.setBackground(getResources().getDrawable(R.drawable.checked_black));
                } else {
                    btn_check_email.setBackground(getResources().getDrawable(R.drawable.unchecked_black));
                }
                isEmailChecked = !isEmailChecked;
            }
        });
        final ImageButton btn_check_password = (ImageButton) findViewById(R.id.btn_check_password);
        btn_check_password.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (!isPasswordChecked) {
                    btn_check_password.setBackground(getResources().getDrawable(R.drawable.checked_black));
                } else {
                    btn_check_password.setBackground(getResources().getDrawable(R.drawable.unchecked_black));
                }
                isPasswordChecked = !isPasswordChecked;
            }
        });
        btn_update.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (!isEmailChecked && !isPasswordChecked) {
                    AlertUtil.showAlert(ProfileEditActivity.this, getString(R.string.choose_option_message));
                    return;
                }
                email = edit_email.getText().toString();
                password = edit_password.getText().toString();
                confirm_password = edit_confirm_password.getText().toString();

                if (isEmailChecked) {
                    if (email.length() == 0) {
                        AlertUtil.showAlert(ProfileEditActivity.this, getString(R.string.fill_message));
                        return;
                    }
                    if (!android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
                        AlertUtil.showAlert(ProfileEditActivity.this, getString(R.string.invalid_email_message));
                        return;
                    }
                } else {
                    email = App.getJsonValue(App.readPreference_JsonObject(App.MY_INFO), "email");
                }

                if (isPasswordChecked) {
                    if (password.length()*confirm_password.length() == 0) {
                        AlertUtil.showAlert(ProfileEditActivity.this, getString(R.string.fill_message));
                        return;
                    }
                    if (!password.equals(confirm_password)) {
                        AlertUtil.showAlert(ProfileEditActivity.this, getString(R.string.not_match_password_message));
                        return;
                    }
                } else {
                    password = App.getJsonValue(App.readPreference_JsonObject(App.MY_INFO), "password");
                }

                profile_updateRequest(email, password);
            }
        });
    }


    private void profile_updateRequest(String email, String password) {
        btn_update.setEnabled(false);
        ProgressDialog.showDlg(ProfileEditActivity.this);
        RequestBuilder requestBuilder = new RequestBuilder(App.serverUrl);
        requestBuilder
                .addParam("type", "profile_update")
                .addParam("id", App.getJsonValue(App.readPreference_JsonObject(App.MY_INFO), "id"))
                .addParam("email", email)
                .addParam("password", password)
                .sendRequest(callback);
    }
    RunanbleCallback callback = new RunanbleCallback() {
        @Override
        public void finish(ResponseElement element) {
            int code = element.getStatusCode();
            ProgressDialog.hideDlg();
            switch (code) {
                case 200:
                    App.setPreference_JsonObject(App.MY_INFO, element.getJsonObject("data"));
                    ProfileEditActivity.this.finish();
                    Toast.makeText(getBaseContext(), getString(R.string.profile_update_success_message), Toast.LENGTH_SHORT).show();
                    break;
                case 400:
                    AlertUtil.showAlert(ProfileEditActivity.this, getString(R.string.email_already_exists_message));
                    break;
                case 500:
                    AlertUtil.showAlert(ProfileEditActivity.this, getString(R.string.server_connection_error_message));
                    break;
                default:
                    break;
            }
            btn_update.setEnabled(true);
        }

    };
    @Override
    protected void onPause() {
        super.onPause();
        overridePendingTransition(0, 0);
    }
}
