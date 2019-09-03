package com.softexpert.ujs.davidhood;

import android.app.Activity;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextUtils;
import android.text.TextWatcher;
import android.text.method.DigitsKeyListener;
import android.view.MotionEvent;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageButton;

import com.softexpert.ujs.davidhood.widget.AlertUtil;

import org.json.JSONObject;

import java.util.Calendar;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class Signup2Activity extends AppCompatActivity {
    public EditText edit_iban;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup2);

        final EditText edit_address = findViewById(R.id.edit_address);
        final EditText edit_city = findViewById(R.id.edit_city);
        final EditText edit_postal_code = findViewById(R.id.edit_postal_code);
        edit_iban = findViewById(R.id.edit_iban);

        ImageButton btn_back = (ImageButton)findViewById(R.id.btn_back);
        btn_back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });

        ImageButton btn_next = (ImageButton)findViewById(R.id.btn_next);
        btn_next.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String address = edit_address.getText().toString().trim();
                String city = edit_city.getText().toString().trim();
                String postal_code = edit_postal_code.getText().toString().trim();
                String iban = edit_iban.getText().toString().trim();

                if (address.length()*postal_code.length()*iban.length()*city.length() == 0) {
                    AlertUtil.showAlert(Signup2Activity.this, getString(R.string.fill_message));
                    return;
                }
                if (iban.length() < 26) {
                    AlertUtil.showAlert(Signup2Activity.this, getString(R.string.fill_message));
                    return;
                }
                JSONObject jsonObject = App.readPreference_JsonObject(App.SIGNUP_INFO);
                try {
                    jsonObject.put("address", address);
                    jsonObject.put("city", address);
                    jsonObject.put("postal_code", postal_code);
                    jsonObject.put("iban", iban);
                }catch (Exception e) {
                    e.printStackTrace();
                }
                App.setPreference_JsonObject(App.SIGNUP_INFO, jsonObject);
                Intent intent = new Intent(getBaseContext(), Signup3Activity.class);
                startActivity(intent);
            }
        });

        edit_iban.setOnTouchListener(new View.OnTouchListener() {
            @Override
            public boolean onTouch(View view, MotionEvent motionEvent) {
                if (edit_iban.getText().toString().equals("CHXX XXXX XXXX XXXX XXXX X")) {
                    edit_iban.setText("CH");
                    edit_iban.setSelection(2);
                }
                return false;
            }
        });

//        edit_iban.setKeyListener(
//                DigitsKeyListener.getInstance("ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890 "));
        edit_iban.addTextChangedListener(new IBANTextWatcher());
    }
    private class IBANTextWatcher implements TextWatcher {

        // means divider position is every 5th symbol
        private static final int DIVIDER_MODULO = 5;
        private static final int GROUP_SIZE = DIVIDER_MODULO - 1;
        private static final char DIVIDER = ' ';
        private static final String STRING_DIVIDER = " ";
        private String previousText = "";

        private int deleteLength;
        private int insertLength;
        private int start;

        private String regexIBAN = "(\\w{" + GROUP_SIZE + "}" + DIVIDER +
                ")*\\w{1," + GROUP_SIZE + "}";
        private Pattern patternIBAN = Pattern.compile(regexIBAN);

        @Override
        public void beforeTextChanged(final CharSequence s, final int start, final int count, final int after) {
            this.previousText = s.toString();
            this.deleteLength = count;
            this.insertLength = after;
            this.start = start;
        }

        @Override
        public void onTextChanged(final CharSequence s, final int start, final int before, final int count) {

        }

        @Override
        public void afterTextChanged(final Editable s) {
            String originalString = s.toString();
            if (originalString.length() < 2) {
                edit_iban.setText("CH");
                edit_iban.setSelection(2);
                return;
            }
            if (!previousText.equals(originalString) &&
                    !isInputCorrect(originalString)) {
                String newString = previousText.substring(0, start);
                int cursor = start;

                if (deleteLength > 0 && s.length() > 0 &&
                        (previousText.charAt(start) == DIVIDER ||
                                start == s.length())) {
                    newString = previousText.substring(0, start - 1);
                    --cursor;
                }

                if (insertLength > 0) {
                    newString += originalString.substring(start, start + insertLength);
                    newString = buildCorrectInput(newString);
                    cursor = newString.length();
                }

                newString += previousText.substring(start + deleteLength);
                s.replace(0, s.length(), buildCorrectInput(newString));
                if (cursor >= 26) {
                    return;
                }
                edit_iban.setSelection(cursor);
            }
        }

        /**
         * Check if String has the white spaces in the correct positions, meaning
         * if we have the String "123456789" and there should exist a white space
         * every 4 characters then the correct String should be "1234 5678 9".
         *
         * @param s String to be evaluated
         * @return true if string s is written correctly
         */
        private boolean isInputCorrect(String s) {
            Matcher matcherDot = patternIBAN.matcher(s);
            return matcherDot.matches();
        }

        /**
         * Puts the white spaces in the correct positions,
         * see the example in {@link IBANTextWatcher#isInputCorrect(String)}
         * to understand the correct positions.
         *
         * @param s String to be corrected.
         * @return String corrected.
         */
        private String buildCorrectInput(String s) {
            StringBuilder sbs = new StringBuilder(
                    s.replaceAll(STRING_DIVIDER, ""));

            // Insert the divider in the correct positions
            for (int i = GROUP_SIZE; i < sbs.length(); i += DIVIDER_MODULO) {
                sbs.insert(i, DIVIDER);
            }

            return sbs.toString();
        }
    }
}
