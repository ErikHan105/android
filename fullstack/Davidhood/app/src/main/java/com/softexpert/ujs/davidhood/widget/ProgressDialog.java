package com.softexpert.ujs.davidhood.widget;

import android.app.Dialog;
import android.content.Context;
import android.view.animation.Animation;
import android.view.animation.LinearInterpolator;
import android.view.animation.RotateAnimation;
import android.widget.ImageView;

import com.softexpert.ujs.davidhood.R;


public class ProgressDialog extends Dialog {
    private static ProgressDialog progressDialog;
    private ImageView iv;
    public ProgressDialog(Context context) {
        super(context, R.style.TransparentProgressDialog);
        setContentView(R.layout.dialog_progress);
        setTitle(null);
        setCancelable(false);
        setOnCancelListener(null);
        iv = (ImageView)findViewById(R.id.iv_progress);
    }

    @Override
    public void show() {
        super.show();
        RotateAnimation anim = new RotateAnimation(0.0f, 360.0f , Animation.RELATIVE_TO_SELF, .5f, Animation.RELATIVE_TO_SELF, .5f);
        anim.setInterpolator(new LinearInterpolator());
        anim.setRepeatCount(Animation.INFINITE);
        anim.setDuration(1000);
        iv.setAnimation(anim);
        iv.startAnimation(anim);
    }

    public static void showDlg(Context context) {
        if (progressDialog != null) {
            progressDialog = null;
        }

        progressDialog = new ProgressDialog(context);
        progressDialog.show();
    }

    public static void hideDlg() {
        if (progressDialog == null)
            return;

        if (progressDialog.isShowing())
            progressDialog.dismiss();

        progressDialog = null;
    }
}
