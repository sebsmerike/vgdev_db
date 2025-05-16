using UnityEngine;
using UnityEngine.Networking;
using System.Collections;
using System.Collections.Generic;

public class Login : MonoBehaviour
{
    private string baseUrl = "http://localhost:8080/";

    // Start is called once before the first execution of Update after the MonoBehaviour is created
    void Start()
    {
        StartCoroutine(testPost());
    }

    // Update is called once per frame
    void Update()
    {
        
    }

    IEnumerator testPost()
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
        form.AddField("username", "nani");
        //form.AddBinaryData("fileUpload", bytes, "screenShot.png", "image/png");
        var www = UnityWebRequest.Post(baseUrl + "user", form);


        yield return www.SendWebRequest();
        if (www.result != UnityWebRequest.Result.Success)
        {
            Debug.Log(www.error);
        }
        else
        {
            Debug.Log("Send to the server");
            Debug.Log(www.downloadHandler.text);
            Debug.Log(www.result);
        }
    }
}
