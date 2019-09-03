package com.softexpert.ujs.davidhood;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;

import com.softexpert.ujs.davidhood.httpModule.RequestBuilder;
import com.softexpert.ujs.davidhood.httpModule.ResponseElement;
import com.softexpert.ujs.davidhood.httpModule.RunanbleCallback;
import com.softexpert.ujs.davidhood.widget.AlertUtil;
import com.softexpert.ujs.davidhood.widget.ProgressDialog;

import org.json.JSONObject;

import java.util.Calendar;

public class Signup1Activity extends AppCompatActivity {
    ImageButton btn_next;
    String first_name, last_name, email, birth_date, password, confirm_password;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup1);

        final EditText edit_first_name = findViewById(R.id.edit_first_name);
        final EditText edit_last_name = findViewById(R.id.edit_last_name);
        final EditText edit_email = findViewById(R.id.edit_email);
        final EditText edit_birth_date = findViewById(R.id.edit_birth_date);
        final EditText edit_password = findViewById(R.id.edit_password);
        final EditText edit_confirm_password = findViewById(R.id.edit_confirm_password);

        ImageButton btn_back = (ImageButton)findViewById(R.id.btn_back);
        btn_back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });

        btn_next = (ImageButton)findViewById(R.id.btn_next);
        btn_next.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                first_name = edit_first_name.getText().toString().trim();
                last_name = edit_last_name.getText().toString().trim();
                email = edit_email.getText().toString().trim();
                birth_date = edit_birth_date.getText().toString().trim();
                password = edit_password.getText().toString().trim();
                confirm_password = edit_confirm_password.getText().toString().trim();

                if (first_name.length()*last_name.length()*email.length()*birth_date.length()*password.length()*confirm_password.length() == 0) {
                    AlertUtil.showAlert(Signup1Activity.this, getString(R.string.fill_message));
                    return;
                }

                if (!android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
                    AlertUtil.showAlert(Signup1Activity.this, getString(R.string.invalid_email_message));
                    return;
                }
                if (password.length() < 8) {
                    AlertUtil.showAlert(Signup1Activity.this, getString(R.string.password_min_length));
                    return;
                }

                if (!password.equals(confirm_password)) {
                    AlertUtil.showAlert(Signup1Activity.this, getString(R.string.not_match_password_message));
                    return;
                }

                check_emailRequest(email);
            }
        });

        TextWatcher tw = new TextWatcher() {
            private String current = "";
            private String ddmmyyyy = "ddmmyyyy";
            private Calendar cal = Calendar.getInstance();

            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
                if (!s.toString().equals(current)) {
                    String clean = s.toString().replaceAll("[^\\d.]|\\.", "");
                    String cleanC = current.replaceAll("[^\\d.]|\\.", "");

                    int cl = clean.length();
                    int sel = cl;
                    for (int i = 2; i <= cl && i < 6; i += 2) {
                        sel++;
                    }
                    //Fix for pressing delete next to a forward slash
                    if (clean.equals(cleanC)) sel--;

                    if (clean.length() < 8){
                        clean = clean + ddmmyyyy.substring(clean.length());
                    }else{
                        //This part makes sure that when we finish entering numbers
                        //the date is correct, fixing it otherwise
                        int day  = Integer.parseInt(clean.substring(0,2));
                        int mon  = Integer.parseInt(clean.substring(2,4));
                        int year = Integer.parseInt(clean.substring(4,8));

                        mon = mon < 1 ? 1 : mon > 12 ? 12 : mon;
                        cal.set(Calendar.MONTH, mon-1);
                        year = (year<1900)?1900:(year>2100)?2100:year;
                        cal.set(Calendar.YEAR, year);
                        // ^ first set year for the line below to work correctly
                        //with leap years - otherwise, date e.g. 29/02/2012
                        //would be automatically corrected to 28/02/2012

                        day = (day > cal.getActualMaximum(Calendar.DATE))? cal.getActualMaximum(Calendar.DATE):day;
                        clean = String.format("%02d%02d%02d",day, mon, year);
                    }

                    clean = String.format("%s/%s/%s", clean.substring(0, 2),
                            clean.substring(2, 4),
                            clean.substring(4, 8));

                    sel = sel < 0 ? 0 : sel;
                    current = clean;
                    edit_birth_date.setText(current);
                    edit_birth_date.setSelection(sel < current.length() ? sel : current.length());
                }
            }

            @Override
            public void afterTextChanged(Editable editable) {

            }

            @Override
            public void beforeTextChanged(CharSequence charSequence, int i, int i1, int i2) {

            }
        };

        edit_birth_date.addTextChangedListener(tw);
    }


    private void check_emailRequest(String email) {
        btn_next.setEnabled(false);
        ProgressDialog.showDlg(Signup1Activity.this);
        RequestBuilder requestBuilder = new RequestBuilder(App.serverUrl);
        requestBuilder
                .addParam("type", "check_email")
                .addParam("email", email)
                .sendRequest(callback);
    }
    RunanbleCallback callback = new RunanbleCallback() {
        @Override
        public void finish(ResponseElement element) {
            int code = element.getStatusCode();
            ProgressDialog.hideDlg();
            switch (code) {
                case 200:
                    JSONObject jsonObject = new JSONObject();
                    try {
                        jsonObject.put("lang", App.SEL_LANG);
                        jsonObject.put("first_name", first_name);
                        jsonObject.put("last_name", last_name);
                        jsonObject.put("email", email);
                        jsonObject.put("password", password);
                        jsonObject.put("email", email);
                        jsonObject.put("birth_date", birth_date);
                    }catch (Exception e) {
                        e.printStackTrace();
                    }
                    App.setPreference_JsonObject(App.SIGNUP_INFO, jsonObject);
                    Intent intent = new Intent(getBaseContext(), Signup2Activity.class);
                    startActivity(intent);
                    break;
                case 400:
                    AlertUtil.showAlert(Signup1Activity.this, getString(R.string.email_already_exists_message));
                    break;
                case 500:
                    AlertUtil.showAlert(Signup1Activity.this, getString(R.string.server_connection_error_message));
                    break;
                default:
                    break;
            }
            btn_next.setEnabled(true);
        }

    };
}
