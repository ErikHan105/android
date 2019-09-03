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

import com.softexpert.ujs.davidhood.models.AdvertiseModel;

public class TermsActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_terms);
        String title = (String) getIntent().getSerializableExtra("SEL_TITLE");
        String terms = (String) getIntent().getSerializableExtra("SEL_TERMS");

        TextView txt_title = (TextView)findViewById(R.id.txt_title);
        TextView txt_terms = (TextView)findViewById(R.id.txt_terms);
        txt_terms.setMovementMethod(new ScrollingMovementMethod());
        txt_terms.setClickable(true);
        txt_terms.setMovementMethod (LinkMovementMethod.getInstance());
        txt_title.setText(title);
        txt_terms.setText(Html.fromHtml(terms));
        ImageButton btn_back = (ImageButton)findViewById(R.id.btn_back);
        btn_back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });

        ImageView img1 = (ImageView)findViewById(R.id.img1);
        ImageView img2 = (ImageView)findViewById(R.id.img2);
        ImageView img3 = (ImageView)findViewById(R.id.img3);
        if (!txt_title.getText().toString().equals(getString(R.string.about_us))) {
            LinearLayout ly_image = (LinearLayout)findViewById(R.id.ly_image);
            ly_image.setVisibility(View.GONE);
        } else {
            if (App.getSelectedLang().equals(App.Fr)) {
                img1.setBackgroundResource(R.drawable.about_fr_1);
                img2.setBackgroundResource(R.drawable.about_fr_2);
                img3.setBackgroundResource(R.drawable.about_fr_3);
            } else {
                img1.setBackgroundResource(R.drawable.about_de_1);
                img2.setBackgroundResource(R.drawable.about_de_2);
                img3.setBackgroundResource(R.drawable.about_de_3);
            }
        }
    }
}
