package com.softexpert.ujs.davidhood;

import android.content.DialogInterface;
import android.graphics.Color;
import android.support.v4.app.ActivityCompat;
import android.support.v4.view.ViewPager;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.view.WindowManager;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.softexpert.ujs.davidhood.adapters.MainTabAdapter;
import com.softexpert.ujs.davidhood.fragments.HomeFragment;
import com.softexpert.ujs.davidhood.fragments.ProfileFragment;
import com.softexpert.ujs.davidhood.fragments.SettingsFragment;
import com.softexpert.ujs.davidhood.widget.AlertUtil;
import com.softexpert.ujs.davidhood.widget.ProgressView;

import org.w3c.dom.Text;

import java.util.ArrayList;

public class MainActivity extends AppCompatActivity {
    private ViewPager vpPager;
    MainTabAdapter mainTabAdapter;
    LinearLayout ly_home, ly_my_profile, ly_settings;
    public TextView txt_title, txt_price;
    public ProgressView progressView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        this.getWindow().setSoftInputMode(WindowManager.LayoutParams.SOFT_INPUT_ADJUST_PAN);

        txt_title = (TextView)findViewById(R.id.txt_title);
        txt_price = (TextView)findViewById(R.id.txt_price);
        progressView = (ProgressView)findViewById(R.id.pv_progress);
        ly_home = (LinearLayout)findViewById(R.id.ly_home);
        ly_home.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                vpPager.setCurrentItem(0);
                setTab_home();
            }
        });
        ly_my_profile = (LinearLayout)findViewById(R.id.ly_my_profile);
        ly_my_profile.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                vpPager.setCurrentItem(1);
                setTab_profile();
            }
        });
        ly_settings = (LinearLayout)findViewById(R.id.ly_settings);
        ly_settings.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                vpPager.setCurrentItem(2);
                setTab_settings();
            }
        });
        setupTabFragments();
    }

    private void setupTabFragments()
    {
        vpPager = (ViewPager)findViewById(R.id.vp_fragment);
        HomeFragment homeFragment = new HomeFragment();
        mainTabAdapter = new MainTabAdapter(getSupportFragmentManager() );
        mainTabAdapter.addFragment(homeFragment, getResources().getString(R.string.home_top));
        ProfileFragment profileFragment = new ProfileFragment();
        mainTabAdapter.addFragment(profileFragment, getResources().getString(R.string.my_profile));
        SettingsFragment settingsFragment = new SettingsFragment();
        mainTabAdapter.addFragment(settingsFragment, getResources().getString(R.string.settings));

        vpPager.setAdapter(mainTabAdapter);
        vpPager.setOnPageChangeListener(new ViewPager.OnPageChangeListener() {
            @Override
            public void onPageScrolled(int position, float positionOffset, int positionOffsetPixels) {

            }

            @Override
            public void onPageSelected(int position) {
                switch (position) {
                    case 0:
                        setTab_home();
                        break;
                    case 1:
                        setTab_profile();
                        break;
                    case 2:
                        setTab_settings();
                        break;
                    default:
                        break;
                }
            }

            @Override
            public void onPageScrollStateChanged(int state) {

            }
        });
        setTab_home();
    }

    void initTabsColor() {
        ly_home.setBackgroundColor(Color.TRANSPARENT);
        ly_my_profile.setBackgroundColor(Color.TRANSPARENT);
        ly_settings.setBackgroundColor(Color.TRANSPARENT);
    }
    void setTab_home() {
        initTabsColor();
        ly_home.setBackgroundColor(getResources().getColor(R.color.colorAccent));
        txt_title.setText(getResources().getString(R.string.home_top));
    }
    void setTab_profile() {
        initTabsColor();
        ly_my_profile.setBackgroundColor(getResources().getColor(R.color.colorAccent));
        txt_title.setText(getResources().getString(R.string.my_profile));
    }
    void setTab_settings() {
        initTabsColor();
        ly_settings.setBackgroundColor(getResources().getColor(R.color.colorAccent));
        txt_title.setText(getResources().getString(R.string.settings));
    }

    @Override
    public void onBackPressed() {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setMessage(getString(R.string.finish_app_message));
        builder.setPositiveButton(getString(R.string.ok),new DialogInterface.OnClickListener() {
            public void onClick(DialogInterface dialog,int id) {
                ActivityCompat.finishAffinity(MainActivity.this);
                System.exit(0);
            }
        });
        builder.setNegativeButton(getString(R.string.cancel),new DialogInterface.OnClickListener() {
            public void onClick(DialogInterface dialog,int id) {
            }
        });
        AlertDialog alert = builder.create();
        alert.show();
    }

    @Override
    protected void onResume() {
        updateCHF();
        if (App.EMAIL_SUCCESS) {
            App.EMAIL_SUCCESS = false;
            vpPager.setCurrentItem(0);
        }
        super.onResume();
    }

    public void updateCHF() {
        String price = App.getJsonValue(App.readPreference_JsonObject(App.MY_INFO), "price");
        if (price.length() == 0) {
            price = "0";
        }
        txt_price.setText(price + "CHF");
        progressView.setProgress(Float.valueOf(price));
    }
}
