package com.softexpert.ujs.davidhood;

import android.content.DialogInterface;
import android.content.Intent;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.Toast;

import com.softexpert.ujs.davidhood.httpModule.RequestBuilder;
import com.softexpert.ujs.davidhood.httpModule.ResponseElement;
import com.softexpert.ujs.davidhood.httpModule.RunanbleCallback;
import com.softexpert.ujs.davidhood.widget.AlertUtil;
import com.softexpert.ujs.davidhood.widget.ProgressDialog;

public class AskQuestionsActivity extends AppCompatActivity {
    Button btn_submit;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_ask_questions);
        ImageButton btn_back = (ImageButton)findViewById(R.id.btn_back);
        btn_back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
        final EditText edit_subject = (EditText)findViewById(R.id.edit_subject);
        final EditText edit_message = (EditText)findViewById(R.id.edit_message);

        btn_submit = (Button)findViewById(R.id.btn_submit);
        btn_submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                final String subject = edit_subject.getText().toString().trim();
                final String body = edit_message.getText().toString().trim();
                if (subject.length()*body.length() == 0) {
                    AlertUtil.showAlert(AskQuestionsActivity.this, getString(R.string.fill_message));
                    return;
                }
                ask_questionRequest(subject, body);
            }
        });
    }

    private void ask_questionRequest(String subject, String body) {
        btn_submit.setEnabled(false);
        ProgressDialog.showDlg(AskQuestionsActivity.this);
        RequestBuilder requestBuilder = new RequestBuilder(App.serverUrl);
        requestBuilder
                .addParam("type", "ask_question")
                .addParam("subject", subject)
                .addParam("body", body)
                .addParam("email", App.getJsonValue(App.readPreference_JsonObject(App.MY_INFO), "email"))
                .sendRequest(callback);
    }
    RunanbleCallback callback = new RunanbleCallback() {
        @Override
        public void finish(ResponseElement element) {
            int code = element.getStatusCode();
            ProgressDialog.hideDlg();
            App.EMAIL_SUCCESS = false;
            switch (code) {
                case 200:
                    AlertDialog.Builder builder = new AlertDialog.Builder(AskQuestionsActivity.this);
                    builder.setMessage(getString(R.string.email_success_message));
                    builder.setCancelable(false);
                    builder.setPositiveButton(getString(R.string.ok),new DialogInterface.OnClickListener() {
                        public void onClick(DialogInterface dialog,int id) {
                            getWindow().clearFlags(WindowManager.LayoutParams.FLAG_SPLIT_TOUCH);
                            App.EMAIL_SUCCESS = true;
                            AskQuestionsActivity.this.finish();
                        }
                    });
                    AlertDialog alert = builder.create();
                    alert.show();
                    getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
//                    Toast.makeText(AskQuestionsActivity.this, getString(R.string.email_success_message), Toast.LENGTH_SHORT).show();
                    break;
                case 400:
                    AlertUtil.showAlert(AskQuestionsActivity.this, getString(R.string.email_error_message));
                    break;
                case 500:
                    AlertUtil.showAlert(AskQuestionsActivity.this, getString(R.string.server_connection_error_message));
                    break;
                default:
                    break;
            }
            btn_submit.setEnabled(true);
        }

    };
}
