package com.softexpert.ujs.davidhood;

import android.app.Activity;
import android.content.Intent;
import android.content.res.Configuration;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import org.json.JSONObject;

import java.util.Locale;

public class LanguageActivity extends AppCompatActivity {
    Configuration config;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_language);

        config = App.getSelectedConfiguration();
        if (!config.locale.equals(Locale.ENGLISH)) {
            App.SEL_LANG = App.getSelectedLang();
            goWelcomeActivity();
        }

        Button btn_french = (Button)findViewById(R.id.btn_french);
        btn_french.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                App.SEL_LANG = App.Fr;
                config.locale = Locale.FRENCH;
                goWelcomeActivity();
            }
        });
        Button btn_deutsch = (Button)findViewById(R.id.btn_deutsch);
        btn_deutsch.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                App.SEL_LANG = App.De;
                config.locale = Locale.GERMAN;
                goWelcomeActivity();
            }
        });
    }

    void goWelcomeActivity() {
        getResources().updateConfiguration(config, null);
        Intent intent = new Intent(getBaseContext(), WelcomeActivity.class);
        startActivity(intent);
        finish();

    }

}
