package com.softexpert.ujs.davidhood.models;

import org.json.JSONArray;

import java.io.Serializable;

/**
 * Created by Acer on 01/12/2016.
 */

public class AdvertiseModel implements Serializable {
    public int _id;
    public String thumbnailURL;
    public String videoURL;
    public String title;
    public String description;
    public String chf;
    public String cnt;
    public String type;
    public String question;
    public String answer_json_array;
    public String updated;
    public String companyURL;

    public AdvertiseModel(int _id, String thumbnailURL, String videoURL, String title, String description, String chf, String cnt, String type, String question, String answer_json_array, String updated, String companyURL)
    {
        this._id = _id;
        this.thumbnailURL = thumbnailURL;
        this.videoURL = videoURL;
        this.title = title;
        this.description = description;
        this.chf = chf;
        this.cnt = cnt;
        this.type = type;
        this.question = question;
        this.answer_json_array = answer_json_array;
        this.updated = updated;
        this.companyURL = companyURL;
    }
    public AdvertiseModel()
    {
        this._id = 0;
        this.thumbnailURL = "https://drive.google.com/thumbnail?authuser=0&sz=w320&id=0B9EClND00YIMMlNRZm5VWHkzQk0";
        this.videoURL = "https://drive.google.com/uc?export=download&id=0B9EClND00YIMMlNRZm5VWHkzQk0";
        this.title = "Dummy rabbit";
        this.description = "Example dummy video";
        this.chf = "0";
        cnt = "0";
        type = "once";
        question = "";
        answer_json_array = "[]";
        updated = "";
        companyURL = "";
    }
}
