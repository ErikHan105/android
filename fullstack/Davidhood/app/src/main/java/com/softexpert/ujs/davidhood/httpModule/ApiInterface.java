package com.softexpert.ujs.davidhood.httpModule;

import okhttp3.RequestBody;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Headers;
import retrofit2.http.Multipart;
import retrofit2.http.POST;
import retrofit2.http.Part;
import retrofit2.http.Path;
import retrofit2.http.Query;

/**
 * Created by resea on 27/04/2017.
 */

public interface  ApiInterface {



    @GET("mobile")
    Call<ResponseBody> loginResponse(@Query("type") String type,
                                     @Query("email") String email,
                                     @Query("password") String password);



    @Multipart
    @Headers({"Content-Type: application/x-www-form-urlencoded", "Accept:*/*"})
    @POST("flashes")
    Call<ResponseBody> postFlashes(@Part("file\"; filename=\"flash.png\"; name=\"flash[media_item_data]\" ") RequestBody file ,
                                   @Query("flash[text]") String text,
                                   @Query("flash[who_can_view]") String whoView,
                                   @Query("flash[expires_in]") String expire,
                                   @Query("flash[view_time_limit]") String limit);


    @Multipart
//    @Headers({"Content-Type: application/x-www-form-urlencoded", "Accept:*/*"})
    @POST("flashes")
    Call<ResponseBody> postFlashe(@Part("file\"; filename=\"flash.png\"; name=\"flash[media_item_data]\"") RequestBody file ,
                                  @Part("flash[text]") RequestBody text,
                                  @Part("flash[who_can_view]") RequestBody whoView,
                                  @Part("flash[expires_in]") RequestBody expire,
                                  @Part("flash[view_time_limit]") RequestBody limit);

}