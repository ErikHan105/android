package com.softexpert.ujs.davidhood;

import android.app.Activity;
import android.content.Intent;
import android.graphics.Paint;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
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

import java.util.Calendar;

public class Signup3Activity extends AppCompatActivity {

    boolean isChecked = false;
    ImageButton btn_next;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup3);

        ImageButton btn_back = (ImageButton)findViewById(R.id.btn_back);
        btn_back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
        Button btn_condition = (Button)findViewById(R.id.btn_condition);
        btn_condition.setPaintFlags(btn_condition.getPaintFlags() | Paint.UNDERLINE_TEXT_FLAG);
        btn_condition.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent0 = new Intent(Signup3Activity.this, TermsActivity.class);
                intent0.putExtra("SEL_TITLE", getString(R.string.general_condition));
                intent0.putExtra("SEL_TERMS", getString(R.string.general_condition_detail));
                startActivity(intent0);
            }
        });

        final ImageButton btn_check = (ImageButton)findViewById(R.id.btn_check);
        btn_check.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (!isChecked) {
                    btn_check.setBackground(getResources().getDrawable(R.drawable.checked_white));
                } else {
                    btn_check.setBackground(getResources().getDrawable(R.drawable.unchecked_white));
                }
                isChecked = !isChecked;
            }
        });

        btn_next = (ImageButton)findViewById(R.id.btn_next);
        btn_next.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (!isChecked) {
                    AlertUtil.showAlert(Signup3Activity.this, getString(R.string.agree_condition_message));
                    return;
                }
                signupRequest();
            }
        });

    }

    private void signupRequest() {
        btn_next.setEnabled(false);
        ProgressDialog.showDlg(Signup3Activity.this);
        RequestBuilder requestBuilder = new RequestBuilder(App.serverUrl);
        requestBuilder
                .addParam("type", "signup")
                .addParam("param", App.readPreference_JsonObject(App.SIGNUP_INFO).toString())
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
                    getResources().updateConfiguration(App.getSelectedConfiguration(), null);
                    Intent intent = new Intent(getBaseContext(), MainActivity.class);
                    startActivity(intent);
                    Signup3Activity.this.finish();
                    Toast.makeText(getApplicationContext(), getString(R.string.signup_success_message), Toast.LENGTH_SHORT).show();
                    break;
                case 400:
                    AlertUtil.showAlert(Signup3Activity.this, getString(R.string.email_already_exists_message));
                    break;
                case 401:
                    AlertUtil.showAlert(Signup3Activity.this, getString(R.string.iban_already_exists_message));
                    break;
                case 500:
                    AlertUtil.showAlert(Signup3Activity.this, getString(R.string.server_connection_error_message));
                    break;
                default:
                    break;
            }
            btn_next.setEnabled(true);
        }

    };
}
