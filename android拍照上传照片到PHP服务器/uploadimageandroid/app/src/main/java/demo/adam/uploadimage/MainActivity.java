package demo.adam.uploadimage;

import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Environment;
import android.provider.MediaStore;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Base64;
import android.util.Log;
import android.view.View;
import android.widget.Button;

import com.zhy.http.okhttp.OkHttpUtils;
import com.zhy.http.okhttp.callback.StringCallback;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.util.Calendar;
import java.util.HashMap;

import okhttp3.Call;

public class MainActivity extends AppCompatActivity {
    private static final int CODE_CAMERA = 111;
    private Button btn_paizhao, btn_tuku;
    private String encoded_string, image_name;
    private Bitmap bitmap;
    private File file;
    private Uri file_uri;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        initView();
    }

    private void initView() {
        btn_paizhao = (Button) findViewById(R.id.btn_paizhao);
        btn_tuku = (Button) findViewById(R.id.btn_tuku);
        btn_paizhao.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
                getFileUri();
                intent.putExtra(MediaStore.EXTRA_OUTPUT, file_uri);
                startActivityForResult(intent, CODE_CAMERA);
            }
        });

    }

    private void getFileUri() {
        image_name = Calendar.getInstance().getTimeInMillis() + ".jpg";
        file = new File(Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_PICTURES) + File.separator + image_name);
        file_uri = Uri.fromFile(file);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {

        if (requestCode == CODE_CAMERA && resultCode == RESULT_OK) {
//            new EncodeImage().execute();   //把bitmap转换成base74字符串
            uploadImage2();
        }
    }

    private class EncodeImage extends AsyncTask<Void, Void, Void> {
        @Override
        protected Void doInBackground(Void... voids) {
            bitmap = BitmapFactory.decodeFile(file_uri.getPath());
            ByteArrayOutputStream stream = new ByteArrayOutputStream();
            bitmap.compress(Bitmap.CompressFormat.JPEG, 80, stream);
            byte[] array = stream.toByteArray();
            encoded_string = Base64.encodeToString(array, 0);
            bitmap.recycle();  //防止oom
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {

            uploadImage();  //上传图片
        }
    }

    private void uploadImage() {
        HashMap<String, String> map = new HashMap<>();
        map.put("encoding_string", encoded_string);
        map.put("image_name", image_name);
        OkHttpUtils.post()
                .url("http:192.168.0.115/phpdemo/uploadimage.php")
                .params(map)
                .tag(this)
                .build()
                .execute(new StringCallback() {
                    @Override
                    public void onError(Call call, Exception e, int id) {
                        Log.e("出错了", "错误信息：" + e.getMessage());
                    }

                    @Override
                    public void onResponse(String response, int id) {
                        Log.e("成功or失败", "信息：" + response);
                    }
                });
    }


    private void uploadImage2(){
        OkHttpUtils.post()
                .url("http:192.168.0.115/phpdemo/upload_file.php")
                .addFile("file",image_name,file)
                .tag(this)
                .build()
                .execute(new StringCallback() {
                    @Override
                    public void onError(Call call, Exception e, int id) {
                        Log.e("出错了", "错误信息：" + e.getMessage());
                    }

                    @Override
                    public void onResponse(String response, int id) {
                        Log.e("成功or失败", "信息：" + response);
                    }
                });

    }


    @Override
    protected void onDestroy() {

        OkHttpUtils.getInstance().cancelTag(this);
        super.onDestroy();
    }
}
