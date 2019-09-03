package com.softexpert.ujs.davidhood;

import android.app.Activity;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.InputType;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.Toast;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import com.softexpert.ujs.davidhood.httpModule.ApiInterface;
import com.softexpert.ujs.davidhood.httpModule.RequestBuilder;
import com.softexpert.ujs.davidhood.httpModule.ResponseElement;
import com.softexpert.ujs.davidhood.httpModule.RunanbleCallback;
import com.softexpert.ujs.davidhood.widget.AlertUtil;
import com.softexpert.ujs.davidhood.widget.ProgressDialog;

import org.json.JSONObject;

import java.net.CookieHandler;
import java.util.Locale;

import okhttp3.JavaNetCookieJar;
import okhttp3.OkHttpClient;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class LoginActivity extends AppCompatActivity {
    ImageButton btn_next;
    String email = "", password = "";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        Button btn_forgot_password = (Button)findViewById(R.id.btn_forgot_password);
        btn_forgot_password.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AlertUtil.showAlert( LoginActivity.this, getString(R.string.forgot_password_description));
            }
        });
        ImageButton btn_back = (ImageButton)findViewById(R.id.btn_back);
        final EditText edit_email = (EditText)findViewById(R.id.edit_email);
        final EditText edit_password = (EditText)findViewById(R.id.edit_password);

        final JSONObject jsonObject = App.readPreference_JsonObject(App.MY_INFO);
        if ( jsonObject != null) {
            email = App.getJsonValue(jsonObject, "email");
            password = App.getJsonValue(jsonObject, "password");
        }


        btn_back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
//                Intent intent = new Intent(getBaseContext(), WelcomeActivity.class);
//                startActivity(intent);
                finish();
            }
        });

        final Button btn_show = (Button)findViewById(R.id.btn_show);
        btn_show.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (edit_password.getInputType() == (InputType.TYPE_CLASS_TEXT |
                        InputType.TYPE_TEXT_VARIATION_PASSWORD)) {
                    edit_password.setInputType(InputType.TYPE_CLASS_TEXT |
                            InputType.TYPE_TEXT_VARIATION_NORMAL);
                    btn_show.setText(getResources().getString(R.string.hide));
                } else {
                    edit_password.setInputType(InputType.TYPE_CLASS_TEXT |
                            InputType.TYPE_TEXT_VARIATION_PASSWORD);
                    btn_show.setText(getResources().getString(R.string.show));
                }
            }
        });

        btn_next = (ImageButton)findViewById(R.id.btn_next);
        btn_next.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String email = edit_email.getText().toString().trim();
                String password = edit_password.getText().toString();

                if (email.length()*password.length() == 0) {
                    AlertUtil.showAlert(LoginActivity.this, getString(R.string.fill_message));
                    return;
                }
                if (!android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
                    AlertUtil.showAlert(LoginActivity.this, getString(R.string.invalid_email_message));
                    return;
                }
                if (password.length() < 8) {
                    AlertUtil.showAlert(LoginActivity.this, getString(R.string.password_min_length));
                    return;
                }

                loginRequest(email, password);
//                loginAPI(email, password);
            }
        });

        // auto login-------------
        if (email.length() > 0) {
            edit_email.setText(email);
            edit_password.setText(password);
            loginRequest(email, password);
        }
    }

    private void loginRequest(String email, String password) {
        btn_next.setEnabled(false);
        ProgressDialog.showDlg(LoginActivity.this);
        RequestBuilder requestBuilder = new RequestBuilder(App.serverUrl);
        requestBuilder
                .addParam("type", "login")
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
                    getResources().updateConfiguration(App.getSelectedConfiguration(), null);
                    Intent intent = new Intent(getBaseContext(), MainActivity.class);
                    startActivity(intent);
                    LoginActivity.this.finish();
                    break;
                case 400:
                    AlertUtil.showAlert(LoginActivity.this, getString(R.string.email_password_wrong_message));
                    break;
                case 500:
                    AlertUtil.showAlert(LoginActivity.this, getString(R.string.server_connection_error_message));
                    break;
                default:
                    break;
            }
            btn_next.setEnabled(true);
        }

    };

    /*----------------- Http module --------------
    private void loginAPI(String email, String password){
        final String root_URL = "http://192.168.0.107/davidhood/index.php/";

        Gson gson = new GsonBuilder()
                .setLenient()
                .create();

        // Add the interceptor to OkHttpClient
        OkHttpClient.Builder builder = new OkHttpClient.Builder();
        OkHttpClient client = builder.build();

        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl(root_URL)
                .client(client)
                .addConverterFactory(GsonConverterFactory.create(gson))
                .build();

        ApiInterface apiInterface = retrofit.create(ApiInterface.class);
        Call<ResponseBody> call = apiInterface.loginResponse("login", email, password);
        call.enqueue(new Callback<ResponseBody>() {
            @Override
            public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {


                if (response.isSuccessful()){

                    ResponseBody loginResult = response.body();
                    Log.d("fdsa", "fdsa");
                } else {

                }
            }

            @Override
            public void onFailure(Call<ResponseBody> call, Throwable t) {

                t.printStackTrace();
            }
        });
    }
    --------------------*/
}
