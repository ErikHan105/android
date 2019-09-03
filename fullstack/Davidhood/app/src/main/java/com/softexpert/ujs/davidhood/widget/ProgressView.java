package com.softexpert.ujs.davidhood.widget;

import android.content.Context;
import android.graphics.Canvas;
import android.graphics.Color;
import android.graphics.Paint;
import android.graphics.Rect;
import android.util.AttributeSet;
import android.view.View;

import com.softexpert.ujs.davidhood.R;

public class ProgressView extends View {

	private final int PGCOLOR = getResources().getColor(R.color.colorAccent);
	private final int BGCOLOR = Color.parseColor("#d0d0d0");
	private int end_val = 20;
	private float cur_val = 14;

	public ProgressView(Context context) {
		super(context);
	}

	public ProgressView(Context context, AttributeSet attrs) {
		super(context, attrs);
	}
	public void setProgress(float cur_val) {
		this.cur_val = cur_val;
		invalidate();
	}
	public void onDraw(Canvas canvas) {
		Paint paint = new Paint();
		paint.setAntiAlias(true);
		paint.setColor(PGCOLOR);
		float pg_right = getWidth()*(cur_val/end_val);
		if (cur_val > end_val) {
			pg_right = getWidth();
		}
		canvas.drawRect(new Rect(0, 0, (int)pg_right, getHeight()), paint);
	}
}
