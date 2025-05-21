using UnityEngine;
using UnityEngine.Networking;
using System.Collections;
using System.Collections.Generic;
using TMPro;

public class Login : MonoBehaviour
{
    private string baseUrl = "http://localhost:8080/";

    public TMP_Text txtLogger;
    public TMP_InputField txtUser, txtPass;
    public Material mat;

    // Start is called once before the first execution of Update after the MonoBehaviour is created
    void Start()
    {
        mat.color = Color.gray;
    }

    // Update is called once per frame
    void Update()
    {
        
    }

    public void tryLogin ()
    {
        string username = txtUser.text;
        string password = txtPass.text;

        if (username != "" && password != "")
            StartCoroutine(testPost(username, password));
        else
            mat.color = Color.red;
    }

    IEnumerator testPost(string username, string password)
    {
        // Multi part
        /* 
        var formData = new List<IMultipartFormSection>();
        formData.Add(new MultipartFormDataSection("username=asd&password=qwe"));
        //formData.Add(new MultipartFormFileSection("my file data", "myfile.txt"));
        using var www = UnityWebRequest.Post(baseUrl + "user", formData);
        */

        // WWWForm
        WWWForm form = new WWWForm();
        form.AddField("username", username);
        form.AddField("password", password);
        //form.AddBinaryData("fileUpload", bytes, "screenShot.png", "image/png");
        var www = UnityWebRequest.Post(baseUrl + "login", form);
        mat.color = Color.cyan;


        yield return www.SendWebRequest();
        if (www.result != UnityWebRequest.Result.Success)
        {
            Debug.Log(www.error);
        }
        else
        {
            //Debug.Log("Send to the server");
            Debug.Log(www.downloadHandler.text);
            txtLogger.text = "server: " + www.downloadHandler.text;
            //Debug.Log(www.result);
        }
    }
}
