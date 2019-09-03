package com.softexpert.ujs.davidhood.adapters;

import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.Color;
import android.graphics.drawable.BitmapDrawable;
import android.media.MediaPlayer;
import android.media.ThumbnailUtils;
import android.net.Uri;
import android.provider.MediaStore;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.MediaController;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.VideoView;

import com.bumptech.glide.Glide;
import com.softexpert.ujs.davidhood.R;
import com.softexpert.ujs.davidhood.models.AdvertiseModel;
import com.softexpert.ujs.davidhood.utils.Utils;

import java.util.ArrayList;

/**
 * Created by Acer on 01/12/2016.
 */

public class AdvertiseListAdapter extends BaseAdapter
{
    ArrayList<AdvertiseModel> arrayList;
    Context context;

    AdvertiseListAdapter() {
        arrayList = null;
        context = null;
    }
    public AdvertiseListAdapter(Context _context, ArrayList<AdvertiseModel> _arrayList) {
        arrayList = _arrayList;
        context = _context;
    }
    @Override
    public int getCount() {

        if (arrayList == null)
            return 0;
        return arrayList.size();
    }

    @Override
    public Object getItem(int i) {
        return null;
    }

    @Override
    public long getItemId(int i) {
        return 0;
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        final AdvertiseModel data = arrayList.get(i);

        if (view == null) {
            LayoutInflater inflater = LayoutInflater.from(context);
            view = inflater.inflate(R.layout.cell_advertise, null);
        }
        TextView txt_title = (TextView)view.findViewById(R.id.txt_title);
        TextView txt_description = (TextView)view.findViewById(R.id.txt_description);
        TextView txt_chf = (TextView)view.findViewById(R.id.txt_chf);
        TextView txt_type = (TextView)view.findViewById(R.id.txt_type);
        TextView txt_cnt = (TextView)view.findViewById(R.id.txt_cnt);
        final ImageView img_cover = (ImageView)view.findViewById(R.id.img_cover);

        txt_title.setText(data.title);
        txt_description.setText(data.description);
        txt_chf.setText(String.valueOf(data.chf)+"CHF");
        txt_type.setText(data.type);
        txt_cnt.setText(data.cnt);
        Glide.with(context).load(data.thumbnailURL).placeholder(R.drawable.default_media).dontAnimate().into(img_cover);

        return view;
    }
}
