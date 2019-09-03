package com.softexpert.ujs.davidhood;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Html;
import android.text.method.LinkMovementMethod;
import android.text.method.ScrollingMovementMethod;
import android.view.View;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

public class PublishActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_publish);
        ImageButton btn_back = (ImageButton)findViewById(R.id.btn_back);
        btn_back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });

        ImageView img = (ImageView)findViewById(R.id.img);
        if (App.getSelectedLang().equals(App.Fr)) {
            img.setBackgroundResource(R.drawable.publish_fr);
        } else {
            img.setBackgroundResource(R.drawable.publish_de);
        }
        TextView txt1 = (TextView)findViewById(R.id.txt_publish1);
        TextView txt2 = (TextView)findViewById(R.id.txt_publish2);
        txt1.setText(Html.fromHtml(getString(R.string.publish_advertisement_detail1)));
        txt2.setText(Html.fromHtml(getString(R.string.publish_advertisement_detail2)));

    }
}
